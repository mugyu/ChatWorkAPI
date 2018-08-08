<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';

class Status
{
	protected static $_properties = [
		'unread_room_num',
		'mention_room_num',
		'mytask_room_num',
		'unread_num',
		'mention_num',
		'mytask_num',
	];

	public function __get($name)
	{
		if (in_array($name, self::$_properties))
		{
			$this->_inject(self::_fetch());
		}
		return $this->$name;
	}

	public static function inject($data)
	{
		$object = new self();
		$object->_inject($data);
		return $object;
	}

	public function _inject($data)
	{
		foreach(self::$_properties as $name)
		{
			if (property_exists($data, $name))
			{
				$this->$name = $data->$name;
			}
		}
	}

	public static function fetch()
	{
		return self::inject(self::_fetch());
	}

	protected static function _fetch()
	{
		$connection = new Connection();
		$response = $connection->execute(
			'GET',
			'https://api.chatwork.com/v2/my/status'
		);
		return json_decode($response['body']);
	}
}
