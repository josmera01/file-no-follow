<?php

namespace Drupal\file_no_follow\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Plugin\Field\FieldWidget\FileWidget;

/**
 * Plugin implementation of the 'file_no_follow' widget.
 *
 * @FieldWidget(
 *   id = "file_no_follow",
 *   label = @Translation("File no follow"),
 *   field_types = {
 *     "file"
 *   }
 * )
 */
class FileNoFollowFieldWidget extends FileWidget {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element = parent::formElement($items, $delta, $element, $form, $form_state);
    $element['options']['rel'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Tag rel'),
      '#default_value' => isset($items[$delta]->options['rel']) ? $items[$delta]->options['rel'] : NULL,
    ];

    return $element;
  }

}
