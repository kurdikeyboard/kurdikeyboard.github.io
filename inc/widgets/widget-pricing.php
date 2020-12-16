<?php
/**
 * Services
 */
class Glow_Pricing_Widget extends Widget_Ultimate_Widget_Base {

    public function __construct() {

        parent::__construct(
            'glow_pricing',
            __( 'Glow: Pricing', 'glow' ),
            array(
                'description'   => __( 'Show Pricing pages with shot description and featured image', 'glow' ),
                'customize_selective_refresh' => true,
            )
        );

    }

    function config( ){
       
            $limit = 3;
        

        $fields = array(
            array(
                'type' =>'text',
                'name' => 'title',
                'default' => __( 'Glow Spa Packages', 'glow' ),
                'label' => esc_html__( 'Title', 'glow' ),
            ),

            array(
                'type' =>'text',
                'name' => 'description',
                'default' => __( 'Experience the Art of Caring', 'glow' ),
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
                'name' => 'plans',
                'label'    => esc_html__( 'Services', 'glow' ),
                'title_id' => 'title',
                'limit' => $limit,
                'limit_msg' => esc_html__( 'Please Upgrade to Pro version to add unlimited items.', 'glow' ),
                'default' => array(
                    array(
                        'title' => __( 'Style', 'glow' ),
                        'banner' => get_template_directory_uri().'/images/pricing_header1.jpg',
                        'desc' => __( 'Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'glow' ),
                        'options' => __( "Shampoo, cut and blowdry style $40+\nShampoo and deluxe style $40+\nHair Extensions by consultation\nSpecial Occasion Design $50+\n", 'glow' ),
                        'button_label' => __( 'Get Started', 'glow' ),
                        'button_link' => '#',
                        'button_style' => 'default',
                    ),
                    array(
                        'title' => __( 'Relaxing - $89/m', 'glow' ),
                        'banner' => get_template_directory_uri().'/images/pricing_header1.jpg',
                        'desc' => __( 'Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'glow' ),
                        'options' => __( "Ncreases The Energy Level.\nPracticing Meditation On A Daily Basis.\nPrimordial Sound Meditation Uses.\nMeditation Is A Tool For Rediscovering.", 'glow' ),
                        'button_label' => __( 'Contact Us', 'glow' ),
                        'button_link' => '#',
                        'button_style' => 'default',
                    ),
                    array(
                        'title' => __( 'Makeup', 'glow' ),
                        'banner' => get_template_directory_uri().'/images/pricing_header3.jpg',
                        'desc' => __( 'Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'glow' ),
                        'options' => __( "Brow Shaping $15\nLip, Chin or Neckline Wax $5+\nLash or Brow Tint $15\nLash Retouch Service $25 - $50", 'glow' ),
                        'button_label' => __( 'Book Now', 'glow' ),
                        'button_link' => '#',
                        'button_style' => 'default',
                    ),

                ),
                'fields' => array(
                    array(
                        'type' =>'text',
                        'name' => 'title',
                        'label' => esc_html__( 'Title', 'glow' ),
                    ),

                    array(
                        'type' =>'image',
                        'name' => 'banner',
                        'label' => esc_html__( 'Banner', 'glow' ),
                    ),
                    array(
                        'type' =>'textarea',
                        'name' => 'desc',
                        'label' => esc_html__( 'Description', 'glow' ),
                    ),
                    array(
                        'type' =>'textarea',
                        'name' => 'options',
                        'label' => esc_html__( 'Pricing Option', 'glow' ),
                        'desc' => esc_html__( 'Each option per line.', 'glow' ),
                    ),
                    array(
                        'type' =>'text',
                        'name' => 'button_label',
                        'label' => esc_html__( 'Button Label', 'glow' ),
                    ),
                    array(
                        'type' =>'text',
                        'name' => 'button_link',
                        'label' => esc_html__( 'Button URL', 'glow' ),
                    ),
                    array(
                        'type' =>'select',
                        'name' => 'button_style',
                        'label' => esc_html__( 'Button Style', 'glow' ),
                        'options' => array(
                            'default' => __( 'Default', 'glow' ),
                            'primary' => __( 'Primary', 'glow' ),
                            'secondary' => __( 'Secondary', 'glow' ),
                            'success' => __( 'Success', 'glow' ),
                            'info' => __( 'Info', 'glow' ),
                            'warning' => __( 'Warning', 'glow' ),
                            'danger' => __( 'Danger', 'glow' ),
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

    public function widget( $args, $instance ) {
        $instance = $this->setup_default_values( $instance, $this->get_configs() );
        $instance = wp_parse_args( $instance, array(
            'title' => '',
            'description' => '',
            'plans' => '',
            'layout' => '',
            'icon' => '',
        ) );

        $title              = $instance['title'];
        $description        = $instance['description'];
        $pricing_tables     = $instance['plans'];
        $layout             = absint( $instance['layout'] );
        if ( ! $layout ) {
            $layout = 3;
        }
        $icon = $instance['icon'] ? $instance['icon'] : 'fa fa-pagelines';

        echo $args['before_widget'];
        ?>
        <div class="widget-padding dt-pricing">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <header class="dt-widget-header dt-entry-header">
                            <?php if( ! empty( $title ) ) : ?><h2 class="widget-title"><?php echo $title; ?>
                                <?php if ( $icon ) { ?>
                                <span><i class="<?php echo esc_attr( $icon ); ?>"></i> </span>
                                <?php } ?>
                                </h2><?php endif; ?>
                            <?php if( ! empty( $description ) ) : ?><p><?php echo $description; ?></p><?php endif; ?>
                        </header><!-- .dt-services-meta -->

                        <div class="dt-pricing-wrap ">
                            <?php if ( ! empty( $pricing_tables ) ) { ?>
                                <div class="eq-row-col-<?php echo $layout; ?> grid-row pricing-area pricing__tables">
                                    <?php
                                    foreach ( $pricing_tables as $k => $table ) {
                                        $table = wp_parse_args( $table, array(
                                            'title'         => '',
                                            'banner'        => '',
                                            'desc'          => '',
                                            'options'       => '',
                                            'button_link'   => '',
                                            'button_label'  => '',
                                            'button_style'  => '',
                                        ) );

                                        $image = $this->get_image( $table['banner'] );
                                        if ( ! $table['button_label'] ) {
                                            $table['button_label'] = esc_html__( 'Get Started', 'glow' );
                                        }

                                        ?>
                                        <div class=" pricing__table eq-col">
                                            <div class="pricing-item">
                                                <div class="pricing_header">
                                                    <div class="pricing_header_image">
                                                        <?php if ( $image ) { ?>
                                                            <img src="<?php echo esc_url( $image ); ?>" alt="">
                                                        <?php } ?>
                                                        <h2 class="pricing_title"><?php echo wp_kses_post( $table['title'] ); ?></h2>
                                                    </div>
                                                </div>
                                                <div class="pricing_content">
                                                    <?php if ( $table['desc'] ){ ?>
                                                        <div class="pricing_sentense"><?php echo wp_kses_post( $table['desc'] ); ?></div>
                                                    <?php } ?>
                                                    <?php
                                                    $items = explode( "\n", $table['options'] );
                                                    $items = array_map( 'trim', $items );
                                                    $items = array_filter( $items );
                                                    $button_class = '';
                                                    if ( $table['button_style'] == 'default' ) {
                                                        $button_class = 'p_button';
                                                    } else {
                                                        $button_class = 'btn btn-'.$table['button_style'];
                                                    }
                                                    if ( ! empty( $items ) ) {
                                                        ?>
                                                        <ul class="pricing_features">
                                                            <?php foreach( $items as $i ){ ?>
                                                                <li><?php echo wp_kses_post( $i ); ?></li>
                                                            <?php } ?>
                                                        </ul>
                                                    <?php } ?>
                                                    <div class="pricing_button">
                                                        <a href="<?php echo esc_url( $table['button_link'] ); ?>" class="<?php echo esc_attr( $button_class ); ?>"><?php echo esc_html( $table['button_label'] ); ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } // end if have pricing tables ?>

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