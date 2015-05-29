
jQuery(function($) {

    var form = jQuery('<div id="porto_widget_woo_top_rated_products-form"><table id="porto_widget_woo_top_rated_products-table" class="form-table">\
			<tr>\
				<th><label for="porto_widget_woo_top_rated_products-title">Title</label></th>\
                <td><input type="text" name="title" id="porto_widget_woo_top_rated_products-title" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_widget_woo_top_rated_products-number">Number of products</label></th>\
				<td><input type="text" name="number" id="porto_widget_woo_top_rated_products-number" value="5" /></td>\
			</tr>\
			<tr>\
				<th><label for="porto_widget_woo_top_rated_products-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="porto_widget_woo_top_rated_products-animation_type">\
                ' + porto_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_widget_woo_top_rated_products-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="porto_widget_woo_top_rated_products-animation_duration" value="1000" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_widget_woo_top_rated_products-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="porto_widget_woo_top_rated_products-animation_delay" value="0" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="porto_widget_woo_top_rated_products-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_widget_woo_top_rated_products-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_widget_woo_top_rated_products-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_widget_woo_top_rated_products-submit').click(function(){

        var options = {
            'title'              : '',
            'number'             : '5',
            'animation_type'     : '',
            'animation_duration' : '1000',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[porto_widget_woo_top_rated_products';

        for( var index in options) {
            var value = table.find('#porto_widget_woo_top_rated_products-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});