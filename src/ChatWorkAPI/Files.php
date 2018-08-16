<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/File.php';

class Files implements \IteratorAggregate
{
	protected $room_id;
	protected $account_id;
	function __construct($room_id, $account_id = NULL)
	{
		$this->room_id = $room_id;
		$this->account_id = $account_id;
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
