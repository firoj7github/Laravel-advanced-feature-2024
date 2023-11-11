<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
        }

        p {
            margin: 0pt;
        }

        table.items {
            border: 0.1mm solid #e7e7e7;
        }

        td {
            vertical-align: top;
        }

        .items td {
            border-left: 0.1mm solid #e7e7e7;
            border-right: 0.1mm solid #e7e7e7;
        }

        table thead td {
            text-align: center;
            border: 0.1mm solid #e7e7e7;
        }

        .items td.blanktotal {
            background-color: #EEEEEE;
            border: 0.1mm solid #e7e7e7;
            background-color: #FFFFFF;
            border: 0mm none #e7e7e7;
            border-top: 0.1mm solid #e7e7e7;
            border-right: 0.1mm solid #e7e7e7;
        }

        .items td.totals {
            text-align: right;
            border: 0.1mm solid #e7e7e7;
        }

        .items td.cost {
            text-align: "." center;
        }
    </style>

   
  </head>
  <body>
  @php
    $invoiceData = Session::get('invoice_data');
@endphp

  <div class="page-content-tab">

<div class="container-fluid" id="contentToConvert">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <a href="#" class="btn btn-primary float-right " onclick="NewInvoice()">
                        <i class="fa-solid fa-file-invoice-dollar"></i> Create Invoice
                    </a>

                    


                </div>
            </div>
        </div>
        <div class="col-md-12">

            <table width="100%" style="font-family: sans-serif;" cellpadding="10">
                <tr>
                    <td width="100%"></td>
                    <td width="100%" style="padding: 0px 40px;">
                        <h1 style="font-weight: bold"> INVOICE</h1>
                    </td>
                </tr>
                <tr>
                    <td width="100%" style=" font-size: 20px; font-weight: bold; padding: 40px;">
                        <img src="{{ asset('dashboard') }}/assets/images/localcarz.png" alt="logo.png"
                            height="auto" width="100">
                    </td>
                    <td width="100%" style="font-size: 14px; padding: 40px; ">

                        <p>LocalCarz.com</p>
                        <p>8080 Howells Ferry Rd. <br /> Semmes, AL 36575</p><br />


                        <p>Phone: (251) 281-8666</p>
                        <a href="https://localcarz.com/">localcarz.com</a>

                    </td>
                </tr>
            </table>
            <hr>

            <table width="100%" style="font-family: sans-serif; " cellpadding="10">
                <tr>
                    <td width="100%" style=" font-size: 14px;  padding: 40px;">
                        <p style="font-weight: bold; opacity:50%">BILL TO</p>
                        @if (!empty($userInfo))
                            @foreach ($userInfo as $user)
                                <p>Contact Name - {{ $user->user->username ?? '' }}</p>
                                <p>+1 {{ $user->user->phone ?? '' }}</p>
                                <p>{{ $user->user->email ?? '' }}</p>
                                <input type="hidden" value="{{ $user->user->id }}" id="user_id">
                                <br />
                            @endforeach
                        @endif

                    </td>
                    <td width="100%" style="font-size: 14px;  padding: 10px; margin-left:-50px;">
                        <p> <span style="font-weight: bold">Invoice No:</span></p>
                        
                        @php
                        $dateTime = new DateTime(now());
                        $formattedDate =  $dateTime->format('F j, Y');
                        @endphp
                        <p> <span style="font-weight: bold">Invoice Date:</span> {{ $formattedDate }}</p>
                        
                    </td>
                </tr>

            </table>
            @if (!empty($invoiceData))
                    <table class="items table table-bordered" width="100%" style="font-size: 14px;"
                        cellpadding="8">
                        <thead>
                            <tr style="background-color: #EB172C;color:white;font-weight:bold">
                                
                                <td width="20%" style="text-align: left;" align="center"><strong>Listing</strong>
                                </td>
                                <td width="20%" style="text-align: left;" align="center">
                                    <strong>Quantity</strong>
                                </td>
                                
                                <td width="20%" style="text-align: left;" align="center"><strong>Amount</strong>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_product = 0;
                                $total_banner = 0;
                               
                            @endphp
                            <!-- ITEMS HERE -->
                            @if (!empty($invoiceData['product_ids']))
                                @foreach ($invoiceData['product_ids'] as $inventoryId)
                                    @php
                                    $total_product += 20; 
                                    @endphp
                                @endforeach
                                <tr>
                                    
                                    <td style="padding:3px 7px; line-height: 20px;" align="center"> Feature Listing
                                    </td>
                                    <td style="padding:3px 7px; line-height: 20px;" align="center">
                                        {{ count($invoiceData['product_ids']) }}

                                    </td>
                                    <td style="padding: 3px 7px; line-height: 20px;" align="center"> <input
                                            type="text" 
                                            value="{{ $total_product }}" disabled
                                            class="amount-input"></td>
                                </tr>
                            @endif
                            @if (!empty($invoiceData['banner_ids']))
                                @foreach ($invoiceData['banner_ids'] as $inventoryId)
                                    @php
                                        $total_banner += 100; 
                                    @endphp
                                @endforeach
                                <tr>
                                    
                                    <td style="padding:3px 7px; line-height: 20px;" align="center">Banner
                                    </td>
                                    <td style="padding:3px 7px; line-height: 20px;" align="center">
                                        {{ count($invoiceData['banner_ids']) }}

                                    </td>

                                    <td style="padding: 3px 7px; line-height: 20px;" align="center"
                                        class="amount-input"><input type="text" class="amount-input" disabled
                                            value="{{ $total_banner }}"></td>
                                </tr>
                            @endif

                            
                               
                           



                        </tbody>
                    </table>
                    <br>
                    <table width="100%" style="font-family: sans-serif; font-size: 14px;">
                        <tr>
                            <td>
                                <table width="60%" align="left"
                                    style="font-family: sans-serif; font-size: 14px;">
                                    <tr>
                                        <td style="padding: 0px; line-height: 20px;">&nbsp;</td>
                                    </tr>
                                </table>
                                <table width="20%" align="right"
                                    style="font-family: sans-serif; font-size: 14px;">
                                    <tr>
                                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                            <strong>Subtotal: </strong>
                                        </td>
                                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"
                                            >
                                           <input type="text" id="subtotal" class="subtotal" value="${{ $total_product+ $total_banner  }}" disabled />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                            <strong>Discount: </strong>
                                        </td>
                                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                            <div class="input-group">
                                                <input type="text" name="discount" class="form-control"
                                                    id="discount">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                            <strong>Total :</strong>
                                        </td>
                                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                            <input type="text" id="total" disabled>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                            <strong>Amount Due (USD):</strong>
                                        </td>
                                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"
                                            id="another-total"></td>

                                    </tr>

                                    

                                </table>
                            </td>
                        </tr>
                    </table>
            @endif
            <div
                style="height: 85px;
            width: 20%;
            background-color: #ddd;
            float: right; margin:0 auto;margin-top:20px;border-radius:10px">

                <button
                    style="border: none;
            background-color: black;
            color: white;
            margin-top: 19px;
            margin-left: 30%;
            padding: 10px;
            border-radius: 10px;font-weight:bold;margin-bottom:5px">Pay
                    Securely Online</button><br />
                
               

            </div>

            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            

            
            

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
            // Watch for changes in the amount input
            $('.amount-input').on('input', function() {
                updateSubtotalAndTotal();
            });
            $('#discount').on('input',function(){
                updateSubtotalAndTotal();
            });

            function  updateSubtotalAndTotal(){
              
                var total = 0;
              
                $('.amount-input').each(function(){
                    var amount = parseFloat($(this).val()) || 0;
                    total += amount;
                })
                var discountPercentage = parseFloat($('#discount').val()) ||0;
                var subtotal = total - (total * discountPercentage/100);
                // console.log(subtotal);

               $('#total').val('$' + subtotal.toFixed(2));
               $('#another-total').text('$' + subtotal.toFixed(2));
            
            }
            updateSubtotalAndTotal()
           
        });




    
   </script>
    
  </body>
</html>