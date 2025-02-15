<?php
/**
 * Template - 404
 * 
 * The template for displaying 404 pages (Not Found)
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

  $page_header_title = esc_html__('Page not Found', 'valkivid');

  /**
   * Page Header
   */
  get_template_part('template-part/page/page-header', $body_type, [
    'title'       => $page_header_title,
    'breadcrumbs' => valkivid_navigation_breadcrumbs_get($page_header_title)
  ]);

  $section_button_modifier = $body_type === 'streamer-v2' ? 'valkivid-button_secondary' : 'valkivid-button_primary';

?>

<!-- SECTION -->
<section class="valkivid-section valkivid-grid-limit valkivid-template_<?php echo esc_attr($body_version); ?>">
  <!-- SECTION MESSAGE -->
  <div class="valkivid-section-message">
    <!-- SECTION TITLE -->
    <h2 class="valkivid-section-title"><?php esc_html_e('404', 'valkivid'); ?></h2>
    <!-- /SECTION TITLE -->

    <!-- SECTION TEXT -->
    <p class="valkivid-section-text"><?php esc_html_e('Oops! It seems that the page that you are looking for doesn\'t exist or is no longer here!', 'valkivid'); ?></p>
    <!-- /SECTION TEXT -->

    <!-- BUTTON -->
    <a  class="valkivid-button <?php echo esc_attr($section_button_modifier); ?> valkivid-template_<?php echo esc_attr($body_version); ?>"
        href="<?php echo esc_url(apply_filters('valkivid_404_button_href', home_url('/'))); ?>">
    <?php esc_html_e('Return to Home', 'valkivid'); ?>
    </a>
    <!-- /BUTTON -->
  </div>
  <!-- /SECTION MESSAGE -->
</section>
<!-- /SECTION -->

<?php

  get_footer();

?>