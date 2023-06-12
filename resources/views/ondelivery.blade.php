@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Order</h1>
    <table class="table mt-3">
        <thead>
          <tr>
              <th>Resi</th>
            <th>Transaction ID</th>
            <th>Nama Penerima</th>
            <th>Telepon</th>
            <th>service</th>
            <th>ongkir</th>
            <th>kota</th>
            <th>Kode Pos</th>
            <th>Alamat</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($filteredData as $data)
            <tr>
                <td><strong>{{ $data['resi']}}</strong></td>
                <td>{{ $data['transaction_id']}}</td>
                <td>{{ $data['nama_penerima']}}</td>
                <td>{{ $data['telp_penerima']}}</td>
                <td>{{ $data['service']}}</td>
                <td>{{ $data['ongkir']}}</td>
                <td>{{ $data['kota']}}</td>
                <td>{{ $data['kode_pos']}}</td>
                <td>{{ $data['alamat_pengiriman']}}</td>
                <td>" {{ $data['status']}} "</td>

              </tr>
            @endforeach
        </tbody>
</div>
@endsection
