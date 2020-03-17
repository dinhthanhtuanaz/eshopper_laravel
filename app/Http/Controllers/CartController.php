<?php

namespace App\Http\Controllers;

use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function addProductToCart(Request $request){
        $productId = $request->product_id_hidden;
        $qty = $request->qty;
        $product = Product::find($productId);
        $cart = array(
            'id' => $productId,
            'name' => $product->name,
            'qty' => $qty,
            'price' => $product->price,
            'weight' => 0,
            'options' => ['image' => $product->image]
        );
        Cart::add($cart);
        return redirect()->route('cart');
    }
    public function showCart(){
        return view("pages.cart");
    }
    public function deleteOneCart(Request $request){
        $rowId = $request->rowId;
        Cart::update($rowId, 0);
        return redirect()->route('cart');
    }
    public function updateOneCart(Request $request){
        $rowId = $request->rowId;
        $qty = $request->qty;
        Cart::update($rowId, $qty);
        return redirect()->route('cart');
    }
    public function removeCart(){
        Cart::destroy();
        return redirect("");
    }

    //Handle pay cart
    public function showPaymentForm(){
        return view("pages.cart_payment");
    }
    public function payCart(Request $request){
        $rules = [
            'order_receiver' => 'required',
            'order_phone' => 'required',
            'order_address' => 'required'
        ];
        $messages = [
            'order_receiver.required' => 'Họ tên người nhận không được để trống!',
            'order_phone.required' => 'Điện thoại người nhận không được để trống!',
            'order_address.required' => 'Địa chỉ người nhận không được để trống!'
        ];
        $v = Validator::make($request->all(), $rules, $messages);
        if($v->fails()){
            $dataEntered = array(
                'order_receiver' => $request->order_receiver,
                'order_phone' => $request->order_phone,
                'order_address' => $request->order_address,
                'order_note' => $request->order_note,
                'order_email' => isset($request->order_email) ? "checked" : "unchecked"
            );
            session()->flash('dataEntered', $dataEntered);
            return redirect()->back()->withErrors($v->errors())->withInput();
        }
        $order = new Order();
        $order->customer_id = session('customer_id');
        $order->order_receiver = $request->order_receiver;
        $order->order_phone = $request->order_phone;
        $order->order_address = $request->order_address;
        $order->order_note = $request->order_note;
        if(!$order->save()){
            //Xử lý lỗi
            //return

        }
        //Có ID của order rồi
        $orderId = $order->id;
        $carts = Cart::content();
        foreach($carts as $cart){
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $orderId;
            $orderDetail->product_id = $cart->id;
            $orderDetail->quantity = $cart->qty;
            $orderDetail->save();
        }
        Cart::destroy();
        return redirect()->route('home');
    }

    //BackEnd - Admin
    public function showOrders(){
        return view("admin.orders.order_list");
    }
}
