@extends('layouts.admin_layout')
@section('admin_content')
<div id="wrap-content">
    <?php
        if(Session::has('messages')){
            ?>
                <div class="alert alert-primary alert-dismissible show" role="alert">
                <strong>{{Session::get('messages')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            <?php
        }
    ?>

    <div class="wrap-content_head">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="breadcome-heading">
                    <form role="search" class="sr-input-func" id="search-form" method="POST" action="">
                        <input type="text" placeholder="Tìm kiếm..." class="search-int form-control"
                            style="background:#fff">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <a href="{{ url('/admin/products/create') }}" class="btn btn-primary float-right">Thêm</a>
            </div>
        </div>
    </div>
    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th scope="col" class="width-45">#</th>
                <th scope="col" style="width:200px;">Mã khách hàng</th>
                <th scope="col" >Người nhận</th>
                <th scope="col" >Điện thoại</th>
                <th scope="col" >Địa chỉ</th>
                <th scope="col" >Ghi chú</th>
                <th scope="col" >Trạng thái</th>
                <th scope="col" class="width-110">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @php $index=1; @endphp
            @foreach ($orders as $item)
                <tr>
                    <th scope="row">{{$index++}}</th>
                    <td>{{$item->customer_id}}</td>
                    <td>{{$item->order_receiver}}</td>
                    <td>{{$item->order_phone}}</td>
                    <td>{{$item->order_address}}</td>
                    <td>{{$item->order_note}}</td>
                    <td>{{printOrderStatus($item->status)}}</td>
                    <td>
                        <a title="Xem chi tiết" href="{{ url("/admin/customers/$item->id/showOrderDetail") }}" class="btn-custom-1">
                            <i class="far fa-eye text-success"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <div class="row ">
        <div class="col-12 pagination-center">
            {{$customers->render()}}
        </div>
    </div> --}}
</div>
@endsection
