    </main>
    <footer>
    <?php 
      wp_nav_menu(
        array(
          'menu' => 'footer',
          'container' => '',
          'theme_location' => 'footer',
          'items_wrap' => '<ul id="" class="">%3$s</ul>' /* TODO peut etre utiliser pour spécifier l'archi de la liste mais ne peut pas accéder au élément en particulier (ajout de classe depuis backend). L'autre possibilité est d'ajouter une walker class pour redéfinir l'ensemble de l'architecture du menu */
        )
      );
    ?>
    <?php 
      wp_footer();
    ?>
    </footer>
  </body>
</html>