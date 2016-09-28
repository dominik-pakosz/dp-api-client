<form id="form-add-service" action="/facilities/{{ $facilityId }}/doctors/{{ $doctorId }}/addresses/{{ $addressId }}/services"
      method="POST">
    <div class="modal fade remote-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add service to addressId: {{ $addressId }}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ddl-service" class="control-label">Service:</label>
                        <select name="service-id" id="ddl-service" required="required" class="form-control">
                            <option value="">Select service</option>
                            @foreach($services as $service)
                                <option value="{{ $service->getId() }}">{{ $service->getName() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txt-price" class="control-label">Price:</label>
                        <input type="number" min="0" class="form-control" id="txt-price"
                               name="price">
                    </div>
                    <div class="form-group">
                        <label for="txt-maximum-price" class="control-label">Is price from:</label>
                        <input type="checkbox" value="1" class="form-control" id="bool-price-from"
                               name="is-price-from">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-add-service">Add</button>
                    <button class="btn btn-danger btn-cancel-service" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>