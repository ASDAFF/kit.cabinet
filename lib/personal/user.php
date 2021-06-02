<?php
namespace Kit\Cabinet\Personal;

use Bitrix\Main\UserTable;

/**
 * Class User
 * @package Kit\Cabinet\Personal
 *
 */
class User extends \KitCabinet
{

	protected $id            = 0;
	protected $name          = '';
	protected $lastName      = '';
	protected $secondName    = '';
	protected $personalPhone = '';
	protected $email         = '';
	protected $personalPhoto = '';

	/**
	 *
	 * @param number $idUser
	 */
	public function __construct($idUser = 0)
	{
		if($idUser > 0)
		{
			$user = UserTable::getList(array(
				'filter' => array('ID' => $idUser),
				'limit' => 1,
				'select' => array(
					'ID',
					'NAME',
					'LAST_NAME',
					'SECOND_NAME',
					'PERSONAL_PHONE',
					'EMAIL',
					'PERSONAL_PHOTO'
				)
			))->fetch();
			$this->id = $user['ID'];
			$this->name = $user['NAME'];
			$this->lastName = $user['LAST_NAME'];
			$this->secondName = $user['SECOND_NAME'];
			$this->personalPhone = $user['PERSONAL_PHONE'];
			$this->email = $user['EMAIL'];
			$this->personalPhoto = $user['PERSONAL_PHOTO'];
		}
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
	 */
	public function setId($id)
	{
		$this->id = $id;
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
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * @param string $lastName
	 */
	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
	}

	/**
	 * @return string
	 */
	public function getSecondName()
	{
		return $this->secondName;
	}

	/**
	 * @param string $secondName
	 */
	public function setSecondName($secondName)
	{
		$this->secondName = $secondName;
	}

	/**
	 * @return string
	 */
	public function getPersonalPhone()
	{
		return $this->personalPhone;
	}

	/**
	 * @param string $personalPhone
	 */
	public function setPersonalPhone($personalPhone)
	{
		$this->personalPhone = $personalPhone;
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
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getPersonalPhoto()
	{
		return $this->personalPhoto;
	}

	/**
	 * @param string $personalPhoto
	 */
	public function setPersonalPhoto($personalPhoto)
	{
		$this->personalPhoto = $personalPhoto;
	}

	/**
	 * get user fio
	 * @return string
	 */
	public function getFIO()
	{
		return trim($this->name . ' ' . $this->lastName . ' ' . $this->secondName);
	}

	/**
	 * @param array $settings
	 * @return array
	 */
	public function genAvatar(
		$settings = array(
			'width' => 50,
			'height' => 50,
			'resize' => BX_RESIZE_IMAGE_EXACT
		)
	)
	{
		if($this->personalPhoto > 0)
		{
			return \CFile::ResizeImageGet($this->personalPhoto, array(
				'width' => $settings['width'],
				'height' => $settings['height']
			), $settings['resize'], true);
		}
		else
		{
			return array();
		}
	}
}