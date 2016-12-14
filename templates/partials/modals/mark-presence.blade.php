<div class="modal fade remote-modal " tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Mark presence</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <button type="button"
                            class="btn btn-success btn-presence-call btn-sm"
                            data-method="POST"
                            data-url="/facilities/{{ $facilityId }}/doctors/{{ $doctorId }}/addresses/{{ $addressId }}/bookings/{{ $bookingId }}/presence/patient">
                        PRESENT
                    </button>
                    <button type="button"
                            class="btn btn-danger btn-presence-call btn-sm"
                            data-method="DELETE"
                            data-url="/facilities/{{ $facilityId }}/doctors/{{ $doctorId }}/addresses/{{ $addressId }}/bookings/{{ $bookingId }}/presence/patient">
                        ABSENT
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>