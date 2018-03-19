@extends('welcome')

@section('title')
    Laravel Shopping Cart
@endsection

@section('content')

    @if(Session::has('cart'))
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3 shopping-cart">
                <ul class="list-group">
                    @foreach($products as $product)
                        <li class="list-group-item">
                            <span class="badge">{{ $product['qty'] }}</span>
                            <strong>{{ $product['item']['name'] }}</strong>
                            <span class="label label-success">{{ $product['price'] }}</span>
                            <div class="btn-group">
                                <button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                    Методы <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="btn btn-danger" href="{{url('/reduce',['id'=>$product['item']['id']])}}">Уменьшить 1</a></li>
                                    <li><a href="{{url('/remove',['id' =>$product['item']['id']])}}"> Убрат всех</a></li>
                                </ul>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <strong>Total: {{$totalPrice}}</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <a href="{{url('/checkout')}}" type="button" class="btn btn-success">Оформить заказ</a>
                <a href="{{url('/forget')}}" class="btn btn-success">Очистка</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3 no-item">
                <h2>No Items in </h2>
            </div>
        </div>
    @endif
@endsection