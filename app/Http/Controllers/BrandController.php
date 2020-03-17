<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class BrandController extends Controller
{
    public function index(){
        $brands = Brand::orderByDesc('id')->paginate(env('ITEM_PER_PAGE'));

        return view("admin.brands.brand_list", compact('brands'));
    }

    public function create(){
        return view("admin.brands.brand_add");
    }

    public function store(Request $request){
        $rules = [
            'brand_name' => 'required',
            'brand_desc' => 'required'
        ];
        $messages = [
            'brand_name.required' => 'Tên thương hiệu không được để trống',
            'brand_desc.required' => 'Mô tả không được để trống'
        ];
        //C1 : Dài
        $v = Validator::make($request->all(), $rules, $messages);
        if($v->fails()){
            session()->flash('dataEntered', array(
                'brand_name' => $request->brand_name,
                'brand_desc' => $request->brand_desc,
                'brand_status' => $request->brand_status
            ));
            return redirect()->back()->withErrors($v->errors())
                    ->withInput();
        }
        //C2 : Ghi ngắn hơn nhưng không thực hiện thêm được gì? Cách 1 thì ADD được Session
        //$request->validate($rules, $messages);
        $brand = new brand();
        $brand->name = $request->brand_name;
        $brand->slug = str_slug($brand->name);
        $brand->desc = $request->brand_desc;
        $brand->status = $request->brand_status;
        if($brand->save()){
            session()->flash('messages', 'Thêm thành công!');
        } else{
            session()->flash('messages', 'Thêm không thành công!');
        }
        return redirect("admin/brands");
    }

    public function edit($id){
        $brand = Brand::find($id);
        $data = array(
            'brand' => $brand
        );
        return view("admin.brands.brand_edit", $data);
    }

    public function update(Request $request ){
        $rules = [
            'brand_name' => 'required',
            'brand_desc' => 'required'
        ];
        $messages = [
            'brand_name.required' => 'Tên thương hiệu không được để trống',
            'brand_desc.required' => 'Mô tả không được để trống'
        ];
        //C1 : Dài
        $v = Validator::make($request->all(), $rules, $messages);
        if($v->fails()){
            session()->flash('dataEntered', array(
                'brand_name' => $request->brand_name,
                'brand_desc' => $request->brand_desc,
                'brand_status' => $request->brand_status
            ));
            return redirect()->back()->withErrors($v->errors())
                    ->withInput();
        }
        $brand = Brand::find($request->id);
        $brand->name = $request->brand_name;
        $brand->slug = str_slug($brand->name);
        $brand->desc = $request->brand_desc;
        $brand->status = $request->brand_status;
        if($brand->save()){
            session()->flash('messages', 'Cập nhật thành công!');
        }else{
            session()->flash('messages', 'Cập nhật không thành công!');
        }
        return redirect("admin/brands");
    }

    public function destroy($id){
        $productTotal = Product::where('brand_id', $id)->count();
        if($productTotal>0){
            session()->flash('messages', 'Nếu muốn xóa thương hiệu này, hãy xóa hết sản phẩm của thương hiệu');
        } else{
            //$result = DB::table('brands')->where('id', '=', $id)->delete();
            $result = Brand::where('id', $id)->delete();
            if($result){
                session()->flash('messages', 'Xóa thành công!');
            } else{
                session()->flash('messages', 'Xóa không thành công!');
            }
        }
        return redirect()->back();
    }

    public function changeStatus($id, $status){
        //echo "ID = " . $id . " Status = " . $status;
        $brand = Brand::find($id);
        $brand->status = !$status;
        if($brand->save()){
            session()->flash('messages', 'Cập nhật thành công!');
        } else{
            session()->flash('messages', 'Cập nhật không thành công!');
        }
        return redirect()->back();
    }

    //FrontEnd Code
    public function showProductsByBrand($slug){
        $brandId = getIdFromLink($slug);
        $products = Product::orderByDesc('id')
                    ->where('brand_id', $brandId)
                    ->where('status', 1)
                    ->paginate(12);
        return view("pages.products_by_category", compact('products'));
    }
}
