<?php

namespace App\Http\Controllers;

use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderByDesc('id')->paginate(env('ITEM_PER_PAGE'));
        return view("admin.products.product_list", compact('products'));
    }

    public function create(){
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $data = array(
            'categories' => $categories,
            'brands' => $brands
        );
        return view("admin.products.product_add", $data);
    }

    public function store(Request $request){
        //Step 1: Validate
        $rules = [
            'product_name' => 'required',
            'product_image' => 'required|image',
            'product_price' => 'required',
            'product_desc' => 'required',
            'product_content' => 'required'
        ];
        $messasges = [
            'product_name.required' => 'Chưa nhập tên sản phẩm',
            'product_image.required' => 'Chưa chọn ảnh sản phẩm',
            'product_image.image' => 'Chỉ được chọn file định dạng là ảnh',
            'product_price.required' => 'Chưa nhập giá sản phẩm',
            'product_desc.required' => 'Chưa nhập mô tả sản phẩm',
            'product_content.required' => 'Chưa nhập nội dung sản phẩm'
        ];
        $v = Validator::make($request->all(), $rules, $messasges);
        if($v->fails()){
            $dataEntered = array(
                'product_name' => $request->product_name,
                'product_category' => $request->product_category,
                'product_brand' => $request->product_brand,
                'product_price' => $request->product_price,
                'product_image' => $request->product_image,
                'product_desc' => $request->product_desc,
                'product_content' => $request->product_content,
                'product_status' => $request->product_status,
                'product_hot' => $request->product_hot,
            );
            session()->flash('dataEntered', $dataEntered);
            return redirect()->back()->withErrors($v->errors())->withInput();
        }
        //Step 2: Move image to uploads forlder
        $imageNew = "";
        if ($request->hasFile('product_image')){
            $file = $request->product_image;

            $tempArr = explode('.', $file->getClientOriginalName());
            $date = getdate();
            $secondAll = $date['0']; // 1583829884 - Riêng biệt - Không bao giờ trùng

            $imageNew = str_slug($request->product_name). '-' .$secondAll . '.'
                        . $tempArr[count($tempArr)-1];
            $file->move('public/uploads/products', $imageNew);
        }

        //Step 3: Insert data to db
        $dataInsert = array(
            'name' => $request->product_name,
            'slug' => str_slug($request->product_name),
            'category_id' => $request->product_category,
            'brand_id' => $request->product_brand,
            'desc' => $request->product_desc,
            'content' => $request->product_content,
            'price' => $request->product_price,
            'image' => $imageNew,
            'hot' => $request->product_hot,
            'status' => $request->product_status,
        );
        //$insertResult = Product::insert($dataInsert);
        $product = new Product();
        $product->name = $dataInsert['name'];
        $product->slug = $dataInsert['slug'];
        $product->category_id = $dataInsert['category_id'];
        $product->brand_id = $dataInsert['brand_id'];
        $product->desc = $dataInsert['desc'];
        $product->content = $dataInsert['content'];
        $product->image = $dataInsert['image'];
        $product->price = $dataInsert['price'];
        $product->hot = $dataInsert['hot'];
        $product->status = $dataInsert['status'];
        if($product->save()){
            session()->flash('messages', 'Thêm thành công!');
        }else{
            session()->flash('messages', 'Thêm không thành công!');
        }
        return redirect("/admin/products");
    }

    public function edit($id){
        $product = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        $data = array(
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands
        );
        return view("admin.products.product_edit", $data);
    }

    public function update(Request $request){
        //Step 1: Validate
        $rules = [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_desc' => 'required',
            'product_content' => 'required'
        ];
        $messasges = [
            'product_name.required' => 'Chưa nhập tên sản phẩm',
            'product_price.required' => 'Chưa nhập giá sản phẩm',
            'product_desc.required' => 'Chưa nhập mô tả sản phẩm',
            'product_content.required' => 'Chưa nhập nội dung sản phẩm'
        ];
        $v = Validator::make($request->all(), $rules, $messasges);
        if($v->fails()){
            $dataEntered = array(
                'product_name' => $request->product_name,
                'product_category' => $request->product_category,
                'product_brand' => $request->product_brand,
                'product_price' => $request->product_price,
                'product_desc' => $request->product_desc,
                'product_content' => $request->product_content,
                'product_hot' => $request->product_hot,
                'product_status' => $request->product_status,
            );
            session()->flash('dataEntered', $dataEntered);
            return redirect()->back()->withErrors($v->errors())->withInput();
        }
        //Step 2: Handle image if user upload new image replace for old image
        $imageNew = "";
        if ($request->hasFile('product_image')){
            $file = $request->product_image;

            $tempArr = explode('.', $file->getClientOriginalName());
            $date = getdate();
            $secondAll = $date['0']; // 1583829884 - Riêng biệt - Không bao giờ trùng

            $imageNew = str_slug($request->product_name). '-' .$secondAll . '.'
                        . $tempArr[count($tempArr)-1];
            //Xóa file cũ đi
            if(file_exists(public_path("/uploads/products/$request->old_product_image"))){
                unlink(public_path("/uploads/products/$request->old_product_image"));
            }
            //Chuyển file mới vào
            $file->move('public/uploads/products', $imageNew);
        }
        $dataUpdate = array(
            'name' => $request->product_name,
            'slug' => str_slug($request->product_name),
            'category_id' => $request->product_category,
            'brand_id' => $request->product_brand,
            'desc' => $request->product_desc,
            'content' => $request->product_content,
            'price' => $request->product_price,
            'image' => $imageNew=="" ? $request->old_product_image : $imageNew,
            'hot' => $request->product_hot,
            'status' => $request->product_status,
        );
        $product = Product::find($request->id);
        $product->name = $dataUpdate['name'];
        $product->slug = $dataUpdate['slug'];
        $product->category_id = $dataUpdate['category_id'];
        $product->brand_id = $dataUpdate['brand_id'];
        $product->desc = $dataUpdate['desc'];
        $product->content = $dataUpdate['content'];
        $product->price = $dataUpdate['price'];
        $product->image = $dataUpdate['image'];
        $product->hot = $dataUpdate['hot'];
        $product->status = $dataUpdate['status'];
        if($product->save()){
            session()->flash('messages', 'Cập nhật hình công!');
        } else{
            session()->flash('messages', 'Cập nhật không thành công!');
        }
        return redirect("admin/products");
    }

    public function destroy($id){
        //Destroy trả về 1/0
        $product = Product::find($id);
        $result = Product::destroy($id);
        if($result>0){
            if(file_exists(public_path("/uploads/products/$product->image"))){
                unlink(public_path("/uploads/products/$product->image"));
            }
            session()->flash('messages', 'Xóa thành công!');
        } else{
            session()->flash('messages', 'Xóa không thành công!');
        }
        return redirect()->back();
    }

    //FrontEnd
    public function showProductDetail($slug){
        $productId = getIdFromLink($slug);
        $product = Product::find($productId);
        $relatedProducts = Product::where('category_id', $product->category_id)
                                    -> where('id', '!=', $productId)
                                    ->limit(9)->get();

        $data = array(
            'product' => $product,
            'relatedProducts' => $relatedProducts
        );
        return view("pages.product_detail", $data);
    }
}
