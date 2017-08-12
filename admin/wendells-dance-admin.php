<?php

class Wendells_Dance_Admin {

  private $version;

  public function __construct( $version ) {
    $this->version = $version;
  }

  public function enqueue_styles() {
    wp_enqueue_style(
      'ccafe-reservation',
      plugin_dir_url( __FILE__ ) . 'css/wendells-styles.css',
      array(),
      $this->version,
      FALSE
    );
  }

  public function add_meta_box() {
    add_meta_box(
      'ccafe-reservation',
      "Wendell's Dance Card test",
      array( $this, 'render_meta_box' ),
      'post',
      'normal',
      'core'
    );
  }

  public function render_meta_box() {
    require_once plugin_dir_path( __FILE__ ) . 'partials/wendells-dance-card.php';
  }
}
