


<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <form action="" method="post" id="addProductForm">
    @csrf

    

    
 
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
            @error('vichele_name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
        </div>
        
        <div class="form-group">
            <label for="name">Product Price</label>
            <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price">
            @error('vichele_name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button"  class="btn btn-primary add_product">Save Product</button>
      </div>
    </div>
  </div>
  </form>
</div>