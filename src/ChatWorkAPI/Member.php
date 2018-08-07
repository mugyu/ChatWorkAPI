<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Account.php';

class Member
{
	public $account_id;
	public $role;
	public $name;
	public $chatwork_id;
	public $organization_id;
	public $organization_name;
	public $department;
	public $avatar_image_url;

	public function __construct($member)
	{
		$this->account_id        = $member->account_id;
		$this->role              = $member->role;
		$this->name              = $member->name;
		$this->chatwork_id       = $member->chatwork_id;
		$this->organization_id   = $member->organization_id;
		$this->organization_name = $member->organization_name;
		$this->department        = $member->department;
		$this->avatar_image_url  = $member->avatar_image_url;
	}
}
