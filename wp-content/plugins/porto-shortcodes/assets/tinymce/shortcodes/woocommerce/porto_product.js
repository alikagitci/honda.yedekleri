
jQuery(function($) {

    var form = jQuery('<div id="porto_product-form"><table id="porto_product-table" class="form-table">\
			<tr>\
				<th><label for="porto_product-title">Title</label></th>\
                <td><input type="text" name="title" id="porto_product-title" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_product-view">View Mode</label></th>\
				<td><select name="view" id="porto_product-view">\
                ' + porto_shortcode_product_view() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="porto_product-column_width">Grid Width</label></th>\
                <td><select name="column_width" id="porto_product-column_width">\
                ' + porto_shortcode_products_grid_column_width() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product-id">Product ID</label></th>\
                <td><input type="text" name="id" id="porto_product-id" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_product-addlinks_pos">Add Links Position</label></th>\
                <td><select name="addlinks_pos" id="porto_product-addlinks_pos">\
                ' + porto_shortcode_products_addlinks_pos() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="porto_product-animation_type">\
                ' + porto_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="porto_product-animation_duration" value="1000" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_product-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="porto_product-animation_delay" value="0" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="porto_product-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_product-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_product-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_product-submit').click(function(){

        var options = {
            'title'              : '',
            'view'               : '',
            'column_width'       : '',
            'id'                 : '',
            'addlinks_pos'       : '',
            'animation_type'     : '',
            'animation_duration' : '1000',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[porto_product';

        for( var index in options) {
            var value = table.find('#porto_product-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});