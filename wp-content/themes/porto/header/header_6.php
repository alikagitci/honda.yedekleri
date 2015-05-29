<?php
global $porto_settings, $porto_layout;

$minicart_type = $porto_settings['minicart-type'];
?>
<header id="header" class="header-6 <?php echo $porto_settings['search-size'] ?>">
    <?php if ($porto_settings['show-header-top']) : ?>
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
                // show welcome message
                if ($porto_settings['welcome-msg'])
                    echo '<span class="welcome-msg">' . force_balance_tags($porto_settings['welcome-msg']) . '</span>';
                ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="header-main">
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
                <div id="main-menu">
                    <?php
                    // show main menu
                    echo porto_main_menu();
                    ?>
                </div>
            </div>
            <div class="header-right search-popup">
                <div class="<?php if ($porto_settings['show-minicart'] && class_exists('WooCommerce')) echo 'header-minicart'.str_replace('minicart', '', $minicart_type) ?>">
                    <?php // show mobile toggle ?>
                    <a class="mobile-toggle"><i class="fa fa-reorder"></i></a>
                    <div class="block-nowrap">
                        <?php
                        // show top navigation
                        $top_nav = porto_top_navigation();
                        echo $top_nav;

                        // show search form
                        echo porto_search_form();
                        ?>
                    </div>

                    <br class="mobile-hide" />

                    <?php
                    // show currency and view switcher
                    $currency_switcher = porto_currency_switcher();
                    $view_switcher = porto_view_switcher();

                    if ($currency_switcher || $view_switcher)
                        echo '<div class="switcher-wrap">';

                    echo $currency_switcher;

                    echo $view_switcher;

                    if ($currency_switcher || $view_switcher)
                        echo '</div>';

                    // show mini cart
                    $minicart = porto_minicart();
                    echo $minicart;
                    ?>
                </div>
            </div>
        </div>
    </div>
</header>