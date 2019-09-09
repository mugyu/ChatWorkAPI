<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/File.php';

class Files implements \IteratorAggregate
{
	protected $room_id;
	protected $account_id;
	protected $iterator = NULL;

	function __construct($room_id, $account_id = NULL)
	{
		$this->room_id = $room_id;
		$this->account_id = $account_id;
	}

	public function getIterator()
	{
		if ($this->iterator === NULL)
		{
			$this->iterator =  new \ArrayIterator($this->fetch());
		}
		return $this->iterator;
	}

	protected function fetch()
	{
		$find_by_account_id = '';
		if ($this->account_id)
		{
			$find_by_account_id = '?account_id='.$this->account_id;
		}
		$connection = new Connection();
		$response = $connection->execute(
			'GET',
			'https://api.chatwork.com/v2/rooms/'.$this->room_id.'/files'.$find_by_account_id
		);
		$files = [];
		foreach(json_decode($response['body']) ?: [] as $file)
		{
			$files[$file->file_id] = new File($file);
		}
		return $files;
	}
}
