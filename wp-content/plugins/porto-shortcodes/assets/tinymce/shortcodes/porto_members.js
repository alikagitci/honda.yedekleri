
jQuery(function($) {

    var form = jQuery('<div id="porto_members-form"><table id="porto_members-table" class="form-table">\
			<tr>\
				<th><label for="porto_members-title">Title</label></th>\
                <td><input type="text" name="title" id="porto_members-title" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_members-cat">Category IDs</label></th>\
                <td><input type="text" name="cat" id="porto_members-cat" value="" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_members-post_in">Member IDs</label></th>\
                <td><input type="text" name="post_in" id="porto_members-post_in" value="" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_members-number">Members Count</label></th>\
                <td><input type="text" name="number" id="porto_members-number" value="8" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_members-view_more">Show View More</label></th>\
				<td><select name="view_more" id="porto_members-view_more">\
                ' + porto_shortcode_boolean_false() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="porto_members-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="porto_members-animation_type">\
                ' + porto_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_members-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="porto_members-animation_duration" value="1000" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_members-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="porto_members-animation_delay" value="0" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="porto_members-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_members-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_members-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_members-submit').click(function(){

        var options = {
            'title'              : '',
            'cat'                : '',
            'post_in'            : '',
            'number'             : '8',
            'view_more'          : 'false',
            'animation_type'     : '',
            'animation_duration' : '1000',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[porto_members';

        for( var index in options) {
            var value = table.find('#porto_members-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});