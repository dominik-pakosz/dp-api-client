<table class="table table-striped">
    <thead>
    <tr>
        <th>id</th>
        <th>Name</th>
        <th>Surname</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($doctors as $doctor)
        <tr>
            <th>
                {{ $doctor->getId() }}
            </th>
            <td>
                {{$doctor->getName()}}
            </td>
            <td>
                {{$doctor->getSurname()}}
            </td>
            <td>
                <div class="btn-group btn-group-sm" role="group">
                    <button class="btn btn-default btn-remote-modal" role="button"
                            data-url="/facilities/{{ $facilityId }}/doctors/{{ $doctor->getId() }}/addresses">
                        <span class="glyphicon glyphicon-list"></span>
                        Addresses
                    </button>
                    <button class="btn btn-default btn-remote-modal"
                            data-trigger="daterangepicker"
                            data-url="/forms/calendar?facility-id={{ $facilityId }}&doctor-id={{$doctor->getId()}}">
                        <span class="glyphicon glyphicon-calendar"></span>
                        Calendar
                    </button>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
