@extends('layouts.layout')
@section('slider')
@include('pages.blocks.slider')
@endsection
@section('sidebar')
@include('pages.blocks.sidebar')
@endsection
@section('content')
<div class="col-sm-9 padding-right">
    <div class="features_items">
        <!--features_items-->
        <h2 class="title text-center">Sản phẩm mới nhất</h2>
        @foreach ($newProducts as $item)
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
                {{$newProducts->render()}}
            </div>
        </div>
    </div>

    <div class="recommended_items">
        <!--recommended_items-->
        <h2 class="title text-center">Sản phẩm nổi bật</h2>

        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                    $sizeHotProducts=floor(count($hotProducts)/3); //4/1=1
                    for($index=0; $index < $sizeHotProducts; $index++){
                        $start=$index*3;
                        $item0 = $hotProducts[$start];
                        $item1 = $hotProducts[$start+1];
                        $item2 = $hotProducts[$start+2];
                        ?>
                <div class="item <?php if($index==0) echo 'active'; ?>">

                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{ route('detail-product', ['slug'=> "$item0->slug-$item0->id.html"]) }}">
                                        <img height="240" src="{{ asset("public/uploads/products/$item0->image") }}"
                                            alt="{{$item0->slug}}" title="{{$item0->name}}" />
                                    </a>
                                    <h6>{{number_format($item0->price) . ' VNĐ'}}</h6>
                                    <h5><a
                                            href="{{ route('detail-product', ['slug'=> "$item0->slug-$item0->id.html"]) }}">{{$item0->name}}</a>
                                    </h5>
                                    <form action="{{ route('add-product') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="qty" value="1" />
                                        <input type="hidden" name="product_id_hidden" value="{{$item0->id}}">
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
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{ route('detail-product', ['slug'=> "$item1->slug-$item1->id.html"]) }}">
                                        <img height="240" src="{{ asset("public/uploads/products/$item1->image") }}"
                                            alt="{{$item1->slug}}" title="{{$item1->name}}" />
                                    </a>
                                    <h6>{{number_format($item1->price) . ' VNĐ'}}</h6>
                                    <h5><a
                                            href="{{ route('detail-product', ['slug'=> "$item1->slug-$item1->id.html"]) }}">{{$item1->name}}</a>
                                    </h5>
                                    <form action="{{ route('add-product') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="qty" value="1" />
                                        <input type="hidden" name="product_id_hidden" value="{{$item1->id}}">
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
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{ route('detail-product', ['slug'=> "$item2->slug-$item2->id.html"]) }}">
                                        <img height="240" src="{{ asset("public/uploads/products/$item2->image") }}"
                                            alt="{{$item2->slug}}" title="{{$item2->name}}" />
                                    </a>
                                    <h6>{{number_format($item2->price) . ' VNĐ'}}</h6>
                                    <h5><a
                                            href="{{ route('detail-product', ['slug'=> "$item2->slug-$item2->id.html"]) }}">{{$item2->name}}</a>
                                    </h5>
                                    <form action="{{ route('add-product') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="qty" value="1" />
                                        <input type="hidden" name="product_id_hidden" value="{{$item2->id}}">
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
                </div>
                <?php
                    }
                ?>
            </div>

            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
    <!--/recommended_items-->
    @endsection
