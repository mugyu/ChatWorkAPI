<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Member.php';

class Members implements \Iterator
{
	protected $room_id;
	protected $members = NULL;
	protected $connection;
	protected $index;
	protected $size;
	function __construct($room_id)
	{
		$this->room_id = $room_id;
		$this->connection = new Connection();
	}

	public function current()
	{
		return $this->members[$this->index];
	}

	public function key()
	{
		return $this->members[$this->index]->account_id;
	}

	public function next()
	{
		++$this->index;
	}

	public function rewind()
	{
		if ($this->members === NULL)
		{
			$this->fetch();
		}
		$this->index = 0;
	}

	public function valid()
	{
		return $this->index < $this->size;
	}

	protected function fetch()
	{
		$response = $this->connection->execute(
			'GET',
			'https://api.chatwork.com/v2/rooms/'.$this->room_id.'/members'
		);
		$members = json_decode($response['body']);
		$this->members = [];
		foreach($members ?: [] as $member)
		{
			$this->members[] = new Member($member);
		}
		$this->size = count($this->members);
	}
}
