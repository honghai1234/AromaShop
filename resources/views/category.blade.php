@extends('layout.guest-page')
  
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Shop Category</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->


    <!-- ================ category section start ================= -->
    <section class="section-margin--small mb-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-5">
                    <div class="sidebar-categories">
                        <div class="head">Browse Categories</div>
                        <ul class="main-categories">
                            <li class="common-filter">
                                <form action="#">
                                    <ul>
                                        <li class="filter-list"><input class="pixel-radio" type="radio" id="men"
                                            name="brand" value="0" checked><label
                                            for="men">All</label></li>
                                        @foreach ($categorys as $item)
                                            <li class="filter-list"><input class="pixel-radio" type="radio" id="men"
                                                    name="brand" value="{{ $item['id'] }}"><label
                                                    for="men">{{ $item['name'] }}<span>
                                                        (3600)</span></label></li>
                                        @endforeach
                                    </ul>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="sidebar-filter">
                        <div class="top-filter-head">Product Filters</div>
                        <div class="common-filter">
                            <div class="head">Brands</div>
                            <form action="#">
                                <ul>
                                    <li class="filter-list"><input class="radio-supplier-category" type="radio"
                                        id="radio-supplier-category" value="0"
                                        name="radio-supplier-category" checked><label
                                        for="black">All</label>
                                </li>
                                    @foreach ($suppliers as $item)
                                        <li class="filter-list"><input class="radio-supplier-category" type="radio"
                                                id="radio-supplier-category" value="{{ $item['id'] }}"
                                                name="radio-supplier-category"><label
                                                for="black">{{ $item->name }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </form>
                        </div>
                        <div class="common-filter">
                            <div class="head">Color</div>
                            <form action="#">
                                <ul>
                                    <li class="filter-list"><input class="radio-color-category" type="radio"
                                        id="radio-color-category" value="0"
                                        name="radio-color-category" checked><label
                                        for="black">All</span></label>
                                </li>
                                    @foreach ($querys as $item)
                                        <li class="filter-list"><input class="radio-color-category" type="radio"
                                                id="radio-color-category" value="{{ $item['color'] }}"
                                                name="radio-color-category"><label
                                                for="black">{{ arrayColor($item->color) }}<span>({{ $counted[$item['color']] }})</span></label>
                                        </li>
                                    @endforeach
                                </ul>
                            </form>
                        </div>
                        <div class="common-filter">
                            <div class="head">Price</div>
                            <div class="price-range-area">
                                <div id="price-range"></div>
                                <div class="value-wrapper d-flex">
                                    <div class="price">Price:</div>
                                    <span>$</span>
                                    <div id="lower-value"></div>
                                    <div class="to">to</div>
                                    <span>$</span>
                                    <div id="upper-value"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-7">
                    <!-- Start Filter Bar -->
                    <div class="filter-bar d-flex flex-wrap align-items-center">
                        <div class="sorting">
                            <select>
                                <option value="1">Default sorting</option>
                                <option value="1">Default sorting</option>
                                <option value="1">Default sorting</option>
                            </select>
                        </div>
                        <div class="sorting mr-auto">
                            <select onchange="location = this.options[this.selectedIndex].value;">
                                <option value="{{ route('users.show3') }}">Show 3</option>
                                <option value="{{ route('users.show6') }}">Show 6</option>
                                <option value="{{ route('users.show9') }}">Show 9</option>
                            </select>
                        </div>
                        <div>
                            <div class="input-group filter-bar-search">
                                <input type="text" id="search-category" name="search-category" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="button" onclick=""><i class="ti-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <section class="lattest-product-area pb-40 category-list">
                        <div class="row products-category">
                            @foreach ($products as $item)
                                <x-card_product type="error" :item="$item" />
                            @endforeach
                        </div>
                        <div class="d-print-inline-block">
                            {{ $products->links() }}
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </section>
    <!-- ================ category section end ================= -->

    <!-- ================ top product area start ================= -->
    <section class="related-product-area">
        <div class="container">
            <div class="section-intro pb-60px">
                <p>Popular Item in the market</p>
                <h2>Top <span class="section-intro__style">Product</span></h2>
            </div>
            <div class="row mt-30">
                <div class="col-sm-6 col-xl-3 mb-4 mb-xl-0">
                    <div class="single-search-product-wrapper">
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="img/product/product-sm-1.png" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="img/product/product-sm-2.png" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="img/product/product-sm-3.png" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3 mb-4 mb-xl-0">
                    <div class="single-search-product-wrapper">
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="img/product/product-sm-4.png" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="img/product/product-sm-5.png" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="img/product/product-sm-6.png" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3 mb-4 mb-xl-0">
                    <div class="single-search-product-wrapper">
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="img/product/product-sm-7.png" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="img/product/product-sm-8.png" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="img/product/product-sm-9.png" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3 mb-4 mb-xl-0">
                    <div class="single-search-product-wrapper">
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="img/product/product-sm-1.png" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="img/product/product-sm-2.png" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                        <div class="single-search-product d-flex">
                            <a href="#"><img src="img/product/product-sm-3.png" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Gray Coffee Cup</a>
                                <div class="price">$170.00</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ top product area end ================= -->

    <!-- ================ Subscribe section start ================= -->
    <section class="subscribe-position">
        <div class="container">
            <div class="subscribe text-center">
                <h3 class="subscribe__title">Get Update From Anywhere</h3>
                <p>Bearing Void gathering light light his eavening unto dont afraid</p>
                <div id="mc_embed_signup">
                    <form target="_blank"
                        action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                        method="get" class="subscribe-form form-inline mt-5 pt-1">
                        <div class="form-group ml-sm-auto">
                            <input class="form-control mb-1" type="email" name="EMAIL" placeholder="Enter your email"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '">
                            <div class="info"></div>
                        </div>
                        <button class="button button-subscribe mr-auto mb-1" type="submit">Subscribe Now</button>
                        <div style="position: absolute; left: -5000px;">
                            <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('script')
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    // search category supplier ---------------------------------------------------------------
    $('input:radio').change(
    function(e) {
            e.preventDefault();
            let color = 0;
            let category = 0;
            let supplier = 0;
            let _token   = $('meta[name="csrf-token"]').attr('content');
            let name = $('#search-category').val();
            category = $('input[name="brand"]:checked').val();
            color = $('input[name="radio-color-category"]:checked').val();
            supplier = $('input[name="radio-supplier-category"]:checked').val();

        $.ajax({
            url:  "{{ route('users.search-category') }}",
            type:"POST",
            data:{
                name: name,
                color: color,
                category: category,
                supplier: supplier,
                _token: _token
                },
                success:function(response){
                    console.log(response);
                    $(".products-category").empty();
                    response.data.forEach(element => {
                        $('.products-category').append(
                        '<div class="col-md-6 col-lg-4">' +
                        '<div class="card text-center card-product">' +
                        '<div class="card-product__img">' +
                        '<img class="card-img" src="/' + element['image'] + '" alt="">' +
                        '<ul class="card-product__imgOverlay">' +
                        '<li><button id="asd"><i class="ti-search"></i></button></li>' +
                        '<li><button><i class="ti-shopping-cart"></i></button></li>' +
                        '<li><button><i class="ti-heart"></i></button></li>' +
                        '</ul>' +
                        '</div>' +
                        '<div class="card-body">' +
                        '<p>Accessories</p>' +
                        '<h4 class="card-product__title"><a href="single-product.html">' + element.name + '</a></h4>' +
                        '<p class="card-product__price">' + element['price'] + '</p>' +
                        '</div>' +
                        '</div>' +
                        '</div>' );
                    });
                    $('ul.pagination').replaceWith(data);
                    console.log(data)
                },
        });
    });
    // search keyboard ----------------------------------------------------------------------- 
        var timeout;
        $("#search-category").keyup(function() {
        var $this = $(this);
        let name = $('#search-category').val();
        let _token   = $('meta[name="csrf-token"]').attr('content');
        let color = 0;
        let category = 0;
        let supplier = 0;
        color = $('input[name="radio-color-category"]:checked').val();
        category = $('input[name="brand"]:checked').val();
        supplier = $('input[name="radio-supplier-category"]:checked').val();

        if(timeout) {
            clearTimeout(timeout);
        }
        timeout = setTimeout(function() {
            
        
        $.ajax({
            url:  "{{ route('users.search-category') }}",
            type:"POST",
            data:{
                name: name,
                color: color,
                category: category,
                supplier: supplier,
                _token: _token
            },
            success:function(response) {
                console.log(response);
                $(".products-category").empty();
                    response.data.forEach(element => {
                        $('.products-category').append(
                        '<div class="col-md-6 col-lg-4">' +
                        '<div class="card text-center card-product">' +
                        '<div class="card-product__img">' +
                        '<img class="card-img" src="/' + element['image'] + '" alt="">' +
                        '<ul class="card-product__imgOverlay">' +
                        '<li><button id="asd"><i class="ti-search"></i></button></li>' +
                        '<li><button><i class="ti-shopping-cart"></i></button></li>' +
                        '<li><button><i class="ti-heart"></i></button></li>' +
                        '</ul>' +
                        '</div>' +
                        '<div class="card-body">' +
                        '<p>Accessories</p>' +
                        '<h4 class="card-product__title"><a href="single-product.html">' + element.name + '</a></h4>' +
                        '<p class="card-product__price">' + element['price'] + '</p>' +
                        '</div>' +
                        '</div>' +
                        '</div>' );
                    });
            },
            });
            
        }, 300);
        });
        

    </script>
@endsection