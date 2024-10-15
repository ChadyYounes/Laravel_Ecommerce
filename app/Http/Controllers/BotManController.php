<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Store;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');
        $botman->hears('start', function($botman) {
            $user = Auth::user();
            $name = $user->name; 
            
            $botman->reply("Welcome back, $name! How can I assist you today?");
        });
        $botman->hears('{message}', function($botman, $message) {
            $user = Auth::user(); // Get the authenticated user
            $name = $user->name; // Assuming the user's name is stored in the 'name' field
    
            if ($message == 'hi') {
                $botman->reply("Welcome back, $name!");
            } elseif (str_contains($message, 'today\'s gain')) {
                $gain = $this->getTodaysGains();
                $botman->reply("Today's gain is $gain.");
            } elseif (str_contains($message, 'orders')) {
                $orders = $this->getOrders(); // Implement getOrders method
                $botman->reply("You have " . count($orders) . " orders.");
            } elseif (str_contains($message, 'store info')) {
                $storeInfo = $this->getStoreInfo(); // Implement getStoreInfo method
                $botman->reply($storeInfo);
            } elseif (str_contains($message, 'most sold item')) {
                $mostSoldItem = $this->getMostSoldItem(); // Implement getMostSoldItem method
                $botman->reply("The most sold item is $mostSoldItem.");
            } else {
                $botman->reply("I don't understand your request. Please ask about today's gain, orders, store info, or the most sold item.");
            }
        });
    
        $botman->listen();
    }
   
    /**
     * Send a welcome message to the user.
     */
    public function sendWelcomeMessage($botman)
    {
        $sellerName = Auth::user()->name; // Fetch the authenticated user's name
        $botman->reply('Welcome ' . $sellerName . '!');
    }

    public function askName($botman)
    {
        $botman->ask('Hello! What is your Name?', function(Answer $answer) {
            $name = $answer->getText();
            $this->say('Nice to meet you '.$name);
        });
    }

    public function getTodaysGains()
    {
        $today = Carbon::today();
        $totalGains = Order::whereDate('created_at', $today)
            ->sum('total_amount'); // Adjust 'total_amount' to your column name

        return $totalGains;
    }

    public function getOrders()
    {
        // Example: Retrieve all orders for the authenticated user
        return Order::where('buyer_id', Auth::id())->get();
    }

    public function getStoreInfo()
    {
        // Example: Retrieve the store information for the authenticated user
        $store = Store::where('seller_id', Auth::id())->first();
        return $store ? $store->store_name : 'No store information found.';
    }

    public function getMostSoldItem()
    {
        // Example: Retrieve the most sold item
        $mostSoldItem = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'DESC')
            ->first();

        if ($mostSoldItem) {
            $product = DB::table('products')->find($mostSoldItem->product_id);
            return $product ? $product->product_name : 'No product information found.';
        }

        return 'No orders found.';
    }
}
