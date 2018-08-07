<?php
namespace ChatWorkAPI;

class Connection
{
	protected static $chatWorkToken;
	protected $timeout = 30;
	protected $max_redirects = 10;
	protected $curl_options;

	public static function set_token($chatWorkToken)
	{
		self::$chatWorkToken = $chatWorkToken;
	}

	public function __construct($options = [])
	{
		if (isset($options['timeout'])) {
			$this->timeout = $options['timeout'];
		}
		if (isset($options['max_redirects'])) {
			$this->max_redirects = $options['max_redirects'];
		}
		$this->curl_options = [
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => $this->max_redirects,
			CURLOPT_TIMEOUT => $this->timeout,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_HTTPHEADER => [
				'Cache-Control: no-cache',
				'X-ChatWorkToken: '.self::$chatWorkToken
			]
		];
	}

	public function execute($method, $url)
	{
		$options = $this->curl_options;
		$options[CURLOPT_CUSTOMREQUEST] = $method;
		$options[CURLOPT_URL] = $url;

		$curl = curl_init();
		curl_setopt_array($curl, $options);
		$info = curl_getinfo( $curl );
		$info['body'] = curl_exec($curl);
		$info['errorMessage'] = curl_error($curl);
		curl_close($curl);
		return $info;
	}
}
