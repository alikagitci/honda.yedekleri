(function() {
    tinymce.PluginManager.add('shortcodes', function(editor, url) {
        editor.addButton('porto_shortcodes_button', {
            type: 'menubutton',
            icon: 'porto',
            tooltip: 'Porto Shortcodes',
            menu: [
                { text: 'Block', value: 'porto_block', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Container', value: 'porto_container', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Animation', value: 'porto_animation', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Testimonial', value: 'porto_testimonial', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Content Box', value: 'porto_content_box', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'History', value: 'porto_history', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Grid Container', value: 'porto_grid_container', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Grid Item', value: 'porto_grid_item', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Links Block', value: 'porto_links_block', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Links Item', value: 'porto_links_item', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Recent Posts', value: 'porto_recent_posts', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Blog', value: 'porto_blog', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Portfolios', value: 'porto_portfolios', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'FAQs', value: 'porto_faqs', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Members', value: 'porto_members', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Recent Products', value: 'porto_recent_products', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Featured Products', value: 'porto_featured_products', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Sale Products', value: 'porto_sale_products', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Best Selling Products', value: 'porto_best_selling_products', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Top Rated Products', value: 'porto_top_rated_products', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Products', value: 'porto_products', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Product Category', value: 'porto_product_category', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Product Attribute', value: 'porto_product_attribute', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Product', value: 'porto_product', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Product Categories', value: 'porto_product_categories', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Widget Woocommerce Products', value: 'porto_widget_woo_products', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Widget Woocommerce Top Rated Products', value: 'porto_widget_woo_top_rated_products', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Widget Woocommerce Recently Viewed', value: 'porto_widget_woo_recently_viewed', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Widget Woocommerce Recent Reviews', value: 'porto_widget_woo_recent_reviews', onclick: function() { porto_shortcode_open(this.text(), this.value()); } },
                { text: 'Widget Woocommerce Product Tags', value: 'porto_widget_woo_product_tags', onclick: function() { porto_shortcode_open(this.text(), this.value()); } }
            ]
        });
    });

})();