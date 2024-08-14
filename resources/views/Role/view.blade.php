<div class="modal fade" id="editUserModal{{$role->id}}" tabindex="-1" aria-labelledby="editUserModalLabel{{$role->id}}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel{{$role->id}}">View User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="card-body">
        <form action="{{route('role.update', $role->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="exampleInputFirstName" class="form-label">Role Name</label>
                <input type="text" value="{{$role->role_name}}" name="role_name" class="form-control" id="exampleInputFirstName" readonly>
              </div>
            </div>
          </div>
          <!-- <button type="submit" class="btn btn-primary">Update</button> -->
          <a class="btn btn-light" href="{{route('role.index')}}">Cancel</a>
        </form>
      </div>
    </div>


    <script>
      function checkRole() {
        var roleSelect = document.getElementById('exampleSelectOption');
        var specializationField = document.getElementById('specializationField');
        if (roleSelect.options[roleSelect.selectedIndex].text.toLowerCase() === 'patient') {
          specializationField.style.display = 'block';
        } else {
          specializationField.style.display = 'none';
        }
      }

      function previewImage(event) {
        var output = document.getElementById('profileImageView');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
          URL.revokeObjectURL(output.src) // free memory
        }
      }
    </script>
  </div>


</div>