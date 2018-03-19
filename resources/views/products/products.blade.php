@extends('welcome')
@section('content')

    <div class="container">
        @if(Session::has('success'))
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3 success">
                    <div id="charge-message" class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                </div>
            </div>
        @endif
        <div class="row">

            @foreach($products as $product)
                <div class="col-md-3 product">
                    <a href="{{url('/show',['id'=>$product->id])}}"><img src='{{asset("images/$product->image")}}' class="product-image"></a>
                    <h3 class="product_name">{{$product->name}}</h3>
                    <p class="product__composition">{{$product->composition}}</p>
                    <a href="{{url('/addToCart',['id'=>$product->id])}}" class="btn btn-danger product_link"><span >{{$product->price}}т</span>  <span><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> в корзину</span></a>
                </div>
            @endforeach


            {{ $products->links() }}


        </div>
    </div>
@endsection