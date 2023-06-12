<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Document</title>
</head>
<body>
    <div class="container">

        <table class="table mt-3">
            <thead>
              <tr>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total Price</th>
                <th>Transaction Date</th>
                <th>Payment Method</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($datatable as $value)
              <tr>
                <td>{{ $value['product_code'] }}</td>
                <td>{{ $value['product_name'] }}</td>
                <td>{{ $value['price'] }}</td>
                <td>{{ $value['qty'] }}</td>
                <td>{{ $value['total_price'] }}</td>
                <td>{{ $value['transaction_date'] }}</td>
                <td>{{ $value['payment_method'] }}</td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
                <tr>
                <td class="fw-semibold" colspan="3">Sub Total : Rp {{ $subtotal }}</td>
                </tr>
            </tfoot>
          </table>
          <a href="shipping-details">
        <button class="btn btn-primary">Next</button></a>
    </div>
</body>
</html>
