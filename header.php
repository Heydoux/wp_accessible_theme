<!DOCTYPE html>
<html <?php language_attributes();?>>
  <head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Blog Accessible"> <!-- TODO Get that from the setting -->
    <meta name="author" content="https://antoine-dev.fr"> <!-- TODO Get that from the setting -->
    <link rel="shortcut icon" href="/wp-content/themes/accessibility/assets/images/logo.png"> <!-- TODO Create an input to upload favicon and retrieve it here -->
    
    <!-- TODO Add all the element for accessible og:images --> 

    <?php 
      wp_head();
    ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <?php
      $setting = get_option('wap_theme_settings');
      $value = ! empty( $setting['text'] ) ? $setting['text'] : '';

      if (isset($value) && !empty($value)) : ?>
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $value; ?>"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag("js", new Date());
      
        gtag("config", "<?php echo $value; ?>");
      </script>
      <?php endif; ?>

  </head>

  <body>
    <!-- TODO Add "skip to main content" button -->
    <header>
      
      <a id="skipcontent" href="#mainContent">
        <!-- To make a string translatable put it like esc_html__("string to translate", "text-domain"); to echo that string in browser esc_html_e('string to translate', 'text-domain'); 
        To display with argument  printf( esc_html__( 'We deleted %d spam messages.', 'my-text-domain' ), $count );
        -->
        <?php esc_html_e ("Skip to main content", "wap-theme"); ?>
      </a>

      <nav>
        <?php 
          $custom_logo_id = get_theme_mod('custom_logo');
          $logo = wp_get_attachment_image_src($custom_logo_id);
        ?>
        <!-- TODO : Here maybe put a an automatic alternative text refering to anchor for homepage  -->
        <a href="<?php echo get_home_url(); ?>">
          <img class="mb-3 mx-auto logo" src="<?php echo $logo[0] ?>" alt="<?php echo get_post_meta($custom_logo_id , '_wp_attachment_image_alt', true); ?>">
        </a>
        <!-- MENU --> 
        <?php 
          wp_nav_menu(
            array(
              'menu' => 'primary',
              'container' => '',
              'theme_location' => 'primary',
              'items_wrap' => '<ul id="" class="">%3$s</ul>' /* TODO peut etre utiliser pour spécifier l'archi de la liste mais ne peut pas accéder au élément en particulier (ajout de classe depuis backend). L'autre possibilité est d'ajouter une walker class pour redéfinir l'ensemble de l'architecture du menu */
            )
          );
        ?>
        <!-- END OF MENU --> 
      </nav>
    </header>
    <main id="mainContent">