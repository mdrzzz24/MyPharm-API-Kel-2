<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyPharm - Admin</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
  <!-- Custom CSS -->
  <style>
     .sidebar {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      z-index: 100;
      padding: 48px 0 0;
      box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
      background-color: #f8f9fa;
    }

    .sidebar-sticky {
      position: relative;
      top: 0;
      height: calc(100vh - 48px);
      padding-top: .5rem;
      overflow-x: hidden;
      overflow-y: auto;
    }

    .nav-link {
      color: #333;
      font-weight: bold;
      transition: all 0.3s ease;
    }

    .nav-link:hover {
      color: #007bff;
    }

    .active {
      color: #007bff !important;
    }

    .container {
      margin-left: 125px;
    }
  </style>
 <!-- Sidebar -->
 <div class="sidebar">
    <nav class="sidebar-sticky">
      <ul class="nav flex-column">
        <!-- Cashier menu -->
        <li class="nav-item">
          <a class="nav-link active" href="#" data-menu="cashier">
            Cashier
          </a>
        </li>
        <!-- View Stock menu -->
        <li class="nav-item">
            <a class="nav-link" href="#" data-menu="view-stock">
              View Stock
            </a>
          </li>
        <!-- Add Stock menu -->
        <li class="nav-item">
          <a class="nav-link" href="#" data-menu="add-stock">
            Add Stock
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" data-menu="history">
            History
          </a>
        </li>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
      </ul>
    </nav>
  </div>

  <!-- Content -->
    <div class="container mt-4">
        <div id="cashier-content" style="display: none;">
        <h1>Product List</h1>
        <form action="admin/find" method="get">
            @method('get')
                <input name="search" type="text" class="form-control-sm" placeholder="Search">
                <button type="submit" class="btn btn-primary">Find</button>
            </form>
            <a href="admin/cart">
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
              <form action="admin/addcart" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $value['id'] }}">
                <input type="hidden" name="product_code" value="{{ $value['code'] }}">
                <input type="hidden" name="product_name" value="{{ $value['name'] }}">
                <input type="hidden" name="price" value="{{ $value['price'] }}">
                <input class="form-control-sm" type="number" name="qty" value="1" min="1">
                <input type="hidden" name="payment_method" value="cash">
                <input type="hidden" name="payment_status" value="waiting">
                <input type="hidden" name="customer_name" value="offline customer">
                <button class="btn btn-primary" type="submit">Tambahkan ke Keranjang</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div id="view-stock-content" style="display: none;">
        <h1>View Stock</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>CODE</th>
                    <th>NAME</th>
                    <th>CATEGORY</th>
                    <th>DESCRIPTION</th>
                    <th>STOCK</th>
                    <th>EXP DATE</th>
                    <th>PRICE</th>
                    <th>ACTION</th>
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
                        <a href="admin/{{ $value['id'] }}">
                            <button type="button" class="btn btn-primary ml-1">Edit</button>
                        </a>
                        <form action="admin/delete/{{ $value['id'] }}" method="post">
                            @csrf
                            @method('delete')
                            <input class="btn btn-danger rounded-2 m-1" type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="add-stock-content" style="display: none;">
      <h1>Add Stock Content</h1>
      <div class="container w-50 mt-3 mb-3">
        <form action="admin/addproduct" method="post">
            @csrf
          <div class="form-group">
            <label for="code">Code:</label>
            <input type="text" class="form-control" id="code" name="code">
          </div>
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group">
            <label for="category">Category:</label>
            <select class="form-control" id="category" name="category">
                <option value="">Select a category</option>
                <option value="Obat Resep">Obat Resep</option>
                <option value="Obat Bebas">Obat Bebas</option>
                <option value="Obat Bebas Terbatas">Obat Bebas Terbatas</option>
                <option value="Obat Herbal">Obat Herbal</option>
                <option value="Obat Suplemen">Obat Suplemen</option>
              </select>
          </div>
          <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" ></textarea>
          </div>
          <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" class="form-control" id="stock" name="stock">
          </div>
          <div class="form-group">
            <label for="exp_date">Expiration Date:</label>
            <input type="text" class="form-control" id="exp_date" name="exp_date">
          </div>
          <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" id="price" name="price" >
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
  <div class="container mt-4">
    <div id="history-content" style="display: none;">
    <h1>Order History</h1>
    {{-- <div class="container"> --}}
        <table class="table mt-3">
            <thead>
              <tr>
                <th>Transaction ID</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total Price</th>
                <th>Transaction Date</th>
                <th>Payment Method</th>
                <th>Customer Name</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($history as $h)
              <tr>
                <td>{{ $h['transaction_id'] }}</td>
                <td>{{ $h['product_code'] }}</td>
                <td>{{ $h['product_name'] }}</td>
                <td>{{ $h['qty'] }}</td>
                <td>{{ $h['price'] }}</td>
                <td>{{ $h['total_price'] }}</td>
                <td>{{ $h['transaction_date'] }}</td>
                <td>{{ $h['payment_method'] }}</td>
                <td>{{ $h['customer_name'] }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>

</div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Custom JS -->
  <script>
      $(document).ready(function() {
      // Show Cashier content by default
      $('#cashier-content').show();

      $('.nav-link').click(function(e) {
        e.preventDefault();
        var menu = $(this).data('menu');
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
        $('.container > div').hide();
        $('#' + menu + '-content').show();
      });
    });
  </script>
</body>
</html>
