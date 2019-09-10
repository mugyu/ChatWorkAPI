<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/IteratorAggregate.php';
require_once __DIR__.'/Contact.php';

class Contacts extends IteratorAggregate
{
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
