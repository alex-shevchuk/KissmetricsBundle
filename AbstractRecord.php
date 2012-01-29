<?php

namespace Tirna\KissmetricsBundle;

abstract class AbstractRecord implements RecordInterface {

	protected $properties;

	public function setProperties($properties) {
		$this->properties = $properties;
	}

	public function getProperties() {
		return $this->properties;
	}

}
