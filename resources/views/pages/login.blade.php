@extends('layouts.layout')
@section('content')
<div id="login-page" class="container" style="padding-bottom:30px;">
    <div class="bg">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <!--login form-->
                    <h2>Đăng nhập</h2>
                    @if(session()->has('messages'))
                    <div class="alert alert-warning alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <strong>{{session('messages')}}</strong>
                    </div>
                    @endif
                    @if(session()->has('login_error'))
                    <div class="alert alert-warning alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <strong>{{session('login_error')}}</strong>
                    </div>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="customer_name">Tên tài khoản</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name"
                                placeholder="Tối thiểu 8 ký tự">
                        </div>
                        <div class="form-group">
                            <label for="customer_name">Mật khẩu</label>
                            <input type="password" class="form-control" id="customer_password" name="customer_password"
                                placeholder="Tối thiểu 8 ký tự" >
                        </div>
                        <a href="{{ url('lay-mat-khau.html') }}">Quên mật khẩu</a>
                        {{-- <span>
                            <input type="checkbox" class="checkbox">
                            Lưu tài khoản
                        </span> --}}
                        <button type="submit" class="btn btn-default" style="margin-top: 10px;">Đăng nhập</button>
                    </form>
                </div>
                <!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">


                <div class="signup-form">
                    <!--sign up form-->
                    <h2>Tạo tài khoản mới</h2>
                    @if(count($errors)>0)
                    <div class="alert alert-warning alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        @foreach ($errors->all() as $error)
                        <p>- {{$error}}</p>
                        @endforeach
                    </div>
                    @endif
                    @if(session()->has('email_error'))
                    <div class="alert alert-warning alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <p>- {{session('email_error')}}</p>
                    </div>
                    @endif
                    <form action="{{ route('signUp') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="customer_name">Tên tài khoản</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name"
                                placeholder="Tối thiểu 8 ký tự" value="<?php if(session()->has('dataEntered'))
                                echo session('dataEntered')['customer_name']?>">
                        </div>
                        <div class="form-group">
                            <label for="customer_email">Địa chỉ Email</label>
                            <input type="email" class="form-control" id="customer_email" name="customer_email"
                                placeholder="Mật khẩu sẽ được gửi đến email" value="<?php if(session()->has('dataEntered'))
                                echo session('dataEntered')['customer_email']?>">
                        </div>
                        <button type="submit" class="btn btn-default">Đăng ký</button>
                    </form>
                </div>
                <!--/sign up form-->
            </div>
        </div>
    </div>
</div>
@endsection
