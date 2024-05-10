<?php 
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShoppingCartItem;
use App\Models\ShoppingCart;

use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendReceiptOrder;
use Illuminate\Database\QueryException;
class StripeController extends Controller
{
    public function shoppingCart()
            {
            $user = Auth::user();
            $shoppingCart = $user->getShoppingCart;
            $totalPrice = 0;
            if ($shoppingCart) {
                $shoppingCart->load('getShoppingCartItem.getProduct');
                $shoppingCart = $shoppingCart->first();
                foreach ($shoppingCart->getShoppingCartItem as $item) {
                    $totalPrice += $item->quantity * $item->getProduct->price;
                }
            }

            return view('payment.shoppingCart', compact('user', 'shoppingCart', 'totalPrice'));
            }

            public function addToCart(Request $request)
{
    // Retrieve the product ID and quantity from the request
    $productId = $request->input('productId');
    $quantity = 1; // You can modify this to get the quantity from the request if needed

    // Check if the product exists
    $product = Product::find($productId);
    if (!$product) {
        return redirect()->back()->with('error', 'Product not found.');
    }

    // Retrieve the user's shopping cart or create a new one if it doesn't exist
    $userId = auth()->id(); // Assuming you have authentication set up
    $shoppingCart = ShoppingCart::where('user_id', $userId)->first();
    if (!$shoppingCart) {
        $shoppingCart = new ShoppingCart();
        $shoppingCart->user_id = $userId;
        $shoppingCart->save();
    }

    // Check if the product is already in the cart, if so, update the quantity
    $existingItem = ShoppingCartItem::where('cart_id', $shoppingCart->id)
        ->where('product_id', $productId)
        ->first();

    if ($existingItem) {
        $existingItem->quantity += $quantity;
        $existingItem->save();
    } else {
        // Create a new shopping cart item
        $item = new ShoppingCartItem();
        $item->cart_id = $shoppingCart->id;
        $item->product_id = $productId;
        $item->quantity = $quantity;
        $item->unit_price = $product->price; // You may adjust this based on your product model
        $item->save();
    }

    return redirect()->back()->with('success', 'Product added to cart successfully.');
}
            public function updateCartItem(Request $request)
                    {
                        try {
                            Log::info('Incoming request data:', $request->all());

                            $itemId = $request->input('itemId');
                            $quantity = $request->input('quantity');
                            $user = Auth::user();
                            $shoppingCart = $user->getShoppingCart;
                        
                            if ($shoppingCart) {
                                $item = $shoppingCart->getShoppingCartItem()->find($itemId);
                                if ($item) {
                                    $item->quantity = $quantity;
                                    $item->save();
                                }
                            }

                            return response()->json(['success' => true]);
                        } catch (\Exception $e) {
                            Log::error('Error updating cart item: ' . $e->getMessage());
                            return response()->json(['success' => false], 500);
                        }
                    }


    public function deleteCartItem(Request $request)
            {
                $itemId = $request->input('itemId');
                $user = Auth::user();
                $shoppingCart = $user->getShoppingCart;

                if ($shoppingCart) {
                    $item = $shoppingCart->getShoppingCartItem()->find($itemId);
                    if ($item) {
                        $item->delete();
                        return redirect()->back()->with('success', 'Item deleted successfully.');
                    }
                }
                
                return redirect()->back()->with('error', 'Failed to delete item.');
            }
    
    public function deliveryAddress() {

        $user = Auth::user();
            $shoppingCart = $user->getShoppingCart;
            $totalPrice = 0;
            if ($shoppingCart) {
                $shoppingCart->load('getShoppingCartItem.getProduct');
                $shoppingCart = $shoppingCart->first();
                foreach ($shoppingCart->getShoppingCartItem as $item) {
                    $totalPrice += $item->quantity * $item->getProduct->price;
                }
            }
        return view('payment.deliveryAddress', compact('user', 'shoppingCart', 'totalPrice'));
    }

    public function session(Request $request)
            {
                \Stripe\Stripe::setApiKey(config('stripe.sk'));
        
                $productname = $request->get('productname');
                $totalprice = $request->get('total');
                $deliveryAddress = $request->input('userAddress');   
                $specificAddress = $request->input('specificLocation');   
                $two0 = "00";
        
                $session = \Stripe\Checkout\Session::create([
                    'line_items'  => [
                        [
                            'price_data' => [
                                'currency'     => 'USD',
                                'product_data' => [
                                    "name" => $productname,
                                ],
                                'unit_amount'  => $totalprice.$two0,
                            ],
                            'quantity'   => 1,
                        ],
                        
                    ],
                    'mode'        => 'payment',
                    'success_url' => route('success', ['total' => $totalprice, 'deliveryAdress' => $deliveryAddress, 'specificAddress' => $specificAddress]),
                    'cancel_url'  => route('deliveryAddress'),
                ]);
        
                return redirect()->away($session->url);
            }
 
            public function success(Request $request)
            {
                try {
                    $user = Auth::user();
                    $totalPrice = $request->input('total');
                    $deliveryAddress = $request->input('deliveryAddress');   
                    $specificAddress = $request->input('specificAddress');   
            
                    $order = new Order();
                    $order->buyer_id = $user->id;
                    $order->total_amount = $totalPrice;
                    $order->delivery_address = $deliveryAddress;
                    $order->delivery_longitude_latitude = $specificAddress;
                    $order->order_status = 'pending'; 
                    $order->save();
            
                    foreach ($user->getShoppingCart->getShoppingCartItem as $item) {
                        $orderItem = new OrderItem();
                        $orderItem->order_id = $order->id; 
                        $orderItem->product_id = $item->product_id;
                        $orderItem->quantity = $item->quantity;
                        $orderItem->unit_price = $item->getProduct->price; 
                        $orderItem->save();
            
                        $product = Product::find($item->product_id);
                        if ($product) {
                            $product->quantity -= $item->quantity;
                            $product->save();
                        }
                    }
            
                    foreach ($user->getShoppingCart->getShoppingCartItem as $item) {
                        $item->delete();
                    }
                    Mail::to($user->email)->send(new SendReceiptOrder($order));

                    return redirect()->route('home');
                } catch (QueryException $e) {
                    Log::error('Error saving order: ' . $e->getMessage());
                    return redirect()->route('home')->with('error', 'An error occurred while processing your order. Please try again later.');
                }
            }
}