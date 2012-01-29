<?php

namespace Tirna\KissmetricsBundle\Tests\Queue;

use Tirna\KissmetricsBundle\Queue\Item;

class ItemTest extends \PHPUnit_Framework_TestCase {

	protected $item;

	public function setUp() {
		parent::setup();
		$this->item = new Item();
	}

	public function tearDown() {
		$this->item = null;
		parent::tearDown();
	}

	public function testConstructor() {
		$this->assertNull($this->item->getKey());
		$this->assertNull($this->item->getName());
		$this->assertNull($this->item->getProperties());
	}

	public function testSetGetKey() {
		$val = "key";
		$this->item->setKey($val);
		$this->assertEquals($val, $this->item->getKey());
	}

	public function testSetGetName() {
		$val = "name";
		$this->item->setName($val);
		$this->assertEquals($val, $this->item->getName());
	}

	public function testSetGetProperties() {
		$val = "properties";
		$this->item->setProperties($val);
		$this->assertEquals($val, $this->item->getProperties());
	}

}
