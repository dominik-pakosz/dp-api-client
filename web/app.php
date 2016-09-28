<?php

use App\Initialize;
use DP\DPClient;
use DP\Model\BookVisitRequest;
use DP\Model\PutSlotsRequest;
use DP\Model\AddressService;


require '../vendor/autoload.php';

$init = new Initialize;

$app        = $init->getApp();
$serializer = $init->getSerializer();

$locale = $app->getCookie('locale');
$token  = $app->getCookie('token');
$dp     = (new DPClient($serializer, $locale))->setToken($token);


$app->get('/', function () use ($app, $dp)
{
	$app->render('index', [
		'token' => $app->getCookie('token')
	]);
});

$app->post('/authorization', function () use ($app, $dp, $serializer)
{
	$clientId     = $app->request()->post('client-id');
	$clientSecret = $app->request()->post('client-secret');
	$locale       = $app->request()->post('locale');

	$dp = (new DPClient($serializer, $locale))
		->setClientId($clientId)
		->setClientSecret($clientSecret);

	$token = $dp->authorize();

	$app->setCookie('locale', $locale);
	$app->setCookie('token', $token);
	$app->setCookie('clientId', $clientId);
	$app->setCookie('clientSecret', $clientSecret);

	$app->response()->header('Content-Type', 'application/json');
	$app->response()->body(json_encode([
		'token'  => $token,
		'status' => true
	]));
});

$app->get('/logout', function () use ($app, $dp)
{
	$app->deleteCookie('locale');
	$app->deleteCookie('token');
	$app->deleteCookie('clientId');
	$app->deleteCookie('clientSecret');

	$app->session->clear();

	$dp = null;

	$app->redirect('/');
});


$app->get('/forms/add-doctor-service', function () use ($app, $dp)
{

	$facilityId = $app->request()->get('facility-id');
	$doctorId   = $app->request()->get('doctor-id');
	$doctor     = $dp->getDoctor($facilityId, $doctorId);
	$services   = $dp->getServices();

	$app->check($doctor);
	$app->check($services);

	$app->render('partials.forms.add-doctor-service', [
		'services'   => $services->getItems(),
		'facilityId' => $facilityId,
		'doctor'     => $doctor
	]);
});


$app->get('/forms/modify-doctor-service', function () use ($app, $dp)
{


	$facilityId      = $app->request()->get('facility-id');
	$doctorId        = $app->request()->get('doctor-id');
	$doctorServiceId = $app->request()->get('doctor-service-id');


	$app->render('partials.forms.modify-doctor-service', [
		'facilityId'      => $facilityId,
		'doctorId'        => $doctorId,
		'doctorServiceId' => $doctorServiceId
	]);
});

$app->get('/forms/calendar', function () use ($app, $dp)
{
	$facilityId = $app->request()->get('facility-id');
	$doctorId   = $app->request()->get('doctor-id');

	$addresses = $dp->getAddresses($facilityId, $doctorId);
	$doctor    = $dp->getDoctor($facilityId, $doctorId);

	$app->check($addresses);
	$app->check($doctor);

	$app->render('partials.forms.calendar', [
		'addresses'  => $addresses->getItems(),
		'doctor'     => $doctor,
		'facilityId' => $facilityId,
		'minDate'    => (new DateTime('00:00:00'))->format('c'),
		'maxDate'    => (new DateTime('00:00:00'))->modify('+12 weeks')->format('c')
	]);
});

$app->get('/forms/book-visit', function () use ($app, $dp)
{
	$facilityId = $app->request()->get('facility-id');
	$doctorId   = $app->request()->get('doctor-id');
	$addressId  = $app->request()->get('address-id');
	$start      = new \DateTime($app->request()->get('start'));

	$address        = $dp->getAddress($facilityId, $doctorId, $addressId);
	$doctor         = $dp->getDoctor($facilityId, $doctorId);
	$addressServices = $dp->getAddressServicesForSlot($facilityId, $doctorId, $addressId, $start);

	$app->check($addressServices);
	$app->check($address);
	$app->check($doctor);

	$app->render('partials.forms.book-visit', [
		'address'        => $address,
		'doctor'         => $doctor,
		'facilityId'     => $facilityId,
		'visitStart'     => $start,
		'extraFields'    => $address->getBookingExtraFields(),
		'addressServices' => $addressServices->getItems()
	]);
});


