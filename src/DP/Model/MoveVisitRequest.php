<?php

namespace DP\Model;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class MoveVisitRequest
{
	/**
	 * @Type("integer")
	 * @SerializedName("address_service_id")
	 */
	private $addressServiceId;

    /**
     * @Type("DateTime<'Y-m-d\TH:i:sP'>")
     * @SerializedName("start")
     */
	private $start;

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param mixed $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

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

}