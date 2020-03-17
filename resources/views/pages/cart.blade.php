@extends('layouts.layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb breadcrumb-custom">
              <li><a href="{{ url('') }}">Trang chủ</a></li>
              <li class="active">Giỏ hàng</li>
            </ol>
        </div>

    </div>
</section>
<!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="table-responsive cart_info cart_info-custom">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="cart-no">#</td>
                                <td class="image">Ảnh</td>
                                <td class="name">Tên sản phẩm</td>
                                <td class="price">Giá</td>
                                <td class="quantity">Số lượng</td>
                                <td class="total">Tổng</td>
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
                                $slugName = str_slug($item->name);
                            @endphp
                            <tr>
                                <td style="text-align:center;"><strong>{{$index++}}</strong></td>
                                <td class="cart_product">
                                    @php
                                        $image = $item->options->image;
                                    @endphp
                                    <a target="_blank" href="{{ route('detail-product', ['slug'=> "$slugName-$item->id.html"]) }}">
                                        <img  src="{{ asset("public/uploads/products/$image") }}"
                                        alt="" width="35" height="35">
                                    </a>
                                </td>
                                <td class="cart_name">
                                    <h4>
                                        <a target="_blank" href="{{ route('detail-product', ['slug'=> "$slugName-$item->id.html"]) }}">{{$item->name}}</a>
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
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="total_area total_area_custom">
                    <ul>
                        <li>Tổng <span>{{number_format($total) . ' đ'}}</span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Thành tiền <span>{{number_format($total) . ' đ'}}</span></li>
                    </ul>
                        <div style="text-align:center;">
                            <a class="btn btn-default update" href="{{ route('remove-cart') }}"
                                onclick="return confirm('Bạn chắc chắn xóa giỏ hàng?');">Xóa giỏ hàng</a>
                            <a class="btn btn-default check_out" href="{{ route('payment-form') }}">Thanh toán</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->
@endsection
