
jQuery(function($) {

    var form = jQuery('<div id="porto_grid_container-form"><table id="porto_grid_container-table" class="form-table">\
			<tr>\
				<th><label for="porto_grid_container-gutter_size">Gutter Size</label></th>\
                <td><input type="text" name="gutter_size" id="porto_grid_container-gutter_size" value="2%" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_grid_container-grid_size">Grid Min Size</label></th>\
                <td><input type="text" name="grid_size" id="porto_grid_container-grid_size" value="0" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_grid_container-max_width">Max Width</label></th>\
                <td><input type="text" name="max_width" id="porto_grid_container-max_width" value="767px" />\
                <br/><small>Will be show as grid only when window width > max width.</small></td>\
            </tr>\
			<tr>\
				<th><label for="porto_animation-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="porto_animation-animation_type">\
                ' + porto_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_grid_container-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="porto_grid_container-animation_duration" value="1000" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_grid_container-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="porto_grid_container-animation_delay" value="0" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="porto_grid_container-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_grid_container-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_grid_container-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_grid_container-submit').click(function(){

        var options = {
            'gutter_size'        : '2%',
            'grid_size'          : '0',
            'max_width'          : '767px',
            'animation_type'     : '',
            'animation_duration' : '1000',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[porto_grid_container';

        for( var index in options) {
            var value = table.find('#porto_grid_container-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Porto Grid Item Shortcodes[/porto_grid_container]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});