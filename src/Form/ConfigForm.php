<?php

namespace Drupal\token_data_hash\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\token_data_hash\Base64Encoder;
use Drupal\token_data_hash\OpenSSLEncoder;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ConfigForm.
 */
class ConfigForm extends ConfigFormBase {

  /**
   * Drupal\Core\Config\ConfigManagerInterface definition.
   *
   * @var \Drupal\Core\Config\ConfigManagerInterface
   */
  protected $configManager;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->configManager = $container->get('config.manager');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'token_data_hash.config',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'token_data_hash_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('token_data_hash.config');
    $form = parent::buildForm($form, $form_state);
    $form['url_param'] = [
      '#type' => 'textfield',
      '#title' => $this->t('URL Parameter Name'),
      '#default_value' => $config->get('url_param') ?? '',
    ];
    $form['generate'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Hash Generator'),
      'type' => [
        '#type' => 'select',
        '#title' => $this->t('Encoding type'),
        '#options' => [
          'base64' => 'Base 64',
          'open_ssl' => 'Open SSL',
        ],
      ],
      'key' => [
        '#type' => 'textfield',
        '#title' => $this->t('Encryption Key'),
        '#states' => [
          'visible' => [
            ':input[name="type"]' => [
              'value' => 'open_ssl',
            ],
          ],
        ],
      ],
      'values' => [
        '#type' => 'textarea',
        '#title' => $this->t('Values to store (one per line)'),
      ],
      'button' => [
        '#type' => 'button',
        '#value' => $this->t('Generate String'),
        '#ajax' => [
          'callback' => '::updateHash',
          'event' => 'click',
          'wrapper' => 'hash',
        ],
      ],
      'hash' => [
        '#type' => 'html_tag',
        '#tag' => 'p',
        '#attributes' => ['id' => 'hash'],
      ],
    ];
    return $form;
  }

  public function updateHash(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValue('values');
    $values = explode(PHP_EOL, $values);
    foreach ($values as $key => $value) {
      $values[$key] = trim($value);
      if (empty($values[$key])) {
        unset($values[$key]);
      }
    }
    $values = implode(',', $values);
    $encoder = new Base64Encoder();
    if ($form_state->getValue('type') == 'open_ssl') {
      $key = $form_state->getValue('key');
      $encoder = new OpenSSLEncoder($key);
    }
    $msg = $encoder->encode($values);
    $form['generate']['hash']['#value'] = $msg;
    return $form['generate']['hash'];
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('token_data_hash.config')
      ->set('url_param', $form_state->getValue('url_param'))
      ->save();
  }

}
