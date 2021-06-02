<?php

namespace Kit\Cabinet\Shop;
use Bitrix\Sale\Internals\PersonTypeTable;

/**
 * Class listOrders
 * @package Kit\Cabinet\Order
 */
class Orders extends \KitCabinet
{
	public  $orderList = array();
	private $limit     = 2;

	/**
	 * Orders constructor.
	 */
	public function __construct()
	{

	}

	/**
	 * @param array $filter
	 * @return array
	 */
	public function getOrders($filter = array())
	{
			$orders = array();
			$listStatusNames = \Bitrix\Sale\OrderStatus::getAllStatusesNames(LANGUAGE_ID);
			$personTypes = array();
			$orderList = \Bitrix\Sale\Order::getList(array(
				'select' => array(
					"ID",
					'PERSON_TYPE_ID',
					'STATUS_ID',
					'ACCOUNT_NUMBER',
					'PRICE',
					'CURRENCY',
					'DELIVERY_ID',
					'DATE_INSERT'
				),
				'filter' => $filter,
				'order' => array("ID" => "DESC"),
				'limit' => $this->limit
			));

			while ($order = $orderList->fetch())
			{
				$this->orderList[$order['ID']] = new Order($order);
				$this->orderList[$order['ID']]->setStatus(array(
					$order['STATUS_ID'] => $listStatusNames[$order['STATUS_ID']]
				));
				$orders[$order['ID']] = $order;
				$personTypes[$order['ID']] = $order['PERSON_TYPE_ID'];
			}
			$rsPersonTypes = PersonTypeTable::getList(array('filter' => array('ID' => $personTypes)));
			while($personType = $rsPersonTypes->fetch())
			{
				foreach($personTypes as $idOrder => $idPersonType)
				{
					if($idPersonType == $personType['ID'])
					{
						$this->orderList[$idOrder]->setPersonType($personType['NAME']);
					}
				}
			}

		return $this->orderList;
	}

	/**
	 * @return int
	 */
	public function getLimit()
	{
		return $this->limit;
	}

	/**
	 * @param int $limit
	 */
	public function setLimit($limit)
	{
		$this->limit = $limit;
	}
}