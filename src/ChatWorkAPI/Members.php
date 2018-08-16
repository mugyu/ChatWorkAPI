<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Member.php';

class Members implements \IteratorAggregate
{
	protected $room_id;
	function __construct($room_id)
	{
		$this->room_id = $room_id;
	}

	public function getIterator()
	{
		static $iterator = NULL;
		if ( ! $iterator)
		{
			$iterator =  new \ArrayIterator($this->fetch());
		}
		return $iterator;
	}

	protected function fetch()
	{
		$connection = new Connection();
		$response = $connection->execute(
			'GET',
			'https://api.chatwork.com/v2/rooms/'.$this->room_id.'/members'
		);
		$members = [];
		foreach(json_decode($response['body']) ?: [] as $member)
		{
			$members[$member->account_id] = new Member($member);
		}
		return $members;
	}
}
