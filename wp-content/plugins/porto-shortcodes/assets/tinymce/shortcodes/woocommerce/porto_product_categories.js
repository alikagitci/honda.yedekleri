
jQuery(function($) {

    var form = jQuery('<div id="porto_product_categories-form"><table id="porto_product_categories-table" class="form-table">\
			<tr>\
				<th><label for="porto_product_categories-title">Title</label></th>\
                <td><input type="text" name="title" id="porto_product_categories-title" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_product_categories-view">View Mode</label></th>\
				<td><select name="view" id="porto_product_categories-view">\
                ' + porto_shortcode_product_categories_view() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="porto_product_categories-number">Number</label></th>\
                <td><input type="text" name="number" id="porto_product_categories-number" value="" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_categories-columns">Grid Columns</label></th>\
                <td><select name="columns" id="porto_product_categories-columns">\
                ' + porto_shortcode_products_grid_columns() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_categories-column_width">Grid Column Width</label></th>\
                <td><select name="column_width" id="porto_product_categories-column_width">\
                ' + porto_shortcode_products_grid_column_width() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_categories-orderby">Order by</label></th>\
                <td><select name="orderby" id="porto_product_categories-orderby">\
                ' + porto_shortcode_products_orderby() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_categories-order">Order way</label></th>\
                <td><select name="order" id="porto_product_categories-order">\
                ' + porto_shortcode_products_order() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_categories-category">Category</label></th>\
                <td><input type="text" name="category" id="porto_product_categories-category" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_product_categories-hide_empty">Number (Hide Empty)</label></th>\
                <td><input type="text" name="hide_empty" id="porto_product_categories-hide_empty" value="" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_categories-ids">Category IDs</label></th>\
                <td><input type="text" name="ids" id="porto_product_categories-ids" value="" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_category-addlinks_pos">Add Links Position</label></th>\
                <td><select name="addlinks_pos" id="porto_product_category-addlinks_pos">\
                ' + porto_shortcode_products_addlinks_pos() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_category-hide_count">Hide Products Count</label></th>\
                <td><select name="hide_count" id="porto_product_category-hide_count">\
                ' + porto_shortcode_boolean_true() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_categories-navigation">Show Navigation</label></th>\
                <td><select name="navigation" id="porto_product_categories-navigation">\
                ' + porto_shortcode_boolean_true() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_categories-pagination">Show Pagination</label></th>\
                <td><select name="pagination" id="porto_product_categories-pagination">\
                ' + porto_shortcode_boolean_false() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_categories-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="porto_product_categories-animation_type">\
                ' + porto_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_categories-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="porto_product_categories-animation_duration" value="1000" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_product_categories-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="porto_product_categories-animation_delay" value="0" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="porto_product_categories-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_product_categories-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_product_categories-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_product_categories-submit').click(function(){

        var options = {
            'title'              : '',
            'view'               : '',
            'number'             : '',
            'columns'            : '4',
            'column_width'       : '',
            'orderby'            : '',
            'order'              : '',
            'hide_empty'         : '',
            'ids'                : '',
            'addlinks_pos'       : '',
            'hide_count'         : 'true',
            'navigation'         : 'true',
            'pagination'         : 'false',
            'animation_type'     : '',
            'animation_duration' : '1000',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[porto_product_categories';

        for( var index in options) {
            var value = table.find('#porto_product_categories-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});