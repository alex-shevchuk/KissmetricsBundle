<?php

namespace Tirna\KissmetricsBundle\Queue;

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

	public function toJson() {
		$record = array();
		$record[] = $this->getKey();
		if (self::SET != $this->getKey()) {
			$record[] = $this->getName();
		}
		if ($properties = $this->getProperties()) {
			if (is_array($properties)) {
				foreach ($properties as $key => $property) {
					if (is_array($property)) {
						foreach($property as $instance) {
							if (is_object($instance)) {
								$properties[$key] = array_map(function($item){
									return $item->toArray();
								}, $properties[$key]);
							}
						}
					}
				}
			}
			$record[] = $properties;
		}
		return json_encode($record);
	}

}
