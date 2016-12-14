<form id="form-book-visit"
      action="/facilities/{{ $facilityId }}/doctors/{{ $doctor->getId() }}/addresses/{{ $address->getId() }}/bookings/{{ $bookingId }}/move"
      method="POST">
    <div class="modal fade remote-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Move a visit</h4>
                </div>
                <div class="booking-form form-content">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="ddl-address-service" class="control-label">Service:</label>
                            <select name="address_service_id" id="ddl-address-service" required="required"
                                    class="form-control">
                                <option value="">Select address service</option>
                                @foreach($addressServices as $addressService)
                                    <option value="{{ $addressService->getId() }}">{{ $addressService->getName() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" value="{{ $visitStart->format('Y-m-d H:i:s') }}" class="form-control" name="start" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-move-visit">Move visit</button>
                        <button class="btn btn-danger btn-cancel-service" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>