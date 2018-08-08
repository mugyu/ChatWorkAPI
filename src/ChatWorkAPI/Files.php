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
	protected $index;
	protected $size;
	function __construct($room_id, $account_id = NULL)
	{
		$this->room_id = $room_id;
		$this->account_id = $account_id;
		$this->connection = new Connection();
	}

	public function current()
	{
		return $this->files[$this->index];
	}

	public function key()
	{
		return $this->files[$this->index]->file_id;
	}

	public function next()
	{
		++$this->index;
	}

	public function rewind()
	{
		if ($this->files === NULL)
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
		$this->files = [];
		foreach($files ?: [] as $file)
		{
			$this->files[] = new File($file);
		}
		$this->size = count($this->files);
	}
}
