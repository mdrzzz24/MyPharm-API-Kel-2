@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container mt-4">
        <div id="cashier-content">
        <h1>Product List</h1>
        <form action="admin/find" method="get">
            @method('get')
                <input name="search" type="text" class="form-control-sm" placeholder="Search">
                <button type="submit" class="btn btn-primary">Find</button>
            </form>
            <a href="user/cart">
            <button class="btn btn-primary">Cart</button></a>
        <table class="table mt-3">
            <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Stock</th>
                <th>Exp Date</th>
                <th>Price</th>
                <th>Qty</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($products as $value)
              <tr>
                <td>{{ $value['code'] }}</td>
                <td>{{ $value['name'] }}</td>
                <td>{{ $value['category'] }}</td>
                <td>{{ $value['description'] }}</td>
                <td>{{ $value['stock'] }}</td>
                <td>{{ $value['exp_date'] }}</td>
                <td>{{ $value['price'] }}</td>
                <td>
                  <form action="user/addcart" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $value['id'] }}">
                    <input type="hidden" name="product_code" value="{{ $value['code'] }}">
                    <input type="hidden" name="product_name" value="{{ $value['name'] }}">
                    <input type="hidden" name="price" value="{{ $value['price'] }}">
                    <input class="form-control-sm" type="number" name="qty" value="1" min="1">
                    <input type="hidden" name="payment_method" value="ewallet">
                    <input type="hidden" name="payment_status" value="waiting">
                    <input type="hidden" name="customer_name" value="{{ Auth::user()->name }}">
                    <button class="btn btn-primary" type="submit">Add to cart</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
</div>
@endsection
