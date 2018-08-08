<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Account.php';

class File
{
	public $file_id;
	public $account;
	public $message_id;
	public $filename;
	public $filesize;
	public $upload_time;

	public function __construct($file)
	{
		$this->file_id     = $file->file_id;
		$this->account     = new Account($file->account);
		$this->message_id  = $file->message_id;
		$this->filename    = $file->filename;
		$this->filesize    = $file->filesize;
		$this->upload_time = $file->upload_time;
	}

	public static function fetch($room_id, $file_id)
	{
		return new self(self::_fetch($room_id, $file_id));
	}

	protected static function _fetch($room_id, $file_id)
	{
		$connection = new Connection();
		$response = $connection->execute(
			'GET',
			'https://api.chatwork.com/v2/rooms/'.$room_id.'/files/'.$file_id
		);
		return json_decode($response['body']);
	}
}