$app->get('/forms/put-slots', function () use ($app, $dp)
{

	$facilityId = $app->request()->get('facility-id');
	$doctorId   = $app->request()->get('doctor-id');
	$addressId  = $app->request()->get('address-id');

	$address        = $dp->getAddress($facilityId, $doctorId, $addressId);
	$doctor         = $dp->getDoctor($facilityId, $doctorId);
	$addressServices = $dp->getAddressServices($facilityId, $doctorId, $addressId);

	$app->check($address);
	$app->check($doctor);
	$app->check($addressServices);

	$app->render('partials.forms.put-slots', [
		'address'        => $address,
		'doctor'         => $doctor,
		'start'          => (new \DateTime)->modify('+1 day'),
		'end'            => (new \DateTime)->modify('+12 weeks'),
		'facilityId'     => $facilityId,
		'addressServices' => $addressServices->getItems()
	]);
});

$app->get('/inputs/slot', function () use ($app, $dp)
{

	$index      = $app->request()->get('index') ?: 0;
	$facilityId = $app->request()->get('facility-id');
	$doctorId   = $app->request()->get('doctor-id');
    $addressId  = $app->request()->get('address-id');

	$addressServices = $dp->getAddressServices($facilityId, $doctorId, $addressId);

	$app->check($addressServices);

	$app->render('partials.forms.inputs.slot', [
		'index'          => $index,
		'start'          => (new \DateTime)->modify('+1 day'),
		'facilityId'     => $facilityId,
		'doctorId'       => $doctorId,
		'addressServices' => $addressServices->getItems(),
        'addressId'       => $addressId
	]);
});

$app->get('/inputs/slot-address-service', function () use ($app, $dp)
{
	$slotIndex          = $app->request()->get('slot-index') ?: 0;
	$addressServiceIndex = $app->request()->get('address-service-index') ?: 0;


	$facilityId = $app->request()->get('facility-id');
	$doctorId   = $app->request()->get('doctor-id');
    $addressId  = $app->request()->get('address-id');

	$addressServices = $dp->getAddressServices($facilityId, $doctorId, $addressId);

	$app->check($addressServices);

	$app->render('partials.forms.inputs.slot-address-service', [
		'slotIndex'          => $slotIndex,
		'addressServiceIndex' => $addressServiceIndex,
		'addressServices'     => $addressServices->getItems()
	]);
});


$app->get('/services', function () use ($app, $dp)
{
	$services = $dp->getServices();

	$app->check($services);

	$app->render('partials.services', [
		'services' => $services->getItems()
	]);
});

$app->get('/notifications', function () use ($app, $dp)
{
	$notification = $dp->getNotification();

	$app->render('partials.notification', [
		'notification' => json_encode(json_decode($notification), JSON_PRETTY_PRINT)
	]);
});


$app->get('/facilities', function () use ($app, $dp)
{
	$facilities = $dp->getFacilities();

	$app->check($facilities);

	$app->render('partials.facilities', [
		'facilities' => $facilities->getItems()
	]);
});


$app->get('/facilities/:facilityId', function ($facilityId) use ($app, $dp)
{
	$facility = $dp->getFacility($facilityId);

	$app->check($facility);

	$app->render('partials.facility', [
		'facility' => $facility
	]);
});

$app->get('/facilities/:facilityId/doctors', function ($facilityId) use ($app, $dp)
{
	$doctors = $dp->getDoctors($facilityId);

	$app->check($doctors);

	$app->render('partials.doctors', [
		'facilityId' => $facilityId,
		'doctors'    => $doctors->getItems()
	]);
});


$app->get('/facilities/:facilityId/doctors/:doctorId/addresses', function ($facilityId, $doctorId) use ($app, $dp)
{
	$addresses = $dp->getAddresses($facilityId, $doctorId);

	$app->check($addresses);

	$app->render('partials.modals.addresses', [
		'addresses'  => $addresses->getItems(),
		'facilityId' => $facilityId,
		'doctorId'   => $doctorId
	]);
});

