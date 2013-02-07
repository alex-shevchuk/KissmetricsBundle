<?php

namespace Tirna\KissmetricsBundle\Tracker\WebTracker;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\DependencyInjection\Container;

use Symfony\Component\HttpFoundation\Session\Session;
use Tirna\KissmetricsBundle\Tracker\WebTracker;
use Tirna\KissmetricsBundle\Queue;

use Symfony\Component\Security\Core\SecurityContext;

class SessionTracker extends WebTracker {

	protected $config = array(
		'trackAnonymous' => true,
		'trackDefaultView' => true
	);
	
	/**
	 * @var \Symfony\Component\HttpFoundation\Session\Session
	 */
	protected $session;
    private $inited = false;
	
	/**
	 * Username string, if a user is logged in (i.e. security context token is available).
	 * @var string
	 */
	protected $user;

	public function __construct(array $config = array(), Container $container, Session $session, SecurityContext $securityContext) {
		$this->config = array_merge($this->config, $config);
        $this->securityContext = $securityContext;
        try {
            $this->request = $container->get('request');
        } catch (\Symfony\Component\DependencyInjection\Exception\InactiveScopeException $e) {
            // we should only get this exception when running on command line; we can safely ignore it in this case
        }
		$this->session = $session;
        if (!is_null($securityContext->getToken())) {
            $this->user = $securityContext->getToken()->getUsername();
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

    public function addRecords($name, $properties = null) {
        $this->_init();
        return $this->addRecord($name, $properties);
    }

    public function addSets($properties) {
        $this->_init();
        return $this->addSet($properties);
    }

    public function addAliases($identity, $associate) {
        $this->_init();
        return $this->addAlias($identity, $associate);
    }

    private function _init() {
        if (!$this->inited) {
            $this->inited = true;
            $this->init();
        }
    }

    public function init() {
        if (!is_null($this->securityContext->getToken())) {
            $this->user = $this->securityContext->getToken()->getUsername();
        }
        $this->checkAnonymous();
        $this->checkTrackDefaultView();
        $this->checkSignedIn();
    }

}
