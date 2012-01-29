<?php

namespace Tirna\KissmetricsBundle\Tracker;

use Symfony\Component\HttpFoundation\Request;
use Tirna\KissmetricsBundle\AbstractTracker;
use Tirna\KissmetricsBundle\Record\Page;
use Tirna\KissmetricsBundle\Record\Transaction;
use Tirna\KissmetricsBundle\Queue;

class WebTracker extends AbstractTracker {

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

	public function addPage(Page $page) {
		$item = $this->addRecord($page->getName(), $page->getProperties());
		return $item;
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
			$page = new Page();
			$page->setHost($this->getRequest()->getHost());
			$page->setPath($this->getRequestUri());
			$page->setUri($page->getHost().$page->getPath());
			if ($this->getRequest()->server->has('HTTP_REFERER')) {
				$page->setReferrer($this->getRequest()->server->get('HTTP_REFERER'));
			}
			$item = $this->addRecord($page->getName(), $page->getProperties());
			return $item;
		}
	}

}
