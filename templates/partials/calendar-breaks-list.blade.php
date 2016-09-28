<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Since - Till</th>
        <th>
            <button class="btn btn-success btn-remote-modal"
                    data-trigger="daterangepicker"
                    data-url="/forms/add-calendar-break?facility-id={{ $facilityId }}&address-id={{ $addressId }}&doctor-id={{$doctorId}}">
                <span class="glyphicon glyphicon-plus"></span>
                Add break
            </button>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($calendarBreaks as $calendarBreak)
        <tr>
            <th>{{ $calendarBreak->getId() }}</th>
            <td>
                {{ $calendarBreak->getSince()->format('Y-m-d H:i:s') }} - {{ $calendarBreak->getTill()->format('Y-m-d H:i:s') }}
            </td>
            <td>
                <button type="button"
                        class="btn btn-danger btn-remote-call"
                        data-method="DELETE"
                        data-url="/facilities/{{ $facilityId }}/doctors/{{ $doctorId }}/addresses/{{ $addressId }}/breaks/{{ $calendarBreak->getId() }}">
                    <span class="glyphicon glyphicon-remove"></span>
                    Delete
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>