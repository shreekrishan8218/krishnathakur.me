<?php
/**
 * Template - Header
 * 
 * @package Valkivid
 * 
 * @since 1.0.0
 * 
 * @author Odin Design Themes (https://odindesignthemes.com/)
 * 
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php if (has_site_icon()) : ?>
  <!-- favicon -->
  <link rel="icon" href="<?php site_icon_url(); ?>">
<?php endif; ?>
<?php

  // add support for the new JavaScript functionality with comment threading
  if (is_singular()) {
    wp_enqueue_script('comment-reply');
  }

?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- SKIP TO CONTENT -->
<a class="skip-link screen-reader-text" href="#valkivid-srt-main-content"><?php esc_html_e('Skip to content', 'valkivid'); ?></a>
<!-- /SKIP TO CONTENT -->

<?php

  $header_type = valkivid_customizer_setting_template_type_value_get('valkivid_header_setting_type');

  $header_options = [
    'social_networks' => valkivid_customizer_setting_social_networks_get()
  ];

  if (is_user_logged_in()) {
    $header_options['account_navigation_sections'] = valkivid_navigation_account_sections_get();
  }

  /**
   * Header
   */
  get_template_part('template-part/header/header', $header_type, $header_options);

  $body_type = valkivid_customizer_setting_template_type_value_get('valkivid_body_setting_type');

?>

<!-- CONTENT -->
<main id="valkivid-srt-main-content" class="valkivid-content valkivid-template_<?php echo esc_attr($body_type); ?>">
