<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Product;
use App\Model\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    public function index(){
        $categories = Category::orderByDesc('id')->paginate(env('ITEM_PER_PAGE'));

        return view("admin.categories.category_list", compact('categories'));
    }

    public function create(){
        return view("admin.categories.category_add");
    }

    public function store(Request $request){
        $rules = [
            'category_name' => 'required',
            'category_desc' => 'required'
        ];
        $messages = [
            'category_name.required' => 'Tên danh mục không được để trống',
            'category_desc.required' => 'Mô tả không được để trống'
        ];
        //C1 : Dài
        $v = Validator::make($request->all(), $rules, $messages);
        if($v->fails()){
            session()->flash('dataEntered', array(
                'category_name' => $request->category_name,
                'category_desc' => $request->category_desc,
                'category_status' => $request->category_status
            ));
            return redirect()->back()->withErrors($v->errors())
                    ->withInput();
        }
        //C2 : Ghi ngắn hơn nhưng không thực hiện thêm được gì? Cách 1 thì ADD được Session
        //$request->validate($rules, $messages);
        $category = new Category();
        $category->name = $request->category_name;
        $category->slug = str_slug($category->name);
        $category->desc = $request->category_desc;
        $category->status = $request->category_status;
        if($category->save()){
            session()->flash('messages', 'Thêm thành công!');
        } else{
            session()->flash('messages', 'Thêm không thành công!');
        }
        return redirect("admin/categories");
    }

    public function edit($id){
        $category = Category::find($id);
        $data = array(
            'category' => $category
        );
        return view("admin.categories.category_edit", $data);
    }

    public function update(Request $request ){
        $rules = [
            'category_name' => 'required',
            'category_desc' => 'required'
        ];
        $messages = [
            'category_name.required' => 'Tên danh mục không được để trống',
            'category_desc.required' => 'Mô tả không được để trống'
        ];
        //C1 : Dài
        $v = Validator::make($request->all(), $rules, $messages);
        if($v->fails()){
            session()->flash('dataEntered', array(
                'category_name' => $request->category_name,
                'category_desc' => $request->category_desc,
                'category_status' => $request->category_status
            ));
            return redirect()->back()->withErrors($v->errors())
                    ->withInput();
        }
        $category = Category::find($request->id);
        $category->name = $request->category_name;
        $category->slug = str_slug($category->name);
        $category->desc = $request->category_desc;
        $category->status = $request->category_status;
        if($category->save()){
            session()->flash('messages', 'Cập nhật thành công!');
        }else{
            session()->flash('messages', 'Cập nhật không thành công!');
        }
        return redirect("admin/categories");
    }

    public function destroy($id){
        $productTotal = Product::where('category_id', $id)->count();
        if($productTotal>0){
            session()->flash('messages', 'Nếu muốn xóa danh mục này, hãy xóa hết sản phẩm của danh mục');
        } else{
            //$result = DB::table('categories')->where('id', '=', $id)->delete();
            $result = Category::where('id', $id)->delete();
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
        $category = Category::find($id);
        $category->status = !$status;
        if($category->save()){
            session()->flash('messages', 'Cập nhật thành công!');
        } else{
            session()->flash('messages', 'Cập nhật không thành công!');
        }
        return redirect()->back();
    }

    public function search(Request $request){
        $request->validate(
            [
                'category_keyword' => 'required'
            ],
            [
                'category_keyword.required' => 'Bạn chưa nhập gì, Sao tìm???'
            ]
        );

        // The GET method is not supported for this route. Supported methods: POST.
        // Nếu đang ở phần Search mà gửi yêu cầu đến đây và Form rỗng -> nó sẽ quay lại
        // route Search --> tức là phương thức GET, mà ta lại chưa xây dựng phương thức GET
        // này ==> vào routes/web.php fixed bằng cách thêm route GET cho /search -> load lại
        // category list.
        $keywordSlug = str_slug($request->category_keyword);
        $categories = Category::where('slug', 'like', "%$keywordSlug%")->get();
        session()->flash("hasPagination", "");
        return view("admin.categories.category_list", compact('categories'));
    }

    //FrontEnd Code
    public function showProductsByCategory($slug){
        $categoryId = getIdFromLink($slug);
        $products = Product::orderByDesc('id')
                    ->where('category_id', $categoryId)
                    ->where('status', 1)
                    ->paginate(12);
        return view("pages.products_by_category", compact('products'));
    }
}
