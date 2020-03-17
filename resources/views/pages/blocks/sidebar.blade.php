<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Danh mục sản phẩm</h2>
        <div class="panel-group category-products" id="accordian">
            <!--category-productsr-->
            @foreach ($SHARED_DATA['categories'] as $item)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="{{ route('products-by-category',
                        ['slug'=> "$item->slug-$item->id.html"]) }}">{{$item->name}}</a>
                    </h4>
                </div>
            </div>
            @endforeach
        </div>
        <!--/category-products-->

        <div class="brands_products">
            <!--brands_products-->
            <h2>Thương hiệu sản phẩm</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    {{-- <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li> --}}
                    @foreach ($SHARED_DATA['brands'] as $item)
                        <li>
                            <a href="{{ route('products-by-brand',
                             ['slug'=>"$item->slug-$item->id.html"]) }}">{{$item->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!--/brands_products-->

    </div>
    </div>
