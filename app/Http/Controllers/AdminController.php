<?php

namespace App\Http\Controllers;

use App\Mail\OrderStatusUpdated;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminController extends Controller
{
    public function index()
    {
        $total_orders = Order::count();
        $total_revenue = Order::sum('total');
        $pending_orders = Order::where('status', 'pending')->count();
        $pending_revenue = Order::where('status', 'pending')->sum('total');
        $delivered_orders = Order::where('status', 'delivered')->count();
        $delivered_revenue = Order::where('status', 'delivered')->sum('total');
        $processing_orders = Order::where('status', 'processing')->count();
        $cancelled_orders = Order::where('status', 'cancelled')->count();
        $cancelled_revenue = Order::where('status', 'cancelled')->sum('total');
        $recent_orders = Order::withCount('items')->orderBy('created_at', 'DESC')->take(5)->get();

        return view('admin.index', compact(
            'total_orders',
            'total_revenue',
            'pending_orders',
            'pending_revenue',
            'delivered_orders',
            'delivered_revenue',
            'processing_orders',
            'cancelled_orders',
            'cancelled_revenue',
            'recent_orders'
        ));
    }

    // brands section
    public function brands()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);

        return view('admin.brands', compact('brands'));
    }

    public function add_brand()
    {
        return view('admin.brand-add');
    }

    public function brand_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:brands,slug',
            'image' => 'mimes:jpg,jpeg,png|max:2048',
        ]);

        $brand = new Brand;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $image = $request->file('image');
        $file_extension = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extension;
        $this->GenarateBrandThumbailsImage($image, $file_name);
        $brand->image = $file_name;
        $brand->save();

        return redirect()->route('admin.brands')->with('success', 'Brand created successfully.');
    }

    public function brand_edit($id)
    {
        $brand = Brand::find($id);

        return view('admin.brand-edit', compact('brand'));
    }

    public function brand_update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:brands,slug,'.$request->id,
            'image' => 'mimes:jpg,jpeg,png|max:2048',
        ]);
        $brand = Brand::find($request->id);
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if (File::exists(public_path('uploads/brands').'/'.$brand->image)) {
                File::delete(public_path('uploads/brands').'/'.$brand->image);
            }

            $image = $request->file('image');
            $file_extension = $request->file('image')->extension();
            $file_name = Carbon::now()->timestamp.'.'.$file_extension;
            $this->GenarateBrandThumbailsImage($image, $file_name);
            $brand->image = $file_name;
        }
        $brand->save();

        return redirect()->route('admin.brands')->with('success', 'Brand has been updated successfully.');
    }

    public function GenarateBrandThumbailsImage($image, $imageName)
    {
        $destinationPath = public_path('uploads/brands');
        $img = Image::read($image->path());
        $img->cover(124, 124, 'top');
        $img->scale(width: 124, height: 124)->save($destinationPath.'/'.$imageName);
    }

    public function brand_delete($id)
    {
        $brand = Brand::find($id);
        if (File::exists(public_path('uploads/brands').'/'.$brand->image)) {
            File::delete(public_path('uploads/brands').'/'.$brand->image);
        }
        $brand->delete();

        return redirect()->route('admin.brands')->with('status', 'Brand has been deleted successfully.');
    }

    // Category Section

    public function categories()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(10);

        return view('admin.categories', compact('categories'));
    }

    public function category_add()
    {
        return view('admin.category-add');
    }

    public function category_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:categories,slug',
            'image' => 'mimes:jpg,jpeg,png|max:2048',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $image = $request->file('image');
        $file_extension = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extension;
        $this->GenarateCategoryThumbailsImage($image, $file_name);
        $category->image = $file_name;

        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category created successfully.');
    }

    public function GenarateCategoryThumbailsImage($image, $imageName)
    {
        $destinationPath = public_path('uploads/categories');
        $img = Image::read($image->path());
        $img->cover(124, 124, 'top');
        $img->scale(width: 124, height: 124)->save($destinationPath.'/'.$imageName);
    }

    public function category_edit($id)
    {
        $category = Category::find($id);

        return view('admin.category-edit', compact('category'));
    }

    public function category_update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:categories,slug,'.$request->id,
            'image' => 'mimes:jpg,jpeg,png|max:2048',
        ]);
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if (File::exists(public_path('uploads/categories').'/'.$category->image)) {
                File::delete(public_path('uploads/categories').'/'.$category->image);
            }

            $image = $request->file('image');
            $file_extension = $request->file('image')->extension();
            $file_name = Carbon::now()->timestamp.'.'.$file_extension;
            $this->GenarateCategoryThumbailsImage($image, $file_name);
            $category->image = $file_name;
        }
        $category->save();

        return redirect()->route('admin.categories')->with('status', 'Category has been updated successfully.');
    }

    public function category_delete($id)
    {
        $category = Category::find($id);
        if (File::exists(public_path('uploads/categories').'/'.$category->image)) {
            File::delete(public_path('uploads/categories').'/'.$category->image);
        }
        $category->delete();

        return redirect()->route('admin.categories')->with('status', 'Category has been deleted successfully.');
    }

    // Products functions
    public function products()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.products', compact('products'));
    }

    public function product_add()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();

        return view('admin.product-add', compact('categories', 'brands'));
    }

    public function product_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required',
            'sale_price' => 'required',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'category_id' => 'required',
            'brand_id' => 'required'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $current_timestamp = Carbon::now()->timestamp;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $current_timestamp.'.'.$image->extension();
            $this->GenarateProductThumbnailImage($image, $imageName);
            $product->image = $imageName;
        }

        $gallery_arr = array();
        $gallery_images = "";
        $counter = 1;

        if ($request->hasFile('images')) {
            $allowedfileExtion = ['jpg', 'png', 'jpeg'];
            $files = $request->file('images');

            foreach ($files as $file) {
                $gextension = $file->getClientOriginalExtension();
                $gcheck = in_array($gextension, $allowedfileExtion);
                if ($gcheck) {
                    $gfileName = $current_timestamp.'-'.$counter.'.'.$gextension;
                    $this->GenarateProductThumbnailImage($file, $gfileName);
                    array_push($gallery_arr, $gfileName);
                    $counter = $counter + 1;
                }
            }
            $gallery_images = implode(',', $gallery_arr);
        }

        $product->images = $gallery_images;
        $product->save();

        return redirect()->route('admin.products')->with('status', 'Product created successfully.');

    }

    public function GenarateProductThumbnailImage($image, $imageName)
    {
        $destinationPathThumbnail = public_path('uploads/products/thumbnails');
        $destinationPath = public_path('uploads/products');
        $img = Image::read($image->path());
        $img->cover(width: 540, height: 689, position: 'top');
        $img->resize(540, 689, function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$imageName);

        $img->resize(104, 104, function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPathThumbnail.'/'.$imageName);
    }

    public function product_edit($id){
        $product = Product::find($id);
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        return view('admin.product-edit', compact('product','categories','brands'));
    }

    public function product_update(Request $request){
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,'.$request->id,
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required',
            'sale_price' => 'required',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:2048',
            'category_id' => 'required',
            'brand_id' => 'required'
        ]);

        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $current_timestamp = Carbon::now()->timestamp;
        if(File::exists(public_path('uploads/products').'/'.$product->image)){
            File::delete(public_path('uploads/products').'/'.$product->image);
        }

         if(File::exists(public_path('uploads/products/thumbnails').'/'.$product->image)){
            File::delete(public_path('uploads/products/thumbnails').'/'.$product->image);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $current_timestamp.'.'.$image->extension();
            $this->GenarateProductThumbnailImage($image, $imageName);
            $product->image = $imageName;
        }

        $gallery_arr = array();
        $gallery_images = "";
        $counter = 1;
        
        if ($request->hasFile('images')) {
            foreach(explode(',',$product->images)as $ofile){
                if(File::exists(public_path('uploads/products').'/'.trim($ofile))){
                    File::delete(public_path('uploads/products').'/'.trim($ofile));
                }
                if(File::exists(public_path('uploads/products/thumbnails').'/'.trim($ofile))){
                    File::delete(public_path('uploads/products/thumbnails').'/'.trim($ofile));
                }
            }
            $allowedfileExtion = ['jpg', 'png', 'jpeg'];
            $files = $request->file('images');

            foreach ($files as $file) {
                $gextension = $file->getClientOriginalExtension();
                $gcheck = in_array($gextension, $allowedfileExtion);
                if ($gcheck) {
                    $gfileName = $current_timestamp.'-'.$counter.'.'.$gextension;
                    $this->GenarateProductThumbnailImage($file, $gfileName);
                    array_push($gallery_arr, $gfileName);
                    $counter = $counter + 1;
                }
            }
            $gallery_images = implode(',', $gallery_arr);
            $product->images = $gallery_images;
        
        }


        $product->save();

        return redirect()->route('admin.products')->with('status', 'Product updated successfully.');
    }

    public function product_delete($id){
        $product = Product::find($id);
        if(File::exists(public_path('uploads/products').'/'.$product->image)){
            File::delete(public_path('uploads/products').'/'.$product->image);
        }

         if(File::exists(public_path('uploads/products/thumbnails').'/'.$product->image)){
            File::delete(public_path('uploads/products/thumbnails').'/'.$product->image);
        }
        foreach(explode(',',$product->images)as $ofile){
                if(File::exists(public_path('uploads/products').'/'.trim($ofile))){
                    File::delete(public_path('uploads/products').'/'.trim($ofile));
                }
                if(File::exists(public_path('uploads/products/thumbnails').'/'.trim($ofile))){
                    File::delete(public_path('uploads/products/thumbnails').'/'.trim($ofile));
                }
            }
        $product->delete();
        return redirect()->route('admin.products')->with('status', 'Product deleted successfully.');
    }

    // Orders section

    public function orders()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.orders', compact('orders'));
    }

    public function order_details($id)
    {
        $order = Order::with('items')->findOrFail($id);

        return view('admin.order-details', compact('order'));
    }

    public function order_update_status(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        Mail::to($order->email)->send(new OrderStatusUpdated($order));

        return redirect()->route('admin.order.details', $id)->with('status', 'Order status updated successfully.');
    }

    // Coupons section

    public function coupons()
    {
        $coupons = Coupon::orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.coupons', compact('coupons'));
    }

    public function coupon_add()
    {
        return view('admin.coupon-add');
    }

    public function coupon_store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code',
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:0',
            'max_uses' => 'nullable|integer|min:1',
            'expires_at' => 'nullable|date',
        ]);

        $coupon = new Coupon();
        $coupon->code = strtoupper($request->code);
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->max_uses = $request->max_uses;
        $coupon->expires_at = $request->expires_at;
        $coupon->active = true;
        $coupon->save();

        return redirect()->route('admin.coupons')->with('status', 'Coupon created successfully.');
    }

    public function coupon_toggle($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->active = ! $coupon->active;
        $coupon->save();

        return redirect()->route('admin.coupons')->with('status', 'Coupon updated successfully.');
    }

    public function coupon_delete($id)
    {
        Coupon::findOrFail($id)->delete();

        return redirect()->route('admin.coupons')->with('status', 'Coupon deleted successfully.');
    }

    // Reviews moderation

    public function review_delete($id)
    {
        Review::findOrFail($id)->delete();

        return back()->with('status', 'Review deleted successfully.');
    }
}
