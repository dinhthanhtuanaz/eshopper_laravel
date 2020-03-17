<?php

namespace App\Http\Controllers;

use App\Mail\SignUpShoppingMail;
use App\Model\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class CustomerController extends Controller
{
    public function showLoginForm(){
        return view("pages.login");
    }

    public function signUp(Request $request){
        $rules = [
            'customer_name' => 'required|min:8|max:20',
            'customer_email'=> 'required|email'
        ];
        $messages = [
            'customer_name.required' => 'Tên tài khoản không được để trống',
            'customer_name.min' => 'Tên tài khoản tối thiểu 8 ký tự',
            'customer_name.max' => 'Tên tài khoản tối đa 20 ký tự',
            'customer_email.required' => 'Bạn chưa nhập địa chỉ Email'
        ];
        $v = Validator::make($request->all(), $rules, $messages);
        if($v->fails()){
            $dataEntered = array(
                'customer_name' => $request->customer_name,
                'customer_email'=> $request->customer_email
            );
            session()->flash('dataEntered', $dataEntered);
            return redirect()->back()->withErrors($v->errors())->withInput();
        }
        //Check exists
        $customer = Customer::where('customer_name', $request->customer_name)->first();
        if(!is_null($customer)){
            session()->flash('email_error', 'Tên tài khoản đã tồn tại!');
            $dataEntered = array(
                'customer_name' => $request->customer_name,
                'customer_email'=> $request->customer_email
            );
            session()->flash('dataEntered', $dataEntered);
            return redirect()->back();
        }
        $customer = Customer::where('email', $request->customer_email)->first();
        if(!is_null($customer)){
            session()->flash('email_error', 'Email này đã được sử dụng!');
            $dataEntered = array(
                'customer_name' => $request->customer_name,
                'customer_email'=> $request->customer_email
            );
            session()->flash('dataEntered', $dataEntered);
            return redirect()->back();
        }
        // dd();

        $emailTitle = "Đăng ký tài khoản thành công!";
        $createdPassword = strtolower(Str::random(8));
        $dataArr = array(
            'customer_name' => $request->customer_name,
            'customer_password' => $createdPassword
        );
        try{
            Mail::to($request->customer_email)->send(
                new SignUpShoppingMail($emailTitle, $dataArr));
        }catch(Exception $e){
            session()->flash('email_error', 'Email bạn không hợp lệ, Đăng ký thất bại');
            return redirect()->back();
        }
        //Xử lý tiếp
        //Insert customer into table in DB
        $customer = new Customer();
        $customer->customer_name = $request->customer_name;
        $customer->email = $request->customer_email;
        $customer->customer_password = md5($createdPassword);
        if($customer->save()){
            session()->flash('messages', 'Tạo tài khoản thành công, kiểm tra Email để có thông tin đăng nhập');
        } else{
            session()->flash('messages', 'Tạo tài khoản không thành công!');
        }
        return redirect()->back();
    }

    public function login(Request $request){
        $rules = [
            'customer_name' => 'required',
            'customer_password' => 'required'
        ];
        $messages = [
            'customer_name.required' => 'Bạn chưa nhập tên tài khoản',
            'customer_password.required' => 'Bạn chưa nhập mật khẩu'
        ];
        $v = Validator::make($request->all(), $rules, $messages);
        if($v->fails()){
            session()->flash('login_error', 'Thông tin đăng nhập không đúng!');
            return redirect()->back();
        }
        $customer = Customer::where('customer_name', $request->customer_name)
                            ->where('customer_password', md5($request->customer_password))
                            ->first();
        if(is_null($customer)){
            session()->flash('login_error', 'Thông tin đăng nhập không đúng!');
            return redirect()->back();
        }
        //Lưu phiên đăng nhập của customer này
        session()->put('customer_id', $customer->id);
        session()->put('customer_name', $customer->customer_name);
        return redirect("");
    }

    public function logout(){
        session()->forget('customer_id');
        session()->forget('customer_name');
        return redirect("");
    }

    //update customer
    public function showUpdateForm(){
        $customer = Customer::find(session('customer_id'));
        return view("pages.customer_info", compact('customer'));
    }

    public function changePassword(Request $request){
        $rules = [
            'customer_password' => 'required|min:8',
            'new_customer_password' => 'required|min:8',
            'new_customer_password_confirmation' => 'required|min:8|same:new_customer_password'
        ];
        $messages = [
            'customer_password.required' => 'Mật khẩu không để trống',
            'customer_password.min' => 'Mật khẩu tối thiểu 8 ký tự',
            'new_customer_password.required' => 'Mật khẩu mới không để trống',
            'new_customer_password.min' => 'Mật khẩu mới tối thiểu 8 ký tự',
            'new_customer_password_confirmation.required' => 'Mật khẩu không khớp',
            'new_customer_password_confirmation.min' => 'Mật khẩu không khớp',
            'new_customer_password_confirmation.same' => 'Mật khẩu không khớp'
        ];
        $v = Validator::make($request->all(), $rules, $messages);
        if($v->fails()){
            $dataEntered = array(
                'customer_password' => $request->customer_password,
                'new_customer_password' => $request->new_customer_password,
                'new_customer_password_confirmation' => $request->new_customer_password_confirmation
            );
            session()->flash('dataEntered', $dataEntered);
            return redirect()->back()->withErrors($v->errors())->withInput();
        }

        $customer = Customer::find(session('customer_id'));
        // print_r($customer);
        if($customer->customer_password != md5($request->customer_password)){
            echo "MK ko khớp";
            session()->flash('pass_err', 'Sai mật khẩu hiện tại!');
            $dataEntered = array(
                'customer_password' => $request->customer_password,
                'new_customer_password' => $request->new_customer_password,
                'new_customer_password_confirmation' => $request->new_customer_password_confirmation
            );
            session()->flash('dataEntered', $dataEntered);
            return redirect()->back();
        }
        $customer->customer_password = md5($request->new_customer_password);
        if(!$customer->save()){
            //
        } else{
            return redirect()->route('home');
        }
    }

    public function changeInfo(Request $request){
        //auto update. don't validate
        $customer = Customer::find(session('customer_id'));
        $customer->full_name = $request->full_name;
        $customer->phone = $request->phone;
        $customer->date = $request->date;
        $customer->address = $request->address;
        if($customer->save()){
            session()->flash('messages', 'Cập nhật thành công!');
            return redirect()->back();
        }
        session()->flash('messages', 'Cập nhật không thành công!');
            return redirect()->back();
    }

    public function showForgotPasswordForm(){
        return view("pages.customer_forgot_password");
    }

    public function sendPasswordToEmail(Request $request){
        $rules = [
            'customer_email' => 'required'
        ];
        $messages = [
            'customer_email.required' => 'Bạn chưa nhập Email'
        ];
        $v = Validator::make($request->all(), $rules, $messages);
        if($v->fails()){
            session()->flash('error', 'Bạn chưa nhập Email');
            return redirect()->back()->withErrors($v->errors())->withInput();
        }
        $customer = Customer::where('email', $request->customer_email)->first();
        if(is_null($customer)){
            session()->flash('error', 'Email không tồn tại');
            return redirect()->back()->withErrors($v->errors())->withInput();
        }
        $emailTitle = "Thay đổi mật khẩu tài khoản!";
        $createdPassword = strtolower(Str::random(8));
        $customer->customer_password = md5($createdPassword);
        $customer->save();
        $dataArr = array(
            'customer_name' => $customer->customer_name,
            'customer_password' => $createdPassword
        );
        Mail::to($request->customer_email)->send(
            new SignUpShoppingMail($emailTitle, $dataArr));
        session()->flash('messages', 'Lấy mật khẩu thành công, Kiểm tra Email để có thông tin đăng nhập');
        return redirect()->route('login-form');
    }
    //===BackEnd for Customer===
    public function index(){
        $customers = Customer::orderByDesc('id')->paginate(env('ITEM_PER_PAGE'));
        return view("admin.customers.customer_list", compact('customers'));
    }

    public function showInfo($id){
        $customer = Customer::find($id);
        return view("admin.customers.customer_detail", compact('customer'));
    }

    public function showCarts($id){
        $customer = Customer::find($id);
        $orders = $customer->orders;
        return view("admin.customers.customer_carts", compact('orders'));
    }
}
