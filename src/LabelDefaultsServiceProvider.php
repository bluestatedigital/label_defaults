<?php

namespace Drupal\label_defaults;

use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Drupal\Core\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Overrides the plugin.manager.field.formatter service to point to custom one.
 */
class LabelDefaultsServiceProvider extends ServiceProviderBase {

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {
    $definition = $container->getDefinition('plugin.manager.field.formatter');
    $definition->setClass('Drupal\label_defaults\LabelDefaultsFormatterPluginManager');
    $definition->addArgument(new Reference('config.factory'));
  }

}
