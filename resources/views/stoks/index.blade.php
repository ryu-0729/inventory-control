@extends('layouts.user.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <table cellpadding="0" cellspacing="0">
                  <thead>
                    <tr>
                      <th>在庫名</th>
                      <th>金額</th>
                      <th>個数</th>
                      <th>ステータス</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($stoks as $stok)
                    <tr>
                      <td>{{ $stok->name }}</td>
                      <td>{{ $stok->price }}</td>
                      <td>{{ $stok->quantity }}</td>
                      <td>{{ $stok->role }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
