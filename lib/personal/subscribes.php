<?php

namespace Kit\Cabinet\Personal;

/**
 * Class Subscribes
 * @package Kit\Cabinet\Personal
 *
 */
class Subscribes extends \KitCabinet
{
	protected $email = '';
	/**
	 * @var array
	 */
	protected $filter     = array();
	/**
	 * @var array
	 */
	protected $subscribes = array();

	/**
	 * @var int
	 */
	protected $idSubscriber = 0;
	/**
	 * Subscribes constructor.
	 */
	public function __construct()
	{

	}

	/**
	 * @return array
	 */
	public function getFilter()
	{
		return $this->filter;
	}

	/**
	 * @return array
	 */
	public function getSubscribes()
	{
		return $this->subscribes;
	}

	/**
	 * @param array $filter
	 */
	public function setFilter($filter)
	{
		$this->filter = $filter;
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
	 * @return int
	 */
	public function getIdSubscriber()
	{
		return $this->idSubscriber;
	}

	/**
	 * @param int $idSubscriber
	 */
	public function setIdSubscriber($idSubscriber)
	{
		$this->idSubscriber = $idSubscriber;
	}

	/**
	 * @param string $email
	 * @param array $subscribes
	 */
	public function updateSubdcribes($email = '', $subscribes = array())
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			if($this->idSubscriber > 0)
			{
				$UPDATE_EMAIL_SAVE = array('EMAIL_TO'=>$email,'CATEGORIES_ID'=>$subscribes);
				\CKitMailingSubscribers::Update($this->idSubscriber, $UPDATE_EMAIL_SAVE);
			}
			else
			{
				\CkitMailingSubTools::AddSubscribers($email);
			}
		}
	}

	/**
	 *
	 */
	public function genSubscribes()
	{
		if($this->checkInstalledModules('kit.mailing'))
		{
			$subscriberCategories = array();
			$subscriber = \CKitMailingSubscribers::GetList(Array(), $this->filter, false, array('ID','EMAIL_TO'))->Fetch();
			if($subscriber['ID'] > 0)
			{
				$this->idSubscriber = $subscriber['ID'];
				$subscriberCategories = \CKitMailingSubscribers::GetCategoriesBySubscribers($subscriber['ID']);
				$this->email = $subscriber['EMAIL_TO'];
			}
			$rsCategories = \CKitMailingCategories::GetList(Array(
				'ID' => "ASC"
			), Array(
				'ACTIVE' => 'Y'
			), false, array());
			while ($category = $rsCategories->Fetch())
			{
				$this->subscribes[$category['ID']] = new Subscribe();
				$this->subscribes[$category['ID']]->setId($category['ID']);
				$this->subscribes[$category['ID']]->setName($category['NAME']);
				if(in_array($category['ID'], $subscriberCategories))
				{
					$this->subscribes[$category['ID']]->setSubscribed(true);
				}
			}
		}
	}

}