<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>

.cart-container {
    position: relative;

}

.cart-icon {
    cursor: pointer;
    position: relative;
    margin-top: 10px;
    color: orangered;
}

.cart-icon img {
    width: 30px;
}

.badge {
    position: absolute;
    top: 0;
    right: 200;
    background-color: red;
    color: white;
    padding: 5px 8px;
    border-radius: 50%;
}

.cart-content {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    min-width: 500px;
    background-color: white;
    border: 1px solid #ccc;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 10px;
    z-index: 1;
}

    </style>












    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>ajax crud</title>
  </head>
  <body>
  @include('navbar')   
   <div class="container">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <h3 class="my-5 text-center">Laravel9 ajax crud</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
  add Product
</button>
            <div class="table-data">
            <table class="table table-border">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($products as $key=>$product)
    <tr>
      <th scope="row">{{$key+1}}</th>
      <td>{{$product->name}}</td>
      <td>{{$product->price}}</td>
      <td>
        <button data-bs-toggle="modal" data-bs-target="#updateProductModal"
        data-id="{{$product->id}}"
        data-name="{{$product->name}}"
        data-price="{{$product->price}}"
         class="btn btn-success update_product_form">Edit</button>
        <button 
        class="btn btn-danger delete_product"
        data-id="{{$product->id}}"
        
        >Delete</button>
      </td>
    </tr>
    @endforeach
    
  </tbody>
</table>
            </div>
        </div>
    </div>
   </div>

 
@include('add_product') 
@include('add_lead') 
@include('update_product_modal')  
@include('product_js')
   
  </body>
</html>