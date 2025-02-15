<?php
/**
 * Template - Footer
 * 
 * @package Valkivid
 * 
 * @since 1.0.0
 * 
 * @author Odin Design Themes (https://odindesignthemes.com/)
 * 
 */

?>

</main>
<!-- /CONTENT -->

<?php

  $show_footer_top = valkivid_customizer_setting_value_get('valkivid_footer_setting_top_status') === 'display';
  $show_footer_bottom = valkivid_customizer_setting_value_get('valkivid_footer_setting_bottom_status') === 'display';

  if ($show_footer_top || $show_footer_bottom) {

    $footer_type = valkivid_customizer_setting_template_type_value_get('valkivid_footer_setting_type');

?>

<!-- FOOTER -->
<footer class="valkivid-footer valkivid-template_<?php echo esc_attr($footer_type); ?>">
<?php

  if ($show_footer_top) {
    $footer_options = [
      'social_networks' => valkivid_customizer_setting_social_networks_get()
    ];
  
    /**
     * Footer Top
     */
    get_template_part('template-part/footer/footer-top', $footer_type, $footer_options);
  }

  if ($show_footer_bottom) {
    $footer_bottom_options = [
      'navigation_split_modifiers'  => 'valkivid-template_' . $footer_type,
      'grid_limit'                  => $footer_type === 'streamer-v2' ? false : true
    ];
  
    /**
     * Footer Bottom
     */
    get_template_part('template-part/footer/footer-bottom', $footer_bottom_options);
  }

?>
</footer>
<!-- /FOOTER -->
<?php

  }

  wp_footer();

?>
</body>
</html>
