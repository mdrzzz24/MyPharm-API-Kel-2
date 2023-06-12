<!DOCTYPE html>
<html>
<head>
  <title>Product Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

  <div class="container w-50 mt-3 mb-3">
    <h2>Detail Product</h2>
    @if(count($products) > 0)
    <form action="{{ $products[0]['id'] }}/update" method="post">
        @method('put')
        @csrf
      <div class="form-group">
        <label for="code">Code:</label>
        <input type="text" class="form-control" id="code" name="code" value=" {{ $products[0]['code'] }}" disabled>
      </div>
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value=" {{ $products[0]['name'] }}" disabled>
      </div>
      <div class="form-group">
        <label for="category">Category:</label>
        <select class="form-control" id="category" name="category" disabled>
            <option value="">Select a category</option>
            <option value="Obat Resep">Obat Resep</option>
            <option value="Obat Bebas">Obat Bebas</option>
            <option value="Obat Bebas Terbatas">Obat Bebas Terbatas</option>
            <option value="Obat Herbal">Obat Herbal</option>
            <option value="Obat Suplemen">Obat Suplemen</option>
          </select>
      <script>
        var categoryValue = "{{ $products[0]['category'] }}";

        var selectElement = document.getElementById("category");
        for (var i = 0; i < selectElement.options.length; i++) {
          if (selectElement.options[i].value === categoryValue) {
            selectElement.options[i].selected = true;
            break;
          }
        }
      </script>
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" name="description" disabled>{{ $products[0]['description'] }}</textarea>
      </div>
      <div class="form-group">
        <label for="stock">Stock:</label>
        <input type="number" class="form-control" id="stock" name="stock" value="{{ $products[0]['stock'] }}">
      </div>
      <div class="form-group">
        <label for="exp_date">Expiration Date:</label>
        <input type="text" class="form-control" id="exp_date" name="exp_date" value=" {{ $products[0]['exp_date'] }}">
      </div>
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" class="form-control" id="price" name="price" value="{{ $products[0]['price'] }}">
      </div>
      <a href="/admin"  class="btn btn-secondary">Back</a>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
    @else
        <p>Tidak ada produk yang tersedia.</p>
    @endif
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
