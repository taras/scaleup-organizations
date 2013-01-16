<?php
class ScaleUp_Organizations_Plugin {

    private static $_this;

    public static function this() {
        return self::$_this;

    }

    function __construct( $args = array() ) {
        self::$_this = $this;

    }

}