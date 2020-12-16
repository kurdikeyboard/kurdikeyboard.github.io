<?php
/**
 * Testimonial.
 */
class Glow_Testimonial_Widget extends Widget_Ultimate_Widget_Base {

    public function __construct() {

        parent::__construct(
            'glow_testimonial',
            __( 'Glow: Testimonial', 'glow' ),
            array(
                'description'   => __( 'Show client Testimonials', 'glow' ),
                'customize_selective_refresh' => true,
            )
        );

    }

    public function widget( $args, $instance ) {
        $instance               = $this->setup_default_values( $instance, $this->get_configs() );
        $title                  = isset( $instance['title'] ) ? $instance['title'] : '';
        $dt_testimonial_page    = isset( $instance['dt_testimonial_page'] ) ? $instance['dt_testimonial_page'] : '';
        echo $args['before_widget'];
        $icon = $instance['icon'] ? $instance['icon'] : 'fa fa-pagelines';
        ?>

        <div class="widget-padding dt-testimonial">
            <div class="dt-testimonial-wrap">
                <header class="dt-entry-header">
                    <?php if( ! empty( $title ) ) : ?><h2 class="widget-title"><?php echo $title; ?>
                        <?php if ( $icon ) { ?>
                        <span><i class="<?php echo esc_attr( $icon ); ?>"></i> </span>
                        <?php } ?>
                    </h2><?php endif; ?>
                </header>

                <div class="dt-testimonial-slider">
                    <div class="swiper-wrapper">

                        <?php foreach ( $dt_testimonial_page as $dt_testimonial_page_key => $dt_testimonial_page_value ) :
                            $dt_testimonial_page_id = esc_attr( $dt_testimonial_page_value['page'] ); ?>

                            <div class="swiper-slide">
                                <div class="dt-testimonial-holder">
                                    <?php

                                    $dt_service_post = get_post( $dt_testimonial_page_id );
                                    $dt_service_page_content = apply_filters( 'the_content', $dt_service_post->post_content );
                                    $postOutput = preg_replace( '/<img[^>]+./','', $dt_service_page_content );

                                    $dt_testimonial_page_trimmed_content = wp_trim_words( $postOutput, 250, '...' );

                                    ?>

                                    <div class="dt-testimonial-desc">
                                        <p><?php echo esc_attr( $dt_testimonial_page_trimmed_content ); ?></p>
                                    </div>

                                    <div class="dt-testimonial-meta">
                                        <figure>
                                            <a href="<?php echo esc_url( get_the_permalink( $dt_testimonial_page_id ) ); ?>">

                                                <?php
                                                $dt_testimonial_page_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $dt_testimonial_page_id ), 'glow-service-img' );
                                                $dt_testimonial_page_thumbnail_url = $dt_testimonial_page_thumbnail_src[0];
                                                ?>

                                                <img src="<?php echo esc_url( $dt_testimonial_page_thumbnail_url ); ?>" alt="<?php echo esc_attr( get_the_title( $dt_testimonial_page_id ) ); ?>">
                                            </a>
                                        </figure>

                                        <h5><?php echo esc_attr( get_the_title( $dt_testimonial_page_id ) ); ?></h5>
                                    </div><!-- .dt-testimonial-meta -->
                                </div><!-- .dt-testimonial-holder -->
                            </div><!-- .swiper-slide -->

                        <?php endforeach; ?>

                    </div><!-- .swiper-wrapper -->

                    <!-- Add Arrows -->
                    <div class="swiper-button-next transition5"><i class="fa fa-angle-right"></i></div>
                    <div class="swiper-button-prev transition5"><i class="fa fa-angle-left"></i></div>
                </div><!-- .dt-testimonial-slider -->
            </div>
        </div>

        <?php
        echo $args['after_widget'];
    }

    function config( ){
       
            $limit = 3;
        

        $fields = array(
            array(
                'type' =>'text',
                'name' => 'title',
                'label' => esc_html__( 'Title', 'glow' ),
            ),

            array(
                'type' =>'text',
                'name' => 'description',
                'label' => esc_html__( 'Description', 'glow' ),
            ),

            array(
                'type' =>'icon',
                'name' => 'icon',
                'default' => 'fa fa-pagelines',
                'label' => esc_html__( 'Icon ', 'glow' ),
            ),

            array(
                'type' =>'group',
                'name' => 'dt_testimonial_page',
                'label'    => esc_html__( 'Services', 'glow' ),
                'title_id' => 'page',
                'limit' => $limit,
                'limit_msg' => esc_html__( 'Please Upgrade to Pro version to add unlimited items.', 'glow' ),
                'fields' => array(
                    array(
                        'type' =>'source',
                        'name' => 'page',
                        'label' => esc_html__( 'Page', 'glow' ),
                        'source' => array(
                            'post_type' => 'page', // or any post type
                        )
                    ),

                )
            ),

        );

        return $fields;
    }


}
