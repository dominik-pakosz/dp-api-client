<div class="modal fade remote-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Addresses</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Street</th>
                        <th colspan="3">Extra Fields</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($addresses as $address)
                        <tr>
                            <th>{{ $address->getId() }}</th>
                            <td>

                                {{ $address->getName() }}
                            </td>
                            <td>
                                {{ $address->getStreet() }} {{ $address->getPostCode() }}
                            </td>
                            <td>
                                NIN:
                                <span class="label label-info"> {{ $address->getBookingExtraFields()->isNin() ? 'true' : 'false' }}</span>
                            </td>
                            <td>
                                Birth Date:
                                <span class="label label-info"> {{ $address->getBookingExtraFields()->isBirthDate() ? 'true' : 'false' }}</span>
                            </td>
                            <td>
                                Gender:
                                <span class="label label-info"> {{ $address->getBookingExtraFields()->isGender() ? 'true' : 'false' }}</span>
                            </td>
                            <td>
                                <button type="button"
                                        class="btn btn-sm btn-default btn-remote-modal"
                                        data-url="/facilities/{{ $facilityId }}/doctors/{{ $doctorId }}/addresses/{{ $address->getId() }}/services">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                    Address Services
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>