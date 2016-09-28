<div class="modal fade remote-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Address Services</h4>

            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>ServiceID</th>
                        <th>Price</th>
                        <th>
                            <button class="btn btn-success btn-remote-modal"
                            data-url="/forms/add-address-service?facility-id={{ $facilityId }}&address-id={{ $addressId }}&doctor-id={{$doctorId}}">
                            <span class="glyphicon glyphicon-plus"></span>
                            Add Address Service
                            </button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($addressServices as $addressService)
                        <tr data-address-service-id="{{ $addressService->getId() }}">
                            <th>{{ $addressService->getId() }}</th>
                            <td>{{ $addressService->getName() }}</td>
                            <td>{{ $addressService->getServiceId() }}</td>
                            <td>
                                <span class="price">@if($addressService->getIsPriceFrom())od @endif{{ $addressService->getPrice() ?: 'No price provided' }}</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button"
                                            class="btn btn-default btn-remote-modal"
                                            data-url="/forms/modify-address-service?facility-id={{ $facilityId }}&doctor-id={{ $doctorId }}&address-id={{ $addressId }}&address-service-id={{ $addressService->getId() }}">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                        Modify
                                    </button>

                                    <button type="button"
                                            class="btn btn-danger btn-remote-call"
                                            data-method="DELETE"
                                            data-url="/facilities/{{ $facilityId }}/doctors/{{ $doctorId }}/addresses/{{ $addressId }}/services/{{ $addressService->getId() }}">
                                        <span class="glyphicon glyphicon-remove"></span>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>