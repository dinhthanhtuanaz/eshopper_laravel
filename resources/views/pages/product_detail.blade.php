@extends('layouts.layout')
@section('sidebar')
@include('pages.blocks.sidebar')
@endsection
@section('content')
    <div class="product-details"><!--product-details-->
        <div class="col-sm-5">
            <div class="view-product">
                <img src="{{ asset("public/uploads/products/$product->image") }}"
                    alt="{{$product->slug}}" />
                <h3>ZOOM</h3>
            </div>


        </div>
        <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->
                <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                <h2>{{$product->name}}</h2>
                <p>Mã : {{$product->id}}</p>
                <form action="{{ route('add-product') }}" method="POST">
                    @csrf
                <span style="display:block;">
                    <span style="font-size:20px;">{{money_format($product->price)}}</span>
                    <label>Số lượng:</label>
                    <input type="number" name="qty" value="1" min="1"/>
                    <input type="hidden" name="product_id_hidden" value="{{$product->id}}">
                </span>
                <button type="submit" class="btn btn-fefault cart" style="margin-left:0; margin-bottom:15px;">
                    <i class="fa fa-shopping-cart"></i>
                    Thêm giỏ hàng
                </button>
            </form>
                <p><b>Tình trạng:</b> Còn hàng</p>
                <p><b>Danh mục:</b> {{$product->category->name}}</p>
                <p><b>Thương hiệu:</b> {{$product->brand->name}}</p>
                <a href=""><img src="{{ asset('public/frontend/images/share.png') }}" class="share img-responsive"  alt="" /></a>
            </div><!--/product-information-->
        </div>
    </div><!--/product-details-->

    <div class="category-tab shop-details-tab"><!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_desc" data-toggle="tab">Mô tả</a></li>
                <li><a href="#tab_content" data-toggle="tab">Nội dung</a></li>
                <li><a href="#tab_reviews" data-toggle="tab">Đánh giá</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="tab_desc" style="padding:20px;" >
                {{$product->desc}}
            </div>
            <div class="tab-pane fade" id="tab_content" style="padding:20px;">
                {!!$product->content!!}
            </div>
            <div class="tab-pane fade" id="tab_reviews" style="padding:20px;">
                Form write review in here
            </div>

        </div>
    </div><!--/category-tab-->
    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">Cùng danh mục</h2>
        @php
            //print_r($relatedProducts);
        @endphp
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                    $sizerelatedProducts = floor(count($relatedProducts)/3);
                    for($index=0; $index < $sizerelatedProducts ; $index++){
                        $start=$index*3;
                        $item0 = $relatedProducts[$start];
                        $item1 = $relatedProducts[$start+1];
                        $item2 = $relatedProducts[$start+2];
                        ?>
                            <div class="item <?php if($index==0) echo 'active'; ?>">

                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href="{{ url("/chi-tiet/$item0->slug/$item0->id") }}">
                                                    <img height="240" src="{{ asset("public/uploads/products/$item0->image") }}"
                                                    alt="{{$item0->slug}}" title="{{$item0->name}}"/>
                                                </a>
                                                <h2>{{number_format($item0->price) . ' VNĐ'}}</h2>
                                                <h5><a href="{{ url("/chi-tiet/$item0->slug/$item0->id") }}">{{$item0->name}}</a></h5>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href="{{ url("/chi-tiet/$item1->slug/$item1->id") }}">
                                                    <img height="240" src="{{ asset("public/uploads/products/$item1->image") }}"
                                                    alt="{{$item1->slug}}" title="{{$item1->name}}"/>
                                                </a>
                                                <h2>{{number_format($item1->price) . ' VNĐ'}}</h2>
                                                <h5><a href="{{ url("/chi-tiet/$item1->slug/$item1->id") }}">{{$item1->name}}</a></h5>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href="{{ url("/chi-tiet/$item2->slug/$item2->id") }}">
                                                    <img height="240" src="{{ asset("public/uploads/products/$item2->image") }}"
                                                    alt="{{$item2->slug}}" title="{{$item2->name}}"/>
                                                </a>
                                                <h2>{{number_format($item2->price) . ' VNĐ'}}</h2>
                                                <h5><a href="{{ url("/chi-tiet/$item2->slug/$item2->id") }}">{{$item2->name}}</a></h5>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
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
    </div><!--/recommended_items-->


@stop
