<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Account.php';
require_once __DIR__.'/Room.php';

class Me
{
	protected static $_properties = [
		'account_id',
		'room_id',
		'name',
		'chatwork_id',
		'organization_id',
		'organization_name',
		'department',
		'title',
		'url',
		'introduction',
		'mail',
		'tel_organization',
		'tel_extension',
		'tel_mobile',
		'skype',
		'facebook',
		'twitter',
		'avatar_image_url',
		'login_mail',
	];

	protected $room;

	public function room()
	{
		if (is_null($this->room))
		{
			$this->room = new Room($this->room_id);
		}
		return $this->room;
	}

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
		$me = self::_fetch();
		return self::inject($room);
	}

	protected static function _fetch()
	{
		$connection = new Connection();
		$response = $connection->execute(
			'GET',
			'https://api.chatwork.com/v2/me'
		);
		return json_decode($response['body']);
	}
}
