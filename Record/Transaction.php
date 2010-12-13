<?php

namespace Bundle\KissmetricsBundle\Record;

use Bundle\KissmetricsBundle\AbstractRecord;
use Bundle\KissmetricsBundle\Record\Transaction\Item;

class Transaction extends AbstractRecord {

 	const RECORD_NAME = 'transaction';

	protected properties = array();	

	public function setAffiliation($affiliation) {
		$this->properties['affiliation'] = (string) $affiliation;
	}

	public function getAffiliation() {
		return $this->properties['affiliation'];
	}

	public function setCity($city) {
		$this->properties['city'] = (string) $city;
	}

	public function getCity() {
		return $this->properties['city'];
	}

	public function setCountry($country) {
		$this->properties['country'] = (string) $country;
	}

	public function getCountry() {
		return $this->properties['country'];
	}

	public function hasItems() {
		if (array_key_exists('items', $this->properties) && !empty($this->items)) {
			return true;
		}
		return false;
	}

	public function hasItem(Item $item) {
		if (array_key_exists('items', $this->properties)) {
			if ($this->items instanceof \Doctrine\Common\Collections\Collection) {
				return $this->items->contains($item);
			} else {
				return in_array($item, $this->items, true);
			}
		}
	}

	public function addItem(Item $item) {
		if (!array_key_exists('items', $this->properties)) {
			$this->properties['items'];
		}
		$this->properties['items'][] = $item;
	}

	public function removeItem(Item $item) {
		if (array_key_exists('items', $this->properties)) {
			if (!$this->hasItem($item)) {
				return null;
			}
			if ($this->properties['items'] instanceof \Doctrine\Common\Collections\Collection) {
				return $this->properties['items']->removeElement($item);
			} else {
				unset($this->properties['items'][array_search($item, $this->properties['items'], true)]);
				return $item;
			}
		}
	}

	public function setItems($items) {
		$this->properties['items'] = $items;
	}

	public function getItems() {
		return $this->properties['items'];
	}

	public function getName() {
		return self::RECORD_NAME;
	}

	public function setOrderNumber($orderNumber) {
		$this->properties['orderNumber'] = (string) $orderNumber;
	}

	public function getOrderNumber() {
		return $this->properties['orderNumber'];
	}

	public function setShipping($shipping) {
		$this->properties['shipping'] = (float) $shipping;
	}

	public function getShipping() {
		return $this->properties['shipping'];
	}

	public function setState($state) {
		$this->properties['state'] = (string) $state;
	}

	public function getState() {
		return $this->properties['state'];
	}

	public function setTax($tax) {
		$this->properties['tax'] = (float) $tax;
	}

	public function getTax() {
		return $this->properties['tax'];
	}

	public function setTotal($total) {
		$this->properties['total'] = (float) $total;
	}

	public function getTotal() {
		return $this->properties['total'];
	}

}
