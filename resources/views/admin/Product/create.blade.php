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

    <h2>Добавление продукта</h2>

    <form action="{{url('/admin/products')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" name="name" required class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="category">Категория</label>
            <select required name="category_id" class="form-group" >
                @foreach($categories as $category)

                    <option value="{{$category->id}}">{{$category->name}}</option >
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="composition">Состав</label> <br>
            <textarea id="composition" name="composition" required class="form-control">

            </textarea>
        </div>
        <div class="form-group">
            <label for="desc">Описание</label> <br>
            <textarea id="desc" name="description"  class="form-control">

            </textarea>
        </div>
        <div class="form-group">
            <label for="price">Цена</label> <br>
            <input id="price" type="number" name="price" required class="form-control">
        </div>


        <div class="form-group">
            <label for="img">Изображение</label>
            <input type="file" name="image" required class="form-control" id="img">
        </div>


        <input type="hidden" name="user_id" value="{{$user->id}}">


        <button type="submit" class="btn btn-default">Submit</button>
    </form>

@endsection