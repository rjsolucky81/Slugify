<?php

namespace Drupal\cdeups\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure cdeups settings for this site.
 */
class SlugifySettingsForm extends ConfigFormBase {

  /** 
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'slugify.settings';

  /** 
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'slugify_settings';
  }

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $form['slugify_separator'] = [
      '#type' => 'textfield',
      '#title' => $this->t('slugify_separator'),
      '#default_value' => $config->get('slugify_separator'),
    ]; 

    return parent::buildForm($form, $form_state);
  }

  /** 
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration.
    $this->config(static::SETTINGS)
      // Set the submitted configuration setting.
      ->set('slugify_separator', $form_state->getValue('slugify_separator'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
