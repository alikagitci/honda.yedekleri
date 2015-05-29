
jQuery(function($) {

    var form = jQuery('<div id="porto_recent_posts-form"><table id="porto_recent_posts-table" class="form-table">\
			<tr>\
				<th><label for="porto_recent_posts-title">Title</label></th>\
                <td><input type="text" name="title" id="porto_recent_posts-title" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_recent_posts-number">Posts Count</label></th>\
                <td><input type="text" name="number" id="porto_recent_posts-number" value="8" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_recent_posts-cat">Category IDs</label></th>\
                <td><input type="text" name="cat" id="porto_recent_posts-cat" value="" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_recent_posts-show_image">Show Post Image</label></th>\
				<td><select name="show_image" id="porto_recent_posts-show_image">\
                ' + porto_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="porto_recent_posts-items_desktop">Items to show on Desktop</label></th>\
                <td><input type="text" name="items_desktop" id="porto_recent_posts-items_desktop" value="4" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_recent_posts-items_tablets">Items to show on Tablets</label></th>\
                <td><input type="text" name="items_tablets" id="porto_recent_posts-items_tablets" value="3" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_recent_posts-items_mobile">Items to show on Mobile</label></th>\
                <td><input type="text" name="items_mobile" id="porto_recent_posts-items_mobile" value="2" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_recent_posts-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="porto_recent_posts-animation_type">\
                ' + porto_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_recent_posts-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="porto_recent_posts-animation_duration" value="1000" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_recent_posts-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="porto_recent_posts-animation_delay" value="0" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="porto_recent_posts-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_recent_posts-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_recent_posts-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_recent_posts-submit').click(function(){

        var options = {
            'title'              : '',
            'number'             : '8',
            'cat'                : '',
            'show_image'         : 'true',
            'items_desktop'      : '4',
            'items_tablets'      : '3',
            'items_mobile'       : '2',
            'animation_type'     : '',
            'animation_duration' : '1000',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[porto_recent_posts';

        for( var index in options) {
            var value = table.find('#porto_recent_posts-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});