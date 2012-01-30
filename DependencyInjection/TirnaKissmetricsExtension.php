<?php

namespace Tirna\KissmetricsBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TirnaKissmetricsExtension extends Extension {

	protected $resources = array(
		'kissmetrics_tracker'   => 'tracker.xml',
	);

    public function load(array $configs, ContainerBuilder $container) {
    	$config = $this->processConfiguration(new Configuration(), $configs);
    	
        if (!$container->hasDefinition('tirna_kissmetrics')) {
    		$loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
    		$loader->load($this->resources['kissmetrics_tracker']);
    	}
    	
    	if (isset($config['config'])) {
    	    $container->setParameter('kissmetrics.tracker.config', $config['config']);
    	}
    	return $container;
    }
}