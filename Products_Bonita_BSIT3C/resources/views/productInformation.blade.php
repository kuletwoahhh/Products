<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Information</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container my-5">
    <h1 class="text-center mb-4">Product Information</h1>

    <!-- Product Input Form -->
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <form class="row g-3" action="{{route('product.add')}}" method="POST">
            @csrf
          <div class="col-md-6">
            <label class="form-label">Product ID</label>
            <input type="text" name="id" class="form-control" placeholder="Enter Product ID" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Product Name" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Product Category</label>
            <input type="text" name="category" class="form-control" placeholder="Enter Category" required>
          </div>
          <div class="col-md-3">
            <label class="form-label">Product Quantity</label>
            <input type="number" name="quantity" class="form-control" placeholder="Enter Quantity" required>
          </div>
          <div class="col-md-3">
            <label class="form-label">Product Price</label>
            <input type="number" name="price" step="0.01" class="form-control" placeholder="Enter Price" required>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary me-2">Add Product</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Table for Product List Information -->
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Product List</h5>
          <!-- Search Bar -->
          <form action="{{ route('product.list') }}" method="GET" class="d-flex" role="search">
            <input class="form-control me-2" type="text" id="searchbox" name="search" placeholder="Search product name..." aria-label="Search" value="{{ request('search') }}" oninput="this.for.submit()">
            <button class="btn btn-outline-primary" type="submit">Search</button>
          </form>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="table-dark">
              <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach($productList as $index => $product)
              <tr>
                <td>{{$product['id']}}</td>
                <td>{{$product['name']}}</td>
                <td>{{$product['category']}}</td>
                <td>{{$product['quantity']}}</td>
                <td>{{$product['price']}}</td>
                <td>
                  <a href="{{ route('product.edit', $index) }}" class="btn btn-sm btn-warning me-1">Edit</a>

                    <form action="{{ route('product.delete', $index) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                
                </td>
              </tr>
              @endforeach
              <!-- More rows can be added here -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
