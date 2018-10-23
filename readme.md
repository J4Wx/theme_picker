# Drupal - Theme Selector
_Using Fields for Theme Selection in Drupal 8_


This module performs theme negotiation using fields. 
A content type can have it's theme set in one of three ways 
(ordered by descending priority):
- Through a "Theme" field, with the machine name "field_theme_selection".
- Through an entity reference field, with the machine name "field_parent_theme".
- Through an entity reference field, with the machine name "field_parent". 

If either of the entity reference fields are chosen, 
the referred entity can have it's theme set using either of those methods.
This means the following is possible:

Category Page (With field_theme_selection), 
Subcategory page (with field_parent or field_parent_theme), 
Content page (with field_parent or field_parent_theme).

Changing the category page's field_theme_selection would change update itself, 
the subcategory page and the content page. 
This can be theoretically looped infinitely, 
but each of the nodes traversed is accessed independently so this could be a 
costly process with several traversed nodes.

## Plans
- [x] Initial Version
- [ ] Use paned settings (like drupal/metatags)
