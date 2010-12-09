<?php

namespace Bundle\KissmetricsBundle\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Bundle\KissmetricsBundle\Queue\Item;
use Bundle\KissmetricsBundle\Tracker\WebTracker;

class WebTrackerHelper extends Helper {

	const KMQ = '_kmq';

	protected $tracker;

	public function __construct(WebTracker $tracker) {
		$this->tracker = $tracker;
	}

	public function getApiKey() {
		return $this->tracker->getApiKey();
	}

	public function hasQueue() {
		return $this->tracker->hasQueue();
	}

	public function getQueue() {
		return $this->tracker->getQueue();
	}

	public function render(Item $item) {
		$out = static::KMQ.".push(['".$item->getKey()."'";

		if (Item::SET != $item->getKey()) {
			$out .= ", '".$item->getName()."'";
		}
		if ($item->getProperties()) {
			$out .= ", ".json_encode($item->getProperties(), \JSON_FORCE_OBJECT);
		}

		$out .= "]);";
		return $out;
	}

	static public function getKmq() {
		return static::KMQ;
	}

	public function getName() {
		return 'kissmetrics_webtracker';
	}

}
