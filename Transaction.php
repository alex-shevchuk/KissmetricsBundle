<?php

namespace Bundle\KissmetricsBundle;

use Bundle\KissmetricsBundle\Transaction\Item;

class Transaction {

	protected $affiliation;
	protected $city;
	protected $country;
	protected $items = array();
	protected $orderNumber;
	protected $shipping;
	protected $state;
	protected $tax;
	protected $total;

	public function setAffiliation($affiliation) {
		$this->affiliation = (string) $affiliation;
	}

	public function getAffiliation() {
		return $this->affiliation;
	}

	public function setCity($city) {
		$this->city = (string) $city;
	}

	public function getCity() {
		return $this->city;
	}

	public function setCountry($country) {
		$this->country = (string) $country;
	}

	public function getCountry() {
		return $this->country;
	}

	public function hasItems() {
		if (!empty($this->items)) {
			return true;
		}
		return false;
	}

	public function hasItem(Item $item) {
		if ($this->items instanceof \Doctrine\Common\Collections\Collection) {
			return $this->items->contains($item);
		} else {
			return in_array($item, $this->items, true);
		}
	}

	public function addItem(Item $item) {
		$this->items[] = $item;
	}

	public function removeItem(Item $item) {
		if (!$this->hasItem($item)) {
			return null;
		}
		if ($this->items instanceof \Doctrine\Common\Collections\Collection) {
			return $this->items->removeElement($item);
		} else {
			unset($this->items[array_search($item, $this->items, true)]);
			return $item;
		}
	}

	public function getItems() {
		return $this->items;
	}

	public function setOrderNumber($orderNumber) {
		$this->orderNumber = (string) $orderNumber;
	}

	public function getOrderNumber() {
		return $this->orderNumber;
	}

	public function setShipping($shipping) {
		$this->shipping = (float) $shipping;
	}

	public function getShipping() {
		return $this->shipping;
	}

	public function setState($state) {
		$this->state = (string) $state;
	}

	public function getState() {
		return $this->state;
	}

	public function setTax($tax) {
		$this->tax = (float) $tax;
	}

	public function getTax() {
		return $this->tax;
	}

	public function setTotal($total) {
		$this->total = (float) $total;
	}

	public function getTotal() {
		return $this->total;
	}

}
