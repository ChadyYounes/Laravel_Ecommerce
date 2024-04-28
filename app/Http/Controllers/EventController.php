<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Product;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function storeEvent(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_datetime' => 'required|date',
            'product_name' => 'required|string|max:255',// Assuming you want to store images
            'starting_price' => 'required|numeric|min:0',
            'minimum_increase' => 'required|numeric|min:0',
        ]);

        // Store product image
            $file = $request->file('product_image_url');
            $extension = $file->getClientOriginalExtension();

            $fileName = time().'.'.$extension;
            $path = "storage/product-event-images/";
            $file->move($path,$fileName);

        // Create event
        $event=new Event();
        $event->event_name=$request->input('event_name');
        $event->event_datetime=$request->input('event_datetime');
        $event->product_name=$request->input('product_name');
        $event->product_image_url=$path.$fileName;
        $event->starting_price=$request->input('starting_price');
        $event->minimum_increase=$request->input('minimum_increase');
        $event->store_id=$request->input('store_id');


        $event->save();

        // Optionally, you can return a response indicating success
        return redirect()->back()->with('success', 'Event added successfully');
    }
}
