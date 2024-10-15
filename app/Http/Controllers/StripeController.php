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
use App\Models\Currency;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendReceiptOrder;
use Illuminate\Database\QueryException;
class StripeController extends Controller
{
    public function shoppingCart()
{
    $user = Auth::user();
    $currencies=Currency::all();
    $shoppingCart = $user->getShoppingCart;
    $totalPrice = 0;

    if ($shoppingCart) {
        $shoppingCart->load('getShoppingCartItem.getProduct');
        $shoppingCart = $shoppingCart->first();

        foreach ($shoppingCart->getShoppingCartItem as $item) {
            $totalPrice += $item->quantity * $item->getProduct->price;
        }
    }

    return view('payment.shoppingCart', compact('user', 'shoppingCart', 'totalPrice', 'currencies'));
}

          
public function updateCartItem(Request $request)
{
    try {
        Log::info('Incoming request data:', $request->all());

        $productId = $request->input('productId');
        $quantity = $request->input('quantity');
        $user = Auth::user();
        $shoppingCart = $user->getShoppingCart;
    
        if ($shoppingCart) {
            $item = $shoppingCart->getShoppingCartItem->find($productId);
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
        
                $user = Auth::user();
                $shoppingCart = $user->getShoppingCart;
                $shoppingCartItems = $shoppingCart->getShoppingCartItem;

                $lineItems = [];

                foreach ($shoppingCartItems as $item) {
                    $lineItems[] = [
                        'price_data' => [
                            'currency'     => 'USD',
                            'product_data' => [
                                'name' => $item->getProduct->product_name,
                            ],
                            'unit_amount'  => $item->unit_price * 100, 
                        ],
                        'quantity'   => $item->quantity,
                    ];
                }

                $session = \Stripe\Checkout\Session::create([
                    'line_items'  => $lineItems,
                    'mode'        => 'payment',
                    'success_url' => route('success',['total' => $totalprice, 'deliveryAdress' => $deliveryAddress, 'specificAddress' => $specificAddress]),
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