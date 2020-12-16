<?php
/**
 * Services
 */
class Glow_Services_Widget extends Widget_Ultimate_Widget_Base {

    public function __construct() {

        parent::__construct(
            'glow_services',
            __( 'Glow: Services', 'glow' ),
            array(
                'description'   => __( 'Show Service pages with shot description and featured image', 'glow' ),
                'customize_selective_refresh' => true,
            )
        );

    }

    function config( ){

        $fields = array(
            array(
                'type' =>'text',
                'name' => 'title',
                'label' => esc_html__( 'Title', 'glow' ),
                'default' => esc_html__( 'Our Services', 'glow' ),
            ),

            array(
                'type' =>'text',
                'name' => 'description',
                'label' => esc_html__( 'Description', 'glow' ),
                'default' => __( 'At the Beauty Parlour, we believe in beauty with a conscience. We have created a salon that offers the highest quality hair services in a setting that is healthier for the environment, our guests and our staff.', 'glow' ),
            ),

            array(
                'type' =>'icon',
                'name' => 'icon',
                'default' => 'fa fa-pagelines',
                'label' => esc_html__( 'Icon ', 'glow' ),
            ),

            array(
                'type' =>'select',
                'name' => 'data_type',
                'default' => 'pages',
                'label' => esc_html__( 'Data Type', 'glow' ),
                'desc' => esc_html__( 'Chose List Pages or Page have children.', 'glow' ),
                'options' => array(
                    'pages'   => esc_html__( 'List Pages', 'glow' ),
                    'parent_page'   => esc_html__( 'Page have children', 'glow' ),
                ),
            ),

            array(
                'type' =>'source',
                'name' => 'page',
                'label' => esc_html__( 'Service Page', 'glow' ),
                'desc' => esc_html__( 'Select a page which have have children pages.', 'glow' ),
                'source' => array(
                    'post_type' => 'page', // or any post type
                ),
                'required' => array(
                    'when' => 'data_type' ,
                    'is' => 'parent_page'
                ),
            ),

            array(
                'type' =>'group',
                'name' => 'dt_service_page',
                'label'    => esc_html__( 'Service Pages', 'glow' ),
                'title_id' => 'page',
                'required' => array(
                    'when' => 'data_type' ,
                    'is' => 'pages'
                ),
                //'limit' => $limit,
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

            array(
                'type' =>'select',
                'name' => 'layout',
                'default' => 3,
                'label' => esc_html__( 'Layout Column', 'glow' ),
                'options' => array(
                    1  => 1,
                    2  => 2,
                    3  => 3,
                    4  => 4,
                ),
            ),

        );

        return $fields;
    }

    function the_loop( $p ) {
        ?>
        <div class="eq-col">
            <div class="dt-services-holder">
                <figure>
                    <a href="<?php echo esc_url( get_the_permalink( $p->ID ) ); ?>">
                        <?php
                        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'glow-service-img' );
                        $thumbnail_src = $thumbnail_src[0];
                        ?>
                        <img src="<?php echo esc_url( $thumbnail_src ); ?>" alt="<?php echo esc_attr( get_the_title( $p->ID ) ); ?>">
                    </a>
                    <a href="<?php echo esc_url( get_the_permalink( $p->ID ) ); ?>"><span class="transition35"><i class="fa fa-mail-forward"></i></span></a>
                </figure>

                <header class="dt-services-header transition5">
                    <h3><a href="<?php echo esc_url( get_the_permalink( $p->ID ) ); ?>"><?php echo esc_attr( get_the_title( $p->ID ) ); ?></a></h3>
                    <?php
                    $content = apply_filters( 'the_content', $p->post_content );
                    $content = preg_replace( '/<img[^>]+./','', $content );
                    $content = wp_trim_words( $content, 16, '...' );
                    ?>
                    <p><?php echo esc_attr( $content ); ?></p>
                </header><!-- .dt-services-header -->
            </div><!-- .dt-services-holder -->
        </div>
        <?php
    }

    public function widget( $args, $instance ) {
        $instance = $this->setup_default_values( $instance, $this->get_configs() );
        $instance = wp_parse_args( $instance, array(
            'title'             => '',
            'description'       => '',
            'dt_service_page'   => '',
            'layout'            => '',
            'data_type'         => '',
            'page'              => '',
            'icon'              => '',
        ) );

        $title              = $instance['title'];
        $description        = $instance['description'];
        $services           = $instance['dt_service_page'];
        $layout             = absint( $instance['layout'] );
        if ( ! $layout ) {
            $layout = 3;
        }
        $icon = $instance['icon'] ? $instance['icon'] : 'fa fa-pagelines';

        echo $args['before_widget'];
        ?>

        <div class="dt-services widget-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <header class="dt-entry-header">
                            <?php if( ! empty( $title ) ) : ?><h2 class="widget-title"><?php echo $title; ?>
                                <?php if ( $icon ) { ?>
                                <span><i class="<?php echo esc_attr( $icon ); ?>"></i> </span>
                                <?php } ?>
                                </h2><?php endif; ?>
                            <?php if( ! empty( $description ) ) : ?><p><?php echo $description; ?></p><?php endif; ?>
                        </header><!-- .dt-services-meta -->

                        <div class="dt-services-wrap eq-row-col-<?php echo $layout; ?>">
                            <?php
                            if ( $instance['data_type'] == 'parent_page' ) {
                                $pages = false;
                                if ( $instance['page'] && is_numeric( $instance['page'] ) ) {
                                    $pages = get_posts( array(
                                        'post_type'      => 'page',
                                        'post_parent'    => $instance['page'],
                                        'posts_per_page' => -1,
                                        'orderby'        => 'menu_order',
                                        'order'          => 'ASC'
                                    ) );
                                }

                                if ( $pages ) {
                                    foreach ( $pages as $p ) {
                                        $this->the_loop( $p );
                                    } // end loop pages

                                } // end if pages

                            } else {
                                foreach ( $services as $page_key => $service ) {
                                    $page_id = absint( $service['page'] );
                                    $p = get_post( $page_id );
                                    if ( $p ) {
                                        $this->the_loop( $p );
                                    } // end if p
                                }
                            }
                            ?>
                            <div class="clearfix"></div>
                        </div><!-- .dt-services-wrap -->
                    </div><!-- .col-lg-12 .col-md-12 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div>
        <?php
        echo $args['after_widget'];
    }

}