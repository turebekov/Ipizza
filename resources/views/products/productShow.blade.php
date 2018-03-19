@extends('welcome')


@section('content')

    @if (session('status'))
        <script>
            alert('{{ session('status') }}')
        </script>
    @endif
    <div class="container shopping-cart">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>{{$product->name}}</h1>
                <div class="col-md-6"><img src='{{asset("images/$product->image")}}' class="product-image" alt=""></div>
                <div class="col-md-6">
                    <h3>Состав:</h3>
                    <p>{{$product->composition}}</p>
                    <p>{{$product->description}}</p>
                    <p>{{$product->price}} тг</p>
                    <h3>Рейтинг продукта:</h3>



                @if(isset($result_rating))

                        <p>{{$result_rating}}</p>

                    @else
                        <p>Пока никто не проголосавал за этот продукт</p>
                    @endif
                </div>


            </div>
            <div class="col-md-8 col-md-offset-2">

                <h4>Комментарий покупателей</h4>
                @if(count($comments))
                @foreach($comments as $comment)
                    <p>{{$comment->user->name}}:</p>
                    <p>{{$comment->text}}</p>
                @endforeach
                @else
                    <p>Упс , пока никто не оставил коммент !</p>
                @endif
                @if(isset($purchased))
                    <h3>Добавить рейтинг</h3> <span>( от 1 до 5 баллов) </span>
                    <form action="{{url('/product/raiting')}}" method="post">
                        <select name="rating" id="">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        {{ csrf_field() }}
                        <button class="btn btn-success">Submit</button>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{url('/product/addComment')}}" method="post">
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea type="text" name="text" id="comment" class="form-control">
                            </textarea>
                            <br>
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            {{ csrf_field() }}
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </form>
                @else
                    <h3>Ввести комментарий и рейтинг доступен только после покупки</h3>
                @endif

            </div>
        </div>
    </div>

@endsection