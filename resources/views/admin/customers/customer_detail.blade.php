@extends('layouts.admin_layout');
@section('admin_content')
<div>
    <h3>Thông tin Khách hàng</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>Tên đăng nhập</th>
            <td>{{$customer->customer_name}}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{$customer->email}}</td>
        </tr>
        <tr>
            <th>Họ tên</th>
            <td>{{$customer->full_name}}</td>
        </tr>
        <tr>
            <th>Điện thoại</th>
            <td>{{$customer->phone}}</td>
        </tr>
        <tr>
            <th>Ngày sinh</th>
            <td>{{date('d-m-Y', strtotime($customer->date))}}</td>
        </tr>
        <tr>
            <th>Địa chỉ</th>
            <td>{{$customer->address}}</td>
        </tr>
        <tr>
            <th>Ngày đăng ký</th>
            <td>{{date('d-m-Y', strtotime($customer->created_at))}}</td>
        </tr>
    </table>
</div>

@endsection
