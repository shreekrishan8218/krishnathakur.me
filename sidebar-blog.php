<?php
/**
 * Sidebar - Blog
 * 
 * Vertical sidebar on the right or left side of a blog post.
 * 
 * @package Valkivid
 * 
 * @since 1.0.0
 * 
 * @author Odin Design Themes (https://odindesignthemes.com/) 
 * 
 */

  if (is_active_sidebar('blog')) {
    dynamic_sidebar('blog');
  }
  
?>
