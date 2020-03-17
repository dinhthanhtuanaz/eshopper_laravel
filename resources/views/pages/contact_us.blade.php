@extends('layouts.layout')
@section('content')
<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center">Liên hệ với chúng tôi</h2>
                    <div class="status alert alert-success" style="display: none"></div>
                    <form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                        <div class="form-group col-md-6">
                            <input type="text" name="name" class="form-control" required="required" placeholder="Tên">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" name="email" class="form-control" required="required"
                                placeholder="Email">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="subject" class="form-control" required="required"
                                placeholder="Điện thoại">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="message" id="message" required="required" class="form-control" rows="8"
                                placeholder="Nhập nội dung"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary pull-right"
                                style="margin-top:0;" value="Gửi">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="contact-info">
                    <h2 class="title text-center">Thông tin liên hệ</h2>
                    <address>
                        <p>E-Shopper Inc.</p>
                        <p>Đường 32 Cầu Diễn, phường Minh Khai, Bắc Từ Liêm, HN</p>
                        <p>Mobile: (+84)34 258 2266</p>
                        <p>Email: dinhthanhtuanaz@gmail.com</p>
                    </address>
                    <div class="social-networks">
                        <h2 class="title text-center">Mạng xã hội</h2>
                        <ul>
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
