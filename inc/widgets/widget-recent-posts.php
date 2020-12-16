<?php
/**
 * News Recent Posts
 */
class Glow_Recent_Posts extends Widget_Ultimate_Widget_Base {

    public function __construct() {

        parent::__construct(
            'glow_recent_posts',
            __( 'Glow: Front Recent Posts', 'glow' ),
            array(
                'description'   => __( 'Posts display widget for recently published post', 'glow' ),
                'customize_selective_refresh' => true,
            )
        );
    }

    function config(){
        $fields = array(
            array(
                'type' =>'text',
                'name' => 'title',
                'label' => esc_html__( 'Title', 'glow' ),
                'default' => esc_html__( 'Recent Posts from Blog', 'glow' ),
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
                'type' =>'source',
                'name' => 'category',
                'source' => array(
                    'tax' => 'category'
                ),
                'default' => '',
                'label' => esc_html__( 'Category ', 'glow' ),
            ),
            array(
                'type' =>'text',
                'name' => 'no_of_posts',
                'label' => esc_html__( 'No. of Posts', 'glow' ),
            ),

            array(
                'type' =>'select',
                'name' => 'layout',
                'default' => '3',
                'options' => array(
                    1 => 1,
                    2 => 2,
                    3 => 3,
                    4 => 4,

                ),
                'label' => esc_html__( 'Layout Column', 'glow' ),
            ),

        );

        return $fields;
    }

    public function widget( $args, $instance ) {
        $instance = $this->setup_default_values( $instance, $this->get_configs() );
        $instance = wp_parse_args( $instance, array(
            'title' => '',
            'category' => '',
            'layout' => '',
            'no_of_posts' => '',
            'description' => '',
        ) );

        global $post;
        $title          = isset( $instance['title'] ) ? $instance['title'] : '';
        $category       = isset( $instance['category'] ) ? $instance['category'] : '';
        $no_of_posts    = isset( $instance['no_of_posts'] ) ? $instance['no_of_posts'] : '';
        $description    = $instance['description'];
        $layout         = absint( $instance['layout'] );
        if ( ! $layout ) {
            $layout = 3;
        }
        $icon = $instance['icon'] ? $instance['icon'] : 'fa fa-pagelines';

        $news_layout1 = new WP_Query( array(
            'post_type'         => 'post',
            'category__in'      => $category,
            'posts_per_page'    => $no_of_posts,
        ) );

        echo $args['before_widget'];
        ?>

        <div class="widget-padding dt-news-layout-wrap">
            <?php
            if ( $news_layout1->have_posts() ) : ?>

                <header class="dt-widget-header dt-entry-header">
                <?php if( ! empty( $title ) ) : ?><h2 class="widget-title"><?php echo $title; ?>
                    <?php if ( $icon ) { ?>
                        <span><i class="<?php echo esc_attr( $icon ); ?>"></i> </span>
                    <?php } ?>
                    </h2><?php endif; ?>
                <?php if( ! empty( $description ) ) : ?><p><?php echo $description; ?></p><?php endif; ?>
                </header>

                <div class="container">
                    <div class="eq-row-col-<?php echo $layout; ?>">

                        <?php while ( $news_layout1->have_posts() ) : $news_layout1->the_post(); ?>

                            <div class="eq-col">
                                <div class="dt-recent-post-holder">
                                    <figure class="transition35">
                                        <?php

                                        if ( has_post_thumbnail() ) :
                                            $image = '';
                                            $title_attribute = get_the_title( $post->ID );
                                            $image .= '<a href="'. esc_url( get_permalink() ) . '" title="' . esc_attr( the_title( '', '', false ) ) .'">';
                                            $image .= get_the_post_thumbnail( $post->ID, 'glow-service-img', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                                            echo $image;

                                        else : ?>

                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/blank.png" alt="<?php _e( 'no image found', 'glow' ); ?>"/>

                                        <?php endif; ?>

                                    </figure><!-- .dt-recent-post-img -->

                                    <div class="dt-recent-post-content">
                                        <h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

                                        <p><?php

                                            $excerpt = get_the_excerpt();
                                            $limit   = "140";
                                            $pad     = "...";

                                            if( strlen( $excerpt ) <= $limit ) {
                                                echo esc_attr( $excerpt );
                                            } else {
                                                $excerpt = substr( $excerpt, 0, $limit ) . $pad;
                                                echo esc_attr( $excerpt );
                                            }

                                            ?></p>
                                    </div><!-- .dt-recent-post-content -->
                                </div><!-- .dt-recent-post-holder -->
                            </div>

                        <?php endwhile; ?>

                    </div>
                </div>

            <?php else : ?>
                <p><?php _e( 'Sorry, no posts found in selected category.', 'glow' ); ?></p>
            <?php endif; ?>

            <div class="clearfix"></div>
        </div><!-- .dt-news-layout-wrap -->

        <?php
        echo $args['after_widget'];
    }

}