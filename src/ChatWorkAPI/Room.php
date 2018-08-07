<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Messages.php';
require_once __DIR__.'/Members.php';
require_once __DIR__.'/RoomTasks.php';
require_once __DIR__.'/Files.php';

class Room
{
	protected static $_properties = [
		'name',
		'type',
		'role',
		'sticky',
		'unread_num',
		'mention_num',
		'mytask_num',
		'message_num',
		'file_num',
		'task_num',
		'icon_path',
		'last_update_time',
		'description',
	];

	public $room_id;
	protected $_messages = NULL;
	protected $_members = NULL;
	protected $_tasks = NULL;
	protected $_files = NULL;

	public function __construct($room_id)
	{
		$this->room_id = $room_id;
	}

	public function messages($force = FALSE)
	{
		if (is_null($this->_messages))
		{
			$this->_messages = new Messages($this->room_id, $force);
		}
		return $this->_messages;
	}

	public function message($message_id)
	{
		return Message::fetch($this->room_id, $message_id);
	}

	public function members()
	{
		if (is_null($this->_members))
		{
			$this->_members = new Members($this->room_id);
		}
		return $this->_members;
	}

	public function tasks($options = [])
	{
		if (is_null($this->_tasks))
		{
			$roomTaskFetcher = new RoomTasks($this->room_id, $options);
			$this->_tasks = new Tasks($roomTaskFetcher);
		}
		return $this->_tasks;
	}

	public function task($task_id)
	{
		return Task::fetch($this->room_id, $task_id);
	}

	public function files($account_id = NULL)
	{
		if (is_null($this->_files))
		{
			$this->_files = new Files($this->room_id, $account_id);
		}
		return $this->_files;
	}

	public function file($file_id)
	{
		return File::fetch($this->room_id, $file_id);
	}

	public function __get($name)
	{
		if (in_array($name, self::$_properties))
		{
			$room = self::_fetch($this->room_id);
			$this->_inject($room);
		}
		return $this->$name;
	}

	public static function inject($room)
	{
		$object = new self($room->room_id);
		$object->_inject($room);
		return $object;
	}

	public function _inject($room)
	{
		foreach(self::$_properties as $name)
		{
			if (property_exists($room, $name))
			{
				$this->$name = $room->$name;
			}
		}
	}

	public static function fetch($room_id) {
		$room = self::_fetch($room_id);
		return self::inject($room);
	}

	protected static function _fetch($room_id)
	{
		$connection = new Connection();
		$response = $connection->execute(
			'GET',
			'https://api.chatwork.com/v2/rooms/'.$room_id
		);
		return json_decode($response['body']);
	}
}
