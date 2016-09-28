<div class="modal calendar-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="calendar-carousel" class="carousel slide" data-ride="carousel" data-wrap="false" data-pause="true">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @foreach(array_keys($slotChunks) as $index)
                        <li data-target="#calendar-carousel" data-slide-to="{{ $index }}"
                            class="{{ $index === 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>

                <div class="carousel-inner" role="listbox">
                    @foreach($slotChunks as $index => $slotChunk)
                        <div class="item {{ $index === 0 ? 'active' : '' }}">

                            <table class="table">
                                <thead>
                                <tr>
                                    @foreach(array_keys($slotChunk) as $ymd)
                                        <th class="tac">
                                            {{ $ymd }}
                                            <button type="button" class="close btn-clear-slots"
                                                    data-ymd="{{ $ymd }}"
                                                    data-url="/facilities/{{ $facilityId }}/doctors/{{ $doctorId }}/addresses/{{ $addressId }}/slots/{{ $ymd }}"
                                                    title="Clear slots for this day">
                                                &times;
                                            </button>
                                        </th>
                                    @endforeach
                                </tr>
                                </thead>
                            </table>
                            <div class="calendar-item">
                                <table class="table">

                                    <tbody>
                                    <tr>
                                        @foreach($slotChunk as $slots)
                                            <td class="tac">
                                                <div class="list-group">
                                                    @foreach($slots as $slot)
                                                        <button type="button" class="list-group-item btn-remote-modal"
                                                                data-url="/forms/book-visit?facility-id={{ $facilityId }}&doctor-id={{ $doctorId }}&address-id={{ $addressId }}&start={{ urlencode( $slot->format('c')) }}"
                                                                data-date="{{ $slot->format('Y-m-d') }}"
                                                                data-datetime="{{ $slot->format('c') }}"
                                                                data-trigger="datepicker">
                                                            {{ $slot->format('H:i') }}
                                                        </button>
                                                    @endforeach
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>

                <a class="left carousel-control" href="#calendar-carousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#calendar-carousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button"
                    class="btn btn-default btn-remote-modal"
                    data-trigger="booking-list-range"
                    data-url="/facilities/{{ $facilityId }}/doctors/{{ $doctorId }}/addresses/{{ $addressId }}/bookings">
                <span class="glyphicon glyphicon-list"></span>
                Booking List
            </button>

            <button type="button"
                    class="btn btn-default btn-remote-modal"
                    data-url="/forms/put-slots?facility-id={{ $facilityId }}&doctor-id={{ $doctorId }}&address-id={{ $addressId }}"
                    data-trigger="datepicker,datetimepicker">
                <span class="glyphicon glyphicon-pencil"></span>
                Put slots
            </button>

            <button type="button"
                    class="btn btn-default btn-remote-modal"
                    data-trigger="calendar-breaks-range"
                    data-url="/facilities/{{ $facilityId }}/doctors/{{ $doctorId }}/addresses/{{ $addressId }}/breaks">
                <span class="glyphicon glyphicon-list"></span>
                Calendar breaks
            </button>
        </div>
    </div>
</div>