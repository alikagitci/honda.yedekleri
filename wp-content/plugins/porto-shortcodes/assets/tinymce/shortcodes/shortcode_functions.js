function porto_shortcode_open(name, id) {
    var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
    W = W - 80;
    H = H - 120;
    tb_show( 'Porto ' + name + ' Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId='+ id +'-form' );
}

function porto_shortcode_close() {

}

function porto_shortcode_animation_type() {
    var html = '<option value="">none</option>\
    <optgroup label="Attention Seekers">\
        <option value="bounce">bounce</option>\
        <option value="flash">flash</option>\
        <option value="pulse">pulse</option>\
        <option value="rubberBand">rubberBand</option>\
        <option value="shake">shake</option>\
        <option value="swing">swing</option>\
        <option value="tada">tada</option>\
        <option value="wobble">wobble</option>\
    </optgroup>\
    <optgroup label="Bouncing Entrances">\
        <option value="bounceIn">bounceIn</option>\
        <option value="bounceInDown">bounceInDown</option>\
        <option value="bounceInLeft">bounceInLeft</option>\
        <option value="bounceInRight">bounceInRight</option>\
        <option value="bounceInUp">bounceInUp</option>\
    </optgroup>\
    <optgroup label="Fading Entrances">\
        <option value="fadeIn">fadeIn</option>\
        <option value="fadeInDown">fadeInDown</option>\
        <option value="fadeInDownBig">fadeInDownBig</option>\
        <option value="fadeInLeft">fadeInLeft</option>\
        <option value="fadeInLeftBig">fadeInLeftBig</option>\
        <option value="fadeInRight">fadeInRight</option>\
        <option value="fadeInRightBig">fadeInRightBig</option>\
        <option value="fadeInUp">fadeInUp</option>\
        <option value="fadeInUpBig">fadeInUpBig</option>\
    </optgroup>\
    <optgroup label="Flippers">\
        <option value="flip">flip</option>\
        <option value="flipInX">flipInX</option>\
        <option value="flipInY">flipInY</option>\
    </optgroup>\
    <optgroup label="Lightspeed">\
        <option value="lightSpeedIn">lightSpeedIn</option>\
    </optgroup>\
    <optgroup label="Rotating Entrances">\
        <option value="rotateIn">rotateIn</option>\
        <option value="rotateInDownLeft">rotateInDownLeft</option>\
        <option value="rotateInDownRight">rotateInDownRight</option>\
        <option value="rotateInUpLeft">rotateInUpLeft</option>\
        <option value="rotateInUpRight">rotateInUpRight</option>\
    </optgroup>\
    <optgroup label="Sliders">\
        <option value="slideInDown">slideInDown</option>\
        <option value="slideInLeft">slideInLeft</option>\
        <option value="slideInRight">slideInRight</option>\
    </optgroup>\
    <optgroup label="Specials">\
        <option value="hinge">hinge</option>\
        <option value="rollIn">rollIn</option>\
    </optgroup>';

    return html;
}

function porto_shortcode_testimonial_view_type() {
    var html = '<option value="default">Default</option>\
        <option value="simple">Simple</option>\
        <option value="transparent">Transparent</option>';

    return html;
}

function porto_shortcode_testimonial_color_skin() {
    var html = '<option value="">Normal</option>\
        <option value="white">White</option>';

    return html;
}

function porto_shortcode_align() {
    var html = '<option value="">None</option>\
        <option value="left">Left</option>\
        <option value="right">Right</option>\
        <option value="center">Center</option>\
        <option value="justify">Justify</option>';

    return html;
}

function porto_shortcode_boolean_true() {
    var html = '<option value="true" selected="selected">True</option>\
        <option value="false">False</option>';

    return html;
}

function porto_shortcode_boolean_false() {
    var html = '<option value="true">True</option>\
        <option value="false" selected="selected">False</option>';

    return html;
}

function porto_shortcode_blog_layout() {
    var html = '<option value="full">Full</option>\
        <option value="large">Large</option>\
        <option value="large-alt">Large Alt</option>\
        <option value="medium">Medium</option>\
        <option value="grid">Grid</option>\
        <option value="timeline" selected="selected">Timeline</option>';

    return html;
}

function porto_shortcode_blog_grid_columns() {
    var html = '<option value="2">2</option>\
        <option value="3" selected="selected">3</option>\
        <option value="4">4</option>';

    return html;
}

function porto_shortcode_portfolio_layout() {
    var html = '<option value="grid">Grid</option>\
        <option value="timeline" selected="selected">Timeline</option>\
        <option value="medium">Medium</option>\
        <option value="large">Large</option>\
        <option value="full">Full</option>';

    return html;
}

function porto_shortcode_portfolio_grid_view() {
    var html = '<option value="">Classic</option>\
        <option value="full">Full</option>';

    return html;
}

function porto_shortcode_portfolio_grid_columns() {
    var html = '<option value="2">2</option>\
        <option value="3">3</option>\
        <option value="4">4</option>\
        <option value="5">5</option>\
        <option value="6">6</option>';

    return html;
}

function porto_shortcode_products_view() {
    var html = '<option value="grid">Grid</option>\
        <option value="list">List</option>\
        <option value="products-slider">Slider</option>';

    return html;
}

function porto_shortcode_products_grid_columns() {
    var html = '<option value="1">1</option>\
        <option value="2">2</option>\
        <option value="3">3</option>\
        <option value="4" selected="selected">4</option>\
        <option value="5">5</option>\
        <option value="6">6</option>\
        <option value="7">7 (without sidebar)</option>\
        <option value="8">8 (without sidebar)</option>';

    return html;
}

function porto_shortcode_products_grid_column_width() {
    var html = '<option value="">Default</option>\
        <option value="1">1/1 of content width</option>\
        <option value="2">1/2 of content width</option>\
        <option value="3">1/3 of content width</option>\
        <option value="4">1/4 of content width</option>\
        <option value="5">1/5 of content width</option>\
        <option value="6">1/6 of content width</option>\
        <option value="7">1/7 of content width</option>\
        <option value="8">1/8 of content width</option>';

    return html;
}

function porto_shortcode_products_orderby() {
    var html = '<option value=""></option>\
        <option value="date">Date</option>\
        <option value="ID">ID</option>\
        <option value="author">Author</option>\
        <option value="title">Title</option>\
        <option value="modified">Modified</option>\
        <option value="rand">Random</option>\
        <option value="comment_count">Comment count</option>\
        <option value="menu_order">Menu order</option>';

    return html;
}

function porto_shortcode_products_order() {
    var html = '<option value=""></option>\
        <option value="DESC">Descending</option>\
        <option value="ASC">Ascending</option>';

    return html;
}

function porto_shortcode_products_addlinks_pos() {
    var html = '<option value="">Default</option>\
        <option value="outimage">Out of Image</option>\
        <option value="onimage">On Image</option>';

    return html;
}

function porto_shortcode_product_view() {
    var html = '<option value="grid">Grid</option>\
        <option value="list">List</option>';

    return html;
}

function porto_shortcode_product_categories_view() {
    var html = '<option value="grid">Grid</option>\
        <option value="products-slider">Slider</option>';

    return html;
}

function porto_shortcode_widget_products_show() {
    var html = '<option value="">All Products</option>\
        <option value="featured">Featured Products</option>\
        <option value="onsale">On-sale Products</option>';

    return html;
}

function porto_shortcode_widget_products_orderby() {
    var html = '<option value="date">Date</option>\
        <option value="price">Price</option>\
        <option value="rand">Random</option>\
        <option value="sales">Sales</option>';

    return html;
}