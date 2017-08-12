<?php

if ( !class_exists( 'WendellsDC_ResCount_Table_Info' ) ) {
  class WendellsDC_ResCount_Table_Info {
    public $table_name;
    public $start_date;
    public $end_date;
    public $start_time;
    public $end_time;
    public $time_step;
    public $wpdb;

    public function __construct( $wpdb, $middle, $suffix ) {
        $this->table_name = $wpdb->prefix . $middle . $suffix;
    }
    public function get_table_name() {
        return $this->table_name;
    }

    //info for columns
    public function set_day_boundaries($the_date, $end_date) {
        $this->start_date = $the_date;
        $this->end_date = $end_date;
    }
    public  function get_start_date() {
        return $this->start_date;
    }
    public  function get_end_day() {
        return $this->start_day;
    }

    public  function set_time_boundaries($start_time, $end_time) {
        $this->start_time = $start_time;
        $this->end_time = $end_time;
    }
    public  function get_start_time() {
        return $this->start_time;
    }
    public  function get_end_time() {
        return $this->end_time;
    }

    public  function set_time_step($min_num) {
        $this->time_step = $min_num;
    }
    public  function get_time_step() {
        return $this->time_step;
    }

    public function table_check() {
        global $wpdb;
        $table_name = $this->table_name;
        return $wpdb->get_var("SHOW TABLES LIKE '$table_name'") === $table_name;
    }
  }
}
