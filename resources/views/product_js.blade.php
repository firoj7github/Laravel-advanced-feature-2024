<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    

    <script>
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
        });
    </script>

    <script>

let cartContent = document.getElementById("cart-content");
 let content = document.getElementById("invoice-section");
let cartCount = document.getElementById("cart-count");
let itemCount = 0;

function toggleCart() {
    cartContent.style.display = cartContent.style.display === "block" ? "none" : "block";


}

function addToCart(item) {

let cartItem = document.createElement("div");
cartItem.textContent = item;
cartContent.appendChild(cartItem);
itemCount++;
cartCount.textContent = itemCount;


}




$(document).ready(function () {
             
   // cart item get
   
   $('#updateCart').on('click', function(){
    
    
    $.ajax({
        url:"{{route('get.item')}}",
        method:'GET',
        success:function(res){
            console.log(res);
          
            if(res.status == 'success'){
                var count = res.count;
                $('#cart-count').text(count);
            $('#invoice-section').html(res.data);
                
            };
        },
    });
   });
    
    
    
    
    
    
    
    
    $(document).on('click', '.add_product', function(e){
               e.preventDefault();
               let name= $('#name').val();
               let price= $('#price').val();
               console.log(name,price);
          
             $.ajax({
                url:"{{route('add.product')}}",
                method:'post',
                data:{name:name, price:price},
                success:function(res){
                    if(res.status=='success'){
                        $('#addModal').modal('hide');
                        $('#addProductForm')[0].reset();
                        $('.table').load(location.href+' .table');
                        Swal.fire('data insert successfully');
                    }

                }, error: function(err){
                    let error = err.responseJSON;
                }


             })
            });

            // update product
            $(document).on('click','.update_product_form',function(){
                let id=$(this).data('id');
                let name=$(this).data('name');
                let price= $(this).data('price');

                $('#up_id').val(id);
                $('#up_name').val(name);
                $('#up_price').val(price);

            });
            $(document).on('click', '.update_product', function(e){
               e.preventDefault();
               let up_id = $('#up_id').val();
               let up_name= $('#up_name').val();
               let up_price= $('#up_price').val();
               console.log(name,price);
          
             $.ajax({
                url:"{{route('update.product')}}",
                method:'post',
                data:{up_id:up_id,up_name:up_name, up_price:up_price},
                success:function(res){
                    if(res.status=='success'){
                        $('#updateModal').modal('hide');
                        $('#updateProductForm')[0].reset();
                        $('.table').load(location.href+' .table');
                        Swal.fire('data update successfully');
                    }

                }, error: function(err){

                }


             })
            });

            // delete product
            $(document).on('click', '.delete_product', function(e){
               e.preventDefault();
               let product_id = $(this).data('id');
               
            //   alert (product_id);

              if(confirm("if you delete the product??")){
                  $.ajax({
                url:"{{route('delete.product')}}",
                method:'post',
                data:{product_id:product_id},
                success:function(res){
                    if(res.status=='success'){
                        
                        $('.table').load(location.href+' .table');
                        Swal.fire('data delete successfully');
                    }

                }, error: function(err){

                }


             })
              }
          
            
            });

            // Lead add two table insert with condition

            $(document).on('click', '#lead_submit', function(e){
               e.preventDefault();
               let cus_name= $('#cus_name').val();
               let email= $('#email').val();
               let customer_id= $('#customer_id').val();
               let lead_name= $('#lead').val();
               let lead_type= $('#lead_type').val();
              
          
             $.ajax({
                url:"{{route('lead.add')}}",
                type:'post',
                data:{cus_name:cus_name, email:email,customer_id:customer_id, lead_name:lead_name, lead_type:lead_type  },
                success:function(res){
                    

                  
                    if (res.error) {
                            
                            if(res.error.cus_name)
                            {
                                $('.cus_name_error').text(res.error.cus_name);
                            }
                            if(res.error.email)
                            {
                                $('.cus_email_error').text(res.error.email);
                            }
                            if(res.error.lead_name)
                            {
                                $('.lead_error').text(res.error.lead_name);
                            }
                            if(res.error.lead_type)
                            {
                                $('.cus_lead_typel_error').text(res.error.lead_type);
                            }
                            
                            
                            
                        } 

                }, error: function(err){
                    console.log(err); 
                }


             })
            });

            
        
        
        });


       
    </script>