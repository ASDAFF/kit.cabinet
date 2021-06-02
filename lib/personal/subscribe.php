<?php
namespace Kit\Cabinet\Personal;

/**
 * Class Subscribe
 * @package Kit\Cabinet\Personal
 *
 */
class Subscribe
{
	/**
	 * @var int9
	 *
	 */
	protected $id = 0;
	/**
	 * @var string
	 */
	protected $name = '';
	/**
	 * @var bool
	 */
	protected $subscribed = false;

	/**
	 * @return int9
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int9 $id
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
	 * @return bool
	 */
	public function isSubscribed()
	{
		return $this->subscribed;
	}

	/**
	 * @param bool $subscribed
	 */
	public function setSubscribed($subscribed)
	{
		$this->subscribed = $subscribed;
	}
}