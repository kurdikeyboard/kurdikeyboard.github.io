<?php
/**
 * Opening Hours widget.
 */
class glow_opening_hour extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'glow_opening_hour',
            esc_html__( 'Glow: Opening Hours', 'glow' ),
            array(
                'description'   => esc_html__( 'Opening Hours', 'glow' ),
                'classname' => 'dt-opening-hours'
            )
        );

    }

    public function widget( $args, $instance ) {

        $instance = wp_parse_args( $instance, array(
            'title' => '',
        ) );

        $sun        = isset( $instance['sun'] ) ? $instance['sun'] : '';
        $mon        = isset( $instance['mon'] ) ? $instance['mon'] : '';
        $tue        = isset( $instance['tue'] ) ? $instance['tue'] : '';
        $wed        = isset( $instance['wed'] ) ? $instance['wed'] : '';
        $thus       = isset( $instance['thus'] ) ? $instance['thus'] : '';
        $fri        = isset( $instance['fri'] ) ? $instance['fri'] : '';
        $sat        = isset( $instance['sat'] ) ? $instance['sat'] : '';

        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo '<h2 class="widget-title"><label>' . apply_filters( 'widget_title', $instance['title'] ) .'</label></h2>';
        }

        ?>
        <ul class="clearfix">
            <?php if( ! empty( $sun ) ) { ?>
                <li><label><?php _e( 'Sunday', 'glow' ); ?> </label><span><?php echo esc_attr( $sun ); ?></span></li>
            <?php } ?>

            <?php if( ! empty( $mon ) ) { ?>
                <li><label><?php _e( 'Monday', 'glow' ); ?> </label><span><?php echo esc_attr( $mon ); ?></span></li>
            <?php } ?>

            <?php if( ! empty( $tue ) ) { ?>
                <li><label><?php _e( 'Tuesday', 'glow' ); ?> </label><span><?php echo esc_attr( $tue ); ?></span></li>
            <?php } ?>

            <?php if( ! empty( $wed ) ) { ?>
                <li><label><?php _e( 'Wednesday', 'glow' ); ?> </label><span><?php echo esc_attr( $wed ); ?></span></li>
            <?php } ?>

            <?php if( ! empty( $thus ) ) { ?>
                <li><label><?php _e( 'Thursday', 'glow' ); ?> </label><span><?php echo esc_attr( $thus ); ?></span></li>
            <?php } ?>

            <?php if( ! empty( $fri ) ) { ?>
                <li><label><?php _e( 'Friday', 'glow' ); ?> </label><span><?php echo esc_attr( $fri ); ?></span></li>
            <?php } ?>

            <?php if( ! empty( $sat ) ) { ?>
                <li><label><?php _e( 'Saturday', 'glow' ); ?> </label><span><?php echo esc_attr( $sat ); ?></span></li>
            <?php } ?>

        </ul>
        <?php
        echo $args['after_widget'];
    }

    public function form( $instance ) {

        $instance = wp_parse_args(
            (array) $instance, array(
                'title'             => '',
                'sun'               => '',
                'mon'               => '',
                'tue'               => '',
                'wed'                => '',
                'thus'              => '',
                'fri'               => '',
                'sat'               => '',
            )
        );

        ?>

        <div class="dt-opening-hours">
            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'glow' ); ?></label><br/>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" placeholder="<?php _e( 'Title', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'sun' ); ?>"><?php _e( 'Sunday', 'glow' ); ?></label><br/>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'sun' ); ?>" name="<?php echo $this->get_field_name( 'sun' ); ?>" value="<?php echo esc_attr( $instance['sun'] ); ?>" placeholder="<?php _e( '10:00AM - 6:00PM', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'mon' ); ?>"><?php _e( 'Monday', 'glow' ); ?></label><br/>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'mon' ); ?>" name="<?php echo $this->get_field_name( 'mon' ); ?>" value="<?php echo esc_attr( $instance['mon'] ); ?>" placeholder="<?php _e( '10:00AM - 6:00PM', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'tue' ); ?>"><?php _e( 'Tuesday', 'glow' ); ?></label><br/>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'tue' ); ?>" name="<?php echo $this->get_field_name( 'tue' ); ?>" value="<?php echo esc_attr( $instance['tue'] ); ?>" placeholder="<?php _e( '10:00AM - 6:00PM', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'wed' ); ?>"><?php _e( 'Wednesday', 'glow' ); ?></label><br/>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'wed' ); ?>" name="<?php echo $this->get_field_name( 'wed' ); ?>" value="<?php echo esc_attr( $instance['wed'] ); ?>" placeholder="<?php _e( '10:00AM - 6:00PM', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'thus' ); ?>"><?php _e( 'Thursday', 'glow' ); ?></label><br/>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'thus' ); ?>" name="<?php echo $this->get_field_name( 'thus' ); ?>" value="<?php echo esc_attr( $instance['thus'] ); ?>" placeholder="<?php _e( '10:00AM - 6:00PM', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'fri' ); ?>"><?php _e( 'Friday', 'glow' ); ?></label><br/>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'fri' ); ?>" name="<?php echo $this->get_field_name( 'fri' ); ?>" value="<?php echo esc_attr( $instance['fri'] ); ?>" placeholder="<?php _e( '10:00AM - 6:00PM', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'sat' ); ?>"><?php _e( 'Saturday', 'glow' ); ?></label><br/>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'sat' ); ?>" name="<?php echo $this->get_field_name( 'sat' ); ?>" value="<?php echo esc_attr( $instance['sat'] ); ?>" placeholder="<?php _e( '10:00AM - 6:00PM', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->
        </div><!-- .dt-social-icons -->

        <?php
    }

    public function update( $new_instance, $old_instance ) {

        $instance             = $old_instance;
        $instance['title']    = strip_tags( stripslashes( $new_instance['title'] ) );
        $instance['sun']      = strip_tags( stripslashes( $new_instance['sun'] ) );
        $instance['mon']      = strip_tags( stripslashes( $new_instance['mon'] ) );
        $instance['tue']      = strip_tags( stripslashes( $new_instance['tue'] ) );
        $instance['wed']      = strip_tags( stripslashes( $new_instance['wed'] ) );
        $instance['thus']     = strip_tags( stripslashes( $new_instance['thus'] ) );
        $instance['fri']      = strip_tags( stripslashes( $new_instance['fri'] ) );
        $instance['sat']      = strip_tags( stripslashes( $new_instance['sat'] ) );
        return $instance;

    }

}