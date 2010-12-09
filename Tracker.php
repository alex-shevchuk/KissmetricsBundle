<?php

namespace Bundle\KissmetricsBundle;

use Bundle\KissmetricsBundle\Queue;

class Tracker {

	protected $queue = array();
	protected $config = array();

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

	public function setConfig(array $config = array()) {
		$this->config = $config;
	}

	public function getConfig() {
		return $this->config;
	}

	public function setQueue($queue) {
		$this->queue = $queue;
	}

	public function getQueue() {
		return $this->queue;
	}

	public function hasItem(Queue\Item $item) {
		return in_array($item, $this->queue, true);
	}

	public function addItem(Queue\Item $item) {
		$this->queue[] = $item;
	}

	public function removeItem(Queue\Item $item) {
		if (!$this->hasItem($item)) {
			return null;
		}
		unset($this->queue[array_search($item, $this->queue, true)]);
		return $item;
	}

	public function addIdentify($name) {
		$item = new Queue\Item();
		$item->setKey(Queue\Item::IDENTIFY_KEY);
		$item->setName($name);
		$this->addItem($item);
		return $item;
	}

	public function addRecord($name, $properties = null) {
		$item = new Queue\Item();
		$item->setKey(Queue\Item::RECORD_KEY);
		$item->setName($name);
		if ($properties) {
			$item->setProperties($properties);
		}
		$this->addItem($item);
		return $item;
	}

	public function addSet($properties) {
		$item = new Queue\Item();
		$item->setKey(Queue\Item::SET_KEY);
		$item->setProperties($properties);
		$this->addItem($item);
		return $item;
	}

	public function addAlias($identity, $associate) {
		$item = new Queue\Item();
		$item->setKey(Queue\Item::ALIAS_KEY);
		$item->setName($identity);
		$item->setProperties($associate);
		$this->addItem($item);
		return $item;
	}

}
