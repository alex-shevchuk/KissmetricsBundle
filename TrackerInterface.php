<?php

namespace Bundle\KissmetricsBundle;

use Bundle\KissmetricsBundle\Queue;

interface TrackerInterface {

	public function setApiKey($apiKey);
	public function getApiKey();
	public function setConfig(array $config = array());
	public function getConfig();
	public function hasQueue();
	public function setQueue($queue);
	public function getQueue();
	public function hasItem(Queue\Item $item);
	public function addItem(Queue\Item $item);
	public function removeItem(Queue\Item $item);
	public function addIdentify($name);
	public function addRecord($name, $properties = null);
	public function addSet($properties);
	public function addAlias($identity, $associate);

}
