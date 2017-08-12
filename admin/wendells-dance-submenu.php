<?php

class Wendells_Dance_Submenu {
  private $submenu_page;

  public function __construct( $submenu_page ) {
    $this->submenu_page = $submenu_page;
  }

  public function add_menu_page() {
    add_menu_page(
      "Wendell's Dance Card",
      "Wendell's Dance Card",
      "manage_options",
      "wendells-dance-card-menu",
      array( $this->submenu_page, 'render' ),
      "none",
      3
    );
  }
}
