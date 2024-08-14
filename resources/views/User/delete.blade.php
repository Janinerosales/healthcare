<!-- Delete Modal -->
<div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$user->id}}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel{{$user->id}}">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </button>
      </div>
      <form id="deleteUserForm{{$user->id}}" action="{{ route('user.destroy', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          <div class="text-center mb-3">
            @if($user->profile_image)
            <img id="profilePicturePreview{{$user->id}}" src="{{asset('storage/' . $user->profile_image)}}" class="img-fluid rounded-circle" alt="Avatar" style="width: 130px; height:130px;">
            @else
            <img id="profilePicturePreview{{$user->id}}" src="images/profile_default.png" class="img-fluid rounded-circle" alt="Avatar" style="width: 130px; height:130px;">
            @endif
            <p style="padding-top: 15px;">Are you sure you want to delete <span class="text-danger">{{ '"' . $user->first_name . ' ' . $user->last_name . '"' }}</span>?</p>
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