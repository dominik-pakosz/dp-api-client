<form id="form-modify-service" action="/facilities/{{ $facilityId }}/doctors/{{ $doctorId }}/addresses/{{ $addressId }}/services/{{ $addressServiceId }}" method="PATCH">
    <div class="modal fade remote-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modify Address Service</h4>
                </div>
                <div class="modal-body">
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
                    <button class="btn btn-primary btn-save-service">Save</button>
                    <button class="btn btn-danger btn-cancel-service" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>