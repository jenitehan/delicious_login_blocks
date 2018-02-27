<?php

namespace Drupal\delicious_login_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Provides a 'LoginBlock' block.
 *
 * @Block(
 *  id = "login_block",
 *  admin_label = @Translation("Login block"),
 * )
 */
class LoginBlock extends BlockBase {


  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
        'label' => $this->t('Already registered?'),
        'login_link_text' => $this->t('Log in now'),
      ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['login_link_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Link text'),
      '#description' => $this->t('The text to appear as the link to the login page.'),
      '#default_value' => $this->configuration['login_link_text'],
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
    $this->configuration['login_link_text'] = $form_state->getValue('login_link_text');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#theme' => 'delicious_login_blocks',
      '#link_text' => $this->configuration['login_link_text'],
      '#link_url' => Url::fromRoute('user.login'),
    ];
  }

}
