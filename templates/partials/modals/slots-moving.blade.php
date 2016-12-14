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
                                                                data-url="/forms/move-visit?facility-id={{ $facilityId }}&doctor-id={{ $doctorId }}&address-id={{ $addressId }}&start={{ urlencode( $slot->format('c')) }}&booking-id={{ $bookingId }}"
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
    </div>
</div>