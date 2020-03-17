@extends('layouts.admin_layout')
@section('admin_content')
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h2>Thông tin shop</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" disabled class="form-control" id="email" name="email"
                        value="dinhthanhtuanaz@gmail.com">
                </div>
                <div class="form-group">
                    <label for="text">Tên shop:</label>
                    <input type="text" class="form-control" id="text" name="text">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input type="text" class="form-control" id="address" name="address">
                </div>
                <div class="form-group">
                    <label for="map_address">Google map</label>
                    <input type="text" class="form-control" id="map_address" name="map_address">
                </div>
                <div class="form-group">
                    <label for="phone">Điện thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" name="facebook">
                </div>
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea id="description" class="form-control" name="description" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
        </div>
        <div class="col-sm-6">
            <h2>Đổi mật khẩu</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="password">Mật khẩu hiện tại:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="new_password">Mật khẩu mới:</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                </div>
                <div class="form-group">
                    <label for="new_password_confirmation">Nhập lại mật khẩu mới:</label>
                    <input type="password" class="form-control" id="new_password_confirmation"
                        name="new_password_confirmation">
                </div>
                <button type="submit" class="btn btn-danger">Xác nhận</button>
            </form>
        </div>
    </div>
</div>
@endsection
