<?php

namespace Bundle\KissmetricsBundle\Record;

use Bundle\KissmetricsBundle\AbstractRecord;
use Bundle\KissmetricsBundle\Record\Transaction\Item;

class Transaction extends AbstractRecord {

 	const RECORD_NAME = 'transaction';

	protected $properties = array();	

	public function setAffiliation($affiliation) {
		$this->properties['affiliation'] = (string) $affiliation;
	}

	public function getAffiliation() {
		if (array_key_exists('affiliation', $this->properties)) {
			return $this->properties['affiliation'];
		}
	}

	public function setCity($city) {
		$this->properties['city'] = (string) $city;
	}

	public function getCity() {
		if (array_key_exists('city', $this->properties)) {
			return $this->properties['city'];
		}
	}

	public function setCountry($country) {
		$this->properties['country'] = (string) $country;
	}

	public function getCountry() {
		if (array_key_exists('country', $this->properties)) {
			return $this->properties['country'];
		}	
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
		} else {
			return false;
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
		if (array_key_exists('items', $this->properties)) {
			return $this->properties['items'];
		}
	}

	public function getName() {
		return self::RECORD_NAME;
	}

	public function setOrderNumber($orderNumber) {
		$this->properties['orderNumber'] = (string) $orderNumber;
	}

	public function getOrderNumber() {
		if (array_key_exists('orderNumber', $this->properties)) {
			return $this->properties['orderNumber'];
		}
	}

	public function setShipping($shipping) {
		$this->properties['shipping'] = (float) $shipping;
	}

	public function getShipping() {
		if (array_key_exists('shipping', $this->properties)) {
			return $this->properties['shipping'];
		}
	}

	public function setState($state) {
		$this->properties['state'] = (string) $state;
	}

	public function getState() {
		if (array_key_exists('state', $this->properties)) {
			return $this->properties['state'];
		}
	}

	public function setTax($tax) {
		$this->properties['tax'] = (float) $tax;
	}

	public function getTax() {
		if (array_key_exists('tax', $this->properties)) {
			return $this->properties['tax'];
		}
	}

	public function setTotal($total) {
		$this->properties['total'] = (float) $total;
	}

	public function getTotal() {
		if (array_key_exists('total', $this->properties)) {
			return $this->properties['total'];
		}
	}

}
