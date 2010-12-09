<?php

namespace Bundle\KissmetricsBundle\Tests;

use Bundle\KissmetricsBundle\Tracker;
use Bundle\KissmetricsBundle\Queue\Item;

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

	public function testSetGetQueue() {
		$val = array('1', 2, '3');
		$this->tracker->setQueue($val);
		$this->assertEquals($val, $this->tracker->getQueue());
	}

	public function testAddItem() {
		$item = new Item();
		$this->assertFalse($this->tracker->hasItem($item));
		$this->tracker->addItem($item);
		$this->assertTrue($this->tracker->hasItem($item));
		$this->tracker->removeItem($item);
		$this->assertFalse($this->tracker->hasItem($item));
	}

}
