<?php

namespace Kit\Cabinet\Personal;


class Buyer
{
	protected $id = 0;
	protected $name = '';
	protected $org = '';
	public function __construct($buyer = array())
	{
		if($buyer['ID'])
		{
			$this->id = $buyer['ID'];
		}
		if($buyer['NAME'])
		{
			$this->name = $buyer['NAME'];
		}
	}

	/**
	 * @param $rule
	 */
	public function genEditUrl($rule = '')
	{
		return str_replace('#ID#', $this->id, $rule);
	}

	/**
	 * @param $rule
	 */
	public function genDelUrl($rule = '')
	{

		return str_replace('#ID#', $this->id, $rule);
	}

	/**
	 * @return int|mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return mixed|string
	 */
	public function getName()
	{
		return $this->name;
	}

	public function delete($idUser = 0)
	{
		$dbUserProps = \CSaleOrderUserProps::GetList(
				array(),
				array(
						"ID" => $this->id,
						"USER_ID" => $idUser
				)
				);
		if ($arUserProps = $dbUserProps->Fetch())
		{
			if (!\CSaleOrderUserProps::Delete($arUserProps["ID"]))
			{

			}
		}
	}

	/**
	 * @param int|mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @param mixed|string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}
	/**
	 * @return string
	 */
	public function getOrg()
	{
		return $this->org;
	}

	/**
	 * @param string $org
	 */
	public function setOrg($org)
	{
		$this->org = $org;
	}

}