<?php


class MSP_Notices {

    /**
     * Instance of this class.
     *
     * @var      object
     */
    protected static $instance = null;


    /**
     * Instance of this class.
     *
     * @var      object
     */
    private $notice_ids = array();

    private $notices    = array();

    private $base_url   = '';


    function __construct(){

        $this->notice_ids = array(
            'ms-notice-info-dashboard',
            'ms-notice-info-panel',
            'ms-notice-info-global'
        );

        $this->base_url = 'http://cdn.averta.net/project/masterslider/free/info/';
    }


    private function get_notice_info_transient_id( $notice_id ){
        return 'master-slider-notice-info-' . esc_attr( $notice_id );
    }


    private function fetch_notice_info( $notice_id, $force_update = false ){

        if( empty( $notice_id ) ){
            return false;
        }

        // defaults
        $defaults = array(
            'remote_url'    => '', // the remote notice url
            'beta_url'      => '', // beta remote content
            'revision'      => '', // empty means don't display
            'first_delay'   => 0, // in seconds
            'id'            => $notice_id,
            'enabled'       => true,

            'content'       => '', // the remote notice content
            'delay_passed'  => false, // the remote notice content
            'debug'         => array()
        );

        // info transient id
        $transient_id = $this->get_notice_info_transient_id( $notice_id );

        if( isset( $_GET['msafi'] ) ){
            msp_delete_transient( $transient_id );
        }

        if( ! $force_update && false !== ( $result = msp_get_transient( $transient_id ) ) ){
            // wp_parse_args to prevent the errors while new args implemented in new versions
            $defaults['debug'][] = '1.1';
            return wp_parse_args( $result, $defaults );
        }

        if( false === $info = msp_remote_post( $this->base_url . $notice_id . '.json' ) ){
            $defaults['debug'][] = '1.2';
            return $defaults;
        } else {
            $info = json_decode( $info, true );
            $info = wp_parse_args( $info, $defaults );
            $info['debug'][] = '1.3';
        }

        // get remote content
        $remote_url = isset( $_GET['msbeta'] ) ? $info["beta_url"] : $info["remote_url"];
        $info["content"] = $this->fetch_file_content( $remote_url );

        if( empty( $info["revision"] ) ){
            $info["enabled"] = false;
            $info['debug'][] = '1.4';

        } elseif( is_numeric( $info['revision'] ) && $info['revision'] != msp_get_option( 'master-slider-notice-'. $notice_id .'-latest-revision' ) ){
            $info["enabled"] = true;
            $info['debug'][] = '1.5';
            msp_update_option( 'master-slider-notice-'. $notice_id .'-latest-revision', $info['revision'] );
        }

        if( isset( $_COOKIE[ $notice_id ] ) ){
            $info['debug'][] = 'Initial cookie: '. $_COOKIE[ $notice_id ];
            $info['debug'][] = 'Now: '. ( $_COOKIE[ $notice_id ] + ( (int) $info['first_delay'] ) );
            $info['debug'][] = 'Due: '. ( time() );
            $info['debug'][] = 'Due - Now: '. ( ( $_COOKIE[ $notice_id ] + ( (int) $info['first_delay'] ) ) - time() );
        }

        // check for initial delay
        if( $info['first_delay'] ){
            if( ! isset( $_COOKIE[ $notice_id ] ) ){
                setcookie( $notice_id, time(), time() + 2 * YEAR_IN_SECONDS );
                $info["delay_passed"] = false;
                $info['debug'][] = '1.6';
            } elseif( $_COOKIE[ $notice_id ] + ( (int) $info['first_delay'] ) > time() ){
                $info['debug'][] = '1.7';
                $info["delay_passed"] = false;
            } else {
                $info["delay_passed"] = true;
                $info['debug'][] = '1.8';
            }
        }

        // disable the notice if the revision is not changed since the previous dismiss
        if( false !== $previous_revision = msp_get_option( $transient_id . '-revision', false ) ){
            if( $info['revision'] == $previous_revision ){
                $info["enabled"] = false;
                $info['debug'][] = '2.0';
            }
        }

        msp_set_transient( $transient_id, $info, 6 * HOUR_IN_SECONDS );

        return $info;
    }

    private function fetch_file_content( $url ){
        if( false === $result = msp_remote_post( $url ) ){
            return '';
        }
        return $result;
    }

    public function get_content( $notice_id ){
        $result = $this->fetch_notice_info( $notice_id );

        $debug = isset( $_GET['msdebug'] ) ? axpp( $result, false, true ) : '';

        if( ! empty( $result['content'] ) && $result['enabled'] && $result['delay_passed'] ){
            return $result['content'] . $debug;
        }

        return $debug;
    }


    public function get_notice( $notice_id ){
        if( $content = $this->get_content( $notice_id ) ){
            return '<div class="updated msp-notice-wrapper msp-banner-wrapper">' . $content . '</div>';
        }
        return '';
    }

    public function disable_notice( $notice_id ){

        if( ! in_array( $notice_id, $this->notice_ids ) ){
            return false;
        }

        // info transient id
        $transient_id = $this->get_notice_info_transient_id( $notice_id );

        if( false !== ( $result = $this->fetch_notice_info( $notice_id ) ) ){
            msp_update_option( $transient_id . '-revision', $result['revision'] );
            $result['enabled'] = false;
            msp_set_transient( $transient_id, $result, 6 * HOUR_IN_SECONDS );
        }

        return true;
    }

    /**
     * Return an instance of this class.
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

}
