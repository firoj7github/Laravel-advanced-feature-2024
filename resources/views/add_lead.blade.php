<button type="button" class="btn btn-primary d-flex mt-5 m-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">
  add lead
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form  id="Lead_Form">
    
      
      <div class="container">
     <h6 class="text-left">Add a customer to this lead : </h6>
     <div class="row">
    <div class="col-md-5 mb-3">
    <select name="customer_id" id="customer_id"
    class="form-control ">
    <option value="">Select a Customer</option>
    <option value="1">Firoj Hossain</option>
    </select>
    </div>

    <div class="col-md-7 text-left mb-3">
    
    <div class="form-group mb-2">
    <input placeholder="Name*"
    class="form-control" type="text"
    name="cus_name" id="cus_name">
    <span class="cus_name_error text-danger" role="alert"></span>
   
    </div>


<div class="form-group mb-2">

<input placeholder="Email*"
    class="form-control" type="email"
    name="email" id="email">
    <span class="cus_email_error text-danger" role="alert"></span>


</div>
</div>

<div class="col-md-6 ">
<div class="form-group mb-2">

<input placeholder="Lead Name*"
    class="form-control" type="text" id="lead"
    name="lead">
    <span class="lead_error text-danger" role="alert"></span>


</div>
</div>

<div class="col-md-6 ">
   <div class="form-group">
      <select name="lead_type" id="lead_type"
            class="form-control">
           <option value="">Lead Type</option>
             <option value="Walk-In">Walk-In</option>
           <option value="E-mail">E-mail</option>
        </select>
        <span class="cus_lead_typel_error text-danger" role="alert"></span>
      
 </div>
</div>

    </div>
    <div class="col-md-6">
        <button type="button" id="lead_submit" class="btn btn-warning">Submit</button>
    </div>

   </form>
      </div>
      
    </div>
  </div>
</div>