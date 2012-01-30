<?php

namespace Tirna\KissmetricsBundle\Tracker\WebTracker;

use Symfony\Component\DependencyInjection\Container;

use Symfony\Component\HttpFoundation\Session;
use Tirna\KissmetricsBundle\Tracker\WebTracker;
use Tirna\KissmetricsBundle\Queue;

class SessionTracker extends WebTracker {

	protected $config = array(
		'trackAnonymous' => true,
		'trackDefaultView' => true
	);
	
	/**
	 * @var \Symfony\Component\HttpFoundation\Session
	 */
	protected $session;

	public function __construct(array $config = array(), Container $container, Session $session) {
		$this->config = array_merge($this->config, $config);
		$this->request = $container->get('request');
		$this->session = $session;
	}

	public function setTrackAnonymous($track = true) {
		$this->config['trackAnonymous'] = $track;
	}

	public function getTrackAnonymous() {
		return $this->config['trackAnonymous'];
	}

	public function checkAnonymous() {
		if ($this->getTrackAnonymous() && !is_null($this->session->getId())) {
			$this->addIdentify($this->session->getId());
		}
	}

}
