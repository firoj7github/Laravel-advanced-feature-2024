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
    
   
  </head>
  <body>

  @foreach($products as $product)
  <div class="card mb-3 mt-5 ms-5" style="width: 18rem;">
  <div class="card-body">
    
    <h5 class="card-title">Card title</h5>
    <h6 class="card-subtitle mb-2 text-muted">{{$product->name}}</h6>
    <p class="card-text">{{$product->price}}</p>

    @php 
    $countFavorite = 0;
    @endphp
    @if(Auth::check())

    @php

    $countFavorite = App\Models\Favorite::countFavorite($product->id);
    

    @endphp

    @endif
    <a href="#" data-productid="{{ $product->id }}" class="update_wishlist">

    <i style="color:black" class="fa fa-heart me-2"></i>
    <!-- @if($countFavorite > 0)
        <i style="color:red" class="fa fa-heart me-2"></i>
    @else
        <i style="color:black" class="fa fa-heart me-2"></i>
    @endif -->
</a>

   
    <a href="#"  title="Copy Link" id="copyUrlButton"><i class="fa fa-copy icon-icon" ></i>
    </a>
   
  </div>
</div>
@endforeach

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    
    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        // copy link code start
        document.getElementById('copyUrlButton').addEventListener('click', function() {
            // Get the current URL from the browser's address bar
            const currentUrl = window.location.href;

            // Create a temporary input element to hold the URL
            const tmpInput = document.createElement('input');
            tmpInput.value = currentUrl;
            document.body.appendChild(tmpInput);

            // Select the input's value and copy it to the clipboard
            tmpInput.select();
            document.execCommand('copy');

            // Remove the temporary input element
            document.body.removeChild(tmpInput);

            // Display a message to indicate that the URL has been copied
            alert('The URL has been copied to the clipboard.');
        });
        // copy link code end
    });

    $(document).ready(function() {


      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
        });
        

        // update wishlist start
        $('.update_wishlist').on('click', function() {
          
            var product_id = $(this).data('productid');
            var my_id = "{{ Auth::id() }}";
            var url = "{{ route('update.wishlist') }}";

            console.log(product_id);

            $.ajax({
                url: url,
                type: 'post',
                data: {
                  product_id: product_id,
                    user_id: my_id
                },
                success: function(response) {
                  console.log(response);
                    // Handle success response
                    // Uncomment and modify the code as needed
                    // var icon = $('#wishlist-icon');
                    // if (response.action === 'add') {
                    //     $('a[data-productid=' + inventory_id + ']').html(
                    //         `<i class="fa fa-heart" id="wishlist-icon" title="Wishlist" style="color:red"></i>`
                    //     );
                    //     toastr.success(response.message);
                    // } else if (response.action === 'remove') {
                    //     $('a[data-productid=' + inventory_id + ']').html(
                    //         `<i class="fa fa-heart-o" id="wishlist-icon" title="Wishlist" ></i>`
                    //     );
                    //     toastr.error(response.message);
                    // }
                },
                error: function(error) {
                    // Handle error here
                }
            });
        });
        // update wishlist end
    });
</script>



    
  </body>
</html>