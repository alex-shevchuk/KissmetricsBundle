<?php

namespace Tirna\KissmetricsBundle\Record;

use Tirna\KissmetricsBundle\AbstractRecord;

class Page extends AbstractRecord {

 	const RECORD_NAME = 'Viewed page';

	protected $properties = array();	

	public function setHost($host) {
		$this->properties['host'] = (string) $host;
	}

	public function getHost() {
		if (array_key_exists('host', $this->properties)) {
			return $this->properties['host'];
		}
	}

	public function getName() {
		return self::RECORD_NAME;
	}

	public function setPath($path) {
		$this->properties['path'] = (string) $path;
	}

	public function getPath() {
		if (array_key_exists('path', $this->properties)) {
			return $this->properties['path'];
		}
	}

	public function setReferrer($referrer) {
		$this->properties['referrer'] = (string) $referrer;
	}

	public function getReferrer() {
		if (array_key_exists('referrer', $this->properties)) {
			return $this->properties['referrer'];
		}
	}

	public function setUri($uri) {
		$this->properties['uri'] = (string) $uri;
	}

	public function getUri() {
		if (array_key_exists('uri', $this->properties)) {
			return $this->properties['uri'];
		}
	}

}
