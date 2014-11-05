<?php

namespace Elcweb\DoctrineEncryptExtension\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
*/
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('elcweb_doctrine_encrypt');
        $supportedDrivers = array('orm');
        $supportedEncryptors = array('aes256');

        $rootNode
            ->children()
                ->scalarNode('secret_key')
                    ->beforeNormalization()
                    ->ifNull()
                        ->thenInvalid('You must specifiy secret_key option')
                    ->end()
                ->end()
                ->scalarNode('encryptor')
                    ->validate()
                    ->ifNotInArray($supportedEncryptors)
                        ->thenInvalid('You must choose from one of provided encryptors or specify your own encryptor class through encryptor_class option')
                    ->end()
                    ->defaultValue($supportedEncryptors[0])
                ->end()
                ->scalarNode('encryptor_class')
                ->end()
                ->scalarNode('encryptor_service')
                ->end()
                ->scalarNode('db_driver')
                    ->validate()
                        ->ifNotInArray($supportedDrivers)
                            ->thenInvalid('The driver %s is not supported. Please choose one of ' . json_encode($supportedDrivers))
                        ->end()
                        ->cannotBeOverwritten()
                    ->defaultValue($supportedDrivers[0])
                    ->cannotBeEmpty()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
