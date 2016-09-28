<?php

namespace DP\Model;

use JMS\Serializer\Annotation\Type;

class CalendarBreaks extends AbstractErrorResponse
{
	/**
	 * @Type("array<DP\Model\CalendarBreak>")
	 */
	private $_items;

	/**
	 * @return CalendarBreak[]
	 */
	public function getItems()
	{
		return $this->_items;
	}

	/**
	 * @param CalendarBreak[]
	 */
	public function setItems($items)
	{
		$this->_items = $items;
	}
}