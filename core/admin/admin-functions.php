<?php



add_action( 'admin_menu', 'example_menu_items' );
// Registers our new menu item
function example_menu_items() {
    $hooktheme = add_theme_page(
      "Theme Customization",      // Page Title
      "Theme Customization Menu", // Page title to display in menu backoffice
      "manage_options",           // Habilitation nécessaire pour voir la page (permission utilisateur)
      "theme_options_page",       // Page slug
      "theme_options_markup",     // Page callback
      99                          // La position du menu dans la liste des menus 
    );
}

//this function creates a simple page with title Custom Theme Options Page.
function theme_options_markup() {
  ?>
  <div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form method="post" action="options.php">
      <?php 
        settings_fields('wap_theme_settings');
        do_settings_sections('theme_options_page');
        submit_button();
      ?>
    </form>
  </div>
  <?php
}



add_action( 'admin_init', 'wap_theme_settings' );
function wap_theme_settings(){
  // Déclare à WordPress l'existence de réglages.
  register_setting( 
    'wap_theme_settings',
    'wap_theme_settings',
    'wap_theme_sanitize'
  );

  // Déclarer une section afin de ranger notre réglage
  add_settings_section(
    'design_section',                   // Section slug
    __('First section', 'waptheme'),     // Section Titre
    'design_section_markup',            // Section callback
    'theme_options_page'                // Page slug
  );

  // Déclarer un champ
  add_settings_field(
    'wap_theme_settings',                 // Setting slug
    __('Google Analytics Code', 'waptheme'),   // Setting title
    'wap_theme_google_settings_markup',          // Setting callback
    'theme_options_page',                 // Page slug
    'design_section'                      // Section slug
  );

  // Create input select for Font Google
  add_settings_field(
    'wap_theme_font',                   // Setting slug
    __('Theme Font', 'waptheme'),       // Setting title
    'wap_theme_font_markup',            // Setting callback
    'theme_options_page',               // Page slug
    'design_section'                    // Section slug
  );

    // Create input for Primary Theme Color 
    add_settings_field(
      'wap_theme_primary_color',                   // Setting slug
      __('Theme primary color', 'waptheme'),       // Setting title
      'wap_theme_pcolor_markup',            // Setting callback
      'theme_options_page',               // Page slug
      'design_section'                    // Section slug
    );

    // Create input for Secondary Theme Color 
    add_settings_field(
      'wap_theme_secondary_color',                   // Setting slug
      __('Theme secondary color', 'waptheme'),       // Setting title
      'wap_theme_scolor_markup',            // Setting callback
      'theme_options_page',               // Page slug
      'design_section'                    // Section slug
    );

}

// Afficher le contenu de la section
function design_section_markup($args) {
  ?>
  <div>
    <h2>Design Options</h2>
  </div>
  <?php
}

// Afficher le champ de configuration 
function wap_theme_google_settings_markup($args) {
  $setting = get_option('wap_theme_settings');
  //$value = $setting ? : '';
  $value = ! empty( $setting['text'] ) ? $setting['text'] : '';
  ?>
  <!-- input name and get_option = Setting slug -->
  <!--<input class="" type="text" name="wap_theme_settings" value="<?php //echo esc_attr($value); ?>">-->
  <input class="regular-text" type="text" name="wap_theme_settings[text]" value="<?php echo esc_attr( $value );?>">
  <?php
}

/* Display the Google fonts name list on a select input */ 
function wap_theme_font_markup($args) {
  $setting = get_option('wap_theme_settings');
  $value = ! empty( $setting['select'] ) ? $setting['select'] : '';
  ?>
    <select name="wap_theme_settings[select]">
      
      <?php
        if ($value == '') {
          echo '<option selected="selected">Google Fonts</option>';
        } else {
          echo '<option>Google Fonts</option>';
        }
        global $google_fonts;
        foreach ($google_fonts as $option) {
          if ($value == $option) {
            echo '<option selected="selected">' . $option . '</option>';
          }  else {
            echo '<option>' . $option . '</option>';
          }
        }
      ?>
    </select>
  <?php
}


// Afficher le champ de configuration 
function wap_theme_pcolor_markup($args) {
  $setting = get_option('wap_theme_settings');
  //$value = $setting ? : '';
  $value = ! empty( $setting['pcolor'] ) ? $setting['pcolor'] : '';
  ?>
  <!-- input name and get_option = Setting slug -->
  <!--<input class="" type="text" name="wap_theme_settings" value="<?php //echo esc_attr($value); ?>">-->
  <input class="regular-text" type="color" name="wap_theme_settings[pcolor]" value="<?php echo esc_attr( $value );?>">
  <?php
}


// Afficher le champ de configuration 
function wap_theme_scolor_markup($args) {
  $setting = get_option('wap_theme_settings');
  //$value = $setting ? : '';
  $value = ! empty( $setting['scolor'] ) ? $setting['scolor'] : '';
  ?>
  <!-- input name and get_option = Setting slug -->
  <!--<input class="" type="text" name="wap_theme_settings" value="<?php //echo esc_attr($value); ?>">-->
  <input class="regular-text" type="color" name="wap_theme_settings[scolor]" value="<?php echo esc_attr( $value );?>">
  <?php
}


/**
 * Sanitize our settings array
 * 
 * @param  array  $settings  Our settings value
 */
function wap_theme_sanitize( $settings ){
  $settings['text'] = ! empty( $settings['text'] ) ? sanitize_text_field( $settings['text'] ) : '';
  return $settings;
}

/** TODO : Créer une global array
 *  Lorsque l'on accède à la page de config on requête les google fonts avec option "google fonts" si rien de choisi ainsi que le setting (options-fonts 30)
 *  On passe l'array au setting (theme-options 158) et enregistre dans le setting
 *  On créer le enqueue avec la base url plus les info du setting si présent. 
 */ 
add_action( 'wp_enqueue_scripts', 'wap_register_font' );
function wap_register_font() {
  $theme_font = get_option('wap_theme_settings');
  $theme_font_value = ! empty( $theme_font['select'] ) ? $theme_font['select'] : '';

  if (strcmp($theme_font_value, 'Google Fonts')) {
    $f_font = str_replace( " ", "+", $theme_font_value ); 
    wp_enqueue_style('theme-font', 'https://fonts.googleapis.com/css2?family=' . $f_font . '&display=swap', array(), $version, 'all');
  }
  
}

?>