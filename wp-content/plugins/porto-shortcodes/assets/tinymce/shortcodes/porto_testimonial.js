
jQuery(function($) {

    var form = jQuery('<div id="porto_testimonial-form"><table id="porto_testimonial-table" class="form-table">\
			<tr>\
				<th><label for="porto_testimonial-name">Name</label></th>\
                <td><input type="text" name="name" id="porto_testimonial-name" value="" /></td>\
            </tr>\
            <tr>\
				<th><label for="porto_testimonial-role">Role</label></th>\
                <td><input type="text" name="role" id="porto_testimonial-role" value="" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_testimonial-company">Company</label></th>\
                <td><input type="text" name="company" id="porto_testimonial-company" value="" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_testimonial-author_url">Author Link</label></th>\
                <td><input type="text" name="author_url" id="porto_testimonial-author_url" value="" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_testimonial-photo_url">Photo URL</label></th>\
                <td><input type="text" name="photo_url" id="porto_testimonial-photo_url" value="" /></td>\
            </tr>\
			<tr>\
				<th><label for="porto_testimonial-quote">Quote</label></th>\
                <td><textarea name="quote" id="porto_testimonial-quote" rows="5" cols="20">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat.  Donec hendrerit vehicula est, in consequat.  Donec hendrerit vehicula est, in consequat.</textarea></td>\
            </tr>\
            <tr>\
				<th><label for="porto_testimonial-view">View Type</label></th>\
                <td><select name="view" id="porto_testimonial-view">\
                ' + porto_shortcode_testimonial_view_type() + '\
                </select></td>\
            </tr>\
            <tr>\
				<th><label for="porto_testimonial-color">Color Skin (If View Type is Transparent)</label></th>\
                <td><select name="color" id="porto_testimonial-color">\
                ' + porto_shortcode_testimonial_color_skin() + '\
                </select></td>\
            </tr>\
            <tr>\
				<th><label for="porto_testimonial-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="porto_testimonial-animation_type">\
                ' + porto_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="porto_testimonial-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="porto_testimonial-animation_duration" value="1000" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="porto_testimonial-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="porto_testimonial-animation_delay" value="0" />\
				<br/><small>numerical value (unit: milliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="porto_testimonial-class">Extra Class Name</label></th>\
				<td><input type="text" name="class" id="porto_testimonial-class" value="" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="porto_testimonial-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#porto_testimonial-submit').click(function(){

        var options = {
            'name'               : '',
            'role'               : '',
            'company'            : '',
            'author_url'         : '',
            'photo_url'          : '',
            'quote'              : '',
            'view'               : '',
            'color'              : '',
            'animation_type'     : '',
            'animation_duration' : '1000',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[porto_testimonial';

        for( var index in options) {
            var value = table.find('#porto_testimonial-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});