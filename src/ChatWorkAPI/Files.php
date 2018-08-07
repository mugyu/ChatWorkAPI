<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/File.php';

class Files implements \Iterator
{
	protected $room_id;
	protected $account_id;
	protected $files = NULL;
	protected $connection;
	protected $key;
	protected $size;
	function __construct($room_id, $account_id = NULL)
	{
		$this->room_id = $room_id;
		$this->account_id = $account_id;
		$this->connection = new Connection();
	}

	public function current()
	{
		return new File($this->files[$this->key]);
	}

	public function key()
	{
		return $this->key;
	}

	public function next()
	{
		++$this->key;
	}

	public function rewind()
	{
		if ($this->files === NULL)
		{
			$this->fetch();
		}
		$this->key = 0;
	}

	public function valid()
	{
		return $this->key < $this->size;
	}

	protected function fetch()
	{
		$find_by_account_id = '';
		if ($this->account_id)
		{
			$find_by_account_id = '?account_id='.$this->account_id;
		}
		$response = $this->connection->execute(
			'GET',
			'https://api.chatwork.com/v2/rooms/'.$this->room_id.'/files'.$find_by_account_id
		);
		$files = json_decode($response['body']);
		$this->files = $files ?: [];
		$this->size = count($this->files);
	}
}
