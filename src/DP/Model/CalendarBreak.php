<?php

namespace DP\Model;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;

class CalendarBreak extends AbstractErrorResponse
{
	/**
	 * @Type("integer")
	 * @Groups({"get"})
	 */
	private $id;

	/**
	 * @Type("string")
     * @Type("DateTime<'Y-m-d\TH:i:sP'>")
     * @Groups({"get", "post"})
	 */
	private $since;

	/**
	 * @Type("float")
     * @Type("DateTime<'Y-m-d\TH:i:sP'>")
     * @Groups({"get", "post"})
	 */
	private $till;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSince()
    {
        return $this->since;
    }

    /**
     * @param mixed $since
     *
     * @return $this
     */
    public function setSince($since)
    {
        $this->since = $since;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTill()
    {
        return $this->till;
    }

    /**
     * @param mixed $till
     *
     * @return $this
     */
    public function setTill($till)
    {
        $this->till = $till;

        return $this;

    }
}