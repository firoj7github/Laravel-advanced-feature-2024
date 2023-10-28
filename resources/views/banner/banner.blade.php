<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   
  </head>
  <body>
  <div class="page-content-tab">

<div class="container-fluid" id="contentToConvert">
    <div class="row m-auto">
        <div class="col-md-10">
            <div class="card mt-5">
                <div class="card-header">
                    <h4>Invoice</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive dt-responsive ">
                        <table id="dom-jqry" class="table  table-bordered nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th> <input type="checkbox"
                                        id="checkAll" /> All</th>

                                   
                                    <th style="font-size:14px;">ID</th>
                                    <th style="font-size:14px;">Name</th>
                                    <th style="font-size:14px;">Price</th>
                                    
                                    <th style="font-size:14px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($banners as $banner)
                                    <tr>
                                        <td>
                                            <input type="checkbox"
                                                class="check-row"
                                                data-id="{{  $banner->id }}">
                                        </td>
                                        



                                        <td class="fs-6">
                                            {{  $banner->id }}</td>
                                        <td style="font-size:10px; font-weight:bold; opacity:97%">
                                            {{  $banner->name }}</td>
                                        <td style="font-size:10px; font-weight:bold; opacity:97%">
                                        {{  $banner->price }}</td>
                                        
                                        

                                        
                                        

                                        
                                        

                                        <td>

                                            
                                            <a href="#"
                                                class=" btn btn-info edit_news_form text-inventory">
                                                Edit
                                            </a>


                                            
                                        </td>


                                    </tr>

                                    
                                @endforeach




                            </tbody>

                        </table>

                        <div class="col-md-3 mt-4">

                            <select name="packagePlan" id="selectPlan" class="form-control" style="width: 50%; display:inline;font-size:12px">
                                <option value="">Select Action</option>
                                <option value="0">Make Free</option>
                                <option value="1">Make Featured</option>
                                <option value="2">Make Premium</option>
                            </select>
                            <button class="btn btn-small btn-primary" style="font-size:12px;color:white" id="submit_action">Go</button>

                        </div>
                        <div class="col-md-9 float-right">
                       
                    </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

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


    $(document).ready(function() {
            // Check all checkboxes
            $("#checkAll").change(function() {
                var atLeastOneChecked = $(".check-row:checked").length > 0;
                $(".check-row").prop('checked', $(this).prop("checked"));
                //   $('#go_invoice').prop('disabled', false);

            });

            // Check individual checkbox
            $(".check-row").change(function() {
                var atLeastOneChecked = $(".check-row:checked").length > 0;
                if (!$(this).prop("checked")) {

                    $("#checkAll").prop("checked", false);

                }

            });


            $('#submit_action').on('click', function(){
                let packagePlan = $('#selectPlan').val();
                let listingCheckRows = $('.check-row:checked');
                let ListingSelectData = [];
                listingCheckRows.each(function(){
                    let id = $(this).data('id');
                    ListingSelectData.push(id);
                })
                // console.log(ListingSelectData);

                if(Object.keys(ListingSelectData).length === 0){
                    alert('Opps! select at least one item');
                    return;
                }

                if(packagePlan == ''){
                    alert('Opps! select a package');
                    return;   
                }

                $.ajax({
                    url:"{{ route('banner.store') }}",
                    type:'post',
                    data:{
                        packagePlan :packagePlan ,
                        ListingSelectData:ListingSelectData,
                    },
                    success:function(res){
                        console.log(res);
                        // if (res.status == 'success') {
                        //  location.reload();
                //    }
                    }
                });
                
            })







        });



    
   </script>
    
  </body>
</html>