<?php

namespace Bundle\KissmetricsBundle\Helper\WebTrackerHelper;

use Bundle\KissmetricsBundle\Helper\WebTrackerHelper;
use Bundle\KissmetricsBundle\Queue\Item;
use Bundle\KissmetricsBundle\TrackerInterface;

class SessionTrackerHelper extends WebTrackerHelper {

	public function getName() {
		return 'kissmetrics_sessiontracker';
	}

}
