<?php

namespace Drupal\file_no_follow\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\file\Plugin\Field\FieldFormatter\GenericFileFormatter;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'file_no_follow' formatter.
 *
 * @FieldFormatter(
 *   id = "file_no_follow",
 *   label = @Translation("File no follow"),
 *   field_types = {
 *     "file"
 *   }
 * )
 */
class FileNoFollowFieldFormatter extends GenericFileFormatter {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = parent::viewElements($items, $langcode);

    foreach ($items as $delta => $item) {
      $elements[$delta]['#options'] = $item->options;
      $elements[$delta]['#theme'] = 'file_link_no_follow';
    }

    return $elements;
  }
}
