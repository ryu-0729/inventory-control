@extends('layouts.user.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Dashboard | {{ Link_to_action('StokController@new', '在庫作成', [],
                                    ['class' => 'btn btn-primary']) }}
                </div>

                <table cellpadding="0" cellspacing="0">
                  <thead>
                    <tr>
                      <th>在庫名</th>
                      <th>金額</th>
                      <th>個数</th>
                      <th>ステータス</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($stoks as $stok)
                    <tr>
                      <td>{{ $stok->name }}</td>
                      <td>{{ $stok->price }}</td>
                      <td>{{ $stok->quantity }}</td>
                      <td>{{ $stok->role }}</td>
                      <td><a href="/inventory-control/public/stoks/{{ $stok->id }}">詳細</a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
