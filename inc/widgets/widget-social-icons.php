<?php
/**
 * Social Icons widget.
 */
class glow_social_icons extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'glow_social_icons',
            __( 'Glow: Social Icons', 'glow' ),
            array(
                'description'   => __( 'Social Icons', 'glow' ),
                'customize_selective_refresh' => true,
                'classname' => 'dt-social-icons',
            )
        );

    }

    public function widget( $args, $instance ) {

        $instance = wp_parse_args( $instance, array(
            'title' => '',
        ) );

        $facebook   = isset( $instance['facebook'] ) ? $instance['facebook'] : '';
        $twitter    = isset( $instance['twitter'] ) ? $instance['twitter'] : '';
        $g_plus     = isset( $instance['g-plus' ] ) ? $instance['g-plus'] : '';
        $instagram  = isset( $instance['instagram'] ) ? $instance['instagram'] : '';
        $github     = isset( $instance['github'] ) ? $instance['github'] : '';
        $flickr     = isset( $instance['flickr'] ) ? $instance['flickr'] : '';
        $pinterest  = isset( $instance['pinterest'] ) ? $instance['pinterest'] : '';
        $wordpress  = isset( $instance['wordpress'] ) ? $instance['wordpress'] : '';
        $youtube    = isset( $instance['youtube'] ) ? $instance['youtube'] : '';
        $vimeo      = isset( $instance['vimeo'] ) ? $instance['vimeo'] : '';
        $linkedin   = isset( $instance['linkedin'] ) ? $instance['linkedin'] : '';
        $behance    = isset( $instance['behance'] ) ? $instance['behance'] : '';
        $dribbble   = isset( $instance['dribbble'] ) ? $instance['dribbble'] : '';

        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        ?>
        <ul class="clearfix">
            <?php if( ! empty( $facebook ) ) { ?>
                <li><a href="<?php echo esc_url( $facebook ); ?>" target="_blank"><i class="fa fa-facebook transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $twitter ) ) { ?>
                <li><a href="<?php echo esc_url( $twitter ); ?>" target="_blank"><i class="fa fa-twitter transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $g_plus ) ) { ?>
                <li><a href="<?php echo esc_url( $g_plus ); ?>" target="_blank"><i class="fa fa-google-plus transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $instagram ) ) { ?>
                <li><a href="<?php echo esc_url( $instagram ); ?>" target="_blank"><i class="fa fa-instagram transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $github ) ) { ?>
                <li><a href="<?php echo esc_url( $github ); ?>" target="_blank"><i class="fa fa-github transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $flickr ) ) { ?>
                <li><a href="<?php echo esc_url( $flickr ); ?>" target="_blank"><i class="fa fa-flickr transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $pinterest ) ) { ?>
                <li><a href="<?php echo esc_url( $pinterest ); ?>" target="_blank"><i class="fa fa-pinterest transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $wordpress ) ) { ?>
                <li><a href="<?php echo esc_url( $wordpress ); ?>" target="_blank"><i class="fa fa-wordpress transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $youtube ) ) { ?>
                <li><a href="<?php echo esc_url( $youtube ); ?>" target="_blank"><i class="fa fa-youtube transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $vimeo ) ) { ?>
                <li><a href="<?php echo esc_url( $vimeo ); ?>" target="_blank"><i class="fa fa-vimeo transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $linkedin ) ) { ?>
                <li><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank"><i class="fa fa-linkedin transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $behance ) ) { ?>
                <li><a href="<?php echo esc_url( $behance ); ?>" target="_blank"><i class="fa fa-behance transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $dribbble ) ) { ?>
                <li><a href="<?php echo esc_url( $dribbble ); ?>" target="_blank"><i class="fa fa-dribbble transition35"></i></a> </li>
            <?php } ?>
        </ul>
        <?php

        echo $args['after_widget'];
    }

    public function form( $instance ) {

        $instance = wp_parse_args(
            (array) $instance, array(
                'title'             => '',
                'facebook'          => '',
                'twitter'           => '',
                'g-plus'            => '',
                'instagram'         => '',
                'github'            => '',
                'flickr'            => '',
                'pinterest'         => '',
                'wordpress'         => '',
                'youtube'           => '',
                'vimeo'             => '',
                'linkedin'          => '',
                'behance'           => '',
                'dribbble'          => ''
            )
        );

        ?>

        <div class="dt-social-icons">
            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'glow' ); ?></label><br/>
                <input  class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" placeholder="<?php _e( 'Title', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook', 'glow' ); ?></label><br/>
                <input  class="widefat" type="text" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo esc_attr( $instance['facebook'] ); ?>" placeholder="<?php _e( 'https://www.facebook.com/', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter', 'glow' ); ?></label><br/>
                <input  class="widefat" type="text" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo esc_attr( $instance['twitter'] ); ?>" placeholder="<?php _e( 'https://twitter.com/', 'glow' ); ?>" >
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'g-plus' ); ?>"><?php _e( 'G plus', 'glow' ); ?></label><br/>
                <input  class="widefat" type="text" id="<?php echo $this->get_field_id( 'g-plus' ); ?>" name="<?php echo $this->get_field_name( 'g-plus' ); ?>" value="<?php echo esc_attr( $instance['g-plus'] ); ?>" placeholder="<?php _e( 'https://plus.google.com/', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'Instagram', 'glow' ); ?></label><br/>
                <input  class="widefat" type="text" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo esc_attr( $instance['instagram'] ); ?>" placeholder="<?php _e( 'https://instagram.com/', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'github' ); ?>"><?php _e( 'Github', 'glow' ); ?></label><br/>
                <input  class="widefat" type="text" id="<?php echo $this->get_field_id( 'github' ); ?>" name="<?php echo $this->get_field_name( 'github' ); ?>" value="<?php echo esc_attr( $instance['github'] ); ?>" placeholder="<?php _e( 'https://github.com/', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e( 'Flickr', 'glow' ); ?></label><br/>
                <input  class="widefat" type="text" id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" value="<?php echo esc_attr( $instance['flickr'] ); ?>" placeholder="<?php _e( 'https://www.flickr.com/"', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e( 'Pinterest', 'glow' ); ?></label><br/>
                <input  class="widefat" type="text" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo esc_attr( $instance['pinterest'] ); ?>" placeholder="<?php _e( 'https://www.pinterest.com/', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'wordpress' ); ?>"><?php _e( 'WordPress', 'glow' ); ?></label><br/>
                <input  class="widefat" type="text" id="<?php echo $this->get_field_id( 'wordpress' ); ?>" name="<?php echo $this->get_field_name( 'wordpress' ); ?>" value="<?php echo esc_attr( $instance['wordpress'] ); ?>" placeholder="<?php _e( 'https://wordpress.org/', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'YouTube', 'glow' ); ?></label><br/>
                <input  class="widefat" type="text" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo esc_attr( $instance['youtube'] ); ?>" placeholder="<?php _e( 'https://www.youtube.com/', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><?php _e( 'Vimeo', 'glow' ); ?></label><br/>
                <input  class="widefat" type="text" id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo esc_attr( $instance['vimeo'] ); ?>" placeholder="<?php _e( 'https://vimeo.com/', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e( 'Linkedin', 'glow' ); ?></label><br/>
                <input  class="widefat" type="text" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo esc_attr( $instance['linkedin'] ); ?>" placeholder="<?php _e( 'https://linkedin.com', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'behance' ); ?>"><?php _e( 'Behance', 'glow' ); ?></label><br/>
                <input  class="widefat" type="text" id="<?php echo $this->get_field_id( 'behance' ); ?>" name="<?php echo $this->get_field_name( 'behance' ); ?>" value="<?php echo esc_attr( $instance['behance'] ); ?>" placeholder="<?php _e( 'https://www.behance.net/', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->

            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'dribbble' ); ?>"><?php _e( 'Dribbble', 'glow' ); ?></label><br/>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'dribbble' ); ?>" name="<?php echo $this->get_field_name( 'dribbble' ); ?>" value="<?php echo esc_attr( $instance['dribbble'] ); ?>" placeholder="<?php _e( 'https://dribbble.com/', 'glow' ); ?>">
            </p><!-- .dt-admin-input-wrap -->
        </div><!-- .dt-social-icons -->
        <?php
    }

    public function update( $new_instance, $old_instance ) {

        $instance               = $old_instance;
        $instance['title']     = strip_tags( stripslashes( $new_instance['title'] ) );
        $instance['facebook']  = strip_tags( stripslashes( $new_instance['facebook'] ) );
        $instance['twitter']   = strip_tags( stripslashes( $new_instance['twitter'] ) );
        $instance['g-plus']    = strip_tags( stripslashes( $new_instance['g-plus'] ) );
        $instance['instagram'] = strip_tags( stripslashes( $new_instance['instagram'] ) );
        $instance['github']    = strip_tags( stripslashes( $new_instance['github'] ) );
        $instance['flickr']    = strip_tags( stripslashes( $new_instance['flickr'] ) );
        $instance['pinterest'] = strip_tags( stripslashes( $new_instance['pinterest'] ) );
        $instance['wordpress'] = strip_tags( stripslashes( $new_instance['wordpress'] ) );
        $instance['youtube']   = strip_tags( stripslashes( $new_instance['youtube'] ) );
        $instance['vimeo']     = strip_tags( stripslashes( $new_instance['vimeo'] ) );
        $instance['linkedin']  = strip_tags( stripslashes( $new_instance['linkedin'] ) );
        $instance['behance']   = strip_tags( stripslashes( $new_instance['behance'] ) );
        $instance['dribbble']  = strip_tags( stripslashes( $new_instance['dribbble'] ) );
        return $instance;

    }

}