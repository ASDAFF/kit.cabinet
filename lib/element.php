<?php

namespace Kit\Cabinet;

/**
 * Class Element
 * @package Kit\Cabinet
 *
 */
class Element
{
	protected $id = 0;
	protected $name = '';
	protected $url = '';
	protected $img = array();
	public function __construct()
	{

	}

	/**
	 * @param int $num
	 * @param array $words
	 * @return string
	 */
	public static function num2word($num = 1, $words = array())
	{
		$num = $num % 100;
		if ($num > 19)
		{
			$num = $num % 10;
		}
		switch ($num)
		{
			case 1:
			{
				return($words[0]);
			}
			case 2: case 3: case 4:
			{
				return($words[1]);
			}
			default:
			{
				return($words[2]);
			}
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
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @param string $url
	 */
	public function setUrl($url)
	{
		$this->url = $url;
	}

	/**
	 * @return array
	 */
	public function getImg()
	{
		return $this->img;
	}

	/**
	 * @param array $img
	 */
	public function setImg($img)
	{
		$this->img = $img;
	}
}