<?php

namespace Drupal\label_defaults;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Field\FieldTypePluginManagerInterface;
use Drupal\Core\Field\FormatterPluginManager;

/**
 * Label Defaults field formatter plugin manager.
 *
 * Extends the core field formatter plugin manager to use the default label
 * display setting set in config.
 */
class LabelDefaultsFormatterPluginManager extends FormatterPluginManager {

  /**
   * A config factory for retrieving required config settings.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $config;

  /**
   * {@inheritdoc}
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler, FieldTypePluginManagerInterface $field_type_manager, ConfigFactory $config_factory) {
    $this->config = $config_factory;
    parent::__construct($namespaces, $cache_backend, $module_handler, $field_type_manager);
  }

  /**
   * {@inheritdoc}
   */
  public function prepareConfiguration($field_type, array $configuration) {
    $configuration += [
      'label' => $this->config->get('label_defaults.settings')->get('display_default'),
    ];
    return parent::prepareConfiguration($field_type, $configuration);
  }

}
