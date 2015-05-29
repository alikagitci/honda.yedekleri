<?php
global $porto_settings, $porto_layout;
?>
<header id="header" class="header-9 <?php echo $porto_settings['search-size'] ?> sticky-menu-header">
    <div class="header-main<?php if ($porto_settings['show-minicart'] && class_exists('WooCommerce')) echo ' show-minicart' ?>">

        <div class="side-top">
            <div class="container">
                <?php
                // show currency and view switcher
                $currency_switcher = porto_currency_switcher();
                $view_switcher = porto_view_switcher();
                $minicart = porto_minicart();

                echo $currency_switcher;

                echo $view_switcher;

                echo $minicart;
                ?>
            </div>
        </div>

        <div class="container">
            <div class="header-left">
                <?php // show logo ?>
                <h1 class="logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
                        <?php if($porto_settings['logo'] && $porto_settings['logo']['url']) {
                            echo '<img class="img-responsive" src="' . esc_url(str_replace( array( 'http:', 'https:' ), '', $porto_settings['logo']['url'])) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />';
                        } else {
                            bloginfo( 'name' );
                        } ?>
                    </a>
                </h1>
            </div>

            <div class="header-center">
                <?php
                $sidebar_menu = porto_sidebar_menu();
                if ($sidebar_menu) :
                    // show toggle menu
                    echo $sidebar_menu;
                endif;
                ?>

                <?php
                // show search form
                echo porto_search_form();
                // show mobile toggle
                ?>
                <a class="mobile-toggle"><i class="fa fa-reorder"></i></a>

                <?php
                // show top navigation
                $top_nav = porto_mobile_top_navigation();
                echo $top_nav;
                ?>
            </div>

            <div class="header-right">
                <div class="side-bottom">
                    <?php
                    // show contact info and mini cart
                    $contact_info = $porto_settings['header-contact-info'];

                    if ($contact_info)
                        echo '<div class="header-contact">' . force_balance_tags($contact_info) . '</div>';
                    ?>

                    <?php
                    // show social links
                    echo porto_header_socials();
                    ?>

                    <?php
                    // show copyright
                    $copyright = $porto_settings['header-copyright'];

                    if ($copyright)
                        echo '<div class="header-copyright">' . force_balance_tags($copyright) . '</div>';
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php /*if ($porto_settings['show-header-top']) : ?>
        <div class="header-top">
            <div class="container">
                <div class="header-left">
                    <?php
                    // show social links
                    echo porto_header_socials();
                    ?>
                </div>
                <div class="header-right">
                    <?php


                    if ($porto_settings['welcome-msg'])
                        echo '<span class="welcome-msg">' . force_balance_tags($porto_settings['welcome-msg']) . '</span>';

                    if ($porto_settings['welcome-msg'] && $top_nav)
                        echo '<span class="gap">|</span>';


                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="header-main">
        <div class="container">
            <div class="header-left">

            </div>
            <div class="header-center">

                <a class="mobile-toggle"><i class="fa fa-reorder"></i></a>
            </div>
            <div class="header-right">
                <div class="<?php if ($porto_settings['show-minicart'] && class_exists('WooCommerce')) echo 'header-minicart'.str_replace('minicart', '', $porto_settings['minicart-type']) ?>">
                    <?php

                    $minicart = porto_minicart();
                    echo $minicart;
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    */ ?>
</header>