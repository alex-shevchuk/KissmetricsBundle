<?php

namespace Tirna\KissmetricsBundle\Tests\Record;

use Tirna\KissmetricsBundle\Record\Transaction;

class TransactionTest extends \PHPUnit_Framework_TestCase {

	protected $transaction;

	public function setUp() {
		parent::setup();
		$this->transaction = new Transaction();
	}

	public function tearDown() {
		$this->transaction = null;
		parent::tearDown();
	}

	public function testConstructor() {
		$this->assertNull($this->transaction->getAffiliation());
		$this->assertNull($this->transaction->getCity());
		$this->assertNull($this->transaction->getCountry());
		$this->assertFalse($this->transaction->hasItems());
		$this->assertNull($this->transaction->getOrderNumber());
		$this->assertNull($this->transaction->getShipping());
		$this->assertNull($this->transaction->getState());
		$this->assertNull($this->transaction->getTax());
		$this->assertNull($this->transaction->getTotal());
	}

	public function testSetGetAffiliation() {
		 $val = "affiliation";
		 $this->transaction->setAffiliation($val);
		 $this->assertEquals($val, $this->transaction->getAffiliation());
	}

	public function testSetGetCity() {
		 $val = "city";
		 $this->transaction->setCity($val);
		 $this->assertEquals($val, $this->transaction->getCity());
	}

	public function testSetGetCountry() {
		 $val = "country";
		 $this->transaction->setCountry($val);
		 $this->assertEquals($val, $this->transaction->getCountry());
	}

	public function testSetGetItems() {
		$val = array('1', 2, '3');
		$this->transaction->setItems($val);
		$this->assertEquals($val, $this->transaction->getItems());
	}

	public function testAddRemoveItem() {
		$item = new Transaction\Item();
		$this->assertFalse($this->transaction->hasItem($item));
		$this->transaction->addItem($item);
		$this->assertTrue($this->transaction->hasItem($item));
		$this->transaction->removeItem($item);
		$this->assertFalse($this->transaction->hasItem($item));
	}

	public function testSetGetOrderNumber() {
		 $val = "orderNumber";
		 $this->transaction->setOrderNumber($val);
		 $this->assertEquals($val, $this->transaction->getOrderNumber());
	}

	public function testSetGetShipping() {
		 $val = 99.99;
		 $this->transaction->setShipping($val);
		 $this->assertEquals($val, $this->transaction->getShipping());
	}

	public function testSetGetState() {
		 $val = "state";
		 $this->transaction->setState($val);
		 $this->assertEquals($val, $this->transaction->getState());
	}

	public function testSetGetTax() {
		 $val = 11.11;
		 $this->transaction->setTax($val);
		 $this->assertEquals($val, $this->transaction->getTax());
	}

	public function testSetGetTotal() {
		 $val = 100.00;
		 $this->transaction->setTotal($val);
		 $this->assertEquals($val, $this->transaction->getTotal());
	}

}
