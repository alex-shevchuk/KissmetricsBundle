<?php

namespace Bundle\KissmetricsBundle;

use Symfony\Component\HttpFoundation\Request;

class Tracker {

	protected $config;
	protected $request;
	protected $withoutBaseUrl = TRUE;

	public function __construct(Request $request, array $config = array()) {
		$this->config = $config;
		$this->request = $request;
	}

	public function setApiKey($apiKey) {
		$this->config['apiKey'] = $apiKey;
	}

	public function getApiKey() {
		if (array_key_exists('apiKey', $this->config)) {
			return $this->config['apiKey'];
		}
	}

	public function setRequest(Request $request) {
		$this->request = $request;
	}

	public function getRequest() {
		return $this->request;
	}

	public function getRequestUri() {
		$requestUri = $this->request->getRequestUri();
		if ($this->withoutBaseUrl) {
			$baseUrl = $this->request->getBaseUrl();
			if ($baseUrl != '/') {
				return str_replace($baseUrl, '', $requestUri);
			}
			return $requestUri;
		}
		return $requestUri;
	}

	public function setWithoutBaseUrl($b = true) {
		$this->withoutBaseUrl = (bool) $b;
	}

	public function getWithoutBaseUrl() {
		return $this->withoutBaseUrl;
	}

}
