<?php

namespace Bundle\KissmetricsBundle;

interface RecordInterface {

	public function getName();
	public function setProperties($properties);
	public function getProperties();

}
