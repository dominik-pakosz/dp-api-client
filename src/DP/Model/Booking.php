<?php

namespace DP\Model;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;


class Booking extends AbstractErrorResponse
{
	/**
	 * @Type("integer")
	 */
	private $id;

	/**
	 * @Type("string")
	 */
	private $status;

	/**
	 * @Type("DateTime<'Y-m-d\TH:i:sP'>")
	 * @SerializedName("booked_at")
	 */
	private $bookedAt;

	/**
	 * @Type("DateTime<'Y-m-d\TH:i:sP'>")
	 * @SerializedName("canceled_at")
	 */
	private $canceledAt;

	/**
	 * @Type("DateTime<'Y-m-d\TH:i:sP'>")
	 * @SerializedName("start_at")
	 */
	private $startAt;

	/**
	 * @Type("DateTime<'Y-m-d\TH:i:sP'>")
	 * @SerializedName("end_at")
	 */
	private $endAt;

	/**
	 * @Type("string")
	 * @SerializedName("booked_by")
	 */
	private $bookedBy;

	/**
	 * @Type("string")
	 * @SerializedName("canceled_by")
	 */
	private $canceledBy;


	/**
	 * @Type("integer")
	 */
	private $duration;

	/**
	 * @Type("DP\Model\Patient")
	 */
	private $patient;

	/**
	 * @Type("DP\Model\AddressService")
	 */
	private $addressService;

	/**
	 * @return \DateTime
	 */
	public function getBookedAt()
	{
		return $this->bookedAt;
	}

	/**
	 * @param \DateTime $bookedAt
	 *
	 * @return Booking
	 */
	public function setBookedAt($bookedAt)
	{
		$this->bookedAt = $bookedAt;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getBookedBy()
	{
		return $this->bookedBy;
	}

	/**
	 * @param string $bookedBy
	 *
	 * @return Booking
	 */
	public function setBookedBy($bookedBy)
	{
		$this->bookedBy = $bookedBy;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getCanceledAt()
	{
		return $this->canceledAt;
	}

	/**
	 * @param \DateTime $canceledAt
	 *
	 * @return Booking
	 */
	public function setCanceledAt($canceledAt)
	{
		$this->canceledAt = $canceledAt;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCanceledBy()
	{
		return $this->canceledBy;
	}

	/**
	 * @param string $canceledBy
	 *
	 * @return Booking
	 */
	public function setCanceledBy($canceledBy)
	{
		$this->canceledBy = $canceledBy;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getDuration()
	{
		return $this->duration;
	}

	/**
	 * @param int $duration
	 *
	 * @return Booking
	 */
	public function setDuration($duration)
	{
		$this->duration = $duration;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getEndAt()
	{
		return $this->endAt;
	}

	/**
	 * @param \DateTime $endAt
	 *
	 * @return Booking
	 */
	public function setEndAt($endAt)
	{
		$this->endAt = $endAt;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 *
	 * @return Booking
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return Patient
	 */
	public function getPatient()
	{
		return $this->patient;
	}

	/**
	 * @param Patient $patient
	 *
	 * @return Booking
	 */
	public function setPatient($patient)
	{
		$this->patient = $patient;

		return $this;
	}

	/**
	 * @return AddressService
	 */
	public function getAddressService()
	{
		return $this->addressService;
	}

	/**
	 * @param AddressService $service
	 *
	 * @return Booking
	 */
	public function setAddressService($service)
	{
		$this->addressService = $service;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getStartAt()
	{
		return $this->startAt;
	}

	/**
	 * @param \DateTime $startAt
	 *
	 * @return Booking
	 */
	public function setStartAt($startAt)
	{
		$this->startAt = $startAt;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * @param string $status
	 *
	 * @return Booking
	 */
	public function setStatus($status)
	{
		$this->status = $status;

		return $this;
	}


}