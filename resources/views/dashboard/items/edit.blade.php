<!-- Modal -->
<div class="modal fade" id="editItem{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<form action="{{route('workspace_items.update',$item->id)}}" method="post" enctype="multipart/form-data">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Edit Item</h5>
      </div>
      <div class="modal-body">
        <div class="form-section">
          <!-- Item Name -->
          <div class="mb-3">
            <label for="name">Item Name</label>
            <input type="text" class="form-control" placeholder="Name" name="name" aria-label="Text" aria-describedby="name-addon" value="{{$item->name}}">
          </div>
          <!-- End Item Name -->

         @method('PUT')
          



          <!-- End Item Note -->
        
          <!-- Item Note -->
          <div class="mb-3">
            <label for="note">Item Note</label>
            <input type="text" class="form-control" placeholder="Note" name="note" aria-label="Text" aria-describedby="note-addon" value="{{$item->note}}">
          </div>
          <!-- End Item Note -->

          <!-- Item Price -->
          <div class="mb-3">
            <label for="price">Item Price</label>
            <input type="number" class="form-control" placeholder="Price" name="price" aria-label="Text" aria-describedby="price-addon" value="{{$item->price}}">
          </div>
          <!-- End Item Price -->

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

