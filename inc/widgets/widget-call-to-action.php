<?php

/**
 * Call to Action
 */
class glow_call_to_action extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'glow_call_to_action',
            __( 'Glow: Call to Action', 'glow' ),
            array(
                'description'   => __( 'Show call to action button with link', 'glow' ),
                'customize_selective_refresh' => true,
            )
        );

    }

    public function widget( $args, $instance ) {

        $title          = isset( $instance['title'] ) ? $instance['title'] : '';
        $description    = isset( $instance['description'] ) ? $instance['description'] : '';
        $button         = isset( $instance['button'] ) ? $instance['button'] : '';
        $button_url     = isset( $instance['button-url'] ) ? $instance['button-url'] : 'Button';

        echo $args['before_widget'];
        ?>
        <div class="widget dt-call-to-action-wrap">
            <div class="dt-call-to-action-meta">
                <?php if( ! empty ( $title ) ) : ?><h2 class="widget-title"><?php echo esc_attr( $title ); ?></h2> <?php endif; ?>
                <?php if( ! empty ( $description ) ) : ?><p><?php echo esc_attr( $description ); ?></p><?php endif; ?>
            </div><!-- .dt-call-to-action-meta -->

            <div class="dt-call-to-action-btn">
                <a href="<?php echo esc_url( $button_url ); ?>"><?php echo esc_attr( $button ); ?></a>
            </div><!-- .dt-call-to-action-btn -->

            <div class="clearfix"></div>
        </div><!-- .dt-call-to-action-wrap -->

        <?php
        echo $args['after_widget'];
    }

    public function form( $instance ) {

        $instance = wp_parse_args(
            (array) $instance, array(
                'title'              => '',
                'description'        => '',
                'button'             => '',
                'button-url'         => ''
            )
        );

        ?>

        <p class="dt-admin-input-wrap">
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'glow' ); ?></label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" placeholder="<?php _e( 'Title', 'glow' ); ?>" >
        </p><!-- .dt-admin-input-wrap -->

        <p class="dt-admin-input-wrap">
            <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description', 'glow' ); ?></label>
            <textarea class="widefat" rows="10" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" placeholder="<?php _e( 'Some Description ...', 'glow' ); ?>" ><?php echo esc_attr( $instance['description'] ); ?></textarea>
        </p><!-- .dt-admin-input-wrap -->

        <p class="dt-admin-input-wrap">
            <label for="<?php echo $this->get_field_id( 'button' ); ?>"><?php _e( 'Button Text', 'glow' ); ?></label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'button' ); ?>" name="<?php echo $this->get_field_name( 'button' ); ?>" value="<?php echo esc_attr( $instance['button'] ); ?>" placeholder="<?php _e( 'Button Text', 'glow' ); ?>" >
        </p><!-- .dt-admin-input-wrap -->

        <p class="dt-admin-input-wrap">
            <label for="<?php echo $this->get_field_id( 'button-url' ); ?>"><?php _e( 'Button URL', 'glow' ); ?></label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'button-url' ); ?>" name="<?php echo $this->get_field_name( 'button-url' ); ?>" value="<?php echo esc_attr( $instance['button-url'] ); ?>" placeholder="<?php _e( 'Button URL', 'glow' ); ?>" >
        </p><!-- .dt-admin-input-wrap -->

        <?php
    }

    public function update( $new_instance, $old_instance ) {

        $instance                   = $old_instance;
        $instance['title']        = esc_attr( $new_instance['title'] );
        $instance['description']  = esc_textarea( $new_instance['description'] );
        $instance['button']       = esc_attr( $new_instance['button'] );
        $instance['button-url']   = esc_url( $new_instance['button-url'] );
        return $instance;

    }

}

