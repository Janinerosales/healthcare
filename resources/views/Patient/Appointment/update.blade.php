<div class="modal fade" id="approveUserModal{{$appointment->id}}" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel{{$appointment->id}}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="approveModalLabel{{$appointment->id}}">Confirm approve</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </button>
      </div>
      <form id="approveUserForm{{$appointment->id}}" action="{{ route('status.update', $appointment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="doctor_id" id="doctorID{{$appointment->id}}">
        <div class="modal-body">
          <div class="mb-1">
            <p style="padding-top: 15px;">Are you sure you want to Approve <span class="text-danger">{{ "$appointment->appointment_date" }}</span>?</p>
          </div>
          <div class="mb-1">
            <p style="padding-top: 3px;">Request: <span class="text-danger">{{ "$appointment->requests" }}</span></p>
          </div>
          <div class="mb-1">
            <p style="padding-top: 3px;">Status: <span class="text-danger">{{ "$appointment->status" }}</span></p>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Approved</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- update Appointment Modal -->
<div class="modal fade" id="rejectUserModal{{$appointment->id}}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel{{$appointment->id}}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="approveModalLabel{{$appointment->id}}">Confirm Rejected</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </button>
      </div>
      <form id="approveUserForm{{$appointment->id}}" action="{{ route('status.update', $appointment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" value="Pending">
        <div class="modal-body">
          <div class="mb-1">
            <p style="padding-top: 15px;">Are you sure you want to Approve <span class="text-danger">{{ "$appointment->appointment_date" }}</span>?</p>
          </div>
          <div class="mb-1">
            <p style="padding-top: 3px;">Request: <span class="text-danger">{{ "$appointment->requests" }}</span></p>
          </div>
          <div class="mb-1">
            <p style="padding-top: 3px;">Status: <span class="text-danger">{{ "$appointment->status" }}</span></p>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Rejected</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- update Appointment Modal -->
<script>
  fetch('/api/user', {
      method: 'GET',
      headers: {
        Authorization: 'Bearer ' + localStorage.getItem('TOKEN'),
        Accept: 'application/json',
      }
    }).then(response => response.json())
    .then(response => {
      console.log(response.id);
      document.querySelectorAll('[id^="doctorID"]').forEach(element => {
        element.value = response.id;
      });
    })
</script>