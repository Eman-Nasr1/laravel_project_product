<!-- resources/views/products.blade.php -->  
<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Products</title>  
    <link href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>  
<body> 

<div class="container mt-5">
<a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>  
        <h1>Product List</h1>  
        <table class="table table-bordered" id="productTable">
            <thead>
                <tr>
                    <th scope="col">Product Title</th>
                    <th scope="col">Product description</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Product Quantity</th>
                    <th scope="col">Product image</th>
                    <th scope="col">Show</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    <!-- <th scope="col">Delete</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->amount }}</td>
                    <td>
                   <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->title }}" width="100" height="100">
                    </td>
                   <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-secondary">show</a>  
                   </td>
                   <td>
                      <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success">Edit</a>
                      </td>
                      <td>
                  <form action="{{ route('products.delete', $product->id) }}" method="POST" style="display:inline;">
                          @csrf
                       @method('DELETE')
                       <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table> 
        </div>
 
</body>  
</html>