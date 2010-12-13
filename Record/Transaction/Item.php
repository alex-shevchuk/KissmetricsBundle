<?php

namespace Bundle\KissmetricsBundle\Record\Transaction;

class Item {

	protected $category;
	protected $name;
	protected $price;
	protected $quantity;
	protected $sku;

	public function setCategory($category) {
		$this->category = $category;
	}

	public function getCategory() {
		return $this->category;
	}

	public function setName($name) {
		$this->name = (string) $name;
	}

	public function getName() {
		return $this->name;
	}

	public function setPrice($price) {
		$this->price = (float) $price;
	}

	public function getPrice() {
		return $this->price;
	}

	public function setQuantity($quantity) {
		$this->quantity = (int) $quantity;
	}

	public function getQuantity() {
		return $this->quantity;
	}

	public function setSku($sku) {
		$this->sku = (string) $sku;
	}

	public function getSku() {
		return $this->sku;
	}

}
