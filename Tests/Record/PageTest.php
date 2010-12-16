<?php

namespace Bundle\KissmetricsBundle\Tests\Record;

use Bundle\KissmetricsBundle\Record\Page;

class PageTest extends \PHPUnit_Framework_TestCase {

	protected $transaction;

	public function setUp() {
		parent::setup();
		$this->page = new Page();
	}

	public function tearDown() {
		$this->transaction = null;
		parent::tearDown();
	}

	public function testConstructor() {
		$this->assertNull($this->page->getHost());
		$this->assertNull($this->page->getPath());
		$this->assertNull($this->page->getUri());
	}

	public function testSetGetHost() {
		 $val = "host";
		 $this->page->setHost($val);
		 $this->assertEquals($val, $this->page->getHost());
	}

	public function testSetGetPath() {
		 $val = "path";
		 $this->page->setPath($val);
		 $this->assertEquals($val, $this->page->getPath());
	}

	public function testSetGetUri() {
		 $val = "uri";
		 $this->page->setUri($val);
		 $this->assertEquals($val, $this->page->getUri());
	}

}
