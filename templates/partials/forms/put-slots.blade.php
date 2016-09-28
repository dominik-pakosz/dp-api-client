<form id="form-put-slots"
      action="/facilities/{{ $facilityId }}/doctors/{{ $doctor->getId() }}/addresses/{{ $address->getId() }}/slots"
      method="PUT">
    <div class="modal fade remote-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Put slots into calendar</h4>
                </div>
                <div class="modal-body">
                    <div class="slot-inputs">
                        @include('partials.forms.inputs.slot', ['index' => 0, 'facilityId' => $facilityId, 'doctorId' => $doctor->getId(), 'addressId' => $address->getId()])
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-sm btn-add-slot" data-doctor-id="{{ $doctor->getId() }}" data-facility-id="{{ $facilityId }}" data-address-id="{{ $address->getId() }}" type="button">
                            <span class="glyphicon glyphicon-plus"></span>
                            Add slot
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-save-service">Save</button>
                    <button class="btn btn-danger btn-cancel-service" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>