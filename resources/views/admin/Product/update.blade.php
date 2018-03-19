@extends('admin.index')


@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>
    @endif
    <h2>Изменение продукта</h2>

    <form action='{{url("/admin/products/$product->id")}}' method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="put"/>
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" name="name" value="{{$product->name}}" required class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="category">Категория</label>
            <select required name="category_id" class="form-group" >
                <option value="{{$product->category->id}}">{{$product->category->name}}</option>
                @foreach($categories as $category)
                    @unless($product->category->id === $category->id)
                    <option value="{{$category->id}}">{{$category->name}}</option >
                    @endunless
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="composition">Состав</label> <br>
            <textarea id="composition" name="composition" required class="form-control">
                {{$product->composition}}
            </textarea>
        </div>
        <div class="form-group">
            <label for="desc">Описание</label> <br>
            <textarea id="desc" name="description" required class="form-control">
                {{$product->description}}
            </textarea>
        </div>
        <div class="form-group">
            <label for="price">Цена</label> <br>
            <input id="price" type="number" value="{{$product->price}}" name="price" required class="form-control">
        </div>


        <div class="form-group">
            <label for="img">Изображение</label>
            <input type="file" name="image" required class="form-control" id="img">
        </div>


        <input type="hidden" name="user_id" value="{{$product->user->id}}">

        <button type="submit" class="btn btn-default">Submit</button>
    </form>

@endsection