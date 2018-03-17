<?php

namespace Drupal\file_no_follow\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\MapDataDefinition;
use Drupal\file\Plugin\Field\FieldType\FileItem;

/**
 * Plugin alteration of 'FileItem' field type.
 */
class FileNoFollowFieldType extends FileItem {

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    return [
      'display_no_follow' => FALSE,
    ] + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
    $element = parent::fieldSettingsForm($form, $form_state);
    $settings = $this->getSettings();

    $element['display_no_follow'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable field <em>no follow</em>'),
      '#default_value' => isset($settings['display_no_follow']) ? $settings['display_no_follow'] : '',
      '#description' => $this->t('No follow field allow users to show no follow file attribute.'),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $schema = parent::schema($field_definition);
    // This column allow add options. 
    $schema['columns'] += [
      'options' => [
        'type' => 'blob',
        'size' => 'big',
        'serialize' => TRUE,
        'description' => 'Field options for files',
      ],
    ];

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = parent::propertyDefinitions($field_definition);

    $properties['options'] = MapDataDefinition::create()
      ->setLabel(t('Options'));
    return $properties;
  }

}
