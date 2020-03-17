@extends('layouts.layout')
@section('sidebar')
@include('pages.blocks.sidebar')
@endsection
@section('content')

<div class="features_items">
    <!--features_items-->
    @if(count($products)>0)
    <h2 class="title text-center">{{$products[0]->category->name}}</h2>
    @else
    <h2 class="title text-center">Chưa có sản phẩm</h2>
    @endif

    @foreach ($products as $item)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <a href="{{ route('detail-product', ['slug'=> "$item->slug-$item->id.html"]) }}">
                        <img height="240" src="{{ asset("public/uploads/products/$item->image") }}"
                            alt="{{$item->slug}}" title="{{$item->name}}" />
                    </a>
                    <h6>{{number_format($item->price) . ' VNĐ'}}</h6>
                    <h5><a
                            href="{{ route('detail-product', ['slug'=> "$item->slug-$item->id.html"]) }}">{{$item->name}}</a>
                    </h5>
                    <form action="{{ route('add-product') }}" method="POST">
                        @csrf
                        <input type="hidden" name="qty" value="1" />
                        <input type="hidden" name="product_id_hidden" value="{{$item->id}}">
                        <button type="submit" class="btn btn-fefault cart"
                            style="margin-left:0; margin-bottom:15px;">
                            <i class="fa fa-shopping-cart"></i>
                            Mua
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="row" style="clear:both;text-align: right;">
            <div class="col-12 pagination-center">
                {{$products->render()}}
            </div>
        </div>
</div>

@stop