$app->get('/facilities/:facilityId/doctors/:doctorId/slots', function ($facilityId, $doctorId) use ($app, $dp)
{
	$addressId = $app->request()->get('address-id');
	$start     = new \DateTime($app->request()->get('start'));
	$end       = new \DateTime($app->request()->get('end'));

	$slots = $dp->getSlots($facilityId, $doctorId, $addressId, $start, $end);

	$app->check($slots);

	$slots = $slots->getItems();

	$interval   = new DateInterval('P1D');
	$rangeStart = clone $start->modify('this week Monday')->setTime(0, 0, 0);
	$rangeEnd   = clone $end->modify('this week Sunday')->setTime(0, 0, 0)->add($interval);

	$range = new DatePeriod(
		$rangeStart,
		$interval,
		$rangeEnd
	);

	$slotList = [];

	/** @var \DateTime $date */
	foreach ($range as $date)
	{
		$ymd            = $date->format('Y-m-d');
		$slotList[$ymd] = [];
	}


	/** @var string */
	foreach ($slots as $slot)
	{
		$ymd              = $slot->getStart()->format('Y-m-d');
		$slotList[$ymd][] = $slot->getStart();
	}

	$app->render('partials.modals.slots', [
		'slotChunks' => array_chunk($slotList, 7, true),
		'facilityId' => $facilityId,
		'doctorId'   => $doctorId,
		'addressId'  => $addressId
	]);
});

$app->put(
	'/facilities/:facilityId/doctors/:doctorId/addresses/:addressId/slots',
	function ($facilityId, $doctorId, $addressId) use ($app, $dp, $serializer)
	{
		$data = $app->request()->post();

		/** @var PutSlotsRequest $putSlotsRequest */
		$putSlotsRequest = $serializer->deserialize(json_encode($data), PutSlotsRequest::class, 'json');

		$response = $dp->putSlots($facilityId, $doctorId, $addressId, $putSlotsRequest);

		$app->check($response);

		$app->response()->header('Content-Type', 'application/json');
		$app->response()->setBody(json_encode([
			'status' => true,
		]));
	}
);

$app->delete(
	'/facilities/:facilityId/doctors/:doctorId/addresses/:addressId/slots/:date',
	function ($facilityId, $doctorId, $addressId, $date) use ($app, $dp)
	{
		$date = new \DateTime($date);

		$result = $dp->deleteSlots($facilityId, $doctorId, $addressId, $date);

		$app->check($result);

		$app->response()->header('Content-Type', 'application/json');
		$app->response()->setBody(json_encode(['status' => true]));
	}
);

$app->post(
	'/facilities/:facilityId/doctors/:doctorId/addresses/:addressId/slots/:start/book',
	function ($facilityId, $doctorId, $addressId, $start) use ($app, $dp, $serializer)
	{
		$start = new \DateTime($start);
		$data  = $app->request()->post();

		if (isset($data['patient']['birth_date']))
		{
			//Let's avoid serializer DateTime format validation with a simple trick
			$data['patient']['birth_date'] = (new \DateTime($data['patient']['birth_date']))->format(DATE_ATOM);
		}


		/** @var BookVisitRequest $bookVisitRequest */
		$bookVisitRequest = $serializer->deserialize(json_encode($data), BookVisitRequest::class, 'json');

		/**
		 * You may want to put some validation logic here.
		 */

		$bookVisitResponse = $dp->bookSlot($facilityId, $doctorId, $addressId, $start, $bookVisitRequest);

		$app->check($bookVisitResponse);

		$app->response()->header('Content-Type', 'application/json');
		$app->response()->setBody(json_encode([
			'status'     => true,
			'booking-id' => $bookVisitResponse->getId()
		]));
	}
);

$app->get('/facilities/:facilityId/doctors/:doctorId/addresses/:addressId/bookings',
	function ($facilityId, $doctorId, $addressId) use ($app, $dp)
	{
		$start = new \DateTime($app->request()->get('start'));
		$end   = new \DateTime($app->request()->get('end') ?: '+12 weeks');

		$bookings = $dp->getBookings($facilityId, $doctorId, $addressId, $start, $end);

		$app->check($bookings);

		$app->render('partials.modals.bookings', [
			'facilityId' => $facilityId,
			'doctorId'   => $doctorId,
			'addressId'  => $addressId,
			'bookings'   => $bookings->getItems(),
			'start'      => $start->format('c'),
			'end'        => $end->format('c')
		]);
	}
);

