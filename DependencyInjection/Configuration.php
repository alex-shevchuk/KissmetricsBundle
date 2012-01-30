<?php
namespace Tirna\KissmetricsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('tirna_kissmetrics', 'array');

        $rootNode
            ->children()
                ->arrayNode('config')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('apiKey')->defaultValue('')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
