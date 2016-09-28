<form id="form-book-visit"
      action="/facilities/{{ $facilityId }}/doctors/{{ $doctor->getId() }}/addresses/{{ $address->getId() }}/slots/{{ urlencode( $visitStart->format('c') ) }}/book"
      method="POST">
    <div class="modal fade remote-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Book a visit to {{ $doctor->getName() }} {{ $doctor->getSurname() }}
                        at {{ $visitStart->format('Y-m-d H:i:s') }}</h4>
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
                        @if($extraFields->isNin())
                            <div class="form-group">
                                <label for="txt-nin" class="control-label">National Identity Number:</label>
                                <input type="text" class="form-control" id="txt-nin" name="patient[nin]" required>
                            </div>
                        @endif
                        @if($extraFields->isBirthDate())
                            <div class="form-group">
                                <label for="dt-birthdate" class="control-label">Birthdate:</label>
                                <input type="text" data-end="{{ (new \DateTime)->format('Y-m-d') }}"
                                       class="form-control datepicker" id="dt-birthdate"
                                       name="patient[birth_date]" required>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="txt-name" class="control-label">Name:</label>
                            <input type="text" min="0" class="form-control" id="txt-name"
                                   name="patient[name]">
                        </div>
                        <div class="form-group">
                            <label for="txt-surname" class="control-label">Surname:</label>
                            <input type="text" min="0" class="form-control" id="txt-surname"
                                   name="patient[surname]">
                        </div>
                        <div class="form-group">
                            <label for="txt-phone" class="control-label">Phone:</label>
                            <input type="tel" min="0" class="form-control" id="txt-phone"
                                   name="patient[phone]">
                        </div>
                        <div class="form-group">
                            <label for="txt-email" class="control-label">E-mail:</label>
                            <input type="email" min="0" class="form-control" id="txt-email"
                                   name="patient[email]">
                        </div>
                        @if($extraFields->isGender())
                            <div class="form-group">
                                <label class="radio-inline">
                                    <input type="radio" name="patient[gender]" value="m" required>
                                    Male
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="patient[gender]" value="f" required>
                                    Female
                                </label>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="radio-inline">
                                <input type="radio" name="is_returning" value="1" required>
                                Returning patient
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="is_returning" value="0" required>
                                New patient
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-book-visit">Book visit</button>
                        <button class="btn btn-danger btn-cancel-service" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                <div class="hidden result-content">
                    <h1 class="tac">
                        <span class="glyphicon glyphicon-thumbs-up"></span>
                        Booked (ID: <span class="booking-id"></span>)
                    </h1>
                </div>
            </div>
        </div>
    </div>
</form>