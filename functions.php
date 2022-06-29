<?php 

define('THEME_URI', get_template_directory_uri());

/**
 * Load up core options
 */

require_once(dirname(__FILE__) . '/core/core.php');

function wap_theme_support() {
  // Adds dynamic title tag support for pages
  add_theme_support('title-tag');
  add_theme_support('custom-logo');
  add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'wap_theme_support');


function wap_menus() {
  $locations = array(
    'primary' => 'Desktop Primary Menu',
    'footer' => 'Footer Menu Items'
  );

  register_nav_menus($locations);
}
add_action('init', 'wap_menus');



function wap_register_styles() {
  
  /* Get the current version declare in our stylesheet */
  $version = wp_get_theme()->get('Version');
  /* 1st parameter is a name for the style to enqueue / 2nd is the style file / 3rd is the dependency possible to put array('other-style-enqueu-name') / 4th is the version */
  wp_enqueue_style('wap-theme-style', THEME_URI . '/style.css', array(), $version, 'all');
  wp_enqueue_style('wap-theme-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css', array(), '5.2.0', 'all');

}
/* When Wordpress run the wp_enqueue_scripts it will execute our function */
add_action('wp_enqueue_scripts', 'wap_register_styles');

/* Add subresource integrity to styles. Those attributes allow browser to check that files are delivered without any changes/modification */
function wap_add_style_attributes($html, $handle) {
  if ('wap-theme-bootstrap' === $handle) {
    return str_replace("media='all'", "media='all' integrity='sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor' crossorigin='anonymous'", $html);
  }
  /*if ('xxx' === $handle) {
    return str_replace("media='all'", "media='all' toto", $html);
  }*/
  return $html;
}
add_filter('style_loader_tag', 'wap_add_style_attributes', 10, 2);



function wap_register_scripts() {

  /* Le dernier paramètre permet de spécifier si l'on veut le script dans le header (false par défaut) ou dans le footer (true) */
  wp_enqueue_script('wap-theme-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js', array(), '5.2.0', true);
  wp_script_add_data('wap-theme-bootstrap', array('integrity', 'crossorigin') , array('sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2', 'anonymous'));

  wp_enqueue_script('wap-theme-main', THEME_URI . '/asset/js/main.js', array(), $version, true);
}
add_action('wp_enqueue_scripts', 'wap_register_scripts');

/**
 * Différer l'exécution du script à la fin du chargement du document. Cela permet de ne pas bloquer l'affichage/le rendu HTML de la page.
 * En effet, lorsque le navigateur rencontre une balise "script", le moteur HTML est mis en pause, on scanne le fichier du script pour vérifier s'il n'y a pas de l'HTML ajouté depuis le 
 * script.
 * TODO: Peut être préférable de passer les scripts en async si leur ordre n'importe pas, cela permet un gain de temps => https://www.alsacreations.com/astuce/lire/1562-script-attribut-async-defer.html
 **/ 
function wap_add_defer_attribute($tag, $handle) {
  $script_to_defer = array('wap-theme-bootstrap');
  /*$script_to_defer = array('wap-theme-bootstrap', 'another-one',...);*/

  foreach($script_to_defer as $defer_script) {
    if ($defer_script === $handle) {
      return str_replace('src', 'defer src', $tag);
    }
  }
  return $tag;
}
add_filter('script_loader_tag', 'wap_add_defer_attribute',10 , 2);



function wap_widget_areas() {
  /* In the first array parameter we can put some html to customize the widget */ 
  register_sidebar(
    array(
      'before_title' => '',
      'after_title' => '',
      'before_widget' => '',
      'after_widget' => ''
    ),
    array(
      'name' => 'Wap Sidebar',
      'id' => 'sidebar-1',
      'description' => 'Sidebar Widget Area'
    )
  );
}
add_action('widgets_init', 'wap_widget_areas');




?>