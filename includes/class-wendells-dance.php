<?php

class Wendells_Dance_Card {

  protected $loader;
  protected $plugin_slug;
  protected $version;

  public function __construct() {
    $this->plugin_slug = 'ccafe-reservation';
    $this->version = '0.3';

    $this->load_dependencies();
    $this->define_admin_hooks();
    $this->database_check();
  }

  private function load_dependencies() {

    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wendells-dance-submenu.php';

    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/submenu-page.php';

    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wendells-dance-admin.php';

    require_once plugin_dir_path( __FILE__ ) . 'class-wendells-dance-loader.php';

    require_once plugin_dir_path( __FILE__ ) . 'class-rescount-table.php';

    require_once plugin_dir_path( __FILE__ ) . 'class-rescount-table-info.php';

    $this->loader = new Wendells_Dance_Loader();
  }

  private function define_admin_hooks() {
      $admin = new Wendells_Dance_Admin( $this->get_version() );
      $this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_styles' );
      $this->loader->add_action( 'add_meta_boxes', $admin, 'add_meta_box' );

      $submenu = new Wendells_Dance_Submenu( new Submenu_Page() );
      $this->loader->add_action( 'admin_menu', $submenu, 'add_menu_page' );
  }

  private function database_check() {
    global $wpdb;
    $datestr= date("Y_m,j,t,w");
    $dateArr = explode(',', $datestr);

    $table_name_to_check = new WendellsDC_ResCount_Table_Info( $wpdb, $dateArr[0], "_ccafe_res_count" );
    if ( !$table_name_to_check->table_check() ) {
      //if false, then prep info and create table
      $table_name_to_check->set_day_boundaries( $dateArr[1], $dateArr[2] );
      $table_name_to_check->set_time_boundaries( "10_0", "22_0" );
      $table_name_to_check->set_time_step( 15 );
      $new_rescount_table = new WendellsDC_ResCount_Table( $table_name_to_check );
      $new_rescount_table->create_table();
    }
  }

  public function run() {
    $this->loader->run();
  }

  public function get_version() {
    return $this->version;
  }

}
