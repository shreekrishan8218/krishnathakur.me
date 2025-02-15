<?php
/**
 * Template - Page
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

    /**
     * Elementor Page
     */
    if (valkivid_plugin_elementor_is_active() && valkivid_elementor_is_elementor_page()) {
      the_content();
    } else if (valkivid_plugin_woocommerce_is_active() && is_account_page()) {
      /**
       * WooCommerce Account Page
       */
      get_template_part('template-part/woocommerce/woocommerce-account', 'page');
    } else if (valkivid_plugin_woocommerce_is_active() && (is_cart() || is_checkout() || is_checkout_pay_page() || is_order_received_page())) {
      /**
       * WooCommerce Page
       */
      get_template_part('template-part/woocommerce/woocommerce', 'page');
    } else if (valkivid_plugin_pmpro_is_active() && valkivid_pmpro_is_pmpro_account_page()) {
      /**
       * PMPro Page
       */
      get_template_part('template-part/pmpro/pmpro-account', 'page');
    } else if (valkivid_plugin_pmpro_is_active() && valkivid_pmpro_is_pmpro_page()) {
      /**
       * PMPro Page
       */
      get_template_part('template-part/pmpro/pmpro', 'page');
    } else {

      $page_open_options = valkivid_post_data_get('page-open');
  
      /**
       * Page Open
       */
      get_template_part('template-part/page/page-open', $body_version, $page_open_options);
    }
  }

  get_footer();

?>
