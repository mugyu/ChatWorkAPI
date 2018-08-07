<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/MyTasks.php';

class My
{
	protected $connection;

	function __construct()
	{
		$this->connection = new \ChatWorkAPI\Connection();
	}

	public function status()
	{
		$response = $this->connection->execute(
			'GET',
			'https://api.chatwork.com/v2/my/status'
		);
		return json_decode($response['body']);
	}

	public function tasks($options = [])
	{
		$myTaskFetcher = new MyTasks($options);
		return new Tasks($myTaskFetcher);
	}
}
