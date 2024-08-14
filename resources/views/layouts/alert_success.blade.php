<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  @if(session('sent_success'))
  Swal.fire({
    icon: 'success',
    title: 'Sent',
    showConfirmButton: false,
    timer: 2500
  });
  @elseif(session('update_success'))
  Swal.fire({
    icon: 'success',
    title: 'Update Successfully!',
    showConfirmButton: false,
    timer: 2500
  });
  @elseif(session('add_success'))
  Swal.fire({
    icon: 'success',
    title: 'Added Successfully!',
    showConfirmButton: false,
    timer: 2500
  });
  @elseif(session('register'))
  Swal.fire({
    icon: 'success',
    title: 'Registered Successfully!',
    showConfirmButton: false,
    timer: 2500
  });
  @elseif(session('login'))
  Swal.fire({
    icon: 'success',
    title: 'Login Successfully!',
    showConfirmButton: false,
    timer: 2500
  });
  @elseif(session('delete'))
  Swal.fire({
    icon: 'success',
    title: 'Deleted Successfully!',
    showConfirmButton: false,
    timer: 2500
  });
  @elseif(session('approved'))
  Swal.fire({
    icon: 'success',
    title: 'Approved Successfully!',
    showConfirmButton: false,
    timer: 2500
  });
  @elseif(session('rejected'))
  Swal.fire({
    icon: 'error',
    title: 'Rejected!',
    text: 'Your request has been rejected. Your status now is Pending!',
    showConfirmButton: false,
    timer: 2500
  });
  @endif
</script>