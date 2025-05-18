<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<form action="{{route('workspace_items.store')}}" method="post" enctype="multipart/form-data">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Add Item</h5>
      </div>
      <div class="modal-body">
        <div class="form-section">
          <!-- Item Name -->
          <div class="mb-3">
            <label for="name">Item Name</label>
            <input type="text" class="form-control" placeholder="Name" name="name" aria-label="Text" aria-describedby="name-addon">
          </div>
          <!-- End Item Name -->


          <!-- Item Note -->
          <div class="mb-3">
            <label for="note">Item Image</label>
            <input type="file" class="form-control" accept="image/*" name="image" aria-label="Image" aria-describedby="note-addon" id="image-input">
            
            <!-- Image preview container -->
            <div id="image-preview" style="margin-top: 10px; display: none;">
                <img id="preview-image" src="" alt="Image Preview" style="max-width: 100%; height: auto;"/>
            </div>
        </div>



          <!-- End Item Note -->
        
          <!-- Item Note -->
          <div class="mb-3">
            <label for="note">Item Note</label>
            <input type="text" class="form-control" placeholder="Note" name="note" aria-label="Text" aria-describedby="note-addon">
          </div>
          <!-- End Item Note -->

          <!-- Item Price -->
          <div class="mb-3">
            <label for="price">Item Price</label>
            <input type="number" class="form-control" placeholder="Price" name="price" aria-label="Text" aria-describedby="price-addon">
          </div>
          <!-- End Item Price -->

          <!-- Is Unlimited -->
          <div class="mb-3 form-check form-switch">
            <input type="checkbox" class="form-check-input" name="is_unlimited" id="is_unlimited">
            <label class="form-check-label" for="is_unlimited">Is Unlimited</label>
          </div>
          <!-- End Is Unlimited -->

          <!-- Quantity -->
          <div class="mb-3" id="quantity-field">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" placeholder="Quantity" name="quantity" aria-label="Quantity" aria-describedby="quantity-addon" min="1">
          </div>
          <!-- End Quantity -->

          <!-- Is Active -->
          <div class="mb-3 form-check form-switch">
            <input type="checkbox" class="form-check-input" name="is_active" id="is_active" checked>
            <label class="form-check-label" for="is_active">Is Active</label>
          </div>
          <!-- End Is Active -->
        
          @csrf
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-gradient-primary">Save changes</button>
      </div>
    </div>
  </div>
</form>
</div>

