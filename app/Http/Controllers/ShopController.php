<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(Request $request){
        $size = $request->query("size") ? $request->query("size") : 12;
        $o_column = "";
        $o_order = "";
        $order = $request->query("order") ? $request->query("order") : -1;
        $f_categories = $request->query("categories");
        $f_brands = $request->query("brands");
        $q = $request->query("q");
        switch($order){
            case 1:
                $o_column = "created_at";
                $o_order = "DESC";
                break;
            case 2:
                $o_column = "created_at";
                $o_order = "ASC";
                break;
            case 3:
                $o_column = "sale_price";
                $o_order = "ASC";
                break;
            case 4:
                $o_column = "sale_price";
                $o_order = "DESC";
                break;
            default:
                $o_column = "id";
                $o_order = "DESC";
        }
        $brands = Brand::orderBy('name','ASC')->get();
        $categories = Category::orderBy('name','ASC')->get();
        $products = Product::where(function($query) use ($f_brands){
              if($f_brands){
                  $query->whereIn('brand_id',explode(",",$f_brands));
              }
        })->where(function($query) use ($f_categories){
              if($f_categories){
                  $query->whereIn('category_id',explode(",",$f_categories));
              }
        })->where(function($query) use ($q){
              if($q){
                  $query->where('name','LIKE','%'.$q.'%')
                        ->orWhere('short_description','LIKE','%'.$q.'%');
              }
        })->
                orderBy($o_column,$o_order)->paginate($size);
        return view('shop',compact('products','size', 'order', 'brands', 'f_brands', 'f_categories', 'categories', 'q'));
    }

    public function product_details($product_slug){
        $product = Product::with('reviews.user')->where('slug',$product_slug)->first();
        $rproducts = Product::where('slug','<>',$product_slug)->get()->take(8);
        $avg_rating = round($product->reviews->avg('rating'), 1);
        $reviews_count = $product->reviews->count();
        $in_wishlist = Auth::check()
            ? Wishlist::where('user_id', Auth::id())->where('product_id', $product->id)->exists()
            : false;
        return view('details',compact('product','rproducts','avg_rating','reviews_count','in_wishlist'));
    }
}
