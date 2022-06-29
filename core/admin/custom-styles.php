<?php 

add_action('wp_head', 'wap_custom_styles');

function wap_custom_styles() { ?>

<style type="text/css">
  body {
    font-family: 
    <?php 
      $theme_font = get_option('wap_theme_settings');
      $theme_font_value = ! empty( $theme_font['select'] ) ? $theme_font['select'] : '';
      echo $theme_font_value;
  ?>;
  }
</style> 
<?php
}