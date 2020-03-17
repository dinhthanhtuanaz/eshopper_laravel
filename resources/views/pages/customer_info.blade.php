@extends('layouts.layout')
@section('sidebar')
@include('pages.blocks.sidebar')
@endsection
@section('content')
<div class="features_items">
    <h2 class="title text-center">Tài khoản</h2>
    <div class="row">
        <div class="col-sm-6">
            <h3 style="margin-top:0;">Đổi mật khẩu</h3>
            @if(session()->has('pass_err'))

            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <p>- {{session('pass_err')}}</p>
            </div>
            @endif
            <form action="{{ route('change-password') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="customer_password">Mật khẩu hiện tại:</label>
                    <input type="password" class="form-control" id="customer_password"
                            name="customer_password" value="<?php
                                if(session()->has('dataEntered') && isset(session()->get('dataEntered')['customer_password']))
                                    echo session()->get('dataEntered')['customer_password'];
                            ?>">
                    @if($errors->has('customer_password'))
                    <p class="err-label">{{$errors->first('customer_password')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="new_customer_password">Mật khẩu mới:</label>
                    <input type="password" class="form-control" id="new_customer_password"
                            name="new_customer_password" value="<?php
                            if(session()->has('dataEntered') && isset(session()->get('dataEntered')['new_customer_password']))
                                echo session()->get('dataEntered')['new_customer_password'];
                        ?>">
                    @if($errors->has('new_customer_password'))
                    <p class="err-label">{{$errors->first('new_customer_password')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="re_customer_password">Nhập lại mật khẩu:</label>
                    <input type="password" class="form-control" id="new_customer_password_confirmation"
                        name="new_customer_password_confirmation" value="<?php
                        if(session()->has('dataEntered') && isset(session()->get('dataEntered')['new_customer_password_confirmation']))
                            echo session()->get('dataEntered')['new_customer_password_confirmation'];
                    ?>">
                        @if($errors->has('new_customer_password_confirmation'))
                        <p class="err-label">{{$errors->first('new_customer_password_confirmation')}}</p>
                        @endif
                </div>
                <button type="submit" class="btn btn-default">Cập nhật</button>
            </form>
        </div>
        <div class="col-sm-6">
            <h3 style="margin-top:0;">Cập nhật thông tin</h3>
            @if(session()->has('messages'))

            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <p>- {{session('messages')}}</p>
            </div>
            @endif

            <form action="{{ route('change-info') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="full_name">Họ và tên:</label>
                    <input type="text" class="form-control" id="full_name" name="full_name"
                        value="{{$customer->full_name}}">
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại:</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                    value="{{$customer->phone}}">
                </div>
                <div class="form-group">
                    <label for="date">Ngày sinh:</label>
                    <input type="date" class="form-control" id="date" name="date"
                    value="{{$customer->date}}">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ:</label>
                    <input type="text" class="form-control" id="address" name="address"
                    value="{{$customer->address}}">
                </div>
                <button type="submit" class="btn btn-default">Xác nhận</button>
            </form>
        </div>
    </div>

</div>



@stop
