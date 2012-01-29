<?php

namespace Tirna\KissmetricsBundle;

use Symfony\Component\HttpFoundation\Request;
use Tirna\KissmetricsBundle\Queue;

abstract class AbstractTracker implements TrackerInterface {

	protected $identifier;
	protected $queue = array();
	protected $config = array();

	public function __construct(array $config = array()) {
		$this->config = array_merge($this->config, $config);
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

	public function getIdentifier() {
		return $this->identifier;
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

	public function hasQueue() {
		if (!empty($this->queue)) {
			return true;
		}
		return false;
	}

	public function setQueue($queue) {
		$this->queue = $queue;
	}

	public function getQueue() {
		return $this->queue;
	}

	public function addIdentify($name) {
		$item = new Queue\Item();
		$item->setKey(Queue\Item::IDENTIFY);
		$this->identifier = $name;
		$item->setName($name);
		$this->addItem($item);
		return $item;
	}

	public function addRecord($name, $properties = null) {
		$item = new Queue\Item();
		$item->setKey(Queue\Item::RECORD);
		$item->setName($name);
		if ($properties) {
			$item->setProperties($properties);
		}
		$this->addItem($item);
		return $item;
	}

	public function addSet($properties) {
		$item = new Queue\Item();
		$item->setKey(Queue\Item::SET);
		$item->setProperties($properties);
		$this->addItem($item);
		return $item;
	}

	public function addAlias($identity, $associate) {
		$item = new Queue\Item();
		$item->setKey(Queue\Item::ALIAS);
		$item->setName($identity);
		$item->setProperties($associate);
		$this->addItem($item);
		return $item;
	}

}
