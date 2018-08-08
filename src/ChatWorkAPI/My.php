<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Status.php';
require_once __DIR__.'/Tasks.php';
require_once __DIR__.'/MyTasks.php';
require_once __DIR__.'/Me.php';

class My
{
	protected $connection;

	function __construct()
	{
		$this->connection = new \ChatWorkAPI\Connection();
	}

	public function status()
	{
		return new Status();
	}

	public function tasks($options = [])
	{
		return new Tasks(new MyTasks($options));
	}

	public function room()
	{
		return (new Me())->room();
	}
}
