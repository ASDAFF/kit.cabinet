<?php
namespace Kit\Cabinet;

use \Bitrix\Main\SystemException;

class Collection
{
	public function addItem($obj, $key = null)
	{
		if( $key == null )
		{
			$this->items[] = $obj;
		}
		else
		{
			if( isset( $this->items[$key] ) )
			{
				throw new SystemException( "Key $key already in use." );
			}
			else
			{
				$this->items[$key] = $obj;
			}
		}
	}
	public function updateItem($obj, $key)
	{
		if( isset( $this->items[$key] ) )
		{
			$this->items[$key] = $obj;
		}
		else
		{
			throw new SystemException( "Invalid key $key." );
		}
	}
	public function deleteItem($key)
	{
		if( isset( $this->items[$key] ) )
		{
			unset($this->items[$key]);
		}
		else
		{
			throw new SystemException( "Invalid key $key." );
		}
	}
	public function getItem($key)
	{
		if( isset( $this->items[$key] ) )
		{
			return $this->items[$key];
		}
		else
		{
			throw new SystemException( "Invalid key $key." );
		}
	}
	public function getItems()
	{
		return $this->items;
	}
	public function keys()
	{
		return array_keys( $this->items );
	}
	public function length()
	{
		return count( $this->items );
	}
	public function keyExists($key)
	{
		return isset( $this->items[$key] );
	}
}
?>