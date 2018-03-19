@extends('admin.index')


@section('content')
    @if (session('status'))
        <script>
            alert('{{ session('status') }}')
        </script>

    @endif
    <div class="panel panel-default">
        <div class="panel-heading">Продукты</div>
        <div class="panel-body">


            <p><a href="{{url('/admin/products/create')}}" class="btn btn-primary"> Создать продукт</a></p>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Продукты</th>
                    <th colspan="2">Опции</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td><a href="{{url("/admin/products/$product->id/edit")}}" class="btn btn-success">Update</a>
                        </td>
                        <td>
                            <form action='{{url("/admin/products/$product->id")}}' method="POST">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection