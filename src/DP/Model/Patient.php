<?php
/**
 * Created by PhpStorm.
 * User: umitakkaya
 * Date: 30/09/15
 * Time: 12:17
 */

namespace DP\Model;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\Groups;

class Patient
{
	/**
	 * @Type("string")
	 */
	private $nin;

	/**
	 * @Type("string")
	 */
	private $name;

	/**
	 * @Type("string")
	 */
	private $surname;

	/**
	 * @Type("string")
	 */
	private $phone;

	/**
	 * @Type("string")
	 */
	private $gender;

	/**
	 * @Type("string")
	 */
	private $email;

	/**
	 * @Type("DateTime<'Y-m-d'>")
	 * @SerializedName("birth_date")
	 * @Groups({"get"})
	 */
	private $birthDate;

	/**
	 * @return string
	 */
	public function getNin()
	{
		return $this->nin;
	}

	/**
	 * @param string $nin
	 *
	 * @return $this
	 */
	public function setNin($nin)
	{
		$this->nin = $nin;

		return $this;
	}


	/**
	 * @return \DateTime
	 */
	public function getBirthDate()
	{
		return $this->birthDate;
	}

	/**
	 * @Type("DateTime<'Y-m-d'>")
	 * @VirtualProperty
	 * @SerializedName("birth_date")
	 * @Groups({"post_book"})
	 *
	 * @return \DateTime
	 */
	public function getFormattedBirthDate()
	{
		return $this->birthDate;
	}

	/**
	 * @param \DateTime $birthDate
	 *
	 * @return $this
	 */
	public function setBirthDate($birthDate)
	{
		$this->birthDate = $birthDate;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 *
	 * @return $this
	 */
	public function setEmail($email)
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getGender()
	{
		return $this->gender;
	}

	/**
	 * @param string $gender
	 *
	 * @return $this
	 */
	public function setGender($gender)
	{
		$this->gender = $gender;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFullName()
	{
		return $this->name . ' ' . $this->surname;
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
	 * @return string
	 */
	public function getPhone()
	{
		return $this->phone;
	}

	/**
	 * @param string $phone
	 *
	 * @return $this
	 */
	public function setPhone($phone)
	{
		$this->phone = $phone;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSurname()
	{
		return $this->surname;
	}

	/**
	 * @param string $surname
	 *
	 * @return $this
	 */
	public function setSurname($surname)
	{
		$this->surname = $surname;

		return $this;
	}


}