<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Contact.php';

class Contacts implements \IteratorAggregate
{
	protected $iterator = NULL;

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
		$connection = new Connection();
		$response = $connection->execute(
			'GET',
			'https://api.chatwork.com/v2/contacts'
		);
		$contacts = [];
		foreach(json_decode($response['body']) ?: [] as $contact)
		{
			$contacts[$contact->account_id] = new Contact($contact);
		}
		return $contacts;
	}
}
