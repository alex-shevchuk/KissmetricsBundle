<?php

namespace Tirna\KissmetricsBundle;

interface RecordInterface {

	public function getName();
	public function setProperties($properties);
	public function getProperties();

}
