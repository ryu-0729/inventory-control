@extends('layouts.user.app')
@section('content')
<div class="container">
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
      {!! Form::open(['action' => ['StokController@update', $stok->id], 'method' => 'put']) !!}
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
            <td>{{ Form::text('name', $stok->name, ['id' => 'name', 'class' => 'form-control']) }}</td>
            <td>{{ Form::text('price', $stok->price, ['id' => 'price', 'class' => 'form-control']) }}</td>
            <td>{{ Form::text('quantity', $stok->quantity, ['id' => 'quantity', 'class' => 'form-control']) }}</td>
            <td>
              {{ Form::checkbox('role', $stok->role, false, ['id' => 'role', 'class' => 'custom-control-input']) }}
              {{ Form::label('role', $stok->role, ['class' => 'custom-control-label']) }}
            </td>
          </tr>
        </tbody>
      </table>
      {{ Form::submit('更新', ['class' => 'btn btn-primary']) }}
      {!! Form::close() !!}
      {!! Form::open(['action' => ['StokController@delete', $stok->id], 'method' => 'delete']) !!}
      {{ Form::submit('削除', ['class' => 'btn btn-danger']) }}
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection