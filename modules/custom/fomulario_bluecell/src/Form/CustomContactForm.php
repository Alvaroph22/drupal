<?php

namespace Drupal\custom_contact_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Formulario de contacto personalizado.
 */
class CustomContactForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_contact_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Agrega los campos del formulario.
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Nombre'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
    ];

    $form['phone'] = [
      '#type' => 'tel',
      '#title' => $this->t('Teléfono'),
      '#required' => TRUE,
    ];

    $form['message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Mensaje'),
      '#required' => TRUE,
    ];

    $form['subject'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Asunto'),
      '#required' => TRUE,
    ];

    $form['accept_policy'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Acepto las políticas'),
      '#required' => TRUE,
    ];

    // Agrega un botón de envío.
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Enviar'),
      '#ajax' => [
        'callback' => '::ajaxSubmitForm',
        'event' => 'click',
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Guarda los datos en la base de datos.
    $values = $form_state->getValues();
    $current_timestamp = \Drupal::time()->getRequestTime();
    $data = [
      'name' => $values['name'],
      'email' => $values['email'],
      'phone' => $values['phone'],
      'message' => $values['message'],
      'subject' => $values['subject'],
      'accept_policy' => $values['accept_policy'],
      'created' => $current_timestamp,
    ];
    db_insert('custom_contact_form_data')
      ->fields($data)
      ->execute();
  }

  /**
   * Callback de Ajax para el envío del formulario.
   */
  public function ajaxSubmitForm(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();

    

    // Envía una respuesta al cliente.
    $response->addCommand(
      new AlertCommand('Formulario enviado exitosamente.')
    );

    return $response;
  }
}

   
