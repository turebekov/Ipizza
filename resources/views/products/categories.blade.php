@extends('welcome')
@section('content')
<div class="container">
    <div class="row">

        @foreach($products as $product)
            <div class="col-md-3 product">
                <img src='{{asset("images/$product->image")}}' class="product-image">
                <h3 class="product_name">{{$product->name}}</h3>
                <p class="product__composition">{{$product->composition}}</p>
                <a href="{{url('/addToCart',['id'=>$product->id])}}"  class="btn btn-danger product_link"><span >{{$product->price}}т</span>  <span><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> в корзину</span></a>
            </div>
        @endforeach

    </div>
</div>
    @endsection