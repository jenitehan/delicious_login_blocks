<?php

namespace Drupal\delicious_login_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Provides a 'RegisterBlock' block.
 *
 * @Block(
 *  id = "register_block",
 *  admin_label = @Translation("Register block"),
 * )
 */
class RegisterBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'label' => $this->t("Don't have an account?"),
      'register_link_text' => $this->t('Sign up now'),
    ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['register_link_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Link text'),
      '#description' => $this->t('The text to appear as the link to the register page.'),
      '#default_value' => $this->configuration['register_link_text'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '1',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['register_link_text'] = $form_state->getValue('register_link_text');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#theme' => 'delicious_login_blocks',
      '#link_text' => $this->configuration['register_link_text'],
      '#link_url' => Url::fromRoute('user.register'),
      '#plugin_id' => $this->getPluginId(),
    ];
  }

}
