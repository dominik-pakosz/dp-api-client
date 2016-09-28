<form id="form-add-break" action="/facilities/{{ $facilityId }}/doctors/{{ $doctorId }}/addresses/{{ $addressId }}/breaks"
      method="POST">
    <div class="modal fade remote-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add calendar break to address {{ $addressId }}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="dt-range" class="control-label">Select date:</label>
                        <input id="dt-range" type="text" class="form-control datetime-range">
                        <input type="hidden" name="start" value="">
                        <input type="hidden" name="end" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-add-break">Add</button>
                    <button class="btn btn-danger btn-cancel-service" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>