$app->get('/facilities/:facilityId/doctors/:doctorId/addresses/:addressId/booking-list',
	function ($facilityId, $doctorId, $addressId) use ($app, $dp)
	{
		$start = new \DateTime($app->request()->get('start'));
		$end   = new \DateTime($app->request()->get('end') ?: '+12 weeks');

		$bookings = $dp->getBookings($facilityId, $doctorId, $addressId, $start, $end);

		$app->check($bookings);

		$app->render('partials.booking-list', [
			'facilityId' => $facilityId,
			'doctorId'   => $doctorId,
			'addressId'  => $addressId,
			'bookings'   => $bookings->getItems()
		]);
	}
);

$app->delete('/facilities/:facilityId/doctors/:doctorId/addresses/:addressId/bookings/:bookingId',
	function ($facilityId, $doctorId, $addressId, $bookingId) use ($app, $dp)
	{
		$result = $dp->cancelBooking($facilityId, $doctorId, $addressId, $bookingId);

		$app->check($result);

		$app->response()->header('Content-Type', 'application/json');
		$app->response()->setBody(json_encode(['status' => $result]));
	}
);

$app->error(function (\Exception $e) use ($app)
{
	$app->response()->status($e->getCode());
	$app->response()->header('Content-Type', 'application/json');
	$app->response()->setBody(
		json_encode([
				'status'  => false,
				'message' => $e->getMessage()
			]
		)
	);
});


//add api v3
$app->get('/facilities/:facilityId/doctors/:doctorId/addresses/:addressId/services',
    function ($facilityId, $doctorId, $addressId) use ($app, $dp)
    {
        $addressServices = $dp->getAddressServices($facilityId, $doctorId, $addressId);

        $app->check($addressServices);

        $app->render('partials.modals.address-services', [
            'facilityId'     => $facilityId,
            'doctorId'       => $doctorId,
            'addressId'      => $addressId,
            'addressServices' => $addressServices->getItems()
        ]);
    }
);

$app->get('/forms/modify-address-service', function () use ($app, $dp)
{
    $facilityId      = $app->request()->get('facility-id');
    $doctorId        = $app->request()->get('doctor-id');
    $addressId       = $app->request()->get('address-id');
    $addressServiceId = $app->request()->get('address-service-id');

    $app->render('partials.forms.modify-address-service', [
        'facilityId'      => $facilityId,
        'doctorId'        => $doctorId,
        'addressId'       => $addressId,
        'addressServiceId' => $addressServiceId
    ]);
});


$app->patch(
    '/facilities/:facilityId/doctors/:doctorId/addresses/:addressId/services/:addressServiceId',
    function ($facilityId, $doctorId, $addressId, $addressServiceId) use ($app, $dp)
    {
        $price = $app->request()->patch('price');
        $isPriceFrom = $app->request()->patch('is-price-from') ? true : false;

        $addressService = new AddressService();
        $addressService->setId($addressServiceId)
                        ->setPrice($price)
                        ->setIsPriceFrom($isPriceFrom);


        $patchedAddressService = $dp->patchAddressService($facilityId, $doctorId, $addressId, $addressService);

        $app->check($patchedAddressService);

        $response = [
            'status'             => true,
            'address-service-id' => $patchedAddressService->getId(),
            'price'              => $patchedAddressService->getPrice(),
            'is-price-from'      => $patchedAddressService->getIsPriceFrom()
        ];

        $app->response()->header('Content-Type', 'application/json');
        $app->response()->body(json_encode($response));
    }
);

$app->delete(
    '/facilities/:facilityId/doctors/:doctorId/addresses/:addressId/services/:addressServiceId',
    function ($facilityId, $doctorId, $addressId, $addressServiceId) use ($app, $dp)
    {
        $result = $dp->deleteAddressService($facilityId, $doctorId, $addressId, $addressServiceId);

        $app->check($result);

        $app->response()->status(204);
    }
);

