<?php

namespace Bundle\KissmetricsBundle\Tracker\WebTracker;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use Bundle\KissmetricsBundle\Tracker\WebTracker;
use Bundle\KissmetricsBundle\Queue;

class SessionTracker extends WebTracker {

	protected $config = array(
		'trackAnonymous' => true,
		'trackDefaultView' => true
	);
	protected $session;

	public function __construct(array $config = array(), Request $request, Session $session) {
		$this->config = array_merge($this->config, $config);
		$this->request = $request;
		$this->session = $session;
	}

	public function setTrackAnonymous($track = true) {
		$this->config['trackAnonymous'] = $track;
	}

	public function getTrackAnonymous() {
		return $this->config['trackAnonymous'];
	}

	public function checkAnonymous() {
		if ($this->getTrackAnonymous() && session_id() && '' != session_id()) {
			$name = session_id();
			$this->addIdentify($name);
		}
	}

}
