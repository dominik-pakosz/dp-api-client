<?php

namespace DP\Model;

use JMS\Serializer\Annotation\Type;

class AddressServices extends AbstractErrorResponse
{
	/**
	 * @Type("array<DP\Model\AddressService>")
	 */
	private $_items;

	/**
	 * @return AddressService[]
	 */
	public function getItems()
	{
		return $this->_items;
	}

	/**
	 * @param AddressService[]
	 */
	public function setItems($items)
	{
		$this->_items = $items;
	}
}