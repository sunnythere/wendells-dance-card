<?php

if ( !class_exists( 'WendellsDC_ResCount_Table' ) ) {
  class WendellsDC_ResCount_Table {
    public $table_info;

    public function __construct( $table_info ) {
      $this->table_info = $table_info;
    }

    protected function iterate_over_hours($start_time, $end_time) {
      $incr = $this->table_info->get_time_step();

      $start_time_arr = explode('_', $start_time);
        $current_h = (int) $start_time_arr[0];
        $current_m = (int) $start_time_arr[1];
      $end_time_arr = explode('_', $end_time);

      $hours_sql = [];

      while ($current_h < $end_time_arr[0] || $current_m < $end_time_arr[1]) {

          $hours_sql[] =  $current_h . '_' . $current_m;

          $current_m += $incr;
          if ($current_m >= 60) {
            $current_m -= 60;
            $current_h++;
          }
        }
      return $hours_sql;
    }

    public function create_table() {
      global $wpdb;
      $charset_collate = $wpdb->get_charset_collate();
      $table_name = $this->table_info->get_table_name();
      $start_time = $this->table_info->get_start_time();
      $end_time = $this->table_info->get_end_time();
      $starting_index = $this->table_info->get_start_date();

      $sql_str = 'CREATE TABLE ' . $table_name . " (\n";
      $sql_str .= 'day tinyint(2) NOT NULL AUTO_INCREMENT' .",\n";
      $sql_str .= 'weekday_int tinyint(2) NOT NULL,' . "\n";

      foreach ( $this->iterate_over_hours($start_time, $end_time) as $column ) {
        $sql_str .= $column . ' tinyint(2) DEFAULT 0,' . "\n";
      }

      $sql_str .= 'PRIMARY KEY  (day)' ."\n";
      $sql_str .= ') AUTO_INCREMENT = ' . $starting_index . ";\n";
      $sql_str .= $charset_collate . ";";

      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql_str );
    }

    //set up initial vals
    private function prime_table() {

    }

    private function update_table() {

    }

    private function delete_table() {

    }

  }
}
