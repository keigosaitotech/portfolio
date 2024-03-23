@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
    <h1>商品編集ID:{{$item->id}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                    
                    <div class="card-body">
                    <form action="/items/henkou/{{$item->id}}" method="post">
                    @csrf
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$item->name}}" placeholder="名前">
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label>
                            <input type="text" class="form-control" id="type" name="type" value="{{$item->type}}"placeholder="種別">
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" class="form-control" id="detail" name="detail" value="{{$item->detail}}" placeholder="詳細説明">
                        </div>
                    
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">編集完了</button>
                    </div>
                    </form>
                
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
