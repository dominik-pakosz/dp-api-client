<div class="slot-address-service dismissable" data-index="{{ $addressServiceIndex }}">

    <div class="form-group">
        <div class="input-group input-group-sm">
            <span class="input-group-addon" id="ddl-address-service-{{ $addressServiceIndex }}">Address service:</span>
            <select aria-describedby="ddl-address-service-{{ $addressServiceIndex }}"
                    name="slots[{{ $slotIndex }}][address_services][{{ $addressServiceIndex }}][id]"
                    class="form-control" required>
                <option value="">Select address service</option>
                @foreach($addressServices as $addressService)
                    <option value="{{ $addressService->getId() }}">{{ $addressService->getName() }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group input-group-sm">
            <span class="input-group-addon" id="txt-service-duration-{{ $addressServiceIndex }}">Service duration:</span>
            <input class="form-control input-sm" type="number" min="10" value="10"
                   aria-describedby="txt-service-duration-{{ $addressServiceIndex }}"
                   name="slots[{{ $slotIndex }}][address_services][{{ $addressServiceIndex }}][duration]"
                   placeholder="Duration of this address service" required/>
        </div>
    </div>
    @if($addressServiceIndex > 0)
        <div class="form-group">
            <button class="btn btn-danger btn-sm btn-remove-service" type="button">
                <span class="glyphicon glyphicon-minus"></span>
                Remove address service
            </button>
        </div>
    @endif
</div>