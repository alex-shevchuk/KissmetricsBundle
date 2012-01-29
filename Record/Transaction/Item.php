<?php

namespace Tirna\KissmetricsBundle\Record\Transaction;

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

	public function toArray() {
		$out = array();
		if (isset($this->category)) {
			$out['category'] = $this->category;
		}
		if (isset($this->name)) {
			$out['name'] = $this->name;
		}
		if (isset($this->price)) {
			$out['price'] = $this->price;
		}
		if (isset($this->quantity)) {
			$out['quantity'] = $this->quantity;
		}
		if (isset($this->sku)) {
			$out['sku'] = $this->sku;
		}
		return $out;
	}

}
