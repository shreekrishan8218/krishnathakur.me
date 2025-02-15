<?php
/**
 * Template - Single
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

  while (have_posts()) {
    the_post();

    $post_open_options = valkivid_post_data_get('post-open');

    /**
     * Post Open
     */
    get_template_part('template-part/post/post-open', $body_version, $post_open_options);
  }

  get_footer();

?>