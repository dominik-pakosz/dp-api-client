<!DOCTYPE html>
<!--suppress ALL -->
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/css/daterangepicker.css">
    <link rel="stylesheet" href="/css/jquery.timepicker.css">
    <link rel="stylesheet" href="/css/main.css">

</head>
<body>

<div class="container">

    <div class="page-header">
        <h1>
            DP Sample API Client
        </h1>
    </div>


    <div class="alert alert-info @if (empty($token))hidden@endif" role="alert">
        Here is your access token: <span id="token">{{ $token }}</span>
        <a href="/logout" class="pull-right">
            <span class="glyphicon glyphicon-off"></span>
            Logout
        </a>
    </div>

    @if (empty($token))
        <div class="alert alert-success hidden" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Authorization successful
        </div>

        <div class="alert alert-danger hidden" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Authorization failed please check credentials.
        </div>


        <div class="well well-lg">

            <form id="authorization" class="form-horizontal" action="/authorization" method="POST">
                <div class="form-group">
                    <label for="clientId" class="col-sm-2 control-label">ClientID:</label>

                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="client-id" id="clientId"
                               placeholder="Public ID"
                               autocomplete="on" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="clientSecret" class="col-sm-2 control-label">Client Secret:</label>

                    <div class="col-sm-10">
                        <input class="form-control" type="password" name="client-secret" id="clientSecret"
                               placeholder="Client secret"
                               autocomplete="on" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="ddl-locale" class="col-sm-2 control-label">Locale:</label>

                    <div class="col-sm-10">
                        <select class="form-control" name="locale" id="ddl-locale" required>
                            <option value="">Select locale</option>
                            <option value="pl">ZnanyLekarz (PL)</option>
                            <option value="tr">Eniyihekim (TR)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 pull-right">
                        <button class="btn btn-primary">
                            Authorize
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endif
    <div class="operation-container hidden">
        <div class="operations">
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation">
                    <a href="/facilities" data-target="#facilities" role="tab" data-toggle="tab">Facilities</a>
                </li>
                <li role="presentation">
                    <a href="/services" data-target="#services" role="tab" data-toggle="tab">Services</a>
                </li>
                <li role="presentation">
                    <a href="/notifications" data-target="#notifications" role="tab" data-toggle="tab">Notifications</a>
                </li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="facilities">
                    <div class="panel-body"></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="services">

                </div>
                <div role="tabpanel" class="tab-pane" id="notifications">
                    <div class="panel-body"></div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="modal loading-modal" data-keyboard="false" data-backdrop="static" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header tac text-success">
                Loading
            </div>
            <div class="modal-body">
                <div class="progress progress-striped active"><div class="progress-bar"></div></div>
            </div>
        </div>
    </div>
</div>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/moment.min.js"></script>
<script type="text/javascript" src="/js/daterangepicker.js"></script>
<script type="text/javascript" src="/js/jquery.timepicker.min.js"></script>

