<?php

namespace Bundle\KissmetricsBundle\Queue;

class Item {

	const IDENTIFY_KEY = 'identity';
	const RECORD_KEY   = 'record';
	const SET_KEY      = 'set';
	const ALIAS_KEY    = 'alias';

	protected $key;
	protected $name;
	protected $properties;

	public function setKey($key) {
		$this->key = (string) $key;
	}

	public function getKey() {
		return $this->key;
	}

	public function setName($name) {
		$this->name = (string) $name;
	}

	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed
	 */
	public function setProperties($properties) {
		$this->properties = $properties;
	}

	public function getProperies($properties) {
		return $this->properties;
	}

}
