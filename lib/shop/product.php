<?php

namespace Kit\Cabinet\Shop;


class Product
{
	protected $id = 0;
	protected $name = '';
	protected $url = '';
	protected $img = array();
	public function __construct()
	{

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