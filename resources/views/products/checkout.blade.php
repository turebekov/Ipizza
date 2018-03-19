@extends('welcome')

@section('content')
    <div class="container">


        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3 shopping-cart">
                <h1>Checkout</h1>
                <h4>Your Total: ${{$total}}</h4>

                <form action="{{url('/checkout')}}" method="post" id="checkout-form">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="address">Адрес</label>
                                <input type="text" name="address" id="address" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="card-name">Телефон</label>
                                <input type="text" name="tel" id="card-name" class="form-control" required>
                            </div>
                        </div>




                    </div>
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-success">Оформить заказ</button>
                </form>
            </div>
        </div>
    </div>

@endsection