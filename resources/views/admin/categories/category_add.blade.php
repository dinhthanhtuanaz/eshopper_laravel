@extends('layouts.admin_layout')
@section('admin_content')
<div>
    @if(count($errors)>0)
        <div class="alert alert-danger alert-dismissible show" role="alert">
                <ul class="ul-reset">
                    @foreach($errors->all() as $error)
                        <li>- {{$error}}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    @endif

    <form action="{{ url('/admin/categories/create') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="category_name">Tên danh mục</label>
            <input class="form-control" id="category_name" name="category_name" autocomplete="off"
                    value="{{Session::get('dataEntered')['category_name']}}">
        </div>
        <div class="form-group">
            <label for="category_desc">Mô tả</label>
            <textarea class="form-control" name="category_desc" id="category_desc" cols="30"
        rows="5">{{Session::get('dataEntered')['category_desc']}}</textarea>
        </div>
        <div class="form-group">
            <label for="category_status"><strong>Trạng thái</strong></label>
            <select class="custom-select" id="category_status" name="category_status">
                <?php
                    if(Session::has('dataEntered')){
                        ?>
                <option value="1" <?php if(Session::get('dataEntered')['category_status']==1) echo 'selected'; ?>>Hiển thị
                </option>
                <option value="0" <?php if(Session::get('dataEntered')['category_status']==0) echo 'selected'; ?>>Ẩn</option>
                <?php
                    } else{
                        ?>
                <option value="1">Hiển thị</option>
                <option value="0">Ẩn</option>
                <?php
                    }
                ?>

            </select>
        </div>
        <button type="submit" class="btn btn-primary" style="width: 84px;">Lưu</button>
        <a class="btn btn-danger" href="{{ url('admin/categories') }}">Quay lại</a>

    </form>
</div>

@endsection
