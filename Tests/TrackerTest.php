<?php

namespace Bundle\KissmetricsBundle\Tests;

use Bundle\KissmetricsBundle\Tracker;

class TrackerTest extends \PHPUnit_Framework_TestCase {

	protected $tracker;

	public function setUp() {
		parent::setup();
		$this->tracker = new Tracker();
	}

	public function tearDown() {
		$this->tracker = null;
		parent::tearDown();
	}

	public function testConstructor() {
		$this->assertEquals(0, count($this->tracker->getQueue()));
		$this->assertEquals(0, count($this->tracker->getConfig()));
		$this->assertNull($this->tracker->getApiKey());
	}

	public function testSetGetConfig() {
		$val = array('1', 2, '3');
		$this->tracker->setConfig($val);
		$this->assertEquals($val, $this->tracker->getConfig());
	}

	public function testSetGetApiKey() {
		$val = "XxXxXx";
		$this->tracker->setApiKey($val);
		$this->assertEquals($val, $this->tracker->getApiKey());
	}

}
