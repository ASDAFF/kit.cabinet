<?php

namespace Kit\Cabinet\Personal;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;

/**
 * Class Reviews
 * @package Kit\Cabinet\Personal
 *
 */
class Reviews extends \KitCabinet
{
	protected $reviewsList = array();
	protected $filter      = array();
	protected $limit       = 2;

	/**
	 * Reviews constructor.
	 */
	public function __construct()
	{
	}

	public function getReviews()
	{
		if ($this->checkInstalledModules(array(
				'kit.reviews',
			)))
		{
			$idElements = array();
			$linkReviewElement = Option::get('kit.reviews', 'REVIEWS_ID_ELEMENT_' . SITE_ID, 'ID_ELEMENT');
			$rsReviews = \Kit\Reviews\ReviewsTable::getList(array(
				'filter' => $this->getFilter(),
				'limit' => $this->getLimit(),
				'select' => array(
					'ID',
					'ID_ELEMENT',
					'XML_ID_ELEMENT',
					'RATING',
					'DATE_CREATION',
					'MODERATED',
					'TEXT'
				)
			));
			while ($review = $rsReviews->fetch())
			{
				if ($linkReviewElement == 'ID_ELEMENT')
				{
					$idElements[$review['ID']] = $review['ID_ELEMENT'];
				}
				else
				{
					$idElements[$review['ID']] = $review['XML_ID_ELEMENT'];
				}
				$this->reviewsList[$review['ID']] = new Review($review);
			}
			if (count($idElements) > 0)
			{
				$filter = array('ACTIVE' => 'Y');
				if ($linkReviewElement == 'ID_ELEMENT')
				{
					$filter['ID'] = $idElements;
				}
				else
				{
					$filter['XML_ID'] = $idElements;
				}

				$rsElements = \CIBlockElement::GetList(array(), $filter, false, false, array(
					'ID',
					'NAME',
					'DETAIL_PAGE_URL'
				));
				while ($elem = $rsElements->GetNext())
				{
					if ($linkReviewElement == 'ID_ELEMENT')
					{
						//foreach because may be some reviews for one element
						foreach($idElements as $idReview => $idElement)
						{
							if($elem['ID'] == $idElement)
							{
								$this->reviewsList[$idReview]->getElement()->setId($elem['ID']);
								$this->reviewsList[$idReview]->getElement()->setName($elem['NAME']);
								$this->reviewsList[$idReview]->getElement()->setUrl($elem['DETAIL_PAGE_URL']);
							}
						}
					}
					else
					{
						//foreach because may be some reviews for one element
						foreach($idElements as $idReview => $xmlIdElement)
						{
							if($elem['XML_ID'] == $xmlIdElement)
							{
								$this->reviewsList[$idReview]->getElement()->setId($elem['ID']);
								$this->reviewsList[$idReview]->getElement()->setName($elem['NAME']);
								$this->reviewsList[$idReview]->getElement()->setUrl($elem['DETAIL_PAGE_URL']);
							}
						}
					}
				}
			}
		}
	}

	/**
	 * @return array
	 */
	public function getReviewsList()
	{
		return $this->reviewsList;
	}


	/**
	 * @return array
	 */
	public function getFilter()
	{
		return $this->filter;
	}

	/**
	 * @param array $filter
	 */
	public function setFilter($filter)
	{
		$this->filter = $filter;
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