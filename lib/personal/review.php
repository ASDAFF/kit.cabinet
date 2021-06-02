<?php
namespace Kit\Cabinet\Personal;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/**
 * Class Review
 * @package Kit\Cabinet\Personal
 *
 */
class Review
{
	protected $id        = 0;
	protected $element;
	protected $text      = '';
	protected $rating    = 0;
	protected $moderated = false;
	protected $dateCreate;

	/**
	 * Review constructor.
	 * @param array $review
	 */
	public function __construct($review = array())
	{
		$this->setId($review['ID']);
		$this->setText($review['TEXT']);
		$this->setRating($review['RATING']);
		if($review['MODERATED'] == 'Y')
		{
			$this->setModerated(true);
		}
		else
		{
			$this->setModerated(false);
		}

		$this->setDateCreate($review['DATE_CREATION']);
		$this->setElement(new \Kit\Cabinet\Element());
	}

	/**
	 * get percent param of review
	 * @param int $maxRating
	 * @return float|int
	 */
	public function getRatingProcent($maxRating = 5)
	{
		$return = 0;
		if($maxRating > 0)
		{
			$return = 100 * ($this->getRating() / $maxRating);
		}

		return $return;
	}

	/**
	 * @param string $date
	 * @return string
	 */
	protected function changeLangMonth($date = '')
	{
		return str_replace(
			array(
				'January',
				'February',
				'March',
				'April',
				'May',
				'June',
				'July',
				'August',
				'September',
				'October',
				'November',
				'December'
			),
			array
			(
				Loc::getMessage('KIT_CABINET_REVIEWS_MONTH_1'),
				Loc::getMessage('KIT_CABINET_REVIEWS_MONTH_2'),
				Loc::getMessage('KIT_CABINET_REVIEWS_MONTH_3'),
				Loc::getMessage('KIT_CABINET_REVIEWS_MONTH_4'),
				Loc::getMessage('KIT_CABINET_REVIEWS_MONTH_5'),
				Loc::getMessage('KIT_CABINET_REVIEWS_MONTH_6'),
				Loc::getMessage('KIT_CABINET_REVIEWS_MONTH_7'),
				Loc::getMessage('KIT_CABINET_REVIEWS_MONTH_8'),
				Loc::getMessage('KIT_CABINET_REVIEWS_MONTH_9'),
				Loc::getMessage('KIT_CABINET_REVIEWS_MONTH_10'),
				Loc::getMessage('KIT_CABINET_REVIEWS_MONTH_11'),
				Loc::getMessage('KIT_CABINET_REVIEWS_MONTH_12'),
			), $date
		);
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
	public function getText()
	{
		return $this->text;
	}

	/**
	 * @param string $text
	 */
	public function setText($text)
	{
		$this->text = $text;
	}

	/**
	 * @return int
	 */
	public function getRating()
	{
		return $this->rating;
	}

	/**
	 * @param int $rating
	 */
	public function setRating($rating)
	{
		$this->rating = $rating;
	}

	/**
	 * @return bool
	 */
	public function isModerated()
	{
		return $this->moderated;
	}

	/**
	 * @param bool $moderated
	 */
	public function setModerated($moderated)
	{
		$this->moderated = $moderated;
	}

	/**
	 * @return \Bitrix\Main\Type\DateTime
	 */
	public function getDateCreate($format = "d F Y, H:i")
	{
		return $this->changeLangMonth($this->dateCreate->format($format));
	}

	/**
	 * @param \Bitrix\Main\Type\DateTime $dateCreate
	 */
	public function setDateCreate($dateCreate)
	{
		$this->dateCreate = $dateCreate;
	}
}