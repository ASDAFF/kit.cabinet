<?php

namespace Kit\Cabinet\Shop;
/**
 * Class Order
 * @package Kit\Cabinet\Order
 *
 */
class Order
{
	private $price           = '';
	private $date            = '';
	private $status          = array();
	private $id              = '';
	private $personType      = '';


	/**
	 * Order constructor.
	 * @param array $order
	 */
	public function __construct($order = array())
	{
		if($order['ACCOUNT_NUMBER'])
		{
			$this->setId($order['ACCOUNT_NUMBER']);
		}
		if($order['PRICE'] > 0 && $order['CURRENCY'])
		{
			$this->setPrice($order['PRICE'], $order['CURRENCY']);
		}
		if($order['DATE_INSERT'])
		{
			$this->setDate($order['DATE_INSERT']);
		}
		if($order['ID'])
		{
			$this->setId($order['ID']);
		}
	}

	/**
	 * @param array $props
	 * @return string
	 */
	public function getOrgName($props = array())
	{
		$return = '';
		$order = \Bitrix\Sale\Order::load($this->getId());
		$propertyCollection = $order->getPropertyCollection();
		foreach ($propertyCollection as $property)
		{
			if(in_array($property->getPropertyId(), $props))
			{
				$return .= $property->getValue().' ';
			}
		}
		return trim($return);
	}

	/**
	 * @param string $pathToPay
	 * @return string
	 */
	public function getDownloadBillLink($pathToPay = '')
	{
		$return = '';
		$order = \Bitrix\Sale\Order::load($this->getId());
		$paymentCollection = $order->getPaymentCollection();
		foreach ($paymentCollection as $payment)
		{
			if(!$payment->isPaid())
			{
				$paymentFields = $payment->getFieldValues();
				$paySystem = \Bitrix\Sale\PaySystem\Manager::getById($paymentFields["PAY_SYSTEM_ID"]);
				if($paySystem['ACTION_FILE'] == 'bill')
				{
					$return = $pathToPay . '?ORDER_ID='.$this->getId().'&PAYMENT_ID='.$payment->getId().'&pdf=1&DOWNLOAD=Y';
					break;
				}
			}
		}
		return $return;
	}

	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * @return string
	 */
	public function getDate()
	{
		return $this->date;
	}

	/**
	 * @return string
	 */
	public function getStatus()
	{
		return $this->status;
	}


	/**
	 * @param string $rule
	 * @return string
	 */
	public function getUrl($rule = '')
	{
		return str_replace('#ID#', $this->id, $rule);
	}


	/**
	 * @param string $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @param $price
	 * @param $currency
	 */
	public function setPrice(
		$price,
		$currency
	)
	{
		$this->price = CurrencyFormat($price, $currency);
	}

	/**
	 * @param string $date
	 */
	public function setDate($date)
	{
		$this->date = $date;

	}

	/**
	 * @param string $status
	 */
	public function setStatus($status)
	{
		$this->status = $status;
	}

	/**
	 * @return string
	 */
	public function getPersonType()
	{
		return $this->personType;
	}

	/**
	 * @param string $personType
	 */
	public function setPersonType($personType)
	{
		$this->personType = $personType;
	}

	/**
	 * @return string
	 */
	public function getDownloadBillUrl()
	{
		return $this->downloadBillUrl;
	}

	/**
	 * @param string $downloadBillUrl
	 */
	public function setDownloadBillUrl($downloadBillUrl)
	{
		$this->downloadBillUrl = $downloadBillUrl;
	}
}