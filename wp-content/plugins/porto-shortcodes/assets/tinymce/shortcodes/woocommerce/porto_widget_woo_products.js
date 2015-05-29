
jQuery(function($) {

    var form = jQuery('<div id="porto_widget_woo_products-form"><table id="porto_widget_woo_products-table" class="form-table">\
			<tr>\
				<th><label for="porto_widget_woo_products-title">Title</label></th>\
                <td><input type="text" name="title" id="porto_widget_woo_products-title" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_widget_woo_products-number">Number of products</label></th>\
				<td><input type="text" name="number" id="porto_widget_woo_products-number" value="5" /></td>\
			</tr>\
			<tr>\
				<th><label for="porto_widget_woo_products-show">Show</label></th>\
                <td><select name="show" id="porto_widget_woo_products-show">\
                ' + porto_shortcode_widget_products_show() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_widget_woo_products-orderby">Order by</label></th>\
                <td><select name="orderby" id="porto_widget_woo_products-orderby">\
                ' + porto_shortcode_widget_products_orderby() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_widget_woo_products-order">Order way</label></th>\
                <td><select name="order" id="porto_widget_woo_products-order">\
                ' + porto_shortcode_products_order() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_widget_woo_products-hide_free">Hide free products</label></th>\
                <td><select name="hide_free" id="porto_widget_woo_products-hide_free">\
                ' + porto_shortcode_boolean_true() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_widget_woo_products-show_hidden">Show hidden products</label></th>\
                <td><select name="show_hidden" id="porto_widget_woo_products-show_hidden">\
                ' + porto_shortcode_boolean_true() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_widget_woo_products-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="porto_widget_woo_products-animation_type">\
                ' + porto_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_widget_woo_products-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="porto_widget_woo_products-animation_duration" value="1000" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_widget_woo_products-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="porto_widget_woo_products-animation_delay" value="0" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="porto_widget_woo_products-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_widget_woo_products-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_widget_woo_products-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_widget_woo_products-submit').click(function(){

        var options = {
            'title'              : '',
            'number'             : '5',
            'show'               : '',
            'orderby'            : '',
            'order'              : '',
            'hide_free'          : 'true',
            'show_hidden'        : 'true',
            'animation_type'     : '',
            'animation_duration' : '1000',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[porto_widget_woo_products';

        for( var index in options) {
            var value = table.find('#porto_widget_woo_products-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});