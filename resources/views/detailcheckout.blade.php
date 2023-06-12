@extends('layouts.app')

@section('content')
<div class="container">
    <form action="pay">
        <table class="table mt-3">
            <thead>
              <tr>
                <th>Nama Penerima</th>
                <th>No HP</th>
                <th>Service</th>
                <th>Ongkir</th>
                <th>Kota</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>Kode Pos</th>
                <th>Alamat</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $request['penerima'] }}</td>
                    <td>{{ $request['phone_number'] }}</td>
                    <td>{{ $request['service'] }}</td>
                    <td>{{ $ongkir }}</td>
                    <td>{{ $request['kota'] }}</td>
                    <td>{{ $request['kecamatan'] }}</td>
                    <td>{{ $request['kelurahan'] }}</td>
                    <td>{{ $request['kode_pos'] }}</td>
                    <td>{{ $request['alamat'] }}</td>
                  </tr>
            </tbody>
            <input hidden name="pengirim" type="text" value="{{ $merchant[0]['merchant_name'] }}">
            <input hidden name="telp_pengirim" type="text" value="{{ $merchant[0]['phone'] }}">
            <input hidden name="alamat_pengirim" type="text" value="{{ $merchant[0]['address'] }}">
            <input hidden name="penerima" type="text" value="{{ $request['penerima'] }}">
            <input hidden name="phone" type="text" value="{{ $request['phone_number'] }}">
            <input hidden name="service" type="text" value="{{ $request['service'] }}">
            <input hidden name="ongkir" type="text" value="{{ $ongkir }}">
            <input hidden name="kota" type="text" value="{{ $request['kota'] }}">
            <input hidden name="kecamatan" type="text" value="{{ $request['kecamatan'] }}">
            <input hidden name="kelurahan" type="text" value="{{ $request['kelurahan'] }}">
            <input hidden name="kodepos" type="text" value="{{ $request['kode_pos'] }}">
            <input hidden name="alamat" type="text" value="{{ $request['alamat'] }}">
            <input hidden name="resi" type="text" value="{{ $randomId }}">

    </div>
    <div class="container">
        <h1>Detail Order</h1>
        <table class="table mt-3">
            <thead>
              <tr>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Ongkir</th>
                <th>Transaction Date</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Customer Name</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($datatable as $data)
                <td>{{ $data['product_code'] }}</td>
                <td>{{ $data['product_name'] }}</td>
                <td>{{ $data['price'] }}</td>
                    <td>{{ $data['qty'] }}</td>
                    <td>{{ $ongkir }}</td>
                    <td>{{ $data['transaction_date'] }}</td>
                    <td>{{ $data['payment_method'] }}</td>
                    <td>{{ $data['payment_status'] }}</td>
                    <td>{{ $data['customer_name'] }}</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
                <tr>
                <td class="fw-semibold" colspan="3">Sub Total : Rp {{ $totalsemua }}</td>
                </tr>
            </tfoot>
          </table>
          <button class="btn btn-primary" type="submit">Check Out</button>
    </form>
</div>
@endsection
