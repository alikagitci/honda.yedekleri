
jQuery(function($) {

    var form = jQuery('<div id="porto_faqs-form"><table id="porto_faqs-table" class="form-table">\
			<tr>\
				<th><label for="porto_faqs-title">Title</label></th>\
                <td><input type="text" name="title" id="porto_faqs-title" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_faqs-cat">Category IDs</label></th>\
                <td><input type="text" name="cat" id="porto_faqs-cat" value="" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_faqs-post_in">FAQ IDs</label></th>\
                <td><input type="text" name="post_in" id="porto_faqs-post_in" value="" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_faqs-number">FAQs Count</label></th>\
                <td><input type="text" name="number" id="porto_faqs-number" value="8" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_faqs-view_more">Show View More</label></th>\
				<td><select name="view_more" id="porto_faqs-view_more">\
                ' + porto_shortcode_boolean_false() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="porto_faqs-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="porto_faqs-animation_type">\
                ' + porto_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_faqs-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="porto_faqs-animation_duration" value="1000" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_faqs-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="porto_faqs-animation_delay" value="0" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="porto_faqs-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_faqs-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_faqs-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_faqs-submit').click(function(){

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

        var shortcode = '[porto_faqs';

        for( var index in options) {
            var value = table.find('#porto_faqs-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});