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

    <div class="wrap-content_head">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="breadcome-heading">
                    <form action="{{ url('admin/categories/search') }}" role="search" class="sr-input-func" id="search-form" method="POST">
                        @csrf
                        <input type="text" placeholder="Tìm kiếm..." class="search-int form-control"
                            style="background:#fff" name="category_keyword">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <a href="{{ url('/admin/categories/create') }}" class="btn btn-primary float-right">Thêm</a>
            </div>
        </div>
    </div>
    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th scope="col" class="width-45">#</th>
                <th scope="col" style="width:200px;">Tên danh mục</th>
                <th scope="col">Mô tả</th>
                <th scope="col" style="width:100px;">Trạng thái</th>
                <th scope="col" class="width-110">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @php $index=1; @endphp
             @foreach ($categories as $item)
                <tr>
                    <th scope="row">{{$index++}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->desc}}</td>
                    <td>
                        <a href="{{ url("/admin/categories/$item->id/$item->status") }}">@php
                            echo $item->status ? 'Hiển thị' : 'Ẩn'
                        @endphp</a>
                    </td>
                    <td>
                        <a href="{{ url("/admin/categories/$item->id/edit") }}" class="btn-custom-1">
                            <i class="far fa-edit text-warning fs-24"></i>
                        </a>
                        <a href="{{ url("/admin/categories/$item->id/delete") }}" class="btn-custom-1"
                            onclick="return confirm('Bạn có chắc chắn xóa không ?')">
                            <i class="far fa-trash-alt fs-24 text-danger"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if(!Session::has("hasPagination"))
        <div class="row ">
            <div class="col-12 pagination-center">
                {{$categories->links()}}
            </div>
        </div>
    @endif
</div>
@endsection

