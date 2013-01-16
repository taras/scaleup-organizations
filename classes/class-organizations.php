<?php
class ScaleUp_Organizations {

  private $_args;

  private $_post_type;

  function __construct( $post_type, $args = array() ) {

    $defaults = array(
      'label' => 'Organizations',
      'description' => '',
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'rewrite' => array(
        'slug' => ''
      ),
      'query_var' => true,
      'exclude_from_search' => false,
      'supports' => array(
        'title',
        'editor',
        'excerpt',
        'trackbacks',
        'custom-fields',
        'comments',
        'revisions',
        'thumbnail',
        'author',
        'page-attributes',
      ),
      'labels' => array(
        'name' => 'Organizations',
        'singular_name' => 'Organization',
        'menu_name' => 'Organizations',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Organization',
        'edit' => 'Edit',
        'edit_item' => 'Edit Organization',
        'new_item' => 'New Organization',
        'view' => 'View',
        'view_item' => 'View Organization',
        'search_items' => 'Search Organization',
        'not_found' => 'No Organization Found ',
        'not_found_in_trash' => 'Organization found in Trash',
        'parent' => 'Parent Organization',
      )
    );

    $this->_args      = wp_parse_args( $args, $defaults );
    $this->_post_type = $post_type;

    add_action( 'init', array( $this, 'init' ) );
    add_action( 'register_schemas', array( $this, 'register_schemas' ) );

  }

  function init() {
    register_post_type( $this->_post_type, $this->_args );
  }

  /**
   * Register Organizations post type with schemas
   */
  function register_schemas() {

    $default = array(
      'table' => 'postmeta',
      'default' => '',
      'type' => 'text',
      'create' => 'add_post_meta',
      'read' => 'get_post_meta',
      'update' => 'update_post_meta',
      'delete' => 'delete_post_meta'
    );

    $fields     = array();
    $properties = get_schema_fields( 'Organization', true );
    foreach ( $properties as $property )
      $fields[ $property ] = $default;

    register_schema( 'Organization', $this->_post_type, $fields );
  }

}