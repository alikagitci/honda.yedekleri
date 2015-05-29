
jQuery(function($) {

    var form = jQuery('<div id="porto_history-form"><table id="porto_history-table" class="form-table">\
			<tr>\
				<th><label for="porto_history-year">Year</label></th>\
                <td><input type="text" name="year" id="porto_history-year" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_history-image_url">Photo URL</label></th>\
                <td><input type="text" name="image_url" id="porto_history-image_url" value="" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_history-history">History</label></th>\
                <td><textarea name="history" id="porto_history-history" rows="5" cols="20">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat.  Donec hendrerit vehicula est, in consequat.  Donec hendrerit vehicula est, in consequat.</textarea></td>\
            </tr>\
            <tr>\
				<th><label for="porto_history-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="porto_history-animation_type">\
                ' + porto_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_history-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="porto_history-animation_duration" value="1000" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_history-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="porto_history-animation_delay" value="0" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="porto_history-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_history-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_history-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_history-submit').click(function(){

        var options = {
            'year'               : '',
            'image_url'          : '',
            'history'            : '',
            'animation_type'     : '',
            'animation_duration' : '1000',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[porto_history';

        for( var index in options) {
            var value = table.find('#porto_history-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});