<?php

/**
 * Porto Settings Options
 */

if (!class_exists('Redux_Framework_porto_settings')) {

    class Redux_Framework_porto_settings {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        function compiler_action($options, $css, $changed_values) {

        }

        function dynamic_section($sections) {

            return $sections;
        }

        function change_arguments($args) {

            return $args;
        }

        function change_defaults($defaults) {

            return $defaults;
        }

        function remove_demo() {

        }

        public function setSections() {

            $porto_layouts = porto_ct_layouts();
            $sidebars = porto_options_sidebars();
            $body_wrapper = porto_options_body_wrapper();
            $wrapper = porto_options_wrapper();

            $porto_demo_type = porto_demo_types();

            $porto_banner_pos = porto_ct_banner_pos();
            $porto_footer_view = porto_ct_footer_view();
            $porto_banner_type = porto_ct_banner_type();
            $porto_master_sliders = porto_ct_master_sliders();
            $porto_rev_sliders = porto_ct_rev_sliders();

            $porto_post_archive_layouts = porto_ct_post_archive_layouts();
            $porto_post_single_layouts = porto_ct_post_single_layouts();

            $porto_portfolio_archive_layouts = porto_ct_portfolio_archive_layouts();
            $porto_portfolio_single_layouts = porto_ct_portfolio_single_layouts();

            $porto_header_type = porto_options_header_types();
            $porto_footer_type = porto_options_footer_types();

            // General Settings
            $this->sections[] = array(
                'icon' => 'el-icon-dashboard',
                'icon_class' => 'icon',
                'title' => __('General', 'porto'),
                'fields' => array(

                    array(
                        'id'=>'wrapper',
                        'type' => 'button_set',
                        'title' => __('Body Wrapper', 'porto'),
                        'options' => $body_wrapper,
                        'default' => 'full'
                    ),

                    array(
                        'id'=>'layout',
                        'type' => 'button_set',
                        'title' => __('Page Layout', 'porto'),
                        'options' => $porto_layouts,
                        'default' => 'fullwidth'
                    ),

                    array(
                        'id'=>'sidebar',
                        'type' => 'select',
                        'title' => __('Select Sidebar', 'porto'),
                        'required' => array('layout','equals',$sidebars),
                        'data' => 'sidebars',
                        'default' => 'blog-sidebar'
                    ),

                    array(
                        'id'=>'show-breadcrumbs',
                        'type' => 'switch',
                        'title' => __('Show Breadcrumbs', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'show-pagetitle',
                        'type' => 'switch',
                        'title' => __('Show Page Title', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'header-wrapper',
                        'type' => 'button_set',
                        'title' => __('Header Wrapper', 'porto'),
                        'required' => array('wrapper','equals',array('full', 'wide')),
                        'options' => $wrapper,
                        'default' => 'full'
                    ),

                    array(
                        'id'=>'banner-wrapper',
                        'type' => 'button_set',
                        'title' => __('Banner Wrapper', 'porto'),
                        'required' => array('wrapper','equals',array('full', 'wide')),
                        'options' => $wrapper,
                        'default' => 'full'
                    ),

                    array(
                        'id'=>'footer-wrapper',
                        'type' => 'button_set',
                        'title' => __('Footer Wrapper', 'porto'),
                        'required' => array('wrapper','equals',array('full', 'wide')),
                        'options' => $wrapper,
                        'default' => 'full'
                    ),

                    array(
                        'id'=>'breadcrumbs-wrapper',
                        'type' => 'button_set',
                        'title' => __('Breadcrumbs Wrapper', 'porto'),
                        'required' => array('wrapper','equals',array('full', 'wide')),
                        'options' => $wrapper,
                        'default' => 'full'
                    ),

                    array(
                        'id'=>'show-content-type-skin',
                        'type' => 'switch',
                        'title' => __('Content Type Skin Options', 'porto'),
                        'desc' => __('Show skin options when edit post, page, product, portfolio, member.', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'show-category-skin',
                        'type' => 'switch',
                        'title' => __('Category Skin Options', 'porto'),
                        'desc' => __('Show skin options when edit the category of post, product, portfolio, member.', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Logo, Icons', 'porto')
                    ),

                    array(
                        'id'=>'logo',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Logo', 'porto'),
                        'default' => array(
                            'url' => porto_uri . '/images/logo/logo_charcoal.png'
                        )
                    ),

                    array(
                        'id'=>'favicon',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Favicon', 'porto'),
                        'default' => array(
                            'url' => porto_uri . '/images/logo/favicon.ico'
                        )
                    ),

                    array(
                        'id'=>'icon-iphone',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Apple iPhone Icon', 'porto'),
                        'desc' => __('Icon for Apple iPhone (57px X 57px)', 'porto'),
                        'default' => array(
                            'url' => porto_uri . '/images/logo/apple-touch-icon.png'
                        )
                    ),

                    array(
                        'id'=>'icon-iphone-retina',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Apple iPhone Retina Icon', 'porto'),
                        'desc' => __('Icon for Apple iPhone Retina (114px X 114px)', 'porto'),
                        'default' => array(
                            'url' => porto_uri . '/images/logo/apple-touch-icon_114x114.png'
                        )
                    ),

                    array(
                        'id'=>'icon-ipad',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Apple iPad Icon', 'porto'),
                        'desc' => __('Icon for Apple iPad (72px X 72px)', 'porto'),
                        'default' => array(
                            'url' => porto_uri . '/images/logo/apple-touch-icon_72x72.png'
                        )
                    ),

                    array(
                        'id'=>'icon-ipad-retina',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Apple iPad Retina Icon', 'porto'),
                        'desc' => __('Icon for Apple iPad Retina (144px X 144px)', 'porto'),
                        'default' => array(
                            'url' => porto_uri . '/images/logo/apple-touch-icon_144x144.png'
                        )
                    ),

                    array(
                        'id'=>'4',
                        'type' => 'info',
                        'desc' => __('Javascript Code', 'porto')
                    ),

                    array(
                        'id'=>'js-code',
                        'type' => 'ace_editor',
                        'title' => __('JS Code', 'porto'),
                        'subtitle' => __('Paste your JS code here.', 'porto'),
                        'mode' => 'javascript',
                        'theme' => 'chrome',
                        'default' => "jQuery(document).ready(function(){});"
                    )
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-download-alt',
                'icon_class' => 'icon',
                'title' => __('Import', 'porto'),
                'fields' => array(

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Default Theme Options', 'porto')
                    ),

                    array(
                        'id'=>'theme-type',
                        'type' => 'select',
                        'title' => __('Select Demo', 'porto'),
                        'desc' => __('If you want to <strong>import</strong> the changed options, you should click <strong>"Reset All"</strong> button after save.', 'porto'),
                        'options' => $porto_demo_type,
                        'default' => '_7'
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Import Dummy Data', 'porto')
                    ),

                    array(
                        'id'=>'import-master',
                        'type' => 'switch',
                        'title' => __('Import Master Slider', 'porto'),
                        'desc' => __('If you tried to import dummy data, the master sliders will be import. After change this option, you should click "Save Changes".', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'        => '17',
                        'type'      => 'raw',
                        'content'   => (isset($_GET['import_success'])?'<strong>' . __('Successfully Imported!', 'porto') . '</strong><br/><br/>':'').'<a href="'.admin_url('admin.php?page=porto_settings').'&import_sample_content=true" class="button button-primary">' . __('Import', 'porto') . '</a><br/><br/>'.__('If import is failed, please check your site and try again.', 'porto')
                    )
                )
            );

            // Skin
            $this->sections[] = array(
                'icon' => 'el-icon-broom',
                'icon_class' => 'icon',
                'title' => __('Skin', 'porto'),
                'fields' => array(

                    array(
                        'id'        => '17',
                        'type'      => 'info',
                        'title' => __('After save the changes, will be regenerate the css files (skin_' . get_current_blog_id() . '.css, skin_rtl_' . get_current_blog_id() . '.css) in ', 'porto') . '<strong>' . porto_dir . '/css</strong>.',
                    ),

                    array(
                        'id'=>'compile-css',
                        'type' => 'switch',
                        'title' => __('Compile CSS', 'porto'),
                        'default' => true
                    ),

                    array(
                        'id'=>'body-font',
                        'type' => 'typography',
                        'title' => __('Body Font', 'porto'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'default'=> array(
                            'color'=>"#777777",
                            'google'=>true,
                            'font-weight'=>'400',
                            'font-family'=>'Open Sans',
                            'font-size'=>'14px',
                            'line-height' => '22px'
                        ),
                    ),

                    array(
                        'id'=>'alt-font',
                        'type' => 'typography',
                        'title' => __('Alternative Font', 'porto'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'font-size' => false,
                        'text-align' => false,
                        'color' => false,
                        'line-height' => false,
                        'desc' => __('You can use css class name "alternative-font" when edit html element.', 'porto'),
                        'default'=> array(
                            'google'=>true,
                            'font-weight'=>'400',
                            'font-family'=>'Shadows Into Light',
                        ),
                    ),

                    array(
                        'id'=>'skin-color',
                        'type' => 'color',
                        'title' => __('Default Color', 'porto'),
                        'default' => '#65829d',
                        'validate' => 'color',
                    ),

                    array(
                        'id'        => '17',
                        'type'      => 'info',
                        'title' => '<h3>' . __('Compile CSS Files', 'porto') . '</h3>'
                            . (isset($_GET['compile_theme_success'])?'<strong>' . __('Theme CSS compiled successfully!', 'porto') . '</strong><br/><br/>':'')
                            . (isset($_GET['compile_theme_rtl_success'])?'<strong>' . __('Theme RTL CSS compiled successfully!', 'porto') . '</strong><br/><br/>':'')
                            . (isset($_GET['compile_plugins_success'])?'<strong>' . __('Plugins CSS compiled successfully!', 'porto') . '</strong><br/><br/>':'')
                            . (isset($_GET['compile_plugins_rtl_success'])?'<strong>' . __('Plugins RTL CSS compiled successfully!', 'porto') . '</strong><br/><br/>':'')
                            . '<a href="'.admin_url('admin.php?page=porto_settings').'&compile_theme=true" class="button button-primary">' . __('Theme CSS', 'porto') . '</a> '
                            . '<a href="'.admin_url('admin.php?page=porto_settings').'&compile_theme_rtl=true" class="button button-primary">' . __('Theme RTL CSS', 'porto') . '</a> '
                            . '<a href="'.admin_url('admin.php?page=porto_settings').'&compile_plugins=true" class="button button-primary">' . __('Plugins CSS', 'porto') . '</a> '
                            . '<a href="'.admin_url('admin.php?page=porto_settings').'&compile_plugins_rtl=true" class="button button-primary">' . __('Plugins RTL CSS', 'porto') . '</a> '
                            . '<br/><br/>' . __('Before compile, you should save the changed options', 'porto')
                            . '<br/>'
                            . __('After compile, will be regenerate the css files (theme_' . get_current_blog_id() . '.css, theme_rtl_' . get_current_blog_id() . '.css, plugins_' . get_current_blog_id() . '.css, plugins_rtl_' . get_current_blog_id() . '.css, skin_rtl_' . get_current_blog_id() . '.css) in ', 'porto') . '<strong>' . porto_dir . '/css</strong>.',
                    ),

                    array(
                        'id'=>'container-width',
                        'type' => 'button_set',
                        'title' => __('Container Max Width', 'porto'),
                        'options' => array(
                            '1024' => '1024px',
                            '1170' => '1170px',
                            '1280' => '1280px'
                        ),
                        'default' => '1170'
                    ),

                    array(
                        'id'=>'grid-gutter-width',
                        'type' => 'button_set',
                        'title' => __('Grid Gutter Width', 'porto'),
                        'options' => array(
                            '16' => '16px',
                            '20' => '20px',
                            '30' => '30px'
                        ),
                        'default' => '20'
                    ),

                    array(
                        'id'=>'border-radius',
                        'type' => 'switch',
                        'title' => __('Border Radius', 'porto'),
                        'default' => false
                    ),

                    array(
                        'id'=>'thumb-padding',
                        'type' => 'switch',
                        'title' => __('Thumbnail Padding', 'porto'),
                        'default' => false
                    ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Body, Page', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'body-bg',
                        'type' => 'background',
                        'title' => __('Body Background', 'porto')
                    ),

                    array(
                        'id'=>'content-bg',
                        'type' => 'background',
                        'title' => __('Page Background', 'porto')
                    ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Header', 'porto'),
                'fields' => array(

                    array(
                        'id'=>'header-bg',
                        'type' => 'background',
                        'title' => __('Background', 'porto'),
                        'default' => array(
                            'background-color' => '#ffffff'
                        )
                    ),

                    array(
                        'id'=>'sticky-header-bg',
                        'type' => 'background',
                        'title' => __('Sticky Header Background', 'porto'),
                        'default' => array(
                            'background-color' => '#ffffff'
                        )
                    ),

                    array(
                        'id'=>'header-text-color',
                        'type' => 'color',
                        'title' => __('Text Color', 'porto'),
                        'default' => '#777777',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'header-link-color',
                        'type' => 'link_color',
                        'active' => false,
                        'title' => __('Link Color', 'porto'),
                        'default' => array(
                            'regular' => '#777777',
                            'hover' => '#65829d',
                        )
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Background Opacity when banner show below header', 'porto')
                    ),

                    array(
                        'id'=>'header-opacity',
                        'type' => 'text',
                        'title' => __('Header Opacity', 'porto'),
                        'default' => '80%'
                    ),

                    array(
                        'id'=>'searchform-opacity',
                        'type' => 'text',
                        'title' => __('Search Form Opacity', 'porto'),
                        'default' => '50%'
                    ),

                    array(
                        'id'=>'menuwrap-opacity',
                        'type' => 'text',
                        'title' => __('Menu Wrap Opacity', 'porto'),
                        'default' => '30%'
                    ),

                    array(
                        'id'=>'menu-opacity',
                        'type' => 'text',
                        'title' => __('Menu Opacity', 'porto'),
                        'default' => '30%'
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Header Top', 'porto')
                    ),

                    array(
                        'id'=>'header-top-border',
                        'type' => 'border',
                        'all' => true,
                        'style' => false,
                        'title' => __('Top Border Width', 'porto'),
                        'default' => array('border-color' => '#56738e', 'border-top' => '4px')
                    ),

                    array(
                        'id'=>'header-top-bg-color',
                        'type' => 'color',
                        'title' => __('Background Color', 'porto'),
                        'default' => '#65829d',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'header-top-text-color',
                        'type' => 'color',
                        'title' => __('Text Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'header-top-link-color',
                        'type' => 'link_color',
                        'active' => false,
                        'title' => __('Link Color', 'porto'),
                        'default' => array(
                            'regular' => '#ffffff',
                            'hover' => '#eeeeee',
                        )
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Side Navigation', 'porto')
                    ),

                    array(
                        'id'=>'side-social-bg-color',
                        'type' => 'color',
                        'title' => __('Social Link Background Color', 'porto'),
                        'default' => '#9e9e9e',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'side-social-color',
                        'type' => 'color',
                        'title' => __('Social Link Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'side-copyright-color',
                        'type' => 'color',
                        'title' => __('Copyright Text Color', 'porto'),
                        'default' => '#777777',
                        'validate' => 'color',
                    ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Main Menu', 'porto'),
                'fields' => array(

                    array(
                        'id'=>'mainmenu-wrap-bg-color',
                        'type' => 'color',
                        'title' => __('Wrapper Background Color', 'porto'),
                        'default' => 'transparent',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'mainmenu-wrap-padding',
                        'type' => 'spacing',
                        'mode' => 'padding',
                        'title' => __('Wrapper Padding', 'porto'),
                        'default' => array('padding-top' => 0, 'padding-bottom' => 0, 'padding-left' => 0, 'padding-right' => 0)
                    ),

                    array(
                        'id'=>'mainmenu-bg-color',
                        'type' => 'color',
                        'title' => __('Background Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Top Level Menu Item', 'porto')
                    ),

                    array(
                        'id'=>'mainmenu-toplevel-link-color',
                        'type' => 'link_color',
                        'active' => false,
                        'title' => __('Link Color', 'porto'),
                        'default' => array(
                            'regular' => '#65829d',
                            'hover' => '#ffffff',
                        )
                    ),

                    array(
                        'id'=>'mainmenu-toplevel-hbg-color',
                        'type' => 'color',
                        'title' => __('Hover Background Color', 'porto'),
                        'default' => '#65829d',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'mainmenu-toplevel-padding1',
                        'type' => 'spacing',
                        'mode' => 'padding',
                        'title' => __('Padding on Desktop', 'porto'),
                        'desc' => __('if header type is like type 1 or type 4', 'porto'),
                        'default' => array('padding-top' => 10, 'padding-bottom' => 8, 'padding-left' => 15, 'padding-right' => 15)
                    ),

                    array(
                        'id'=>'mainmenu-toplevel-padding2',
                        'type' => 'spacing',
                        'mode' => 'padding',
                        'title' => __('Padding on Desktop (width > 991px)', 'porto'),
                        'desc' => __('if header type is like type 1 or type 4', 'porto'),
                        'default' => array('padding-top' => 10, 'padding-bottom' => 8, 'padding-left' => 12, 'padding-right' => 12)
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Menu Popup', 'porto')
                    ),

                    array(
                        'id'=>'mainmenu-popup-border',
                        'type' => 'switch',
                        'title' => __('Show Border', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'mainmenu-popup-border-color',
                        'type' => 'color',
                        'title' => __('Border Color', 'porto'),
                        'required' => array('mainmenu-popup-border','equals',true),
                        'default' => '#65829d',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'mainmenu-popup-bg-color',
                        'type' => 'color',
                        'title' => __('Background Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'mainmenu-popup-heading-color',
                        'type' => 'color',
                        'title' => __('Heading Color', 'porto'),
                        'default' => '#333333',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'mainmenu-popup-text-color',
                        'type' => 'link_color',
                        'active' => false,
                        'title' => __('Link Color', 'porto'),
                        'default' => array(
                            'regular' => '#777777',
                            'hover' => '#777777',
                        )
                    ),

                    array(
                        'id'=>'mainmenu-popup-text-hbg-color',
                        'type' => 'color',
                        'title' => __('Link Hover Background Color', 'porto'),
                        'default' => '#f4f4f4',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Tip', 'porto')
                    ),

                    array(
                        'id'=>'mainmenu-tip-bg-color',
                        'type' => 'color',
                        'title' => __('Tip Background Color', 'porto'),
                        'default' => '#0cc485',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Menu Custom Content in header type 1, 4, 9', 'porto')
                    ),

                    array(
                        'id'=>'menu-custom-text-color',
                        'type' => 'color',
                        'title' => __('Text Color', 'porto'),
                        'default' => '#777777',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'menu-custom-link',
                        'type' => 'link_color',
                        'title' => __('Link Color', 'porto'),
                        'active' => false,
                        'default' => array(
                            'regular' => '#65829d',
                            'hover' => '#56738e',
                        )
                    ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Footer', 'porto'),
                'fields' => array(

                    array(
                        'id'=>'footer-bg',
                        'type' => 'background',
                        'title' => __('Background', 'porto'),
                        'default' => array(
                            'background-color' => '#121214'
                        )
                    ),

                    array(
                        'id'=>'footer-heading-color',
                        'type' => 'color',
                        'title' => __('Heading Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'footer-text-color',
                        'type' => 'color',
                        'title' => __('Text Color', 'porto'),
                        'default' => '#777777',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'footer-link-color',
                        'type'=>'link_color',
                        'active' => false,
                        'title' => __('Link Color', 'porto'),
                        'default' => array(
                            'regular' => '#ffffff',
                            'hover' => '#ffffff',
                        )
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Footer Bottom', 'porto')
                    ),

                    array(
                        'id'=>'footer-bottom-bg',
                        'type' => 'background',
                        'title' => __('Background', 'porto'),
                        'default' => array(
                            'background-color' => '#0c0c0c'
                        )
                    ),

                    array(
                        'id'=>'footer-bottom-text-color',
                        'type' => 'color',
                        'title' => __('Text Color', 'porto'),
                        'default' => '#555555',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'footer-bottom-link-color',
                        'type'=>'link_color',
                        'active' => false,
                        'title' => __('Link Color', 'porto'),
                        'default' => array(
                            'regular' => '#ffffff',
                            'hover' => '#ffffff',
                        )
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Background Opacity when footer show in fixed position', 'porto')
                    ),

                    array(
                        'id'=>'footer-opacity',
                        'type' => 'text',
                        'title' => __('Footer Opacity', 'porto'),
                        'default' => '80%'
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Follow Us Widget', 'porto')
                    ),

                    array(
                        'id'=>'footer-social-bg-color',
                        'type' => 'color',
                        'title' => __('Background Color', 'porto'),
                        'default' => '#9e9e9e',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'footer-social-link-color',
                        'type' => 'color',
                        'title' => __('Link Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Breadcrumbs', 'porto'),
                'fields' => array(

                    array(
                        'id'=>'breadcrumbs-bg',
                        'type' => 'background',
                        'title' => __('Background', 'porto'),
                        'default' => array(
                            'background-color' => '#333333'
                        )
                    ),

                    array(
                        'id'=>'breadcrumbs-padding',
                        'type' => 'spacing',
                        'mode' => 'padding',
                        'title' => __('Content Padding', 'porto'),
                        'description' => __('default: 0 15 0 15', 'porto'),
                        'default' => array('padding-top' => 0, 'padding-bottom' => 0, 'padding-left' => 15, 'padding-right' => 15)
                    ),

                    array(
                        'id'=>'breadcrumbs-text-color',
                        'type' => 'color',
                        'title' => __('Text Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'breadcrumbs-link-color',
                        'type' => 'color',
                        'title' => __('Link Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'breadcrumbs-title-color',
                        'type' => 'color',
                        'title' => __('Page Title Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Mobile Panel', 'porto'),
                'fields' => array(

                    array(
                        'id'=>'panel-bg-color',
                        'type' => 'color',
                        'title' => __('Background Color', 'porto'),
                        'default' => '#1e1e1e',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'panel-text-color',
                        'type' => 'color',
                        'title' => __('Text Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'panel-link-color',
                        'type'=>'link_color',
                        'active' => false,
                        'title' => __('Link Color', 'porto'),
                        'default' => array(
                            'regular' => '#ffffff',
                            'hover' => '#ffffff',
                        )
                    ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('View, Currency Switcher', 'porto'),
                'fields' => array(

                    array(
                        'id'=>'switcher-bg-color',
                        'type' => 'color',
                        'title' => __('Background Color', 'porto'),
                        'default' => 'transparent',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'switcher-hbg-color',
                        'type' => 'color',
                        'title' => __('Hover Background Color', 'porto'),
                        'default' => '#65829d',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'switcher-link-color',
                        'type' => 'link_color',
                        'active' => false,
                        'title' => __('Link Color', 'porto'),
                        'default' => array(
                            'regular' => '#ffffff',
                            'hover' => '#ffffff',
                        )
                    ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Search Form', 'porto'),
                'fields' => array(

                    array(
                        'id'=>'searchform-bg-color',
                        'type' => 'color',
                        'title' => __('Background Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'searchform-border-color',
                        'type' => 'color',
                        'title' => __('Border Color', 'porto'),
                        'default' => '#cccccc',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'searchform-popup-border-color',
                        'type' => 'color',
                        'title' => __('Popup Border Color', 'porto'),
                        'default' => '#cccccc',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'searchform-text-color',
                        'type' => 'color',
                        'title' => __('Text Color', 'porto'),
                        'default' => '#777777',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'searchform-hover-color',
                        'type' => 'color',
                        'title' => __('Hover Color', 'porto'),
                        'default' => '#65829d',
                        'validate' => 'color',
                    ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Mini Cart', 'porto'),
                'fields' => array(

                    array(
                        'id'=>'minicart-icon-color',
                        'type' => 'color',
                        'title' => __('Icon Color', 'porto'),
                        'default' => '#65829d',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'minicart-item-color',
                        'type' => 'color',
                        'title' => __('Item Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'minicart-border-color',
                        'type' => 'color',
                        'title' => __('Border Color', 'porto'),
                        'desc' => __('When mini cart type is 2, please configure this option.', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'minicart-bg-color',
                        'type' => 'color',
                        'title' => __('Background Color', 'porto'),
                        'desc' => __('When mini cart type is 2, please configure this option.', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'minicart-popup-border-color',
                        'type' => 'color',
                        'title' => __('Popup Border Color', 'porto'),
                        'default' => '#65829d',
                        'validate' => 'color',
                    ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Custom CSS', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'css-code',
                        'type' => 'ace_editor',
                        'title' => __('CSS Code', 'porto'),
                        'subtitle' => __('Paste your CSS code here.', 'porto'),
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'default' => ""
                    ),
                )
            );

            // Header Settings
            $this->sections[] = array(
                'icon' => 'el-icon-website',
                'icon_class' => 'icon',
                'title' => __('Header', 'porto'),
                'fields' => array(

                    array(
                        'id'=>'header-type',
                        'type' => 'image_select',
                        'title' => __('Header Type', 'porto'),
                        'options' => $porto_header_type,
                        'default' => '2'
                    ),

                    array(
                        'id'=>'show-header-top',
                        'type' => 'switch',
                        'title' => __('Show Header Top', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'wpml-switcher',
                        'type' => 'switch',
                        'title' => __('Show WPML Language Switcher', 'porto'),
                        'desc' => __('Show wpml language switcher instead of view switcher menu.', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'wcml-switcher',
                        'type' => 'switch',
                        'title' => __('Show WPML Currency Switcher', 'porto'),
                        'desc' => __('Show wpml currency switcher instead of currency switcher menu.', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'welcome-msg',
                        'type' => 'text',
                        'title' => __('Welcome Message', 'porto'),
                        'default' => __('WELCOME TO PORTO ECOMMERCE', 'porto')
                    ),

                    array(
                        'id'=>'header-contact-info',
                        'type' => 'textarea',
                        'title' => __('Header Contact Info', 'porto'),
                        'default' => "<i class='fa fa-phone'></i> +(404) 158 14 25 78 <span class='gap'>|</span><a href='#'>CONTACT US</a>"
                    ),

                    array(
                        'id'=>'header-copyright',
                        'type' => 'textarea',
                        'title' => __('Side Navigation Copyright (Header Type: Side)', 'porto'),
                        'default' => __('&copy; Copyright 2015. All Rights Reserved.', 'porto')
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Social Links', 'porto')
                    ),

                    array(
                        'id'=>'show-header-socials',
                        'type' => 'switch',
                        'title' => __('Show Social Links', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id' => "header-social-facebook",
                        'type' => 'text',
                        'title' => __('Facebook', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),

                    array(
                        'id' => "header-social-twitter",
                        'type' => 'text',
                        'title' => __('Twitter', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),

                    array(
                        'id' => "header-social-rss",
                        'type' => 'text',
                        'title' => __('RSS', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),

                    array(
                        'id' => "header-social-pinterest",
                        'type' => 'text',
                        'title' => __('Pinterest', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),

                    array(
                        'id' => "header-social-youtube",
                        'type' => 'text',
                        'title' => __('Youtube', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),

                    array(
                        'id' => "header-social-instagram",
                        'type' => 'text',
                        'title' => __('Instagram', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),

                    array(
                        'id' => "header-social-skype",
                        'type' => 'text',
                        'title' => __('Skype', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),

                    array(
                        'id' => "header-social-linkedin",
                        'type' => 'text',
                        'title' => __('LinkedIn', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),

                    array(
                        'id' => "header-social-googleplus",
                        'type' => 'text',
                        'title' => __('Google Plus', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Mini Cart', 'porto')
                    ),

                    array(
                        'id'=>'show-minicart',
                        'type' => 'switch',
                        'title' => __('Show Mini Cart', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'minicart-type',
                        'type' => 'image_select',
                        'title' => __('Minicart Type', 'porto'),
                        'required' => array('show-minicart','equals',true),
                        'options' => array(
                            '' => array('alt' => __('Minicart Type 1', 'porto'), 'img' => porto_options_uri.'/minicarts/minicart_01.png'),
                            'minicart-box' => array('alt' => __('Minicart Type 2', 'porto'), 'img' => porto_options_uri.'/minicarts/minicart_02.png'),
                            'minicart-inline' => array('alt' => __('Minicart Type 3', 'porto'), 'img' => porto_options_uri.'/minicarts/minicart_03.png'),
                        ),
                        'default' => ''
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Search Form', 'porto')
                    ),

                    array(
                        'id'=>'show-searchform',
                        'type' => 'switch',
                        'title' => __('Show Search Form', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'search-size',
                        'type' => 'button_set',
                        'title' => __('Search Form Size', 'porto'),
                        'required' => array('show-searchform','equals',true),
                        'options' => array('' => __('Large', 'porto'), 'search-md' => __('Medium', 'porto'), 'search-sm' => __('Small', 'porto')),
                        'default' => ''
                    ),

                    array(
                        'id'=>'search-type',
                        'type' => 'button_set',
                        'title' => __('Search Content Type', 'porto'),
                        'required' => array('show-searchform','equals',true),
                        'options' => array('all' => __('All', 'porto'), 'post' => __('Post', 'porto'), 'product' => __('Product', 'porto'), 'portfolio' => __('Portfolio', 'porto')),
                        'default' => 'product'
                    ),

                    array(
                        'id'=>'search-cats',
                        'type' => 'switch',
                        'title' => __('Show Categories', 'porto'),
                        'required' => array('search-type','equals',array('post', 'product')),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Sticky Header', 'porto')
                    ),

                    array(
                        'id'=>'enable-sticky-header',
                        'type' => 'switch',
                        'title' => __('Enable Sticky Header', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'enable-sticky-header-tablet',
                        'type' => 'switch',
                        'title' => __('Enable on Tablet (width < 992px)', 'porto'),
                        'required' => array('enable-sticky-header','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'enable-sticky-header-mobile',
                        'type' => 'switch',
                        'title' => __('Enable on Mobile (width <= 480)', 'porto'),
                        'required' => array('enable-sticky-header-tablet','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    )
                )
            );

            // Menu Settings
            $this->sections[] = array(
                'icon' => 'el-icon-website',
                'icon_class' => 'icon',
                'title' => __('Main Menu', 'porto'),
                'fields' => array(

                    array(
                        'id'=>'menu-arrow',
                        'type' => 'switch',
                        'title' => __('Show Menu Arrow', 'porto'),
                        'desc' => __('If menu item have sub menus, show menu arrow.', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('If header type is 1 or 4', 'porto')
                    ),

                    array(
                        'id'=>'menu-align',
                        'type' => 'button_set',
                        'title' => __('Menu Align', 'porto'),
                        'options' => array(
                            '' => __('Left', 'porto'),
                            'centered' => __('Center', 'porto')
                        ),
                        'default' => ''
                    ),

                    array(
                        'id'=>'menu-sidebar',
                        'type' => 'switch',
                        'title' => __('Show Menu in Sidebar', 'porto'),
                        'desc' => __('If the layout of a page is left sidebar or right sidebar, the main menu shows in the sidebar.', 'porto'),
                        'default' => '0',
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id' => "menu-sidebar-home",
                        'type' => 'switch',
                        'title' => __('Show Sidebar Menu only on Home', 'porto'),
                        'required' => array('menu-sidebar','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id' => "menu-sidebar-title",
                        'type' => 'text',
                        'title' => __('Sidebar Menu Title', 'porto'),
                        'required' => array('menu-sidebar','equals',true),
                        'default' => __('All Department', 'porto')
                    ),

                    array(
                        'id' => "menu-sidebar-toggle",
                        'type' => 'switch',
                        'title' => __('Toggle Sidebar Menu', 'porto'),
                        'required' => array('menu-sidebar','equals',true),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('If header type is 9', 'porto')
                    ),

                    array(
                        'id' => "menu-title",
                        'type' => 'text',
                        'title' => __('Menu Title', 'porto'),
                        'default' => __('All Department', 'porto')
                    ),

                    array(
                        'id' => "menu-toggle-onhome",
                        'type' => 'switch',
                        'title' => __('Toggle on home page', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('If header type is 1 or 4, 9', 'porto')
                    ),

                    array(
                        'id'=>'menu-block',
                        'type' => 'textarea',
                        'title' => __('Menu Custom Content', 'porto'),
                        'desc' => __('example: &lt;span&gt;Custom Message&lt;/span&gt;&lt;a href="#"&gt;Special Offer!&lt;/a&gt;&lt;a href="#"&gt;Buy this Theme!&lt;em class="tip hot"&gt;HOT&lt;i class="tip-arrow"&gt;&lt;/i&gt;&lt;/em&gt;&lt;/a&gt;', 'porto'),
                        'default' => '<a href="#">Special Offer!</a><a href="#">Buy this Theme!<em class="tip hot">HOT<i class="tip-arrow"></i></em></a>'
                    ),
                )
            );

            // Footer Settings
            $this->sections[] = array(
                'icon' => 'el-icon-website',
                'icon_class' => 'icon',
                'title' => __('Footer', 'porto'),
                'fields' => array(

                    array(
                        'id'=>'footer-type',
                        'type' => 'image_select',
                        'title' => __('Footer Type', 'porto'),
                        'options' => $porto_footer_type,
                        'default' => '1'
                    ),

                    array(
                        'id'=>'footer-logo',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Footer Logo', 'porto'),
                        'default' => array(
                            'url' => porto_uri . '/images/logo/logo_footer.png'
                        )
                    ),

                    array(
                        'id' => "footer-ribbon",
                        'type' => 'text',
                        'title' => __('Ribbon Text', 'porto'),
                        'default' => ''
                    ),

                    array(
                        'id' => "footer-copyright",
                        'type' => 'textarea',
                        'title' => __('Copyright', 'porto'),
                        'default' => __('&copy; Copyright 2015. All Rights Reserved.', 'porto')
                    ),

                    array(
                        'id' => "footer-copyright-pos",
                        'type' => 'button_set',
                        'title' => __('Copyright Position', 'porto'),
                        'options' => array(
                            'left' => __('Left', 'porto'),
                            'right' => __('Right', 'porto')
                        ),
                        'default' => 'left'
                    ),

                    array(
                        'id'=>'footer-payments',
                        'type' => 'switch',
                        'title' => __('Show Payments Logos', 'porto'),
                        'default' => '0',
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'footer-payments-image',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Payments Image', 'porto'),
                        'required' => array('footer-payments','equals','1'),
                        'default' => array(
                            'url' => porto_uri . '/images/payments.png'
                        )
                    ),

                    array(
                        'id'=>'footer-payments-link',
                        'type' => 'text',
                        'title' => __('Payments Link URL', 'porto'),
                        'required' => array('footer-payments','equals','1'),
                        'default' => ''
                    ),
                )
            );

            // Page
            $this->sections[] = array(
                'icon' => 'el-icon-bookmark',
                'icon_class' => 'icon',
                'title' => __('Page', 'porto'),
                'fields' => array(

                    array(
                        'id'=>'page-comment',
                        'type' => 'switch',
                        'title' => __('Show Comments', 'porto'),
                        'default' => '0',
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'page-zoom',
                        'type' => 'switch',
                        'title' => __('Slideshow Zoom Effect', 'porto'),
                        'default' => true,
                        'on' => __('Enable', 'porto'),
                        'off' => __('Disable', 'porto'),
                    ),

                    array(
                        'id'=>'page-share',
                        'type' => 'switch',
                        'title' => __('Show Social Share Links', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                )
            );

            // Blog
            $this->sections[] = array(
                'icon' => 'el-icon-file',
                'icon_class' => 'icon',
                'title' => __('Blog & Single Post', 'porto'),
                'fields' => array(

                    array(
                        'id'=>'post-format',
                        'type' => 'switch',
                        'title' => __('Show Post Format', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'post-zoom',
                        'type' => 'switch',
                        'title' => __('Slideshow Zoom Effect', 'porto'),
                        'default' => true,
                        'on' => __('Enable', 'porto'),
                        'off' => __('Disable', 'porto'),
                    ),

                    array(
                        'id' => '1',
                        'type' => 'info',
                        'desc' => __('Blog', 'porto')
                    ),

                    array(
                        'id'=>'blog-title',
                        'type' => 'text',
                        'title' => __('Page Title', 'porto'),
                        'default' => 'Blog'
                    ),

                    array(
                        'id'=>'post-archive-layout',
                        'type' => 'button_set',
                        'title' => __('Page Layout', 'porto'),
                        'options' => $porto_layouts,
                        'default' => 'right-sidebar'
                    ),

                    array(
                        'id'=>'blog-banner_pos',
                        'type' => 'select',
                        'title' => __('Blog Banner Position', 'porto'),
                        'options' => $porto_banner_pos,
                        'default' => ""
                    ),

                    array(
                        'id'=>'blog-footer_view',
                        'type' => 'select',
                        'title' => __('Blog Footer View', 'porto'),
                        'options' => $porto_footer_view,
                        'default' => ""
                    ),

                    array(
                        'id'=>'blog-banner_type',
                        'type' => 'select',
                        'title' => __('Blog Banner Type', 'porto'),
                        'options' => $porto_banner_type,
                        'default' => 0
                    ),

                    array(
                        'id'=>'blog-master_slider',
                        'type' => 'select',
                        'required' => array('blog-banner_type','equals','master_slider'),
                        'title' => __('Master Slider', 'porto'),
                        'options' => $porto_master_sliders,
                        'default' => 0
                    ),

                    array(
                        'id'=>'blog-rev_slider',
                        'type' => 'select',
                        'required' => array('blog-banner_type','equals','rev_slider'),
                        'title' => __('Revolution Slider', 'porto'),
                        'options' => $porto_rev_sliders,
                        'default' => 0
                    ),

                    array(
                        'id'=>'blog-banner_block',
                        'type' => 'editor',
                        'required' => array('blog-banner_type','equals','banner'),
                        'title' => __('Banner Block', 'porto'),
                        'desc' => __('You should input block slug name. You can create a block in <strong>Blocks/Add New</strong>.', 'porto')
                    ),

                    array(
                        'id'=>'blog-content_top',
                        'type' => 'text',
                        'title' => __('Content Top', 'porto'),
                        'desc' => __('You should input block slug name. You can create a block in <strong>Blocks/Add New</strong>.', 'porto')
                    ),

                    array(
                        'id'=>'blog-content_inner_top',
                        'type' => 'text',
                        'title' => __('Content Inner Top', 'porto'),
                        'desc' => __('You should input block slug name. You can create a block in <strong>Blocks/Add New</strong>.', 'porto')
                    ),

                    array(
                        'id'=>'blog-content_inner_bottom',
                        'type' => 'text',
                        'title' => __('Content Inner Bottom', 'porto'),
                        'desc' => __('You should input block slug name. You can create a block in <strong>Blocks/Add New</strong>.', 'porto')
                    ),

                    array(
                        'id'=>'blog-content_bottom',
                        'type' => 'text',
                        'title' => __('Content Bottom', 'porto'),
                        'desc' => __('You should input block slug name. You can create a block in <strong>Blocks/Add New</strong>.', 'porto')
                    ),

                    array(
                        'id'=>'post-layout',
                        'type' => 'button_set',
                        'title' => __('Post Layout', 'porto'),
                        'options' => $porto_post_archive_layouts,
                        'default' => 'large'
                    ),

                    array(
                        'id'=>'grid-columns',
                        'type' => 'button_set',
                        'title' => __('Grid Columns', 'porto'),
                        'required' => array('post-layout','equals','grid'),
                        'options' => array(
                            '2' => '2',
                            '3' => '3',
                            '4' => '4'
                        ),
                        'default' => '3'
                    ),

                    array(
                        'id'=>'blog-infinite',
                        'type' => 'switch',
                        'title' => __('Enable Infinite Scroll', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'blog-excerpt',
                        'type' => 'switch',
                        'title' => __('Show Excerpt', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'blog-excerpt-length',
                        'type' => 'text',
                        'required' => array('blog-excerpt','equals',true),
                        'title' => __('Excerpt Length', 'porto'),
                        'desc' => __('The number of words', 'porto'),
                        'default' => '80',
                    ),

                    array(
                        'id'=>'blog-excerpt-type',
                        'type' => 'button_set',
                        'required' => array('blog-excerpt','equals',true),
                        'title' => __('Excerpt Type', 'porto'),
                        'options' => array('text' => __('Text', 'porto'),'html' => __('HTML', 'porto')),
                        'default' => 'text'
                    ),

                    array(
                        'id' => '1',
                        'type' => 'info',
                        'desc' => __('Single Post', 'porto')
                    ),

                    array(
                        'id'=>'post-single-layout',
                        'type' => 'button_set',
                        'title' => __('Page Layout', 'porto'),
                        'options' => $porto_layouts,
                        'default' => 'right-sidebar'
                    ),

                    array(
                        'id'=>'post-content-layout',
                        'type' => 'button_set',
                        'title' => __('Post Layout', 'porto'),
                        'options' => $porto_post_single_layouts,
                        'default' => 'large'
                    ),

                    array(
                        'id'=>'post-share',
                        'type' => 'switch',
                        'title' => __('Show Social Share Links', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'post-author',
                        'type' => 'switch',
                        'title' => __('Show Author Info', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'post-comments',
                        'type' => 'switch',
                        'title' => __('Show Comments', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'post-related',
                        'type' => 'switch',
                        'title' => __('Show Related Posts', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'post-related-count',
                        'type' => 'text',
                        'required' => array('post-related','equals',true),
                        'title' => __('Related Posts Count', 'porto'),
                        'desc' => __('If you want to show all the related posts, you should input "-1".', 'porto'),
                        'default' => '10'
                    ),

                    array(
                        'id'=>'post-related-orderby',
                        'type' => 'button_set',
                        'required' => array('post-related','equals',true),
                        'title' => __('Related Posts Order by', 'porto'),
                        'options' => array(
                            'none' => __('None', 'porto'),
                            'rand' => __('Random', 'porto'),
                            'date' => __('Date', 'porto'),
                            'ID' => __('ID', 'porto'),
                            'modified' => __('Modified Date', 'porto'),
                            'comment_count' => __('Comment Count', 'porto')
                        ),
                        'default' => 'rand'
                    )
                )
            );

            // Portfolio
            $this->sections[] = array(
                'icon' => 'el-icon-picture',
                'icon_class' => 'icon',
                'title' => __('Portfolio', 'porto'),
                'fields' => array(

                    array(
                        'id'=>'portfolio-zoom',
                        'type' => 'switch',
                        'title' => __('Slideshow Zoom Effect', 'porto'),
                        'default' => true,
                        'on' => __('Enable', 'porto'),
                        'off' => __('Disable', 'porto'),
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Portfolio Archive Page', 'porto')
                    ),

                    array(
                        'id'=>'portfolio-title',
                        'type' => 'text',
                        'title' => __('Page Title', 'porto'),
                        'default' => 'Our <strong>Projects</strong>'
                    ),

                    array(
                        'id'=>'portfolio-archive-layout',
                        'type' => 'button_set',
                        'title' => __('Page Layout', 'porto'),
                        'options' => $porto_layouts,
                        'default' => 'fullwidth'
                    ),

                    array(
                        'id'=>'portfolio-archive-sidebar',
                        'type' => 'select',
                        'title' => __('Select Sidebar', 'porto'),
                        'required' => array('portfolio-archive-layout','equals',$sidebars),
                        'data' => 'sidebars'
                    ),

                    array(
                        'id'=>'portfolio-infinite',
                        'type' => 'switch',
                        'title' => __('Enable Infinite Scroll', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'portfolio-layout',
                        'type' => 'button_set',
                        'title' => __('Portfolio Layout', 'porto'),
                        'options' => $porto_portfolio_archive_layouts,
                        'default' => 'grid'
                    ),
                    array(
                        'id'=>'portfolio-grid-columns',
                        'type' => 'button_set',
                        'title' => __('Grid Columns', 'porto'),
                        'required' => array('portfolio-layout','equals','grid'),
                        "desc" => __("Select the columns in <strong>grid mode</strong>.", 'porto'),
                        'options' => array(
                            "2" => __("2 Columns", 'porto'),
                            "3" => __("3 Columns", 'porto'),
                            "4" => __("4 Columns", 'porto'),
                            "5" => __("5 Columns", 'porto'),
                            "6" => __("6 Columns", 'porto'),
                        ),
                        'default' => '4'
                    ),
                    array(
                        'id'=>'portfolio-grid-view',
                        'type' => 'button_set',
                        "title" => __("Grid View Type", 'porto'),
                        'required' => array('portfolio-layout','equals','grid'),
                        "desc" => __("Select the view type in <strong>grid mode</strong>.", 'porto'),
                        'options' => array(
                            "default" => __("Default", 'porto'),
                            "full" => __("Full Width", 'porto')
                        ),
                        'default' => 'default'
                    ),

                    array(
                        'id'=>'portfolio-excerpt',
                        'type' => 'switch',
                        'title' => __('Show Excerpt', 'porto'),
                        'desc' => __('If yes, will be show the excerpt. If no, will be show the content.', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'portfolio-excerpt-length',
                        'type' => 'text',
                        'required' => array('portfolio-excerpt','equals',true),
                        'title' => __('Excerpt Length', 'porto'),
                        'desc' => __('The number of words', 'porto'),
                        'default' => '80',
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Single Portfolio', 'porto')
                    ),

                    array(
                        'id'=>'portfolio-single-layout',
                        'type' => 'button_set',
                        'title' => __('Page Layout', 'porto'),
                        'options' => $porto_layouts,
                        'default' => 'fullwidth'
                    ),

                    array(
                        'id'=>'portfolio-single-sidebar',
                        'type' => 'select',
                        'title' => __('Select Sidebar', 'porto'),
                        'required' => array('portfolio-single-layout','equals',$sidebars),
                        'data' => 'sidebars'
                    ),

                    array(
                        'id'=>'portfolio-page-nav',
                        'type' => 'switch',
                        'title' => __('Show List & Prev/Next Navigation', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'portfolio-content-layout',
                        'type' => 'button_set',
                        'title' => __('Portfolio Layout', 'porto'),
                        'options' => $porto_portfolio_single_layouts,
                        'default' => 'medium'
                    ),

                    array(
                        'id'=>'portfolio-share',
                        'type' => 'switch',
                        'title' => __('Show Social Share Links', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'portfolio-author',
                        'type' => 'switch',
                        'title' => __('Show Author Info', 'porto'),
                        'default' => '0',
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'portfolio-comments',
                        'type' => 'switch',
                        'title' => __('Show Comments', 'porto'),
                        'default' => '0',
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'portfolio-related',
                        'type' => 'switch',
                        'title' => __('Show Related Portfolios', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'portfolio-related-count',
                        'type' => 'text',
                        'required' => array('portfolio-related','equals',true),
                        'title' => __('Related Portfolios Count', 'porto'),
                        'desc' => __('If you want to show all the related portfolios, you should input "-1".', 'porto'),
                        'default' => '10'
                    ),

                    array(
                        'id'=>'portfolio-related-orderby',
                        'type' => 'button_set',
                        'required' => array('portfolio-related','equals',true),
                        'title' => __('Related Portfolios Order by', 'porto'),
                        'options' => array(
                            'none' => __('None', 'porto'),
                            'rand' => __('Random', 'porto'),
                            'date' => __('Date', 'porto'),
                            'ID' => __('ID', 'porto'),
                            'modified' => __('Modified Date', 'porto'),
                            'comment_count' => __('Comment Count', 'porto')
                        ),
                        'default' => 'rand'
                    ),
                )
            );

            // Member
            $this->sections[] = array(
                'icon' => 'el-icon-user',
                'icon_class' => 'icon',
                'title' => __('Member', 'porto'),
                'fields' => array(

                    array(
                        'id'=>'member-zoom',
                        'type' => 'switch',
                        'title' => __('Slideshow Zoom Effect', 'porto'),
                        'default' => true,
                        'on' => __('Enable', 'porto'),
                        'off' => __('Disable', 'porto'),
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Member Archive Page', 'porto')
                    ),

                    array(
                        'id'=>'member-title',
                        'type' => 'text',
                        'title' => __('Page Title', 'porto'),
                        'default' => 'Meet the <strong>Team</strong>'
                    ),

                    array(
                        'id'=>'member-archive-layout',
                        'type' => 'button_set',
                        'title' => __('Page Layout', 'porto'),
                        'options' => $porto_layouts,
                        'default' => 'fullwidth'
                    ),

                    array(
                        'id'=>'member-archive-sidebar',
                        'type' => 'select',
                        'title' => __('Select Sidebar', 'porto'),
                        'required' => array('member-archive-layout','equals',$sidebars),
                        'data' => 'sidebars'
                    ),

                    array(
                        'id'=>'member-infinite',
                        'type' => 'switch',
                        'title' => __('Enable Infinite Scroll', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'member-excerpt',
                        'type' => 'switch',
                        'title' => __('Show Overview Excerpt', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'member-excerpt-length',
                        'type' => 'text',
                        'required' => array('member-excerpt','equals',true),
                        'title' => __('Excerpt Length', 'porto'),
                        'desc' => __('The number of words', 'porto'),
                        'default' => '80',
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => __('Member Single Page', 'porto')
                    ),

                    array(
                        'id'=>'member-single-layout',
                        'type' => 'button_set',
                        'title' => __('Page Layout', 'porto'),
                        'options' => $porto_layouts,
                        'default' => 'fullwidth'
                    ),

                    array(
                        'id'=>'member-single-sidebar',
                        'type' => 'select',
                        'title' => __('Select Sidebar', 'porto'),
                        'required' => array('member-single-layout','equals',$sidebars),
                        'data' => 'sidebars'
                    ),
                )
            );

            // FAQ
            $this->sections[] = array(
                'icon' => 'el-icon-question',
                'icon_class' => 'icon',
                'title' => __('FAQ', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'faq-title',
                        'type' => 'text',
                        'title' => __('Page Title', 'porto'),
                        'default' => 'Frequently Asked <strong>Questions</strong>'
                    ),

                    array(
                        'id'=>'faq-archive-layout',
                        'type' => 'button_set',
                        'title' => __('Page Layout', 'porto'),
                        'options' => $porto_layouts,
                        'default' => 'fullwidth'
                    ),

                    array(
                        'id'=>'faq-archive-sidebar',
                        'type' => 'select',
                        'title' => __('Select Sidebar', 'porto'),
                        'required' => array('faq-archive-layout','equals',$sidebars),
                        'data' => 'sidebars'
                    ),

                    array(
                        'id'=>'faq-infinite',
                        'type' => 'switch',
                        'title' => __('Enable Infinite Scroll', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                )
            );

            // 404
            $this->sections[] = array(
                'icon' => 'el-icon-error',
                'icon_class' => 'icon',
                'title' => __('404 Error', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'error-block',
                        'type' => 'text',
                        'title' => __('404 Error Links Block', 'porto'),
                        'desc' => __('Input static block slug name', 'porto'),
                        'default' => 'error-404'
                    ),
                )
            );

            // Woocommerce
            $this->sections[] = array(
                'icon' => 'el-icon-shopping-cart',
                'icon_class' => 'icon',
                'title' => __('Woocommerce', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'desc' => __('General', 'porto')
                    ),
                    array(
                        'id'=>'woo-show-rating',
                        'type' => 'switch',
                        'title' => __('Show Rating in Woocommerce Products Widget', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'desc' => __('Products Listing', 'porto')
                    ),
                    array(
                        'id'=>'product-archive-layout',
                        'type' => 'button_set',
                        'title' => __('Page Layout', 'porto'),
                        'options' => $porto_layouts,
                        'default' => 'left-sidebar'
                    ),

                    array(
                        'id'=>'category-item',
                        'type' => 'text',
                        'title' => __('Products per Page', 'porto'),
                        'desc' => __('Comma separated list of product counts.', 'porto'),
                        'default' => '12,24,36'
                    ),

                    array(
                        'id'=>'shop-product-cols',
                        'type' => 'button_set',
                        'title' => __('Shop Page Product Columns', 'porto'),
                        'options' => porto_ct_product_columns(),
                        'default' => '3',
                    ),

                    array(
                        'id'=>'product-cols',
                        'type' => 'button_set',
                        'title' => __('Category Product Columns', 'porto'),
                        'options' => porto_ct_product_columns(),
                        'default' => '4',
                    ),

                    array(
                        'id'=>'category-image-hover',
                        'type' => 'switch',
                        'title' => __('Enable Image Hover Effect', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'category-addlinks-pos',
                        'type' => 'button_set',
                        'title' => __('Add Links Position', 'porto'),
                        'desc' => __('Select position of add to cart, add to wishlist, quickview.', 'porto'),
                        'options' => array('outimage' => __('Out of Image', 'porto'),'onimage' => __('On Image', 'porto')),
                        'default' => 'outimage'
                    ),

                    array(
                        'id'=>'category-hover',
                        'type' => 'switch',
                        'title' => __('Enable Hover Effect', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'product-wishlist',
                        'type' => 'switch',
                        'title' => __('Show Wishlist', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'product-quickview',
                        'type' => 'switch',
                        'title' => __('Show Quick View', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto')
                    ),

                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'desc' => __('Product', 'porto')
                    ),

                    array(
                        'id'=>'product-single-layout',
                        'type' => 'button_set',
                        'title' => __('Page Layout', 'porto'),
                        'options' => $porto_layouts,
                        'default' => 'right-sidebar'
                    ),

                    array(
                        'id'=>'product-nav',
                        'type' => 'switch',
                        'title' => __('Show Prev/Next Product', 'porto'),
                        'desc' => __('Will be show in breadcrumbs', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'product-related',
                        'type' => 'switch',
                        'title' => __('Show Related Products', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'product-related-count',
                        'type' => 'text',
                        'required' => array('product-related','equals',true),
                        'title' => __('Related Products Count', 'porto'),
                        'default' => '10'
                    ),

                    array(
                        'id'=>'product-upsells',
                        'type' => 'switch',
                        'title' => __('Show Up Sells', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'product-upsells-count',
                        'type' => 'text',
                        'required' => array('product-upsells','equals',true),
                        'title' => __('Up Sells Count', 'porto'),
                        'default' => '10'
                    ),

                    array(
                        'id'=>'product-hot',
                        'type' => 'switch',
                        'title' => __('Show "Hot" Label', 'porto'),
                        'desc' => __('Will be show in the featured product.', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'product-sale',
                        'type' => 'switch',
                        'title' => __('Show "Sale" Label', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'product-sale-percent',
                        'type' => 'switch',
                        'title' => __('Show Saved Sale Price Percentage', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'product-stock',
                        'type' => 'switch',
                        'title' => __('Show "Out of stock" Status', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'product-share',
                        'type' => 'switch',
                        'title' => __('Show Social Share Links', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'product-tabs',
                        'type' => 'button_set',
                        'title' => __('Tabs Type', 'porto'),
                        'options' => array('default' => __('Horizontal', 'porto'), 'vertical' => __('Vertical', 'porto'), 'accordion' => __('Accordion', 'porto')),
                        'default' => 'default'
                    ),

                    array(
                        'id' => "product-tab-title",
                        'type' => 'text',
                        'title' => __('Global Product Custom Tab Title', 'porto'),
                        'default' => ''
                    ),

                    array(
                        'id' => "product-tab-block",
                        'type' => 'text',
                        'title' => __('Global Product Custom Tab Block', 'porto'),
                        'desc' => __('Input block slug name', 'porto'),
                        'default' => ''
                    ),

                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'desc' => __('Product Image & Zoom', 'porto')
                    ),

                    array(
                        'id'=>'product-thumbs',
                        'type' => 'switch',
                        'title' => __('Show Thumbnails', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'product-zoom',
                        'type' => 'switch',
                        'title' => __('Enable Image Zoom', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'zoom-type',
                        'type' => 'button_set',
                        'title' => __('Type', 'porto'),
                        'options' => array('inner' => __('Inner', 'porto'), 'lens' => __('Lens', 'porto')),
                        'default' => 'inner'
                    ),

                    array(
                        'id'=>'zoom-scroll',
                        'type' => 'switch',
                        'required' => array('zoom-type','equals',array('lens')),
                        'title' => __('Scroll Zoom', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'zoom-lens-size',
                        'type' => 'text',
                        'required' => array('zoom-type','equals',array('lens')),
                        'title' => __('Lens Size', 'porto'),
                        'default' => '200'
                    ),

                    array(
                        'id'=>'zoom-lens-shape',
                        'type' => 'button_set',
                        'required' => array('zoom-type','equals',array('lens')),
                        'title' => __('Lens Shape', 'porto'),
                        'options' => array('round' => __('Round', 'porto'), 'square' => __('Square', 'porto')),
                        'default' => 'square'
                    ),

                    array(
                        'id'=>'zoom-contain-lens',
                        'type' => 'switch',
                        'required' => array('zoom-type','equals',array('lens')),
                        'title' => __('Contain Lens Zoom', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'zoom-lens-border',
                        'type' => 'text',
                        'required' => array('zoom-type','equals',array('lens')),
                        'title' => __('Lens Border', 'porto'),
                        'default' => true
                    ),

                    array(
                        'id'=>'zoom-border',
                        'type' => 'text',
                        'required' => array('zoom-type','equals',array('lens')),
                        'title' => __('Border Size', 'porto'),
                        'default' => '4'
                    ),

                    array(
                        'id'=>'zoom-border-color',
                        'type' => 'color',
                        'required' => array('zoom-type','equals',array('lens')),
                        'title' => __('Border Color', 'porto'),
                        'default' => '#888888'
                    ),

                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'desc' => __('Cart Page', 'porto')
                    ),

                    array(
                        'id'=>'product-crosssell',
                        'type' => 'switch',
                        'title' => __('Show Cross Sells', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'product-crosssell-count',
                        'type' => 'text',
                        'required' => array('product-crosssell','equals',true),
                        'title' => __('Cross Sells Count', 'porto'),
                        'default' => '8'
                    )
                )
            );

            // Social Share
            $this->sections[] = array(
                'icon' => 'el-icon-share-alt',
                'icon_class' => 'icon',
                'title' => __('Social Share', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'share-enable',
                        'type' => 'switch',
                        'title' => __('Show social links', 'porto'),
                        'desc' => __('Show social links in post and product pages', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'share-nofollow',
                        'type' => 'switch',
                        'title' => __('Add rel="nofollow" to social links', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'share-facebook',
                        'type' => 'switch',
                        'title' => __('Enable Facebook Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'share-twitter',
                        'type' => 'switch',
                        'title' => __('Enable Twitter Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'share-linkedin',
                        'type' => 'switch',
                        'title' => __('Enable LinkedIn Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'share-googleplus',
                        'type' => 'switch',
                        'title' => __('Enable Google + Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'share-pinterest',
                        'type' => 'switch',
                        'title' => __('Enable Pinterest Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => '0',
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'share-email',
                        'type' => 'switch',
                        'title' => __('Enable Email Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'share-vk',
                        'type' => 'switch',
                        'title' => __('Enable VK Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => '0',
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'share-xing',
                        'type' => 'switch',
                        'title' => __('Enable Xing Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => '0',
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'share-tumblr',
                        'type' => 'switch',
                        'title' => __('Enable Tumblr Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => '0',
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),

                    array(
                        'id'=>'share-reddit',
                        'type' => 'switch',
                        'title' => __('Enable Reddit Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => '0',
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                )
            );
        }

        public function setHelpTabs() {

        }

        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                'opt_name'          => 'porto_settings',
                'display_name'      => $theme->get('Name') . ' ' . __('Settings', 'porto'),
                'display_version'   => $theme->get('Version'),
                'menu_type'         => 'menu',
                'allow_sub_menu'    => true,
                'menu_title'        => __('Theme Options', 'porto'),
                'page_title'        => __('Theme Options', 'porto'),
                'footer_credit'     => __('Theme Options', 'porto'),

                'google_api_key' => 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII',
                'disable_google_fonts_link' => true,

                'async_typography'  => false,
                'admin_bar'         => true,
                'global_variable'   => '',
                'dev_mode'          => false,
                'customizer'        => true,

                'page_priority'     => null,
                'page_parent'       => 'themes.php',
                'page_permissions'  => 'manage_options',
                'menu_icon'         => '',
                'last_tab'          => '',
                'page_icon'         => 'icon-themes',
                'page_slug'         => 'porto_settings',
                'save_defaults'     => true,
                'default_show'      => false,
                'default_mark'      => '',
                'show_import_export' => true,

                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,
                'output_tag'        => true,

                'database'              => '',
                'system_info'           => false,

                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/eternalfriend38',
                'title' => __('Follow us on Twitter', 'porto'),
                'icon'  => 'el el-icon-twitter'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf('<p>'.__('Did you know that Porto sets a global variable for you? To access any of your saved options from within your code you can use your global variable: ', 'porto').'<strong>$%1$s</strong></p>', $v);
            } else {
                $this->args['intro_text'] = '<p>'.__('This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.', 'porto').'</p>';
            }
        }

    }

    global $reduxPortoSettings;
    $reduxPortoSettings = new Redux_Framework_porto_settings();
}