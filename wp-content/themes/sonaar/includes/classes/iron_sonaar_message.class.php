<?php

class Iron_Sonaar_Message {
    private $_message;

    function __construct( $title, $subject, $class = false, $helpLink = false , $wp_error = false) {
        $this->_title = $title;
        $this->_subject = $subject;
        $this->_helpLink = $helpLink;
        $this->_message = '';
        $this->_wp_error = $wp_error;
        $this->_class = $class;

        add_action( 'admin_notices', array( $this, 'render' ) );
    }

    function get_message(){

        $message = '<p>';
        $message .= $this->_subject .'</br>';
        if ( is_wp_error( $this->_wp_error ) ) {
            $message .= '<strong>' . $this->_wp_error->get_error_code() . '</strong>: ' . $this->_wp_error->get_error_message() . '</br>';
        }

        $message .= '</p>';

        if ( $this->_helpLink ) {
            $message .= '<p>' . $this->_helpLink . '</p>';
        }


        return $this->_message = $message;
    }

    function render() {
        $this->get_message();
        printf( '<div class="notice  %1$s"><h3>%2$s</h3>%3$s</div>', esc_attr( $this->_class ), $this->_title ,$this->_message );
    }
}