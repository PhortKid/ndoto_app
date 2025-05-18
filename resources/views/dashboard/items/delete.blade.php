<!-- Modal -->
<div class="modal fade" id="deleteItem{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Add Item</h5>
      </div>
      <div class="modal-body">
        <div class="form-section">
        Are you sure you want to delete ?
           
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        
        {!! html()->form('PUT', route('workspace_items.destroy', $item->id))->open() !!}
        @csrf
        {!! html()->hidden('_method', 'DELETE') !!}
        {!! html()->submit('Delete')->class('btn btn-danger') !!}
        {!! html()->form()->close() !!}
      </div>
    </div>
  </div>

</div>

