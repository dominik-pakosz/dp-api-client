<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Start - End</th>
        <th>Booked</th>
        <th>Canceled</th>
        <th>Patient</th>
        <th>Service</th>
        <th>Cancel</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($bookings as $booking)
        <tr>
            <th>{{ $booking->getId() }}</th>
            <td width="120px">

                {{ $booking->getStartAt()->format('Y-m-d') }}
                <div>
                   {{ $booking->getStartAt()->format('H:i') }} - {{ $booking->getEndAt()->format('H:i') }}
                </div>
            </td>
            <td>
                Booked by {{ $booking->getBookedBy() }}
                <div>at {{ $booking->getBookedAt()->format('Y-m-d H:i') }}</div>
            </td>
            <td>
                @if($booking->getCanceledBy())
                    Canceled by {{ $booking->getCanceledBy() }}
                    <div>at {{ $booking->getCanceledAt()->format('Y-m-d H:i') }}</div>
                @endif
            </td>

            <td>
                {{ $booking->getPatient()->getFullName() }}
                <div>{{ $booking->getPatient()->getPhone() }}</div>
            </td>
            <td>
                @if($booking->getAddressService())
                {{ $booking->getAddressService()->getName() }}
                <div>(ID: {{ $booking->getAddressService()->getId() }})</div>
                @else
                    Address service <br />not exist anymore
                @endif
            </td>
            <td>
                @unless($booking->getCanceledBy() || $booking->getStartAt() < (new DateTime))
                    <button type="button"
                            class="btn btn-danger btn-remote-call btn-sm"
                            data-method="DELETE"
                            data-url="/facilities/{{ $facilityId }}/doctors/{{ $doctorId }}/addresses/{{ $addressId }}/bookings/{{ $booking->getId() }}">
                        <span class="glyphicon glyphicon-remove"></span>
                        Cancel
                    </button>
                @endunless
            </td>

        </tr>
    @endforeach
    </tbody>
</table>