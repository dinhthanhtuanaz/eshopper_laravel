@extends('layouts.layout')
@section('content')
<div id="login-page" class="container" style="padding-bottom:30px;">
    <div class="bg">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <!--login form-->
                    <h2>Lấy lại mật khẩu</h2>
                    @if(session()->has('error'))
                    <div class="alert alert-warning alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <strong>{{session('error')}}</strong>
                    </div>
                    @endif
                    <form action="{{ route('send-pass') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="customer_email">Email</label>
                            <input type="email" class="form-control" id="customer_email" name="customer_email"
                                placeholder="Nhập đúng Email của bạn">
                        </div>
                        <button type="submit" class="btn btn-default" style="margin-top: 10px;">Xác nhận</button>
                    </form>
                </div>
                <!--/login form-->
            </div>
        </div>
    </div>
</div>
@endsection
