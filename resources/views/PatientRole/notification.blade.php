<div class="modal fade" id="notifModal" tabindex="-1" aria-labelledby="notifModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="notifModalLabel{{$notification}}">Notifications</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body p-4">

            <ul class="timeline-widget mb-0 position-relative">
              @php
              use App\Models\PatientNotification;
              $notification = PatientNotification::orderBy('created_at', 'desc')->get();
              $patientNotif = PatientNotification::where('patient_id', $profiles->id)->get();
              @endphp
              @foreach($patientNotif as $notify)
              <li class="timeline-item d-flex position-relative overflow-hidden">
                <div class="timeline-time text-dark flex-shrink-0 text-end">{{$notify->day}}</div>
                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                  <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                  <span class="timeline-badge-border d-block flex-shrink-0"></span>
                </div>
                <div class="timeline-desc fs-5 text-dark mt-n1">
                  {{$notify->message}} <span class="notify-date">{{$notify->date}}</span>
                </div>

              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add this CSS in your stylesheet or <style> block -->
<style>
  .timeline-widget {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .timeline-item {
    padding: 1rem 0;
    border-bottom: 1px solid #e9ecef;
  }

  .timeline-time {
    width: 70px;
    text-align: right;
    font-weight: 500;
  }

  .timeline-badge {
    width: 12px;
    height: 12px;
    border-radius: 50%;
  }

  .timeline-badge-border {
    width: 2px;
    height: 100%;
    background-color: #dee2e6;
  }

  .timeline-desc {
    padding-left: 1rem;
  }

  .notify-date {
    color: #ff5733;
    /* Change this to the color you want */
    font-weight: bold;
    /* Optional: Make the date stand out */
  }
</style>