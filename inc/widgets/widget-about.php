<?php
/**
 * About
 */
class glow_about extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'glow_about',
            __( 'Glow: About Me', 'glow'),
            array(
                'description'   => __( 'Show a single page', 'glow' ),
                'customize_selective_refresh' => true,
            )
        );

    }

    public function widget( $args, $instance ) {

        $dt_about_page = isset( $instance['dt_about_page'] ) ? $instance['dt_about_page'] : '';
        $dt_about_page_id = $dt_about_page['0']['page'];
        echo $args['before_widget'];

        ?>
        <aside class="dt-about-holder">
            <article>
                <h2 class="widget-title"><?php echo esc_html( get_the_title( $dt_about_page_id ) ); ?><span></span></h2>

                <?php  if ( has_post_thumbnail( $dt_about_page_id ) ) : ?>

                    <figure>

                        <?php
                        $image = '';
                        $title_attribute = get_the_title( $dt_about_page_id );
                        $image .= '<a href="'. esc_url( get_permalink( $dt_about_page_id ) ) . '" title="' . the_title( '', '', false ) .'">';
                        $image .= get_the_post_thumbnail( $dt_about_page_id, 'glow-about-img', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class' => 'transition35' ) ).'</a>';
                        echo $image;
                        ?>

                    </figure>

                <?php endif; ?>

                <p>
                    <?php
                    echo wp_trim_words( get_the_content( $dt_about_page_id ), 40, '...' );
                    ?>
                    <a href="<?php echo esc_url( get_permalink( $dt_about_page_id ) ); ?>" title="<?php _e( 'Read Details', 'glow' ); ?>"><?php _e( ' ...', 'glow' ); ?></a>
                </p>

            </article>
        </aside>
        <?php

        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $instance = wp_parse_args( $instance, array('dt_about_page' => '') );
        $selected_id = 0;
        if ( is_array( $instance['dt_about_page']  ) ) {
            if ( isset( $instance['dt_about_page'][0] ) ) {
                if ( isset( $instance['dt_about_page'][0]['page'] ) ) {
                    $selected_id = $instance['dt_about_page'][0]['page'];
                }
            }

        }
        $dt_about_page_key = 0;
        ?>
        <p class="dt-admin-input-wrap">
            <label for="<?php echo $this->get_field_id( 'dt_about_page' ).$dt_about_page_key; ?>"><?php _e( 'Select a Page', 'glow' ); ?></label><br/>
            <?php
            $arg = array(
                'name' => $this->get_field_name( "dt_about_page" ).'['.esc_attr( $dt_about_page_key ).'][page]',
                'id'   => $this->get_field_id( "dt_about_page" ).$dt_about_page_key,
                'selected' => $selected_id,
            );
            wp_dropdown_pages( $arg );
            ?>
        </p><!-- .dt-admin-input-wrap -->
        <?php

    }

    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['dt_about_page'] = array();

        if ( isset( $new_instance['dt_about_page'] ) ) {
            foreach ( $new_instance['dt_about_page'] as $stream_source ) {
                $instance['dt_about_page'][] = $stream_source;
            }
        }
        return $instance;
    }

}