<?php

namespace Drupal\theme_picker\Theme;

use Drupal\Core\Theme\ThemeNegotiatorInterface;
use Drupal\Core\Routing\RouteMatchInterface;

/**
 * Theme negotiator implementation.
 */
class ThemeNegotiator implements ThemeNegotiatorInterface {
  private $theme;

  /**
   * {@inheritdoc}
   */
  public function applies(RouteMatchInterface $route_match) {
    $routeName = explode('.', $route_match->getRouteName());
    if ($routeName[0] == 'entity' && (!isset($routeName[2]) || $routeName[2] !== 'edit_form')) {
      $node = $route_match->getParameter('node');
      if (!is_null($node)) {
        return $this->themeOrParent($node);
      }
    }
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  private function themeOrParent($node) {
    if (isset($node->field_theme_selection)) {
      if ($node->field_theme_selection[0]->value) {
        $this->theme = $node->field_theme_selection[0]->value;
        return TRUE;
      }
    }
    if (isset($node->field_parent_theme) || isset($node->field_parent)) {
      if (isset($node->field_parent_theme)) {
        return $this->themeOrParent($node->field_parent_theme[0]->entity);
      }
      else {
        return $this->themeOrParent($node->field_parent[0]->entity);
      }
    }

    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function determineActiveTheme(RouteMatchInterface $route_match) {
    return $this->theme;
  }

}
