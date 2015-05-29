
jQuery(function($) {

    var form = jQuery('<div id="porto_grid_item-form"><table id="porto_grid_item-table" class="form-table">\
			<tr>\
				<th><label for="porto_grid_item-width">Width</label></th>\
				<td><input type="text" name="width" id="porto_grid_item-width" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="porto_grid_item-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_grid_item-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_grid_item-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_grid_item-submit').click(function(){

        var options = {
            'width'              : '',
            'class'              : ''
        };

        var shortcode = '[porto_grid_item';

        for( var index in options) {
            var value = table.find('#porto_grid_item-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/porto_grid_item]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});