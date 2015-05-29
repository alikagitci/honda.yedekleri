
jQuery(function($) {

    var form = jQuery('<div id="porto_blog-form"><table id="porto_blog-table" class="form-table">\
			<tr>\
				<th><label for="porto_blog-title">Title</label></th>\
                <td><input type="text" name="title" id="porto_blog-title" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_blog-post_layout">Blog Layout</label></th>\
                <td><select name="post_layout" id="porto_blog-post_layout">\
                ' + porto_shortcode_blog_layout() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_blog-columns">Grid Columns</label></th>\
                <td><select name="columns" id="porto_blog-columns">\
                ' + porto_shortcode_blog_grid_columns() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_blog-cat">Category IDs</label></th>\
                <td><input type="text" name="cat" id="porto_blog-cat" value="" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_blog-post_in">Post IDs</label></th>\
                <td><input type="text" name="post_in" id="porto_blog-post_in" value="" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_blog-number">Posts Count</label></th>\
                <td><input type="text" name="number" id="porto_blog-number" value="8" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_blog-view_more">Show View More</label></th>\
				<td><select name="view_more" id="porto_blog-view_more">\
                ' + porto_shortcode_boolean_false() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="porto_blog-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="porto_blog-animation_type">\
                ' + porto_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_blog-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="porto_blog-animation_duration" value="1000" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_blog-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="porto_blog-animation_delay" value="0" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="porto_blog-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_blog-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_blog-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_blog-submit').click(function(){

        var options = {
            'title'              : '',
            'post_layout'        : '',
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

        var shortcode = '[porto_blog';

        for( var index in options) {
            var value = table.find('#porto_blog-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});