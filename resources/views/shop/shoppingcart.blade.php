@extends('layouts.index')

@section('title', 'Shopping Cart')

@section('css')
  <script type="text/javascript" src="{{ asset('vendor/hcode/js/jquery.min.js') }}"></script>
  <style type="text/css">
    .btn {
        margin-right: 00px;
    }
  </style>
@endsection

@section('content')
  <!-- head section -->
  <section class="content-top-margin page-title page-title-small bg-gray">
      <div class="container">
          <div class="row">
              <div class="col-lg-8 col-md-7 col-sm-12 wow fadeInUp" data-wow-duration="300ms">
                  <!-- page title -->
                  <h1 class="black-text">Your Orders</h1>
                  <!-- end page title -->
              </div>
              <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">
                  <!-- breadcrumb -->
                  <ul>
                      <li><a href="#">Home</a></li>
                      <li>Shopping Cart</li>
                  </ul>
                  <!-- end breadcrumb -->
              </div>
          </div>
      </div>
  </section>
  <!-- end head section -->
  <!-- content section -->
  <section class="content-section padding-three">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            @if(Session::has('cart'))
              <div class="">
                <ul class="list-group">
                  @foreach($products as $product)
                    <li class="list-group-item" id="productItemListItem{{ $product['item']['id'] }}">
                      <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <strong><a href="{{ route('product.getsingleproduct', [$product['item']['id'], generate_token(100)]) }}">{{ $product['item']['title'] }}</a></strong> / 
                          <span class="label label-success">৳ {{ $product['item']['price'] }}</span>
                          <img src="{{ asset('images/product-images/'.$product['item']['productimages']->first()->image) }}" style="max-height: 40px; border:1px solid #777">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <div class="row">
                            <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12 item-center">
                              <div class="btn-group">
                                <button id="reducebyone{{ $product['item']['id'] }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Reduce Item"><i class="fa fa-minus white-text" aria-hidden="true"></i></button>
                                <a id="itemQtyInBag{{ $product['item']['id'] }}" class="btn btn-primary btn-sm disabled"><span>{{ $product['qty'] }}</span></a>
                                <button id="addbyone{{ $product['item']['id'] }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Increase Item"><i class="fa fa-plus white-text" aria-hidden="true"></i></button>
                              </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 item-center">
                              <span id="itemTotalPrice{{ $product['item']['id'] }}" class="">Total: ৳ {{ $product['price'] }}</span>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 item-center">
                              <a class="btn btn-link btn-sm" class="right" href="{{ route('product.removeitem', ['id' => $product['item']['id']]) }}" data-toggle="tooltip" data-placement="bottom" title="Click here to remove this item from the list"><i class="fa fa-times black-text" aria-hidden="true"></i></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <script type="text/javascript">
                      $(document).ready(function(){
                          $("#reducebyone{{ $product['item']['id'] }}").click(function(){
                            console.log('Item ID: ' + {{ $product['item']['id'] }});
                            $.ajax({
                                url: "/reduce/{{ $product['item']['id'] }}",
                                type: "GET",
                                data: {},
                                success: function (data) {
                                  var response = data;
                                  console.log(response);
                                  if(response == 'success') {
                                    if($(window).width() > 768) {
                                      toastr.success('{{ $product['item']['title'] }} One unit amount of this has been removed from your bag.', 'SUCCESS').css('width','400px');
                                    } else {
                                      toastr.success('{{ $product['item']['title'] }} One unit amount of this has been removed from your bag.', 'SUCCESS').css('width', ($(window).width()-25)+'px');
                                    }
                                  }
                                  var totalInBag = parseInt($("#totalInBag").text()) - 1;
                                  var totalInBagMobile = parseInt($("#totalInBagMobile").text()) - 1;
                                  $("#totalInBag").text(totalInBag);
                                  $("#totalInBagMobile").text(totalInBag);
                                  var itemQtyInBag = parseInt($("#itemQtyInBag{{ $product['item']['id'] }}").text()) - 1;
                                  $("#itemQtyInBag{{ $product['item']['id'] }}").text(itemQtyInBag);
                                  if(itemQtyInBag == 0) {
                                    $("#productItemListItem{{ $product['item']['id'] }}").fadeOut("slow");
                                  }
                                  var itemTotalPrice = $("#itemTotalPrice{{ $product['item']['id'] }}").text();
                                  itemTotalPrice = parseInt(itemTotalPrice.replace("Total: ৳ ", "")) - {{ $product['item']['price'] }};
                                  itemTotalPrice = "Total: ৳ " + itemTotalPrice;
                                  $("#itemTotalPrice{{ $product['item']['id'] }}").text(itemTotalPrice);

                                  var totalPriceGross = $("#totalPriceGross").text();
                                  totalPriceGross = parseInt(totalPriceGross.replace("Total Price: ৳ ", "")) - {{ $product['item']['price'] }};
                                  totalPriceGross = "Total Price: ৳ " + totalPriceGross;
                                  $("#totalPriceGross").text(totalPriceGross);
                                }
                            });
                          });
                          $("#addbyone{{ $product['item']['id'] }}").click(function(){
                            console.log('Item ID: ' + {{ $product['item']['id'] }});
                            $.ajax({
                                url: "/add/{{ $product['item']['id'] }}",
                                type: "GET",
                                data: {},
                                success: function (data) {
                                  var response = data;
                                  console.log(response);
                                  if(response == 'success') {
                                    if($(window).width() > 768) {
                                      toastr.success('{{ $product['item']['title'] }} One unit quantity of this has been added to your bag.', 'SUCCESS').css('width','400px');
                                    } else {
                                      toastr.success('{{ $product['item']['title'] }} One unit quantity of this has been added to your bag.', 'SUCCESS').css('width', ($(window).width()-25)+'px');
                                    }
                                  }
                                  var totalInBag = parseInt($("#totalInBag").text()) + 1;
                                  var totalInBagMobile = parseInt($("#totalInBagMobile").text()) + 1;
                                  $("#totalInBag").text(totalInBag);
                                  $("#totalInBagMobile").text(totalInBag);
                                  var itemQtyInBag = parseInt($("#itemQtyInBag{{ $product['item']['id'] }}").text()) + 1;
                                  $("#itemQtyInBag{{ $product['item']['id'] }}").text(itemQtyInBag);
                                  var itemTotalPrice = $("#itemTotalPrice{{ $product['item']['id'] }}").text();
                                  itemTotalPrice = parseInt(itemTotalPrice.replace("Total: ৳ ", "")) + {{ $product['item']['price'] }};
                                  itemTotalPrice = "Total: ৳ " + itemTotalPrice;
                                  $("#itemTotalPrice{{ $product['item']['id'] }}").text(itemTotalPrice);

                                  var totalPriceGross = $("#totalPriceGross").text();
                                  totalPriceGross = parseInt(totalPriceGross.replace("Total Price: ৳ ", "")) + {{ $product['item']['price'] }};
                                  totalPriceGross = "Total Price: ৳ " + totalPriceGross;
                                  $("#totalPriceGross").text(totalPriceGross);
                                }
                            });
                          });
                      });
                    </script>
                  @endforeach
                </ul>
              </div>
              <div class="">
                <div class="row">
                  <div class="col-md-8"></div>
                  <div class="col-md-2">
                    <strong style="float: right;" id="totalPriceGross">Total Price: ৳ {{ $totalPrice }}</strong>
                  </div>
                  <div class="col-md-2">
                  </div>
                </div>
                <hr/>
              </div>
              <div class="">
                <a href="{{ route('product.checkout') }}" class="highlight-button btn btn-medium no-margin pull-left"><i class="fa fa-check-square-o" aria-hidden="true"></i> Confirm the Order</a>
              </div>
            @else
              <div class="col-md-10 col-md-offset-1">
                <h2>
                  <center>
                    There are no products in your bag! Visit this page by adding our products to your bag. thank you<br/><br/>
                    <a href="{{ route('product.index') }}" class="highlight-button btn btn-medium"><i class="fa fa-cart-plus"></i> See Products</a>
                  </center>
                </h2>

              </div>
            @endif
          </div>
        </div>
      </div>
  </section>
  <!-- end content section -->
@endsection

@section('js')
  
@endsection