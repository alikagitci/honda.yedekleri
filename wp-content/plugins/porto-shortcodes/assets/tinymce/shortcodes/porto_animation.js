
jQuery(function($) {

    var form = jQuery('<div id="porto_animation-form"><table id="porto_animation-table" class="form-table">\
			<tr>\
				<th><label for="porto_animation-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="porto_animation-animation_type">\
                ' + porto_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_animation-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="porto_animation-animation_duration" value="1000" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_animation-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="porto_animation-animation_delay" value="0" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="porto_animation-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_animation-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_animation-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_animation-submit').click(function(){

        var options = {
            'animation_type'     : '',
            'animation_duration' : '1000',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[porto_animation';

        for( var index in options) {
            var value = table.find('#porto_animation-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/porto_animation]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});