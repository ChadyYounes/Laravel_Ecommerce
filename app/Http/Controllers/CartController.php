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

class CartController extends Controller
{
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
     $existingItem = ShoppingCartItem::where('shopping_cart_id', $shoppingCart->id)
        ->where('product_id', $productId)
        ->first();
       
    
    
        if ($existingItem) {
            $existingItem->quantity += $quantity;
            $existingItem->save();
        } else {
            // Create a new shopping cart item
            $item = new ShoppingCartItem();
            $item->shopping_cart_id = $shoppingCart->id;
            $item->product_id = $productId;
            $item->quantity = $quantity;
            $item->unit_price = $product->price; // You may adjust this based on your product model
            $item->save();
        }
    
        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }
}
