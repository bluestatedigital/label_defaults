<?php

namespace Drupal\label_defaults\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Creates the config form for the module settings.
 *
 * @package Drupal\label_defaults\Form
 */
class LabelDefaultsConfigForm extends ConfigFormBase {

  /**
   * The name of the editable config object used by the form.
   *
   * @var string
   */
  protected $configName = 'label_defaults.settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'label_defaults_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $config = $this->config($this->configName);
    $form['default_label_display'] = [
      '#type' => 'select',
      '#title' => $this->t('Default display setting for labels'),
      '#options' => [
        'above' => $this->t('Above'),
        'inline' => $this->t('Inline'),
        'hidden' => '- ' . $this->t('Hidden') . ' -',
        'visually_hidden' => '- ' . $this->t('Visually Hidden') . ' -',
      ],
      '#default_value' => $config->get('display_default'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config($this->configName);
    $config->set(
      'display_default',
      $form_state->getValue('default_label_display')
    );
    $config->save();
    parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [$this->configName];
  }

}
