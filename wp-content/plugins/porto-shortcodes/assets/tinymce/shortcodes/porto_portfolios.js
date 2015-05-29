
jQuery(function($) {

    var form = jQuery('<div id="porto_portfolios-form"><table id="porto_portfolios-table" class="form-table">\
			<tr>\
				<th><label for="porto_portfolios-title">Title</label></th>\
                <td><input type="text" name="title" id="porto_portfolios-title" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_portfolios-portfolio_layout">Portfolio Layout</label></th>\
                <td><select name="portfolio_layout" id="porto_portfolios-post_layout">\
                ' + porto_shortcode_portfolio_layout() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_portfolios-view">Grid View Type</label></th>\
                <td><select name="view" id="porto_portfolios-view">\
                ' + porto_shortcode_portfolio_grid_view() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_portfolios-columns">Grid Columns</label></th>\
                <td><select name="columns" id="porto_portfolios-columns">\
                ' + porto_shortcode_portfolio_grid_columns() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_portfolios-cat">Category IDs</label></th>\
                <td><input type="text" name="cat" id="porto_portfolios-cat" value="" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_portfolios-post_in">Portfolio IDs</label></th>\
                <td><input type="text" name="post_in" id="porto_portfolios-post_in" value="" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_portfolios-number">Portfolios Count</label></th>\
                <td><input type="text" name="number" id="porto_portfolios-number" value="8" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_portfolios-view_more">Show View More</label></th>\
				<td><select name="view_more" id="porto_portfolios-view_more">\
                ' + porto_shortcode_boolean_false() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="porto_portfolios-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="porto_portfolios-animation_type">\
                ' + porto_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_portfolios-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="porto_portfolios-animation_duration" value="1000" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_portfolios-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="porto_portfolios-animation_delay" value="0" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="porto_portfolios-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_portfolios-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_portfolios-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_portfolios-submit').click(function(){

        var options = {
            'title'              : '',
            'portfolio_layout'   : '',
            'view'               : '',
            'columns'            : '',
            'cat'                : '',
            'post_in'            : '',
            'number'             : '8',
            'view_more'          : 'false',
            'animation_type'     : '',
            'animation_duration' : '1000',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[porto_portfolios';

        for( var index in options) {
            var value = table.find('#porto_portfolios-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});