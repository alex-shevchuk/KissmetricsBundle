<?php

namespace Bundle\KissmetricsBundle\Tracker;

use Symfony\Component\HttpFoundation\Request;
use Bundle\KissmetricsBundle\AbstractTracker;
use Bundle\KissmetricsBundle\Record\Transaction;
use Bundle\KissmetricsBundle\Queue;

class WebTracker extends AbstractTracker {

	const PAGE = 'page';
	const URI  = 'uri';

	protected $config = array(
		'trackDefaultView' => true
	);
	protected $request;
	protected $transaction;
	protected $withoutBaseUrl = true;

	public function __construct(array $config = array(), Request $request) {
		$this->config = array_merge($this->config, $config);
		$this->request = $request;
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

	public function setTrackDefaultView($track = true) {
		$this->config['trackDefaultView'] = $track;
	}

	public function getTrackDefaultView() {
		return $this->config['trackDefaultView'];
	}

	public function addTransaction(Transaction $transaction) {
		$item = $this->addRecord($transaction->getName(), $transaction->getProperties());
		return $item;
	}

	public function setWithoutBaseUrl($b) {
		$this->withoutBaseUrl = $b;
	}

	public function getWithoutBaseUrl() {
		return $this->withoutBaseUrl;
	}

	public function checkTrackDefaultView() {
		if ($this->getTrackDefaultView()) {
			$name = static::PAGE;
			$properties = array(
				static::URI => $this->getRequestUri()
			);
			$item = $this->addRecord($name, $properties);
			return $item;
		}
	}

}