$app->post(
    '/facilities/:facilityId/doctors/:doctorId/addresses/:addressId/services/',
    function ($facilityId, $doctorId, $addressId) use ($app, $dp)
    {
        $serviceId = $app->request()->post('service-id');
        $price  = $app->request()->post('price');
        $isPriceFrom  = $app->request()->post('is-price-from') ? true : false;

        /** @var AddressService $addressService */
        $addressService = new AddressService();
        $addressService->setServiceId($serviceId)
                        ->setPrice($price)
                        ->setIsPriceFrom($isPriceFrom);

        $newAddressService = $dp->addAddressService($facilityId, $doctorId, $addressId, $addressService);

        $app->check($newAddressService);

        $response = [
            'status'            => true,
            'address-service-id' => $newAddressService->getId()
        ];

        $app->response()->header('Content-Type', 'application/json');
        $app->response()->body(json_encode($response));
    }
);

$app->get('/forms/add-address-service', function () use ($app, $dp)
{
    $facilityId = $app->request()->get('facility-id');
    $doctorId   = $app->request()->get('doctor-id');
    $addressId  = $app->request()->get('address-id');
    $services   = $dp->getServices();

    $app->check($services);

    $app->render('partials.forms.add-address-service', [
        'services'   => $services->getItems(),
        'facilityId' => $facilityId,
        'doctorId'   => $doctorId,
        'addressId'  => $addressId
    ]);
});

$app->get('/facilities/:facilityId/doctors/:doctorId/addresses/:addressId/breaks',
    function ($facilityId, $doctorId, $addressId) use ($app, $dp)
    {
        $since = (new \DateTime('-10 days'))->format('c');
        $till = (new \DateTime('+10 days'))->format('c');

        $calendarBreaks = $dp->getCalendarBreaks($facilityId, $doctorId, $addressId, $since, $till);

        $app->check($calendarBreaks);

        $app->render('partials.modals.calendar-breaks', [
            'calendarBreaks' => $calendarBreaks->getItems(),
            'facilityId'     => $facilityId,
            'doctorId'       => $doctorId,
            'addressId'      => $addressId,
            'since'          => $since,
            'till'           => $till
        ]);
    }
);

$app->get('/facilities/:facilityId/doctors/:doctorId/addresses/:addressId/breaks-list',
    function ($facilityId, $doctorId, $addressId) use ($app, $dp)
    {
        $since = $app->request()->get('start');
        $till = $app->request()->get('end');

        $calendarBreaks = $dp->getCalendarBreaks($facilityId, $doctorId, $addressId, $since, $till);

        $app->check($calendarBreaks);

        $app->render('partials.calendar-breaks-list', [
            'calendarBreaks' => $calendarBreaks->getItems(),
            'facilityId'     => $facilityId,
            'doctorId'       => $doctorId,
            'addressId'      => $addressId
        ]);
    }
);

$app->get('/forms/add-calendar-break', function () use ($app, $dp)
{
    $since = (new \DateTime('now'))->format('c');
    $till = (new \DateTime('now'))->format('c');
    $facilityId = $app->request()->get('facility-id');
    $doctorId   = $app->request()->get('doctor-id');
    $addressId  = $app->request()->get('address-id');

    $app->render('partials.forms.add-calendar-break', [
        'facilityId' => $facilityId,
        'doctorId'   => $doctorId,
        'addressId'  => $addressId,
        'since'      => $since,
        'till'       => $till
    ]);
});

$app->post('/facilities/:facilityId/doctors/:doctorId/addresses/:addressId/breaks',
    function ($facilityId, $doctorId, $addressId) use ($app, $dp)
    {
        $since = new DateTime($app->request()->post('start'));
        $till = new DateTime($app->request()->post('end'));

        $calendarBreak = new \DP\Model\CalendarBreak();
        $calendarBreak->setSince($since)
                        ->setTill($till);

        $newCalendarBreak = $dp->addCalendarBreak($facilityId, $doctorId, $addressId, $calendarBreak);

        $app->check($newCalendarBreak);

        $response = [
            'status'            => true,
            'calendar-break-id' => $newCalendarBreak->getId()
        ];

        $app->response()->header('Content-Type', 'application/json');
        $app->response()->body(json_encode($response));
    }
);

$app->delete('/facilities/:facilityId/doctors/:doctorId/addresses/:addressId/breaks/:breakId',
    function ($facilityId, $doctorId, $addressId, $breakId) use ($app, $dp)
    {
        $result = $dp->deleteCalendarBreak($facilityId, $doctorId, $addressId, $breakId);

        $app->check($result);

        $app->response()->status(204);
    }
);

$app->run();
