
jQuery(function($) {

    var form = jQuery('<div id="porto_best_selling_products-form"><table id="porto_best_selling_products-table" class="form-table">\
			<tr>\
				<th><label for="porto_best_selling_products-title">Title</label></th>\
                <td><input type="text" name="title" id="porto_best_selling_products-title" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_best_selling_products-view">View Mode</label></th>\
				<td><select name="view" id="porto_best_selling_products-view">\
                ' + porto_shortcode_products_view() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="porto_best_selling_products-per_page">Per Page</label></th>\
                <td><input type="text" name="per_page" id="porto_best_selling_products-per_page" value="12" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_best_selling_products-columns">Grid Columns</label></th>\
                <td><select name="columns" id="porto_best_selling_products-columns">\
                ' + porto_shortcode_products_grid_columns() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_best_selling_products-column_width">Grid Column Width</label></th>\
                <td><select name="column_width" id="porto_best_selling_products-column_width">\
                ' + porto_shortcode_products_grid_column_width() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_best_selling_products-addlinks_pos">Add Links Position</label></th>\
                <td><select name="addlinks_pos" id="porto_best_selling_products-addlinks_pos">\
                ' + porto_shortcode_products_addlinks_pos() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_best_selling_products-navigation">Show Navigation</label></th>\
                <td><select name="navigation" id="porto_best_selling_products-navigation">\
                ' + porto_shortcode_boolean_true() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_best_selling_products-pagination">Show Pagination</label></th>\
                <td><select name="pagination" id="porto_best_selling_products-pagination">\
                ' + porto_shortcode_boolean_false() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_best_selling_products-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="porto_best_selling_products-animation_type">\
                ' + porto_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_best_selling_products-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="porto_best_selling_products-animation_duration" value="1000" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_best_selling_products-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="porto_best_selling_products-animation_delay" value="0" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="porto_best_selling_products-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_best_selling_products-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_best_selling_products-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_best_selling_products-submit').click(function(){

        var options = {
            'title'              : '',
            'view'               : '',
            'per_page'           : '12',
            'columns'            : '4',
            'column_width'       : '',
            'addlinks_pos'       : '',
            'navigation'         : 'true',
            'pagination'         : 'false',
            'animation_type'     : '',
            'animation_duration' : '1000',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[porto_best_selling_products';

        for( var index in options) {
            var value = table.find('#porto_best_selling_products-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});