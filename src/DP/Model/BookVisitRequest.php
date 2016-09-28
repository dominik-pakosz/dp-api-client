<?php
/**
 * Created by PhpStorm.
 * User: umitakkaya
 * Date: 30/09/15
 * Time: 12:15
 */

namespace DP\Model;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class BookVisitRequest
{
	/**
	 * @Type("boolean")
	 * @SerializedName("is_returning")
	 */
	private $isReturning;

	/**
	 * @Type("integer")
	 * @SerializedName("address_service_id")
	 */
	private $addressServiceId;

	/**
	 * @Type("DP\Model\Patient")
	 */
	private $patient;

	/**
	 * @return int
	 */
	public function getAddressServiceId()
	{
		return $this->addressServiceId;
	}

	/**
	 * @param int $addressServiceId
	 *
	 * @return $this
	 */
	public function setAddressServiceId($addressServiceId)
	{
		$this->addressServiceId = $addressServiceId;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function getIsReturning()
	{
		return $this->isReturning;
	}

	/**
	 * @param bool $isReturning
	 *
	 * @return $this
	 */
	public function setIsReturning($isReturning)
	{
		$this->isReturning = $isReturning;

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
	 * @return $this
	 */
	public function setPatient($patient)
	{
		$this->patient = $patient;

		return $this;
	}
}