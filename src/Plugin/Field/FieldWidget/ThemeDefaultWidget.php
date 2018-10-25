<?php

namespace Drupal\theme_picker\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'field_theme_selection' widget.
 *
 * @FieldWidget(
 *   id = "theme_widget",
 *   module = "theme_picker",
 *   label = @Translation("Theme Selector"),
 *   field_types = {
 *     "theme"
 *   }
 * )
 */
class ThemeDefaultWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $themes = (system_list('theme'));
    $themes = array_map(
        function ($theme) {
            return $theme->info['name'];
        }, $themes
    );

    $value = isset($items[$delta]->value) ? $items[$delta]->value : '';
    $element += [
      '#type' => 'select',
      '#required' => TRUE,
      '#size' => 3,
      '#default_value' => $value,
      '#options' => $themes,
      '#element_validate' => [
        [static::class, 'validate'],
      ],
    ];
    return ['value' => $element];
  }

  /**
   * Validate the color text field.
   */
  public static function validate($element, FormStateInterface $form_state) {
    $value = $element['#value'];
    if (strlen($value) == 0) {
      $form_state->setValueForElement($element, '');
      return;
    }
  }

}
