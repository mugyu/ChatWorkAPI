<?php
namespace ChatWorkAPI;

class Account
{
	public $account_id;
	public $name;
	public $avatar_image_url;

	public function __construct($account)
	{
		$this->account_id       = $account->account_id;
		$this->name             = $account->name;
		$this->avatar_image_url = $account->avatar_image_url;
	}
}
