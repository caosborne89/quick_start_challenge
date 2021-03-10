<?php

namespace Drupal\qs_challenge\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class SiteInformationLinkMessageConfigurationForm extends ConfigFormBase {

  public function getEditableConfigNames() {
    return ['qs_challenge.custom_site_info_link_message'];
  }

  public function getFormId() {
    return 'site_info_link_message_config';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('qs_challenge.custom_site_info_link_message');
    $form['site_info_link_message'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Message'),
      '#description' => $this->t('This is the message that will prepend the link to the site information page.'),
      '#default_value' => $config->get('site_info_link_message'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('qs_challenge.custom_site_info_link_message')
         ->set('site_info_link_message', $form_state->getValue('site_info_link_message'))
         ->save();
    parent::submitForm($form, $form_state);
  }
}
