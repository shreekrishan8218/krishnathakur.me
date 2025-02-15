<?php
/**
 * Template - Comments
 * 
 * @package Valkivid
 * 
 * @since 1.0.0
 * 
 * @author Odin Design Themes (https://odindesignthemes.com/) 
 * 
 */

  $body_type = valkivid_customizer_setting_template_type_value_get('valkivid_body_setting_type');
  $body_version = valkivid_template_type_version_get($body_type);

  $comment_list_classes = [
    'valkivid-template_' . $body_version
  ];

  $show_avatars = get_option('show_avatars') == 1;

  if ($show_avatars) {
    $comment_list_classes[] = 'valkivid-comment-list_show-avatars';
  }

  $body_version_avatar_size = [
    'streamer'  => 60,
    'vlogger'   => 80
  ];

  $comment_count = get_comments_number();

  // show comment list if there is at least 1 comment
  if ($comment_count > 0) {

?>
  <!-- COMMENT LIST TITLE -->
  <h2 id="comments" class="valkivid-comment-list-title <?php echo esc_attr('valkivid-template_' . $body_version); ?>">
  <?php

    echo wp_kses(
      sprintf(
        _n('%s%s%s Comment', '%s%s%s Comments', $comment_count, 'valkivid'),
        '<strong>',
        number_format_i18n($comment_count),
        '</strong>'
      ),
      apply_filters(
        'valkivid_comment_list_title_allowed_html',
        [
          'strong' => []
        ]
      )
    );

  ?>
  </h2>
  <!-- /COMMENT LIST TITLE -->

  <!-- COMMENT LIST -->
  <ul class="valkivid-comment-list <?php echo esc_attr(implode(' ', $comment_list_classes)); ?>">
  <?php
  
    wp_list_comments([
      'avatar_size' => $body_version_avatar_size[$body_version],
      'walker'      => new Valkivid_Walker_Comment()
    ]);

  ?>
  </ul>
  <!-- /COMMENT LIST -->
<?php

    $comment_pages_count = get_comment_pages_count();

    // only display comment pagination wrapper if there is more than 1 page of comments
    if ($comment_pages_count > 1) {

?>
  <!-- NAVIGATION -->
  <nav class="navigation valkivid-comment-list-navigation valkivid-template_<?php echo esc_attr($body_type); ?>">
  <?php

    paginate_comments_links([
      'prev_text' => valkivid_navigation_pager_control_template_get($body_version, 'left'),
      'next_text' => valkivid_navigation_pager_control_template_get($body_version, 'right')
    ]);

  ?>
  </nav>
  <!-- /NAVIGATION -->
<?php

    }
  }

  // only display comment form if commenting is enabled
  if (comments_open()) {
    comment_form([
      'class_container' => 'comment-respond valkivid-template_' . $body_version
    ]);
  }

?>

