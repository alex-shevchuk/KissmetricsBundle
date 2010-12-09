<?php

namespace Bundle\KissmetricsBundle;

use Bundle\KissmetricsBundle\Queue;

class Tracker {

	protected $queue;
	protected $config;

	public function __construct(array $config = array()) {
		$this->config = $config;
	}

	public function setApiKey($apiKey) {
		$this->config['apiKey'] = $apiKey;
	}

	public function getApiKey() {
		if (array_key_exists('apiKey', $this->config)) {
			return $this->config['apiKey'];
		}
	}

	public function setQueue($queue) {
		$this->queue = $queue;
	}

	public function getQueue() {
		return $this->queue;
	}

	public function pushQueue(Item $item) {
		$this->queue[] = $item;
	}

	public function hasItem(Queue\Item $item) {
		return in_array($item, $this->queue, true);
	}

	public function addItem(Queue\Item $item) {
		$this->queue[] = $item;
	}

	public function addIdentify($name) {
		$item = new Queue\Item();
		$item->setKey(Queue\Item::IDENTIFY_KEY);
		$item->setName($name);
		$this->addItem($item);
	}

	public function addRecord($name, $properties = null) {
		$item = new Queue\Item();
		$item->setKey(Queue\Item::RECORD_KEY);
		$item->setName($name);
		if ($properties) {
			$item->setProperties($properties);
		}
		$this->addItem($item);
	}

	public function addSet($properties) {
		$item = new Queue\Item();
		$item->setKey(Queue\Item::SET_KEY);
		$item->setProperties($properties);
		$this->addItem($item);
	}

	public function addAlias($identity, $associate) {
		$item = new Queue\Item();
		$item->setKey(Queue\Item::ALIAS_KEY);
		$item->setName($identity);
		$item->setProperties($associate);
		$this->addItem($item);
	}

}
