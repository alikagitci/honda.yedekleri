
jQuery(function($) {

    var form = jQuery('<div id="porto_links_block-form"><table id="porto_links_block-table" class="form-table">\
			<tr>\
				<th><label for="porto_links_block-title">Title</label></th>\
                <td><input type="text" name="title" id="porto_links_block-title" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_links_block-icon">Font Awesome Icon or Icon Class</label></th>\
                <td><input type="text" name="icon" id="porto_links_block-icon" value="" />\
                <br/><small>Input font awesome icon or icon class. You can see <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">Font Awesome Icons in here</a>.</small></td>\
            </tr>\
			<tr>\
				<th><label for="porto_links_block-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="porto_links_block-animation_type">\
                ' + porto_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_links_block-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="porto_links_block-animation_duration" value="1000" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_links_block-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="porto_links_block-animation_delay" value="0" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="porto_links_block-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_links_block-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_links_block-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_links_block-submit').click(function(){

        var options = {
            'title'              : '',
            'icon'               : '',
            'animation_type'     : '',
            'animation_duration' : '1000',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[porto_links_block';

        for( var index in options) {
            var value = table.find('#porto_links_block-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Porto Links Item Shortcodes[/porto_links_block]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});