<script type="application/javascript">
    (function () {
        var $container = $('.container');
        var $operations = $('.operation-container');
        var $loadingModal = $('.loading-modal');
        var $tabs = $('a[data-toggle="tab"]');

        $container.on('click', '.btn-fetch-notification', function () {
            var $this = $(this);
            $this.closest('.tab-pane').load($this.data('url'));
        });

        $container.on('click', '.btn-remote-modal', function (e) {
            var $this = $(this);
            var url = $this.data('url');


            $.get(url).done(function (data) {
                var $content = $(data);
                var $modal = $content.is('form') ? $content.find('.remote-modal') : $content;

                $content.appendTo($container);

                triggerPlugin($content, $this.data('trigger'));

                $modal.modal().on('hidden.bs.modal', function () {
                    $content.remove();
                });

            });

            e.preventDefault();
        });

        $container.on('submit', '#form-modify-service', function (e) {
            var $this = $(this);
            var url = $this.attr('action');
            var formData = $this.serialize();

            $.ajax({
                url: url,
                method: 'PATCH',
                data: formData
            }).done(function (data) {

                if (data.status === true) {
                    var addressServiceId = data['address-service-id'];
                    var addressServiceRow = $('tr[data-address-service-id=' + addressServiceId + ']');

                    addressServiceRow.find('.price').text(data['price']);

                    $this.find('.modal').first().modal('hide');
                }
            });

            e.preventDefault();
        });


        $container.on('submit', '#form-add-service', function (e) {
            var $this = $(this);
            var url = $this.attr('action');
            var formData = $this.serialize();

            $.post(url, formData)
                .done(function (data) {

                    if (data.id !== null) {
                        $this.find('.modal').first().modal('hide');
                    }
                });

            e.preventDefault();
        });

        $container.on('submit', '#form-add-break', function (e) {
            var $this = $(this);
            var url = $this.attr('action');
            var formData = $this.serialize();

            $.post(url, formData)
                    .done(function (data) {

                        if (data.status === true) {
                            $this.find('.modal').first().modal('hide');
                        }
                    });

            e.preventDefault();
        });

        $container.on('submit', '#form-calendar', function (e){
            var $this = $(this);
            var url = $this.attr('action');
            var formData = $this.serialize();

            $.ajax({
                url: url,
                data: formData
            }).done(function (data) {

                var $calendarModal = $(data);
                $calendarModal.appendTo($container);
                $calendarModal.find('.calendar-carousel').carousel();

                $calendarModal.modal()
                    .on('hidden.bs.modal', function () {
                        $calendarModal.remove();
                    });

            });

            e.preventDefault();

        });

        $container.on('submit', '#form-book-visit', function (e) {
            var $this = $(this);
            var url = $this.attr('action');
            var formData = $this.serialize();
            var method = $this.attr('method');

            $.ajax({
                method: method,
                url: url,
                data: formData
            }).done(function (data) {

                if(data.status === true)
                {
                    $this.find('.form-content').addClass('hidden');
                    $this.find('.result-content').removeClass('hidden');

                    $this.find('.booking-id').text(data['booking-id']);
                }

            });

            e.preventDefault();
        });

        $container.on('submit', '#form-put-slots', function (e) {
            var $this = $(this);
            var url = $this.attr('action');
            var formData = $this.serialize();
            var method = $this.attr('method');

            $.ajax({
                method: method,
                url: url,
                data: formData
            }).done(function (data) {

                if(data.status === true)
                {
                    $this.find('.modal').modal('hide');
                }

            });

            e.preventDefault();

        });

        $container.on('click', '.btn-remote-call', function () {
            var $this = $(this);
            var url = $this.data('url');
            var method = $this.data('method');

            if (method === 'DELETE' && confirm('Are you sure?')) {
                $.ajax({
                    url: url,
                    method: method
                }).done(function () {

                    if (method === 'DELETE')
                    {
                        $this.parents('tr').first().remove();
                    }
                });
            }
        });

        $container.on('click', '.btn-clear-slots', function (e) {
            var $this = $(this);
            var date = $this.data('ymd');
            var url = $this.data('url');

            $.ajax({
                url: url,
                method: 'DELETE'
            }).done(function () {
                $('[data-date="' + date + '"]').detach();
            });

        });

        $container.on('click', '.ajax-facility-doctors', function (e) {
            var $this = $(this);
            var uri = $this.attr('href');

            $.get(uri)
                .done(function (data) {

                    $this.parent().next('.facility-doctors').html(data);

                });

            e.preventDefault();
        });

        $container.on('click', '.btn-remove-service, .btn-remove-slot', function (e){
           var $parent = $(this).parents('.dismissable').first();
            if($parent.data('index') > 0)
            {
                $parent.remove();
            }

            e.stopPropagation();
        });

        $container.on('click', '.btn-add-address-service', function () {
            var $this = $(this);
            var $slot = $this.parents('.slot-input').first();
            var $target = $slot.find('.address-service-inputs');
            var facilityId = $this.data('facilityId');
            var doctorId = $this.data('doctorId');
            var addressId = $this.data('addressId');


            $.ajax({
                url:'/inputs/slot-address-service',
                data: {
                    'slot-index' : $slot.data('index'),
                    'address-service-index': $target.children('.slot-address-service').length,
                    'facility-id' : facilityId,
                    'doctor-id' : doctorId,
                    'address-id' : addressId
                }
            }).done(function (data) {
                $target.append(data);
            });
        });

        $container.on('click', '.btn-add-slot', function () {
            var $this = $(this);
            var $target = $('.slot-inputs');
            var facilityId = $this.data('facilityId');
            var doctorId = $this.data('doctorId');
            var addressId = $this.data('addressId');

            $.ajax({
                url:'/inputs/slot',
                data: {
                    index: $target.children('.slot-input').length,
                    'facility-id' : facilityId,
                    'doctor-id' : doctorId,
                    'address-id' : addressId
                }
            }).done(function (data) {
                $target.append(data);
                triggerPlugin($target.children().last(), 'datetimepicker');
            });


        });

        $tabs.on('show.bs.tab', function (e) {
            var $tab = $(e.target);
            var $content = $($tab.data('target'));
            var uri = $tab.attr('href');

            if ($tab.data('loaded') !== true) {

                //to fix manually triggered ajax call
                $(document).trigger('ajaxStart');

                $.get(uri).done(function (data) {
                    $content.html(data);
                    $tab.data('loaded', true);
                    $(document).trigger('ajaxComplete');
                });
            }
        });


        $('#authorization').on('submit', function (e) {

            e.preventDefault();

            var $this   = $(this);
            var url     = $this.attr('action');
            var method  = $this.attr('method');
            var $well   = $this.parent();
            var $button = $this.find('button');
            var $token  = $('#token');

            $button.prop('disabled', true);

            $.ajax({
                url: url,
                method: method,
                data: $this.serialize()
            }).done(function (data, status, jqXHR) {

                    if (data.status === true) {
                        $well.siblings('.alert-success, .alert-info').removeClass('hidden');
                        $token.text(data.token);
                        $well.remove();

                        $operations.removeClass('hidden');
                        $tabs.first().tab('show');
                    }
                    else {
                        console.error(status, jqXHR);
                    }
                })
                .always(function () {
                    $button.prop('disabled', false);
                });
        });

        var triggerPlugin = function ($context, plugins) {

            if(!plugins)
            {
                return;
            }

            plugins = plugins.split(',');

            $.each(plugins, function (index, plugin) {

                var format = 'YYYY-MM-DDTHH:mm:ssZ';

                if(plugin === 'datetimepicker')
                {


                    $($context).find('.datetimepicker').daterangepicker({
                        "singleDatePicker": true,
                        "timePickerIncrement": 5,
                        "timePicker": true,
                        "timePicker24Hour": true,
                        "startDate" : moment().add(1, 'day').format('YYYY-MM-DD'),
                        locale: {
                            format: format
                        },
                        opens: 'right'
                    });

                }
                else if(plugin === 'datepicker')
                {
                    $('.datepicker').daterangepicker({
                        locale: {
                            format: 'YYYY-MM-DD'
                        },
                        "singleDatePicker": true,
                        "endDate": moment().format('YYYY-MM-DD')
                    });
                }
                else if(plugin === 'daterangepicker' || plugin === 'booking-list-range' || plugin === 'calendar-breaks-range')
                {
                    var allowPast = false;

                    if(plugin === 'booking-list-range')
                    {
                        allowPast = true;
                    }


                    $($context).find('.datetime-range').each(function () {
                        var $this = $(this);
                        var $start = $this.next('[name=start]');
                        var $end = $start.next('[name=end]');

                        var startDate = $this.data('start');
                        var endDate = $this.data('end');

                        $this.daterangepicker({
                            "showDropdowns": true,
                            "timePicker": true,
                            "timePicker24Hour": true,
                            "timePickerIncrement": 10,
                            "autoApply": true,
                            "dateLimit": {
                                "weeks": 12
                            },
                            locale: {
                                format: format
                            },
                            "minDate": allowPast ? undefined : startDate,
                            "maxDate": endDate,
                            "startDate": startDate,
                            "endDate": endDate,
                            "opens": "left"

                        }, function(start, end) {

                            if(plugin === 'booking-list-range')
                            {
                                var url = $this.data('url');

                                $.ajax({
                                    url: url,
                                    data: {
                                        start : start.format(),
                                        end : end.format()
                                    }
                                }).done(function (data) {
                                    $context.find('.booking-list').html(data);
                                });
                            }
                            else if(plugin === 'calendar-breaks-range')
                            {
                                var url = $this.data('url');

                                $.ajax({
                                    url: url,
                                    data: {
                                        start : start.format(),
                                        end : end.format()
                                    }
                                }).done(function (data) {
                                    $context.find('.calendar-breaks-list').html(data);
                                });
                            }
                            else {
                                $start.val(start.format());
                                $end.val(end.format());
                            }
                        });
                    })

                }
            });

        };


        $(document).ajaxStart(function () {
            $loadingModal.modal();
        });

        $(document).ajaxComplete(function () {
            $loadingModal.modal('hide');
        });

        $(document).ajaxError(function (event, xhr, options, thrownError) {

            if(xhr.responseJSON)
            {
                var data = xhr.responseJSON;
                alert('API answer:\r\n' + xhr.status + ': ' + data.message);
            }
            else
            {
                alert(thrownError);
            }

        });

        @if( !empty($token) )
        $operations.removeClass('hidden');
        $tabs.first().tab('show');
        @endif


    })();
</script>
</body>
</html>
