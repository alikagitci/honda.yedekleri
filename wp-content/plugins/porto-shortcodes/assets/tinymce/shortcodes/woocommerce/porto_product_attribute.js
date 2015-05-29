
jQuery(function($) {

    var form = jQuery('<div id="porto_product_attribute-form"><table id="porto_product_attribute-table" class="form-table">\
			<tr>\
				<th><label for="porto_product_attribute-title">Title</label></th>\
                <td><input type="text" name="title" id="porto_product_attribute-title" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_product_attribute-view">View Mode</label></th>\
				<td><select name="view" id="porto_product_attribute-view">\
                ' + porto_shortcode_products_view() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="porto_product_attribute-per_page">Per Page</label></th>\
                <td><input type="text" name="per_page" id="porto_product_attribute-per_page" value="12" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_attribute-columns">Grid Columns</label></th>\
                <td><select name="columns" id="porto_product_attribute-columns">\
                ' + porto_shortcode_products_grid_columns() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_attribute-column_width">Grid Column Width</label></th>\
                <td><select name="column_width" id="porto_product_attribute-column_width">\
                ' + porto_shortcode_products_grid_column_width() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_attribute-orderby">Order by</label></th>\
                <td><select name="orderby" id="porto_product_attribute-orderby">\
                ' + porto_shortcode_products_orderby() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_attribute-order">Order way</label></th>\
                <td><select name="order" id="porto_product_attribute-order">\
                ' + porto_shortcode_products_order() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_attribute-attribute">Attribute</label></th>\
                <td><input type="text" name="attribute" id="porto_product_attribute-attribute" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_product_attribute-filter">Filter</label></th>\
                <td><input type="text" name="filter" id="porto_product_attribute-filter" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_product_attribute-addlinks_pos">Add Links Position</label></th>\
                <td><select name="addlinks_pos" id="porto_product_attribute-addlinks_pos">\
                ' + porto_shortcode_products_addlinks_pos() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_attribute-navigation">Show Navigation</label></th>\
                <td><select name="navigation" id="porto_product_attribute-navigation">\
                ' + porto_shortcode_boolean_true() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_attribute-pagination">Show Pagination</label></th>\
                <td><select name="pagination" id="porto_product_attribute-pagination">\
                ' + porto_shortcode_boolean_false() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_attribute-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="porto_product_attribute-animation_type">\
                ' + porto_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_product_attribute-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="porto_product_attribute-animation_duration" value="1000" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_product_attribute-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="porto_product_attribute-animation_delay" value="0" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="porto_product_attribute-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_product_attribute-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_product_attribute-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_product_attribute-submit').click(function(){

        var options = {
            'title'              : '',
            'view'               : '',
            'per_page'           : '12',
            'columns'            : '4',
            'column_width'       : '',
            'orderby'            : '',
            'order'              : '',
            'attribute'          : '',
            'filter'             : '',
            'addlinks_pos'       : '',
            'navigation'         : 'true',
            'pagination'         : 'false',
            'animation_type'     : '',
            'animation_duration' : '1000',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[porto_product_attribute';

        for( var index in options) {
            var value = table.find('#porto_product_attribute-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});