<?php
class ScaleUp_Organizations_Plugin {

  private static $_this;

  private static $_organizations;

  private static $_organization_post_type;

  public static function this() {
    return self::$_this;


  }

  function __construct() {

    self::$_this                   = $this;
    self::$_organization_post_type = apply_filters( 'scaleup_organization_plugin_organization_post_type', 'scaleup_organization' );
    self::$_organizations          = new ScaleUp_Organizations( self::$_organization_post_type );

    add_action( 'admin_init', array( $this, 'admin_init' ) );

  }

  function admin_init() {
    $this->register_field_group();
  }

  function register_field_group() {
    $properties = ScaleUp_Schemas::get_schema_fields( 'Organization', true );
    $post_type  = self::$_organization_post_type;

    $i      = 0;
    $fields = array();
    foreach ( $properties as $property ) {
      $reference = get_schema_field( $property, true );

      $field = array(
        'key'                 => "$post_type.$property",
        'label'               => $reference[ 'label' ],
        'name'                => "$post_type.$property",
        'type'                => 'text',
        'order_no'            => $i,
        'instructions'        => $reference[ 'comment_plain' ],
        'required'            => false,
        'conditional_logic'   => array(
          'status'   => 0,
          'rules'    => array(
            0 =>  array(
              'field'    => 'null',
              'operator' => '==',
            ),
          ),
          'allorany' => 'all',
        ),
        'default_value'     => '',
        'formatting'        => 'none',
      );

      $fields[ ] = $field;
      $i++;
    }

    $field_group = array(
      'id' => 'scaleup_organization_fields',
      'title' => 'Organization Fields',
      'fields' => $fields,
      'location' =>
      array(
        'rules' =>
        array(
          0 =>
          array(
            'param' => 'post_type',
            'operator' => '==',
            'value' => $post_type,
            'order_no' => 0,
          ),
        ),
        'allorany' => 'all',
      ),
      'options' =>
      array(
        'position' => 'normal',
        'layout' => 'no_box',
        'hide_on_screen' =>
        array(),
      ),
      'menu_order' => 0,
    );
    register_field_group( $field_group );
  }


}

new ScaleUp_Organizations_Plugin();