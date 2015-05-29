
jQuery(function($) {

    var form = jQuery('<div id="porto_links_item-form"><table id="porto_links_item-table" class="form-table">\
			<tr>\
				<th><label for="porto_links_item-label">Label</label></th>\
                <td><input type="text" name="label" id="porto_links_item-label" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_links_item-link">Link</label></th>\
                <td><input type="text" name="link" id="porto_links_item-link" value="" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_links_item-icon">Font Awesome Icon or Icon Class</label></th>\
                <td><input type="text" name="icon" id="porto_links_item-icon" value="" />\
                <br/><small>Input font awesome icon or icon class. You can see <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">Font Awesome Icons in here</a>.</small></td>\
            </tr>\
			<tr>\
				<th><label for="porto_links_item-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_links_item-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_links_item-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_links_item-submit').click(function(){

        var options = {
            'label'               : '',
            'link'          : '',
            'icon'            : '',
            'class'              : ''
        };

        var shortcode = '[porto_links_item';

        for( var index in options) {
            var value = table.find('#porto_links_item-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});