
jQuery(function($) {

    var form = jQuery('<div id="porto_block-form"><table id="porto_block-table" class="form-table">\
            <tr>\
				<th colspan="2"><strong>Input Block id or slug name.</strong></th>\
			</tr>\
			<tr>\
				<th><label for="porto_block-id">Block ID *</label></th>\
				<td><input type="text" name="id" id="porto_block-id" value="" />\
				<br/><small>numerical value</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_block-name">Block Slug Name *</label></th>\
				<td><input type="text" name="name" id="porto_block-name" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="porto_block-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="porto_block-animation_type">\
                ' + porto_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_block-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="porto_block-animation_duration" value="1000" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_block-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="porto_block-animation_delay" value="0" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="porto_block-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_block-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_block-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_block-submit').click(function(){

        var options = {
            'id'                 : '',
            'name'               : '',
            'animation_type'     : '',
            'animation_duration' : '1000',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[porto_block';

        for( var index in options) {
            var value = table.find('#porto_block-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        if (table.find('#porto_block-id').val() == '' && table.find('#porto_block-name').val() == '') {
            alert('Please input block id or slug name');
        } else {
            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

            tb_remove();
        }
    });
});