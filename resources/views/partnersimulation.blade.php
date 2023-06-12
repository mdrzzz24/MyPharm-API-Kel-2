<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyPharm - Partner</title>
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
        <li class="nav-item">
          <a class="nav-link active" href="#" data-menu="payment">
            Payment
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-menu="expedisi">
              Expedisi
            </a>
          </li>
      </ul>
    </nav>
  </div>

  <!-- Content -->
    <div class="container mt-4">
        <div id="payment-content" style="display: none;">
            <h1>Payment</h1>
            <form action="payment" method="post">
                @method('POST')
                @csrf
                    <input type="text" name="transaction_id" class="form-control-sm" placeholder="Transaction ID" required>
                    <button type="submit" class="btn btn-primary">Pay</button>
                </form>
        </div>


        <div id="expedisi-content" style="display: none;">
            <h1>View Stock</h1>
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
      $('#payment-content').show();

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
