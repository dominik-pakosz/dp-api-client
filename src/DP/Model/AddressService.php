<?php

namespace DP\Model;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

class AddressService extends AbstractErrorResponse
{
	/**
	 * @Type("integer")
	 * @Groups({"get", "post", "delete"})
	 */
	private $id;

	/**
	 * @Type("string")
	 * @Groups({"get"})
	 */
	private $name;

	/**
	 * @Type("float")
	 * @SerializedName("price")
	 * @Groups({"get", "patch", "post"})
	 */
	private $price;

	/**
	 * @Type("boolean")
	 * @SerializedName("is_price_from")
	 * @Groups({"get", "patch", "post"})
	 */
	private $isPriceFrom;

	/**
	 * @Type("integer")
	 * @SerializedName("service_id")
	 * @Groups({"get", "post"})
	 */
	private $serviceId;

	/**
	 * @Type("integer")
	 * @Groups({"put_slots"})
	 */
	private $duration;


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
	 * @return $this
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @VirtualProperty
	 * @SerializedName("address_service_id")
	 * @Groups({"put_slots"})
	 *
	 * @return int
	 */
	public function getAddressServiceId()
	{
		return $this->getId();
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 *
	 * @return $this
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @return float
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * @param float $price
	 *
	 * @return $this
	 */
	public function setPrice($price)
	{
		$this->price = $price;

		return $this;
	}

    /**
     * @return bool
     */
    public function getIsPriceFrom()
    {
        return $this->isPriceFrom;
    }

    /**
     * @param bool $isPriceFrom
     *
     * @return $this
     */
    public function setIsPriceFrom($isPriceFrom)
    {
        $this->isPriceFrom = $isPriceFrom;

        return $this;
    }

	/**
	 * @return int
	 */
	public function getServiceId()
	{
		return $this->serviceId;
	}

	/**
	 * @param int $serviceId
	 *
	 * @return $this
	 */
	public function setServiceId($serviceId)
	{
		$this->serviceId = $serviceId;

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
	 * @return AddressService
	 */
	public function setDuration($duration)
	{
		$this->duration = $duration;

		return $this;
	}



}