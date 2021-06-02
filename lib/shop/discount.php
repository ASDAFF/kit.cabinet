<?php

namespace Kit\Cabinet\Shop;


use Bitrix\Main\Loader;

/**
 * Class Discount
 * @package Kit\Cabinet\Shop
 *
 */
class Discount extends \KitCabinet
{
	/**
	 * @var string
	 */
	protected $name = '';
	/**
	 * @var string
	 */
	protected $description = '';

	/**
	 * Discount constructor.
	 * @param array $filter
	 */
	public function __construct($filter = array())
	{
		if(Loader::includeModule('catalog'))
		{
			$discount = \Bitrix\Catalog\DiscountTable::getList(
				array(
					'filter' => $filter,
					'select' => array(
						'ID',
						'NAME',
						'NOTES'
					),
					'limit' => 1
				)
			)->fetch();
			if($discount['ID'] > 0)
			{
				$this->name = $discount['NAME'];
				$this->description = $discount['NOTES'];
			}
		}
	}
	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @param string $description
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}
	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}
}