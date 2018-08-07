<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Tasks.php';
require_once __DIR__.'/Task.php';

class MyTasks extends Tasks
{
	protected $params = [];
	protected $connection;

	public function __construct($options = [])
	{
		if (isset($options['assigned_by_account_id']))
		{
			$this->params['assigned_by_account_id'] = $options['assigned_by_account_id'];
		}
		if (isset($options['status']))
		{
			$this->params['status'] = $options['status'];
		}
		$this->connection = new Connection();
	}

	public function fetch()
	{
		$param_string = '';
		$params = [];
		foreach($this->params as $name => $value)
		{
			$params[] = $name.'='.$value;
		}
		if ($params) {
			$param_string = '?'.implode('&', $params);
		}
		$response = $this->connection->execute(
			'GET',
			'https://api.chatwork.com/v2/my/tasks'.$param_string
		);
		$tasks = json_decode($response['body']);
		return $tasks ?: [];
	}
}
