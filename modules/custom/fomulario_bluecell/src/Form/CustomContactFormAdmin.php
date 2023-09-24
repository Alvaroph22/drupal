<?php

namespace Drupal\custom_contact_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Página de administración de las presentaciones del formulario de contacto.
 */
class CustomContactFormAdmin extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_contact_form_admin';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
      https://datatables.net/extensions/buttons/examples/html5/simple.html 
    

    $form['table'] = [
      '#markup' => '<table id="custom-contact-form-table" class="display">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Email</th>
                          <th>Teléfono</th>
                          <th>Mensaje</th>
                          <th>Asunto</th>
                          <th>Acepta Políticas</th>
                          <th>Fecha</th>
                        </tr>
                      </thead>
                    </table>',
    ];

    // Agrega el script para inicializar la tabla DataTables.
    $form['#attached']['library'][] = 'custom_contact_form/datatables';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    
  }
}
