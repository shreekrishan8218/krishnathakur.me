<?php
/**
 * Template - Index
 * 
 * @package Valkivid
 * 
 * @since 1.0.0
 * 
 * @author Odin Design Themes (https://odindesignthemes.com/) 
 * 
 */

  get_header();

  $body_type = valkivid_customizer_setting_template_type_value_get('valkivid_body_setting_type');
  $body_version = valkivid_template_type_version_get($body_type);

  $page_header_title = esc_html__('Blog', 'valkivid');

  /**
   * Page Header
   */
  get_template_part('template-part/page/page-header', $body_type, [
    'title'       => $page_header_title,
    'breadcrumbs' => valkivid_navigation_breadcrumbs_get($page_header_title)
  ]);

?>

<!-- SECTION -->
<section class="valkivid-section valkivid-grid-limit">
<?php if (have_posts()) : ?>
  <!-- GRID -->
  <div class="valkivid-grid valkivid-grid_4-4-4 valkivid-grid_horizontally-centered-on-mobile">
  <?php

    while (have_posts()) {
      the_post();

      $post_preview_options = valkivid_post_data_get();

      /**
       * Post Preview
       */
      get_template_part('template-part/post/post-preview', $body_version, $post_preview_options);
    }

  ?>
  </div>
  <!-- /GRID -->
<?php

  /**
   * Navigation Pager
   */
  the_posts_pagination([
    'class'     => 'valkivid-template_' . $body_type,
    'mid_size'  => 1,
    'prev_text' => valkivid_navigation_pager_control_template_get($body_version, 'left'),
    'next_text' => valkivid_navigation_pager_control_template_get($body_version, 'right')
  ]);

?>
<?php endif; ?>
</section>
<!-- /SECTION -->

<?php

  get_footer();

?>