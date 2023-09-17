<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

    <script>
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
        });
    </script>

    <script>
        $(document).ready(function () {
             $(document).on('click', '.add_product', function(e){
               e.preventDefault();
               let name= $('#name').val();
               let price= $('#price').val();
               console.log(name,price);
          
             $.ajax({
                url:'{{route('add.product')}}',
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
                url:'{{route('update.product')}}',
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
                url:'{{route('delete.product')}}',
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
            });
    </script>