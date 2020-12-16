<?php
/**
 * Services
 */
class Glow_Team_Widget extends Widget_Ultimate_Widget_Base {

    public function __construct() {

        parent::__construct(
            'glow_team',
            __( 'Glow: Team', 'glow' ),
            array(
                'description'   => __( 'Show Team pages with shot description and featured image', 'glow' ),
                'customize_selective_refresh' => true,
            )
        );

    }

    function config( ){
       
            $limit = 2;
        

        $fields = array(
            array(
                'type' =>'text',
                'name' => 'title',
                'default' => __( 'Meet Our Experts', 'glow' ),
                'label' => esc_html__( 'Title', 'glow' ),
            ),

            array(
                'type' =>'text',
                'name' => 'description',
                'default' => __( 'The people of Glow Spa behind us', 'glow' ),
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
                'name' => 'members',
                'label'    => esc_html__( 'Members', 'glow' ),
                'title_id' => 'name',
                'limit' => $limit,
                'limit_msg' => esc_html__( 'Please Upgrade to Pro version to add unlimited members.', 'glow' ),
                'default' => array(
                    array(
                        'name' => __( 'Peter Mendez', 'glow' ),
                        'avatar' => get_template_directory_uri().'/images/team1.jpg',
                        'position' => __( 'Beauty Therapist', 'glow' ),
                        'desc' => __( 'Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.', 'glow' ),
                        'facebook' => '#',
                        'twitter' => '#',
                        'youtube' => '#',
                        'website' => '#',
                    ),
                    array(
                        'name' => __( 'Harry Allen', 'glow' ),
                        'avatar' => get_template_directory_uri().'/images/team2.jpg',
                        'position' => __( 'Hairdresser', 'glow' ),
                        'desc' => __( 'Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.', 'glow' ),
                        'facebook' => '#',
                        'twitter' => '#',
                        'youtube' => '#',
                        'website' => '#',
                    ),
                ),
                'fields' => array(
                    array(
                        'type' =>'text',
                        'name' => 'name',
                        'label' => esc_html__( 'Name', 'glow' ),
                    ),
                    array(
                        'type' =>'text',
                        'name' => 'position',
                        'label' => esc_html__( 'Position', 'glow' ),
                    ),
                    array(
                        'type' =>'image',
                        'name' => 'avatar',
                        'label' => esc_html__( 'Avatar', 'glow' ),
                    ),
                    array(
                        'type' =>'text',
                        'name' => 'desc',
                        'label' => esc_html__( 'Description', 'glow' ),
                    ),
                    array(
                        'type' =>'text',
                        'name' => 'facebook',
                        'label' => esc_html__( 'Facebook URL', 'glow' ),
                    ),
                    array(
                        'type' =>'text',
                        'name' => 'twitter',
                        'label' => esc_html__( 'Twitter URL', 'glow' ),
                    ),
                    array(
                        'type' =>'text',
                        'name' => 'youtube',
                        'label' => esc_html__( 'Youtube URL', 'glow' ),
                    ),
                    array(
                        'type' =>'text',
                        'name' => 'instagram',
                        'label' => esc_html__( 'Instagram URL', 'glow' ),
                    ),
                    array(
                        'type' =>'text',
                        'name' => 'pinterest',
                        'label' => esc_html__( 'Pinterest URL', 'glow' ),
                    ),
                    array(
                        'type' =>'text',
                        'name' => 'website',
                        'label' => esc_html__( 'Website URL', 'glow' ),
                    ),

                )
            ),

            array(
                'type' =>'select',
                'name' => 'layout',
                'default' => 2,
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
            'members' => '',
            'layout' => '',
            'icon' => '',
        ) );

        $title             = $instance['title'];
        $description       = $instance['description'];
        $members           = $instance['members'];
        $layout            = absint( $instance['layout'] );
        if ( ! $layout ) {
            $layout = 2;
        }
        $icon = $instance['icon'] ? $instance['icon'] : 'fa fa-pagelines';

        echo $args['before_widget'];
        ?>
        <div class="widget-padding dt-team-members">
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

                        <div class="dt-services-wrap eq-row-col-<?php echo $layout; ?>">

                            <?php foreach (( array )$members as $member) {
                                $member = wp_parse_args($member, array(
                                    'name' => '',
                                    'position' => '',
                                    'avatar' => '',
                                    'desc' => '',
                                    'facebook' => '',
                                    'twitter' => '',
                                    'youtube' => '',
                                    'instagram' => '',
                                    'pinterest' => '',
                                    'website' => '',
                                ));

                                $image =  $this->get_image( $member['avatar'] );
                                $socials = array();
                                if ($member['facebook']) {
                                    $socials['facebook'] = '<a href="' . esc_url($member['facebook']) . '" target="_blank"><i class="fa fa-facebook"></i></a>';
                                }
                                if ($member['twitter']) {
                                    $socials['twitter'] = '<a href="' . esc_url($member['twitter']) . '" target="_blank"><i class="fa fa-twitter"></i></a>';
                                }
                                if ($member['youtube']) {
                                    $socials['youtube'] = '<a href="' . esc_url($member['youtube']) . '" target="_blank"><i class="fa fa-youtube"></i></a>';
                                }
                                if ($member['instagram']) {
                                    $socials['instagram'] = '<a href="' . esc_url($member['instagram']) . '" target="_blank"><i class="fa fa-instagram"></i></a>';
                                }
                                if ($member['pinterest']) {
                                    $socials['pinterest'] = '<a href="' . esc_url($member['pinterest']) . '" target="_blank"><i class="fa fa-pinterest"></i></a>';
                                }
                                if ($member['website']) {
                                    $socials['website'] = '<a href="' . esc_url($member['website']) . '" target="_blank"><i class="fa fa-globe"></i></a>';
                                }
                                ?>
                                <div class="eq-col team__member">
                                    <div class="member-wrapper">
                                        <div class="member-info">
                                            <?php if ($image) { ?>
                                                <div class="member-avatar">
                                                    <span><img alt="<?php echo esc_attr($member['name']); ?>" src="<?php echo esc_url($image); ?>"></span>
                                                </div>
                                            <?php } ?>
                                            <h3 class="member-name"><?php echo esc_html($member['name']); ?></h3>
                                            <div class="member-role"><?php echo esc_html($member['position']); ?></div>
                                            <div class="member-intro"><?php echo wp_kses_post($member['desc']); ?></div>
                                            <?php if ( ! empty( $socials ) ) { ?>
                                                <ul class="member-social">
                                                    <?php
                                                    foreach ($socials as $s) {
                                                        echo '<li>' . $s . '</li>';
                                                    }
                                                    ?>
                                                </ul>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } // loop members
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