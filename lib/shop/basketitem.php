<?php

namespace Kit\Cabinet\Shop;

/**
 * Class Item
 * @package Kit\Cabinet\Shop
 *
 */
class BasketItem
{
	protected $id = 0;
	protected $price = 0;
	protected $discountPrice = 0;
	protected $qnt = 0;
	protected $fullPrice = 0;
	protected $currency = 'RUB';
	protected $element;
	public function __construct($item = array())
	{
		$this->element = new \Kit\Cabinet\Element();

		if($item['ID'])
		{
			$this->id = $item['ID'];
		}

		if($item['PRODUCT_ID'])
		{
			$this->element->setId($item['PRODUCT_ID']);
		}

		if($item['NAME'])
		{
			$this->element->setName($item['NAME']);
		}
		if($item['DETAIL_PAGE_URL'])
		{
			$this->element->setUrl($item['DETAIL_PAGE_URL']);
		}
		if($item['QUANTITY'])
		{
			$this->qnt = $item['QUANTITY'];
		}
		if($item['PRICE'])
		{
			$this->price = $item['PRICE'];
			$this->fullPrice = $this->price * $this->qnt;
		}
		if($item['DISCOUNT_PRICE'])
		{
			$this->discountPrice = $item['DISCOUNT_PRICE'];
		}
		if($item['CURRENCY'])
		{
			$this->currency = $item['CURRENCY'];
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
	 * @return int
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * @param int $price
	 */
	public function setPrice($price)
	{
		$this->price = $price;
	}

	/**
	 * @return int
	 */
	public function getDiscountPrice()
	{
		return $this->discountPrice;
	}

	/**
	 * @param int $discountPrice
	 */
	public function setDiscountPrice($discountPrice)
	{
		$this->discountPrice = $discountPrice;
	}

	/**
	 * @return int
	 */
	public function getFullPrice()
	{
		return $this->fullPrice;
	}

	/**
	 * @param int $fullPrice
	 */
	public function setFullPrice($fullPrice)
	{
		$this->fullPrice = $fullPrice;
	}

	/**
	 * @return string
	 */
	public function getCurrency()
	{
		return $this->currency;
	}

	/**
	 * @param string $currency
	 */
	public function setCurrency($currency)
	{
		$this->currency = $currency;
	}

	/**
	 * @return \Kit\Cabinet\Element
	 */
	public function getElement()
	{
		return $this->element;
	}

	/**
	 * @param \Kit\Cabinet\Element $element
	 */
	public function setElement($element)
	{
		$this->element = $element;
	}
	/**
	 * @return string
	 */
	public function getQnt()
	{
		return $this->qnt;
	}

	/**
	 * @param string $qnt
	 */
	public function setQnt($qnt)
	{
		$this->qnt = $qnt;
	}
}