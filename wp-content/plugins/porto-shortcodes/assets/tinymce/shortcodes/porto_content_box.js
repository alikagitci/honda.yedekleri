
jQuery(function($) {

    var form = jQuery('<div id="porto_content_box-form"><table id="porto_content_box-table" class="form-table">\
            <tr>\
				<th><label for="porto_content_box-border_top_color">Border Top Color</label></th>\
				<td><input type="text" name="border_top_color" id="porto_content_box-border_top_color" value="" />\
				<br/><small>default: skin color</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_content_box-border_radius">Border Radius</label></th>\
				<td><input type="text" name="border_radius" id="porto_content_box-border_radius" value="" />\
				<br/><small>numerical value (unit: px)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_content_box-border_top_width">Border Top Width</label></th>\
				<td><input type="text" name="border_top_width" id="porto_content_box-border_top_width" value="" />\
				<br/><small>numerical value (unit: px)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_content_box-bg_top_color">Background Gradient Top Color</label></th>\
				<td><input type="text" name="bg_top_color" id="porto_content_box-bg_top_color" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="porto_content_box-bg_bottom_color">Background Gradient Bottom Color</label></th>\
				<td><input type="text" name="bg_bottom_color" id="porto_content_box-bg_bottom_color" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="porto_content_box-align">Align</label></th>\
                <td><select name="align" id="porto_content_box-align">\
                ' + porto_shortcode_align() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_content_box-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="porto_content_box-animation_type">\
                ' + porto_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_content_box-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="porto_content_box-animation_duration" value="1000" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_content_box-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="porto_content_box-animation_delay" value="0" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="porto_content_box-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_content_box-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_content_box-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_content_box-submit').click(function(){

        var options = {
            'border_top_color'   : '',
            'border_radius'      : '',
            'border_top_width'   : '',
            'bg_top_color'       : '',
            'bg_bottom_color'    : '',
            'align'              : '',
            'animation_type'     : '',
            'animation_duration' : '1000',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[porto_content_box';

        for( var index in options) {
            var value = table.find('#porto_content_box-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/porto_content_box]';

        if (table.find('#porto_content_box-id').val() == '' && table.find('#porto_content_box-name').val() == '') {
            alert('Please input block id or slug name');
        } else {
            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

            tb_remove();
        }
    });
});