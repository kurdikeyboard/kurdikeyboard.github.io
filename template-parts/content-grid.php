<div class="eq-col">
    <div class="dt-services-holder">
        <figure>
            <a href="<?php echo esc_url( get_the_permalink( ) ); ?>">
                <?php
                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id(  ), 'glow-service-img' );
                $thumbnail_src = $thumbnail_src[0];
                ?>
                <img src="<?php echo esc_url( $thumbnail_src ); ?>" alt="<?php echo esc_attr( get_the_title(  ) ); ?>">
            </a>
            <a href="<?php echo esc_url( get_the_permalink(  ) ); ?>"><span class="transition35"><i class="fa fa-mail-forward"></i></span></a>
        </figure>

        <header class="dt-services-header transition5">
            <h3><a href="<?php echo esc_url( get_the_permalink( ) ); ?>"><?php echo esc_attr( get_the_title( ) ); ?></a></h3>
            <?php
            $content = apply_filters( 'the_content', get_the_content() );
            $content = preg_replace( '/<img[^>]+./','', $content );
            $content = wp_trim_words( $content, 16, '...' );
            ?>
            <p><?php echo esc_attr( $content ); ?></p>
        </header><!-- .dt-services-header -->
    </div><!-- .dt-services-holder -->
</div>
