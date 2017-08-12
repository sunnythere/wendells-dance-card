<?php

class Wendells_Dance_Loader {
  protected $actions;

  protected $filters;

  public function __construct() {
    $this->actions = array();
    $this->filters = array();
  }

  public function add_action( $hook, $component, $callback ) {
    $this->actions = $this->add( $this->actions, $hook, $component, $callback );
  }

  public function add_filter( $hook, $component, $callback ) {
    $this->filters = $this->add( $this->filters, $hook, $component, $callback );
  }

  public function add( $hooks_arr, $hook, $component, $callback ) {
    $hooks_arr[] = array(
      'hook'  => $hook,
      'component' => $component,
      'callback'  => $callback
    );
    return $hooks_arr;
  }

  public function run() {

    foreach( $this->filters as $filter ) {
      add_filter( $filter['hook'], array( $filter['component'], $filter['callback'] ) );
    }

    foreach( $this->actions as $action ) {
      add_action( $action['hook'], array( $action['component'], $action['callback'] ) );
    }

  }
}
