<?php

namespace Tirna\KissmetricsBundle\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Tirna\KissmetricsBundle\Queue\Item;
use Tirna\KissmetricsBundle\TrackerInterface;

class WebTrackerHelper extends Helper {

	const KMQ = '_kmq';

	protected $tracker;

	public function __construct(TrackerInterface $tracker) {
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
		return static::KMQ.".push(".$item->toJson().");";
	}

	static public function getKmq() {
		return static::KMQ;
	}

	public function getName() {
		return 'kissmetrics_webtracker';
	}

}
