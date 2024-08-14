<!-- Delete Modal -->
<div class="modal fade" id="deletePModal{{$appointment->prescription->id}}" tabindex="-1" role="dialog" aria-labelledby="deletePModalLabel{{$appointment->prescription->id}}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletePModalLabel{{$appointment->prescription->id}}">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </button>
      </div>
      <form id="deleteUserForm{{$appointment->prescription->id}}" action="{{ route('prescription.destroy', $appointment->prescription->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          <div class="text-center mb-3">
            <p style="padding-top: 15px;">Are you sure you want to delete <span class="text-danger">Prescription {{$appointment->id}}</span>?</p>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>