<!-- Delete Modal -->
<div class="modal fade" id="deleteModal{{$appointment->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$appointment->id}}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel{{$appointment->id}}">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </button>
      </div>
      <form id="deleteUserForm{{$appointment->id}}" action="{{ route('appointment.destroy', $appointment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          <div class="text-center mb-3">
            <p style="padding-top: 15px;">Are you sure you want to delete <span class="text-danger">{{ "$appointment->appointment_date" }}</span>?</p>
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