@extends('layouts.admin_layout');
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
    <form action="{{ url('/admin/products/create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="product_name"><strong>Tên sản phẩm</strong></label>
                    <input class="form-control" id="product_name" name="product_name" autocomplete="off"
                        value="{{Session::get('dataEntered')['product_name']}}">
                </div>

                <div class="form-group">
                    <label for="product_price"><strong>Giá sản phẩm</strong></label>
                    <input type="number" class="form-control" id="product_price" name="product_price" autocomplete="off"
                        value="{{Session::get('dataEntered')['product_price']}}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="product_category"><strong>Danh mục</strong></label>
                    {!!spSelectTag("custom-select", "product_category", "product_category",
                    "dataEntered", $categories)!!}
                </div>
                <div class="form-group">
                    <label for="product_brand"><strong>Thương hiệu</strong></label>
                    {!!spSelectTag("custom-select", "product_brand", "product_brand",
                    "dataEntered", $brands)!!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="product_image"><strong>Hình sản phẩm</strong></label>
                    <input type="file" class="form-control-file d-inline-block" id="product_image" name="product_image"
                        autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="product_hot"><strong>Là sản phẩm nổi bật</strong></label>
                    {!!spSelectTwoStateTag("custom-select", "product_hot",
                    "product_hot", "dataEntered", "Có", "Không", false)!!}
                </div>
                <div class="form-group">
                    <label for="product_status"><strong>Trạng thái</strong></label>
                    {!!spSelectTwoStateTag("custom-select", "product_status",
                    "product_status", "dataEntered", "Hiển thị", "Ẩn")!!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="product_desc"><strong>Mô tả</strong></label>
                    <textarea class="form-control" name="product_desc" id="product_desc" cols="30"
                        rows="8">{{Session::get('dataEntered')['product_desc']}}</textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="product_content"><strong>Nội dung</strong></label>
            <textarea class="form-control" name="product_content" id="product_content" cols="30"
                rows="10">{{Session::get('dataEntered')['product_desc']}}</textarea>
        </div>


        <button type="submit" class="btn btn-primary" style="width: 84px;">Lưu</button>
        <a class="btn btn-danger" href="{{ url('admin/products') }}">Quay lại</a>

    </form>
</div>

@endsection
@section('areaCKEditor')
<script>
    CKEDITOR.replace( 'product_content' );
</script>
@endsection
