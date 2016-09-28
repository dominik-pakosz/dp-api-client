<?php
/**
 * Created by PhpStorm.
 * User: umitakkaya
 * Date: 25/09/15
 * Time: 13:26
 */

namespace DP\Model;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;


class Slot
{
	/**
	 * @Type("DateTime<'Y-m-d\TH:i:sP'>")
	 */
	private $start;

	/**
	 * @Type("DateTime<'Y-m-d\TH:i:sP'>")
	 */
	private $end;

	/**
	 * @Type("array<DP\Model\AddressService>")
	 * @SerializedName("address_services")
	 */
	private $addressServices;

	/**
	 * @return \DateTime
	 */
	public function getStart()
	{
		return $this->start;
	}

	/**
	 * @param \DateTime $start
	 */
	public function setStart($start)
	{
		$this->start = $start;
	}

	/**
	 * @return \DateTime
	 */
	public function getEnd()
	{
		return $this->end;
	}

	/**
	 * @param \DateTime  $end
	 */
	public function setEnd($end)
	{
		$this->end = $end;
	}

	/**
	 * @return AddressService[]
	 */
	public function getAddressServices()
	{
		return $this->addressServices;
	}

	/**
	 * @param AddressServices[] $addressServices
	 *
	 * @return Slot
	 */
	public function setAddressServices($addressServices)
	{
		$this->addressServices = $addressServices;

		return $this;
	}

}