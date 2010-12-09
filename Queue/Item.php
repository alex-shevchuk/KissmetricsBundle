<?php

namespace Bundle\KissmetricsBundle\Queue;

class Item {

	const IDENTIFY = 'identify';
	const RECORD   = 'record';
	const SET      = 'set';
	const ALIAS    = 'alias';

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

	public function getProperties() {
		return $this->properties;
	}

}
