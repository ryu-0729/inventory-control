@extends('layouts.user.app')
@section('content')
<div class="container">
  <h2>New Stok</h2>
  <div class="row">
    <div class="col-md-offset-2 col-md-8">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      {!! Form::open(['action' => ['StokController@create'], 'method' => 'post']) !!}
      <table class="table table-hover">
        <thead>
          <tr>
            <td>在庫名</td>
            <td>金額</td>
            <td>個数</td>
            <td>ステータス</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ Form::text('name', '', ['id' => 'name', 'class' => 'form-control' ]) }}</td>
            <td>{{ Form::text('price', '', ['id' => 'price', 'class' => 'form-control']) }}</td>
            <td>{{ Form::text('quantity', '', ['id' => 'quantity', 'class' => 'form-control']) }}</td>
            <td>
              {{ Form::label('role', '発注状態', ['class' => 'form-control-label']) }}
              {{ Form::checkbox('role', '発注状態', ['id' => 'role', 'class' => 'form-control-input']) }}
            </td>
          </tr>
        </tbody>
      </table>
      {{ Form::submit('追加', ['class' => 'btn btn-primary']) }}
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection