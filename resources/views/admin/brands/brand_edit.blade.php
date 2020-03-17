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

    <form action="{{ url("/admin/brands/$brand->id/edit") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="brand_name">Tên thương hiệu</label>
            <input type="hidden" id="id" name="id" value="{{$brand->id}}" />
            <input class="form-control" id="brand_name" name="brand_name" autocomplete="off"
                value="<?php if(Session::has('dataEntered')) echo Session::get('dataEntered')['brand_name'];
                            else echo $brand->desc; ?>">
        </div>
        <div class="form-group">
            <label for="brand_desc">Mô tả</label>
            <textarea class="form-control" name="brand_desc" id="brand_desc" cols="30"
        rows="5"><?php
        if(Session::has('dataEntered')) echo Session::get('dataEntered')['brand_desc'];
             else echo $brand->desc;?></textarea>
        </div>
        <div class="form-group">
            <label for="brand_status"><strong>Trạng thái</strong></label>
            <select class="custom-select" id="brand_status" name="brand_status">
                <?php
                    if(Session::has('dataEntered')){
                        ?>
                <option value="1" <?php if(Session::get('dataEntered')['brand_status']==1) echo 'selected'; ?>>Hiển thị
                </option>
                <option value="0" <?php if(Session::get('dataEntered')['brand_status']==0) echo 'selected'; ?>>Ẩn</option>
                <?php
                    } else{
                        ?>
                <option value="1" <?php if($brand->status==1) echo 'selected'; ?>>Hiển thị</option>
                <option value="0" <?php if($brand->status==0) echo 'selected'; ?>>Ẩn</option>
                <?php
                    }
                ?>

            </select>
        </div>
        <button type="submit" class="btn btn-primary" style="width: 84px;">Lưu</button>
        <a class="btn btn-danger" href="{{ url('admin/brands') }}">Quay lại</a>

    </form>
</div>

@endsection
