<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Room.php';

class Contact
{
	public $account_id;
	public $room_id;
	public $name;
	public $chatwork_id;
	public $organization_id;
	public $organization_name;
	public $department;
	public $avatar_image_url;

	protected $room = NULL;

	public function __construct($contact)
	{
		$this->account_id        = $contact->account_id;
		$this->room_id           = $contact->room_id;
		$this->name              = $contact->name;
		$this->chatwork_id       = $contact->chatwork_id;
		$this->organization_id   = $contact->organization_id;
		$this->organization_name = $contact->organization_name;
		$this->department        = $contact->department;
		$this->avatar_image_url  = $contact->avatar_image_url;
	}

	public function room()
	{
		if (is_null($this->room))
		{
			$this->room = new Room($this->room_id);
		}
		return $this->room;
	}
}
