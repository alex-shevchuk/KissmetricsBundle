<?php

namespace Bundle\KissmetricsBundle\Tests\Tracker;

use Bundle\KissmetricsBundle\Tracker\WebTracker;
use Bundle\KissmetricsBundle\Record\Transaction;
use Bundle\KissmetricsBundle\Queue\Item;

class WebTrackerTest extends \PHPUnit_Framework_TestCase {

	protected $request;
	protected $tracker;

	public function setUp() {
		parent::setup();
		$this->request = $this->getRequestMock();
		$this->tracker = new WebTracker(array(), $this->request);
	}

	public function tearDown() {
		$this->tracker = null;
		$this->request = null;
		parent::tearDown();
	}

	public function testConstructor() {
		$this->assertEquals(0, count($this->tracker->getQueue()));
		$this->assertEquals(1, count($this->tracker->getConfig()));
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

	public function testSetGetTrackDefaultView() {
		$val = true;
		$this->tracker->setTrackDefaultView($val);
		$this->assertTrue($this->tracker->getTrackDefaultView());
		$val = false;
		$this->tracker->setTrackDefaultView($val);
		$this->assertFalse($this->tracker->getTrackDefaultView());
	}

	public function testSetGetQueue() {
		$val = array('1', 2, '3');
		$this->tracker->setQueue($val);
		$this->assertEquals($val, $this->tracker->getQueue());
	}

	public function testAddTransaction() {
		$val = new Transaction();
		$properties = array('1', '2', '3');
		$val->setProperties($properties);
		$item = $this->tracker->addTransaction($val);
		$this->assertEquals(Transaction::RECORD_NAME, $item->getName());
		$this->assertEquals($properties, $item2->getProperties());
		$this->assertTrue($this->tracker->hasItem($item));
	}


	public function testAddIdentify() {
		$name = 'Identify';
		$item = $this->tracker->addIdentify($name);
		$this->assertEquals(Item::IDENTIFY, $item->getKey());
		$this->assertEquals($name, $item->getName());
		$this->assertNull($item->getProperties());
		$this->assertTrue($this->tracker->hasItem($item));
	}

	public function testAddRecord() {
		$name = 'Record';
		$item = $this->tracker->addRecord($name);
		$this->assertEquals(Item::RECORD, $item->getKey());
		$this->assertEquals($name, $item->getName());
		$this->assertNull($item->getProperties());
		$this->assertTrue($this->tracker->hasItem($item));

		$name2 = 'Record2';
		$prop2 = array('some', 2, '45');
		$item2 = $this->tracker->addRecord($name2, $prop2);
		$this->assertEquals(Item::RECORD, $item2->getKey());
		$this->assertEquals($name2, $item2->getName());
		$this->assertEquals($prop2, $item2->getProperties());
		$this->assertTrue($this->tracker->hasItem($item2));
	}

	public function testAddSet() {
		$properties = array('something', 'other thing');
		$item = $this->tracker->addSet($properties);
		$this->assertEquals(Item::SET, $item->getKey());
		$this->assertEquals($properties, $item->getProperties());
		$this->assertNull($item->getName());
		$this->assertTrue($this->tracker->hasItem($item));
	}

	public function testAddAlias() {
		$identity = 'anonymous';
		$associate = 'xxxxxx';
		$item = $this->tracker->addAlias($identity, $associate);
		$this->assertEquals(Item::ALIAS, $item->getKey());
		$this->assertEquals($identity, $item->getName());
		$this->assertEquals($associate, $item->getProperties());
		$this->assertTrue($this->tracker->hasItem($item));
	}

	protected function getRequestMock() {
		return $this->getMockBuilder('Symfony\Component\HttpFoundation\Request')
			->getMock();
	}

}
