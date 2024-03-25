@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- 検索機能 -->
            <div>
                <form action="{{ url('items/kensaku') }}" method="GET">

                @csrf

                    <input type="text" name="keyword">
                    <input type="submit" value="検索">
                </form>
            </div>
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>
                    
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>@sortablelink('id', 'ID')</th>
                                <th>@sortablelink('name', '名前')</th>
                                <th>種別</th>
                                <th>詳細</th>
                                <th> </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->detail }}</td>
                                    <form action="{{ '/items/delete/' }}" method="post">
                                        @csrf
                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                                        <td><button type="submit" class="btn btn-default">削除</button></td>
                                    </form>
                                    <th><a href="{{ url('items/hensyu/'.$item->id) }}" class="btn btn-default">編集</a></th>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>               
                </div>
            </div>
        </div>
    </div>
    <div class="page">
    {{ $items->appends(\Request::except('page'))->render() }}
    </div>    
@stop

@section('css')
@stop

@section('js')
@stop
