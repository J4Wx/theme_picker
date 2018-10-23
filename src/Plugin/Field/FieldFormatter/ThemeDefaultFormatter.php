<?php

namespace Drupal\theme_picker\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Whywouldyoueverusethis.jpg.
 *
 * @FieldFormatter(
 *   id = "theme_formatter",
 *   label = @Translation("Theme Item Formatter"),
 *   field_types = {
 *     "theme"
 *   }
 * )
 */
class ThemeDefaultFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t('Displays the selected theme name.');
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    foreach ($items as $delta => $item) {
      // Render each element as markup.
      $element[$delta] = ['#markup' => $item->value];
    }

    return $element;
  }

}
