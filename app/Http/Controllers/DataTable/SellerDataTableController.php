<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Store;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\StoreFollower;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Yajra\DataTables\DataTables;
class SellerDataTableController extends Controller
{
   
    public function getSellerStoresData(Request $request)
    {
        $stores = Store::where('seller_id', auth()->id());
        
        return DataTables::of($stores)
            ->addColumn('nbrProducts', function ($store) {
                return $store->getProducts->count();
            })
            ->addColumn('nbrFollowers', function ($store) {
                return StoreFollower::where('store_id', $store->id)->count();
            })
            ->addColumn('nbrSales', function ($store) {
                return OrderItem::whereHas('getProduct', function ($query) use ($store) {
                    $query->where('store_id', $store->id);
                })
                ->whereHas('getOrder', function ($query) {
                    $query->where('order_status', 'delivered');
                })
                ->sum('quantity');
            })
            ->addColumn('totalGain', function ($store) {
                return OrderItem::whereHas('getProduct', function ($query) use ($store) {
                    $query->where('store_id', $store->id);
                })
                ->whereHas('getOrder', function ($query) {
                    $query->where('order_status', 'delivered');
                })
                ->sum(DB::raw('quantity * unit_price'));
            })
            ->addColumn('is_active', function ($store) {
                return $store->is_active ? 'Active' : 'Deactivated';
            })
            ->make(true);
    }
    
    public function productData(Request $request, $store_id)
    {
        $query = Product::where('store_id', $store_id)
            ->with('getCategory'); 
    

            // Check if there is a search value and filter the query accordingly
            if (!empty($request->input('search.value'))) {
                $searchValue = $request->input('search.value');
                $query->where(function ($q) use ($searchValue) {
                    $q->where('product_name', 'like', '%' . $searchValue . '%')
                    ->orWhereHas('getCategory', function ($q) use ($searchValue) {
                        $q->where('category_name', 'like', '%' . $searchValue . '%');
                    });
                });
            }
        return DataTables::of($query)
            ->addColumn('product_url', function($product) {
            if (preg_match('/^https?:\/\//', $product->product_url)) {
                $url = $product->product_url;
            } else {
                $url = asset('storage/' . $product->product_url);
            }
            return $url;
            })
            ->addColumn('product_name', function($product) {
                return $product->product_name;
            })
            ->addColumn('category_name', function($product) {
                return $product->getCategory ? $product->getCategory->category_name : 'No Category';
            })
            ->addColumn('quantity', function($product) {
                return $product->quantity;
            })
            ->addColumn('price', function($product) {
                return number_format($product->price, 2) . '$';
            })
            ->addColumn('action', function($product) {
                $editUrl = route('editProductView', ['product_id' => $product->id]);
                $deleteUrl = route('deleteProduct', ['product_id' => $product->id]);
                return '
                    <a href="' . $editUrl . '" class="btn btn-primary">
                    <span class="material-symbols-outlined">
                        edit
                    </span></a>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('POST') . '
                        <button type="submit" class="btn btn-danger"><span class="material-symbols-outlined">
                        delete
                        </span></button>
                    </form>
                ';
            })
            ->rawColumns(['product_url', 'action']) 
            ->make(true);
    }
    
}
