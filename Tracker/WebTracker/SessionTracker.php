<?php

namespace Tirna\KissmetricsBundle\Tracker\WebTracker;

use Symfony\Component\HttpFoundation\Request;

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
	
	/**
	 * Username string, if a user is logged in (i.e. security context token is available).
	 * @var string
	 */
	protected $user;

	public function __construct(array $config = array(), Container $container, Session $session) {
		$this->config = array_merge($this->config, $config);
        try {
            $this->request = $container->get('request');
        } catch (\Symfony\Component\DependencyInjection\Exception\InactiveScopeException $e) {
            // we should only get this exception when running on command line; we can safely ignore it in this case
        }
		$this->session = $session;
		if (!is_null($container->get('security.context')->getToken())) {
		    $this->user = $container->get('security.context')->getToken()->getUsername();
		}
	}

	public function setTrackAnonymous($track = true) {
		$this->config['trackAnonymous'] = $track;
	}

	public function getTrackAnonymous() {
		return $this->config['trackAnonymous'];
	}

	public function checkAnonymous() {
		if ($this->getTrackAnonymous() && is_null($this->getIdentifier()) && !is_null($this->session->getId())) {
			$this->addIdentify($this->session->getId());
		}
	}
	
	/**
	 * Adds an alias for non-anonymous users.
	 */
	public function checkSignedIn() {
	    if (!empty($this->user) && $this->user !== 'anon.') {
	        $this->addAlias($this->getIdentifier(), $this->user);
	    }
	}

}
