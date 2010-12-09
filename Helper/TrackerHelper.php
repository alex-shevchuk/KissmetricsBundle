<?php

namespace Bundle\KissmetricsBundle\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Bundle\KissmetricsBundle\Tracker;

class TrackerHelper extends Helper {

	protected $tracker;

	public function __construct(Tracker $tracker) {
		$this->tracker = $tracker;
	}

	public function getRequestUri() {
		return $this->tracker->getRequestUri();
	}

	public function setWithoutBaseUrl($b = true) {
		return $this->tracker->setWithoutBaseUrl($b);
	}

	public function getName() {
		return 'kissmetrics_tracker';
	}

}
