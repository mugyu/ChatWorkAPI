<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Contact.php';

class Contacts implements \Iterator
{
	protected $contacts = NULL;
	protected $connection;
	protected $index;
	protected $size;
	function __construct()
	{
		$this->connection = new Connection();
	}

	public function current()
	{
		return $this->contacts[$this->index];
	}

	public function key()
	{
		return $this->contacts[$this->index]->account_id;
	}

	public function next()
	{
		++$this->index;
	}

	public function rewind()
	{
		if ($this->contacts === NULL)
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
			'https://api.chatwork.com/v2/contacts'
		);
		$contacts = json_decode($response['body']);
		$this->contacts = [];
		foreach($contacts ?: [] as $contact)
		{
			$this->contacts[] = new Contact($contact);
		}
		$this->size = count($this->contacts);
	}
}
