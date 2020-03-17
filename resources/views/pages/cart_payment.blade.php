@extends('layouts.layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb breadcrumb-custom">
              <li><a href="{{ url('') }}">Trang chủ</a></li>
              <li class="active">Thanh toán</li>
            </ol>
        </div>

    </div>
</section>
<!--/#cart_items-->

<section id="do_action">
    <div class="container">

        <div class="row">
            <div class="col-sm-7">
                <div class="table-responsive cart_info cart_info-custom">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="cart-no">#</td>
                                <td class="image">Ảnh</td>
                                <td class="name">Tên sản phẩm</td>
                                <td class="price" style="width:100px;">Giá</td>
                                <td class="quantity" style="width:8px;">Số lượng</td>
                                <td class="total" style="width:100px;">Tổng</td>
                                <td class="remove">Xóa</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $carts = Cart::content();
                                $index=1;
                                $total=0;
                            @endphp
                            @foreach ($carts as $item)
                            @php
                                $subTotal = $item->qty*$item->price;
                                $total += $subTotal;
                                $slug = str_slug($item->name);
                            @endphp
                            <tr>
                                <td style="text-align:center;"><strong>{{$index++}}</strong></td>
                                <td class="cart_product">
                                    @php
                                        $image = $item->options->image;
                                    @endphp
                                    <a target="_blank" href="{{ url("/chi-tiet/$slug/$item->id") }}">
                                        <img  src="{{ asset("public/uploads/products/$image") }}"
                                        alt="" width="35" height="35">
                                    </a>
                                </td>
                                <td class="cart_name">
                                    <h4>
                                        <a target="_blank" href="{{ url("/chi-tiet/$slug/$item->id") }}">{{$item->name}}</a>
                                    </h4>
                                </td>
                                <td class="">
                                    <span>{{number_format($item->price) . ' đ'}}</span>
                                </td>
                                <td class="">
                                    <form action="{{ route('update-cart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="rowId" value="{{$item->rowId}}" />
                                        <input class="cart_quantity_input" type="number" name="qty"
                                        value="{{$item->qty}}" autocomplete="off" min="0" max="10">
                                        <input type="submit" value="Cập nhật" class="btn-update-cart" />
                                    </form>
                                </td>
                                <td class="">
                                    <span>{{number_format($subTotal) . ' đ'}}</span>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete"
                                        onclick="return confirm('Bạn muốn xóa sản phẩm này ?')"
                                        href="{{ route('delete-item-cart', ['rowId'=> "$item->rowId"]) }}">
                                        <i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="7" style="text-align:right;color:red; font-size:20px;">
                                    <span>Tổng tiền: </span>
                                    <strong>{{money_format($total)}}</strong>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-5">
                <form action="{{ route('pay-cart') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="order_receiver">Họ tên người nhận <span class="text-red">(*)</span></label>
                      <input type="text" class="form-control" id="order_receiver"
                            name="order_receiver" value="<?php if(session()->has('dataEntered'))
                                echo session('dataEntered')['order_receiver'];
                            ?>">
                            @if($errors->has('order_receiver'))

                      <p class="err-label">{{$errors->first('order_receiver')}}</p>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="order_phone">Số điện thoại<span class="text-red">(*)</span></label>
                      <input type="text" class="form-control" id="order_phone"
                            name="order_phone" value="<?php if(session()->has('dataEntered'))
                            echo session('dataEntered')['order_phone'];
                        ?>">
                            @if($errors->has('order_phone'))

                      <p class="err-label">{{$errors->first('order_phone')}}</p>
                      @endif
                    </div>
                    <div class="form-group">
                        <label for="order_address">Địa chỉ nhận<span class="text-red">(*)</span></label>
                        <input type="text" class="form-control" id="order_address"
                        name="order_address" value="<?php if(session()->has('dataEntered'))
                        echo session('dataEntered')['order_address'];
                    ?>">
                        @if($errors->has('order_address'))

                      <p class="err-label">{{$errors->first('order_address')}}</p>
                      @endif
                      </div>
                      <div class="form-group">
                        <label for="order_note">Ghi chú</label>
                        <textarea class="form-control" name="order_note" id="order_note"
                            cols="30" rows="5"><?php if(session()->has('dataEntered'))
                            echo session('dataEntered')['order_note'];
                        ?></textarea>
                    </div>
                    <div class="checkbox">
                      <label><input type="checkbox" name="order_email"
                            <?php if(session()->has('dataEntered')) echo session('dataEntered')['order_email'];?>
                        > Nhận hóa đơn qua Email</label>
                    </div>
                    <button type="submit" class="btn btn-default">Xác nhận</button>
                  </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">

            </div>
        </div>
    </div>
</section>
<!--/#do_action-->
@endsection
