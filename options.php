<?php (!defined('ABSPATH')) ? exit : false; ?>
<div class="wrap">
	<style>
		.form-table.form-table-border{border-top:1px Solid #fff;}
		.form-table.form-table-google{background-color:#fff;border-radius:20px;}
		.disabled{opacity:0.3;}
		.form-table td{vertical-align:top}
		.form-table th{width:15%;}
		p.description{width:80%;}
	</style>

	<h1><?php _e('Additional libraries', 'libraries'); ?></h1>

	<form method="post" action="options.php">
	
	<?php settings_fields('libraries'); ?>

	<?php $settings = get_option('additional_libraries'); ?>
	
	<?php $igor = new IgorKiselev(); ?>
	
		<table class="form-table">
			<tr>
				<th scope="row">
					<?php _e('Styles', 'libraries'); ?>
				</th>
				
				<td width="42%">
					<?php $igor->checkbox('justbenice'); ?>
				</td>
				<td width="42%"<?php $igor->disabled('justbenice'); ?>>
					<?php $igor->customcheckbox('justbenice-editor', __('Load justbenice.css styles in WYSIWYG-editor', 'libraries'), __('', 'libraries')); ?>
				</td>
			</tr>
			
		</table>
		<table class="form-table form-table-border">
			<tr>
				<th scope="row">
					<?php _e('JS Libraries', 'libraries'); ?>
				</th>
				<td width="42%">
					<?php $igor->checkbox('modernizr'); ?>
				</td>
				<td width="42%">
					<?php $igor->checkbox('prefixfree'); ?>
				</td>
			</tr>
			<tr>
				<th scope="row">
					&nbsp;
				</th>
				<td width="42%">
					<?php $igor->checkbox('pace'); ?>
				</td>
				<td width="42%">
					<?php $igor->customcheckbox('imagesloaded', 'ImagesLoaded.js ', __('Allows you to check the loading of the image in the specified places. Now included in the list of basic wordpress scripts.', 'libraries'), 'http://imagesloaded.desandro.com'); ?>
				</td>
			</tr>
			
			
			
			
		</table>
		<table class="form-table form-table-border">
			<tr>
				<th scope="row"><?php _e('Libraries based on jQuery', 'libraries'); ?></th>
				<td width="42%"><?php $igor->checkbox('jquerymask'); ?></td>
				<td width="42%"></td>
			</tr>
			<tr>
				<th scope="row"></th>
				<td width="42%"><?php $igor->checkbox('event_move'); ?></td>
				<td width="42%"><?php $igor->checkbox('jquery_ui_touch_punch'); ?></td>
			</tr>
			
		</table>
		<table class="form-table form-table-border">
			<tr>
				<th scope="row">
					<?php _e('.lazy js library', 'libraries'); ?>
				</th>
				<td width="42%">
					<?php $igor->checkbox('lazy'); ?>
				</td>
				<td width="42%"<?php $igor->disabled('lazy'); ?>>
					<?php $igor->customcheckbox('lazy-srcset', 'Change image attributes for Lazy.js', __('Adding data- to srcset & sizes in image attributes. Allows Lazy.js to load images responsive.', 'libraries')); ?>
				</td>
			</tr>
			<tr>
				<th scope="row">
					&nbsp;
				</th>
				<td colspan="2">
					<?php $igor->customcheckbox('lazy-brakepoints', 'Additional brakepoints', __('Add custom set of sizes to srcset in images.', 'libraries')); ?>
					<div <?php $igor->disabled('lazy-brakepoints'); ?>>
						<p>
							<?php $igor->custominput('lazy-brakepoints-sizes', 'lazy-brakepoints', __('Sizes divided by comma', 'libraries'), __('Add image sizes you want to be generated and displayed in srcset.', 'libraries'), ''); ?>
						</p>
						<p class="description">
							<small><strong><?php _e('Currently registered sizes:', 'libraries'); ?></strong> 
								<?php foreach (get_intermediate_image_sizes() as $size) {
									echo '<span>'.$size.'</span> ';
								} ?>
							</small>
						</p>
					</div>
				</td>
			</tr>
		</table>
		<table class="form-table form-table-border">
			<tr>
				<th scope="row"><?php _e('Fullpage scroller', 'libraries'); ?></th>
				<td width="42%"><?php $igor->checkbox('fullpage'); ?></td>
				<td width="42%"<?php $igor->disabled('fullpage'); ?>><?php $igor->checkbox('fullpage_scrolloverflow','fullpage'); ?></td>
			</tr>
		</table>
		<table class="form-table form-table-border">
			<tr>
				<th scope="row"><?php _e('Isotope block builder', 'libraries'); ?></th>
				<td colspan="2"><?php $igor->checkbox('isotope'); ?></td>
			</tr>
			<tr<?php $igor->disabled('isotope'); ?>>
				<th scope="row">&nbsp;</th>
				<td width="42%"><?php $igor->checkbox('isotope_masonry','isotope'); ?></td>
				<td width="42%"><?php $igor->checkbox('isotope_fitcolumns','isotope'); ?></td>
			</tr>
			<tr<?php $igor->disabled('isotope'); ?>>
				<th scope="row">&nbsp;</th>
				<td width="42%"><?php $igor->checkbox('isotope_cellsbyrow','isotope'); ?></td>
				<td width="42%"><?php $igor->checkbox('isotope_cellsbycolumn','isotope'); ?></td>
			</tr>
			<tr<?php $igor->disabled('isotope'); ?>>
				<th scope="row">&nbsp;</th>
				<td width="42%"><?php $igor->checkbox('isotope_horizontal','isotope'); ?></td>
				<td width="42%"><?php $igor->checkbox('isotope_packery','isotope'); ?></td>
			</tr>
		</table>
		<table class="form-table form-table-border">
			<tr>
				<th scope="row"><?php _e('owlCarousel slider', 'libraries'); ?></th>
				<td width="42%">
					<?php $igor->checkbox('owlcarousel'); ?>
				</td>
				<td width="42%"<?php $igor->disabled('owlcarousel'); ?>>
					<?php $igor->customcheckbox('owlcarousel-gallery', __('Change default gallery to owl', 'libraries'), __('Function that changes the default wordpress gallery layout to owlcarousel.', 'libraries')); ?>
				</td>
			</tr>
			<tr>
				<th scope="row">&nbsp;</th>
				<td colspan="2"><?php $igor->checkbox('animate'); ?></td>
			</tr>
		</table>
		<table class="form-table form-table-border">
			<tr>
				<th scope="row"><?php _e('Beta libraries by Just Be Nice', 'libraries'); ?></th>
				
				<td><?php $igor->checkbox('fullscreenclass'); ?>
					<p>
						<details>
							<summary><?php _e('Code example', 'libraries'); ?></summary>
							<pre>jQuery('a').click(function(e) {</pre>
							<pre>	jQuery('.fullscreen').fullscreen({</pre>
							<pre>		result : function(){},</pre>
							<pre>		notClickable : '.background',</pre>
							<pre>		escapeKey: true</pre>
							<pre>	});</pre>
							<pre>	e.preventDefault();</pre>
							<pre>});</pre>
						</details>
					</p>
				</td>
			</tr>
		</table>
		<table class="form-table form-table-google" >
			<tr>
				<th scope="row">
					<span style="padding-left:20px"><?php _e('Google Libraries', 'libraries'); ?></span>
				</th>
				<td colspan="2">
					<?php $igor->customcheckbox('google-map', __('Google Maps', 'libraries'), __('Loads remote API, so you can create google maps on your website.', 'libraries'), ''); ?>
				</td>
			</tr>
			<tr<?php $igor->disabled('google-map'); ?>>
				<th scope="row">
						&nbsp;
					</th>
					<td colspan="2">
						<?php $igor->custominput('google-map-key', 'google-map', __('API Key', 'libraries'), '', '<a href="https://developers.google.com/maps/documentation/javascript/">'.__('Get key', 'libraries').'</a>'); ?>
				
					</td>
			</tr>
			<tr<?php $igor->disabled('google-map'); ?>>
				<th scope="row">&nbsp;</th>
				<td colspan="2">
					<?php $igor->custominput('google-map-limit', 'google-map', __('Page IDs divided by comma', 'libraries'), __('Limit pages where to load the remote library. Leave empty if not needed', 'libraries'), ''); ?>
				</td>
			</tr>
			<tr>
				<td colspan="3" style="padding:0px"><hr /></td>
			</tr>
			<tr>
				<th scope="row">&nbsp;</th>
				<td width="42%">
					<?php $igor->checkbox('google_clustermarkers'); ?>
				</td>
				<td width="42%">
					<?php $igor->checkbox('google_infobubble'); ?>
				</td>
			</tr>
			<tr>
				<th scope="row">&nbsp;</th>
				<td width="42%">
					<?php $igor->checkbox('google_geocomplete'); ?>
				</td>
				<td width="42%">
					
				</td>
			</tr>
			<tr>
				<td colspan="3" style="padding:0px"><hr /></td>
			</tr>
			<tr>
				<th scope="row">&nbsp;</th>
				<td colspan="2">
					<?php $igor->customcheckbox('google-analytics', __('Google Analytics', 'libraries'), __('A script to track visitor statistics in Google Analytics.', 'libraries'), 'http://analytics.google.com'); ?>
					<p><?php $igor->custominput('google-analytics-key', 'google-analytics', __('UA-#######-##', 'libraries'), '', ''); ?></p>
				</td>
			</tr>
			
		</table>
		<table class="form-table form-table-yandex" >
			<tr>
				<th scope="row"><?php _e('Yandex', 'libraries'); ?></th>
				<td>
					<?php $igor->customcheckbox('yandex-metrics', __('Yandex Metrics', 'libraries'), __('A script to track visitor statistics in Yandex Metrics.', 'libraries'), 'http://metrika.yandex.ru'); ?>
					<p><?php $igor->custominput('yandex-metrics-key', 'yandex-metrics', __('########', 'libraries'), '', ''); ?></p>
			</td>
			</tr>
			
		</table>
		<table class="form-table form-table-border">
			<tr>
				<th scope="row">&nbsp;</th>
				<td>
					<?php $igor->customcheckbox('filenames', __('Filename prefix', 'libraries'), __('Set prefix for filenames that are uploaded to wordpress.', 'libraries')); ?><p><?php $igor->custominput('filenames-slug', 'filenames', '', '', ''); ?></p>
				</td>
			</tr>
			
		</table>
		<table class="form-table form-table-border">
			<tr>
				<th scope="row">
					<?php _e('Remove from &#60;head&#47;&#62;', 'libraries'); ?>
				</th>
				<td width="42%">
					<?php $igor->customcheckbox('disable-emoji', __('Remove emoji support', 'libraries'), __('Remove styles and scripts to process emoji on the website from &#60;head&#47;&#62;', 'libraries')); ?>
				</td>
				<td width="42%">
					<?php $igor->customcheckbox('disable-generator', __('Remove generator meta', 'libraries'), __('Remove information about the administration system and version', 'libraries')); ?>
				</td>
			</tr>
			<tr>
				<th scope="row">
					&nbsp;
				</th>
				<td width="42%">
					<?php $igor->customcheckbox('disable-rsslinks', __('RSS feeds', 'libraries'), __('Remove links to the RSS feeds of the website from &#60;head&#47;&#62; (will still to work if you just add /feed after adress), as well as xml for blog clients', 'libraries')); ?>
				</td>
				<td width="42%">
					<?php $igor->customcheckbox('disable-rellinks', __('REL links', 'libraries'), __('Remove links to the main page, to the first record, to the previous and next record, the link to the parent record and a short link to the current page from &#60;head&#47;&#62;', 'libraries')); ?>
				</td>
			</tr>
			<tr>
				<th scope="row">
					&nbsp;
				</th>
				<td width="42%">
					<?php $igor->customcheckbox('disable-attachment-pages', __('Attachment pages', 'libraries'), __('Remove attachment pages. If you fill all titles, captions and descriptions on the media file, then maybe keep the pages. Improves SEO of the website.', 'libraries')); ?>
				</td>
				<td width="42%">
					
				</td>
			</tr>
		</table>
		<table class="form-table form-table-border">
			<tr>
				<th scope="row">
					<?php _e('Wordpress interface', 'libraries'); ?>
				</th>
				<td width="42%">
					<?php $igor->customcheckbox('disable-adminbar', __('Remove administrator bar', 'libraries'), __('Hide admin panel on the website', 'libraries')); ?>
				</td>
				<td width="42%">
					<?php $igor->customcheckbox('enable-navmenus', __('Menu in nav', 'libraries'), __('Move the menu item to the main navigation bar', 'libraries')); ?>
				</td>
			</tr>
			<tr>
				<th scope="row">
					
				</th>
				<td width="42%">
					<?php $igor->customcheckbox('featured-admin-image', __('Feature images', 'libraries'), __('Add feature images in post and page lists', 'libraries')); ?>
				</td>
				<td width="42%">
					<?php $igor->customcheckbox('custom-filetypes', __('Custom filetypes', 'libraries'), __('Add support for custom filetypes (SVG)', 'libraries')); ?>
				</td>
			</tr>
			
			
		</table>
		<table class="form-table form-table-border">
			<tr>
				<th scope="row">
					<?php _e('Content parser', 'libraries'); ?>
				</th>
				<td width="42%">
					<?php $igor->customcheckbox('content-the_title', __('No title', 'libraries'), __('Display the phrase "No title" in the_title when the title of the post or page is empty', 'libraries')); ?>
				</td>
				<td width="42%">
					<?php $igor->customcheckbox('header-wp_title', __('Site name in title', 'libraries'), __('Display the name of the website (company) in the header after the page name (wp_title)', 'libraries')); ?>
				</td>
			</tr>
			<tr>
				<th scope="row">
					&nbsp;
				</th>
				<td width="42%">
					<?php $igor->customcheckbox('settings-privateprefix', __('Remove "private"', 'libraries'), __('Remove "private" prefix from posts in loop', 'libraries')); ?>
				</td>
				<td width="42%">
					<?php $igor->customcheckbox('opengraph', __('Opengraph meta', 'libraries'), __('Opengraph meta fields in  &#60;head&#47;&#62;', 'libraries')); ?>
				</td>
			</tr>
			<tr>
				<th scope="row">
					&nbsp;
				</th>
				
				<td width="42%">
					<?php $igor->customcheckbox('header-wp_title-separator', __('Change title separator', 'libraries'), __('Change the title separator', 'libraries')); ?><p><?php $igor->custominput('header-wp_title-separator-character', 'header-wp_title-separator', '', '', ''); ?></p>
				</td>
				<td width="42%">
					<?php $igor->customcheckbox('media_oembed_filter', __('oEmbed contols', 'libraries'), __('Remove controls from youtube, mixcloud and vimeo interface', 'libraries')); ?>
				</td>
			</tr>
			
		</table>
		<table class="form-table form-table-border">
			<tr>
				<th scope="row">
					<?php _e('RSS feed', 'libraries'); ?>
				</th>
				<td>
					<?php $igor->customcheckbox('featured-rss', __('Featured to RSS', 'libraries'), __('Add at the beginning of each RSS feed an image of the post', 'libraries')); ?>
				</td>
			</tr>
		</table>
		<table class="form-table form-table-border">
			<tr>
				<th scope="row">
					<?php _e('Theme support', 'libraries'); ?>
				</th>
				<td width="42%">
					<?php $igor->customcheckbox('functions-html5', __('HTML5 markup', 'libraries'), __('Includes support for html5 markup for a list of comments, comment form, search form, gallery, etc.', 'libraries')); ?>
				</td>
				<td width="42%">
					<?php $igor->customcheckbox('functions-post-thumbnails', __('Post thumbnail', 'libraries'), __('Allows you to set a thumbnail post', 'libraries')); ?>
				</td>
			</tr>
		</table>
		<table class="form-table form-table-border">
			<tr>
				<th scope="row">
					<?php _e('Helper functions', 'libraries'); ?>
				</th>
				<td width="42%">
					<?php $igor->customcheckbox('functions-ischild', __('is_child()', 'libraries'), __('Additional reconciliation is whether the page is a subpage of someone', 'libraries')); ?>
				</td>
				<td width="42%">
					<?php $igor->customcheckbox('functions-bodyclass', __('Class in &#60;body&#47;&#62;', 'libraries'), __('Specify slug class in body tag', 'libraries')); ?>
				</td>
			</tr>
			<tr>
				<th scope="row">
					&nbsp;
				</th>
				<td width="42%">
					<?php $igor->customcheckbox('functions-nav-description', __('Menu item description', 'libraries'), __('Show the menu item description in wp_nav_menu', 'libraries')); ?>
				</td>
				<td width="42%">
					<?php $igor->customcheckbox('functions-escapekey', __('Editor on ESC', 'libraries'), __('Open the editing page by pressing ESC button', 'libraries')); ?>
				</td>
			</tr>
		</table>
		<table class="form-table form-table-border">
			<tr>
				<th scope="row">
					<?php _e('jQuery UI', 'libraries'); ?>
				</th>
				<td colspan="2">
					<?php $igor->checkbox('jquery-ui-core'); ?>
				</td>
			</tr>
		</table>
		<table class="form-table form-table-border">
			<tr<?php $igor->disabled('jquery-ui-core'); ?>>
				<th scope="row">
					<?php _e('Interactions', 'libraries'); ?>
				</th>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-draggable', 'jquery-ui-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-droppable', 'jquery-ui-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-resizable', 'jquery-ui-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-selectable', 'jquery-ui-core'); ?>
				</td>
		
			</tr>
			<tr<?php $igor->disabled('jquery-ui-core'); ?>>
				<th scope="row">
					&nbsp;
				</th>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-sortable', 'jquery-ui-core'); ?>
				</td>
				<td width="21%">&nbsp;</td>
				<td width="21%">&nbsp;</td>
				<td width="21%">&nbsp;</td>
			</tr>
		</table>
		<table class="form-table form-table-border">
			<tr<?php $igor->disabled('jquery-ui-core'); ?>>
				<th scope="row">
					<?php _e('Widget', 'libraries'); ?>
				</th>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-accordion', 'jquery-ui-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-autocomplete', 'jquery-ui-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-button', 'jquery-ui-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-datepicker', 'jquery-ui-core'); ?>
				</td>
			</tr>
			<tr<?php $igor->disabled('jquery-ui-core'); ?>>
				<th scope="row">
					&nbsp;
				</th>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-dialog', 'jquery-ui-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-menu', 'jquery-ui-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-progressbar', 'jquery-ui-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-selectmenu', 'jquery-ui-core'); ?>
				</td>
			</tr>
			<tr<?php $igor->disabled('jquery-ui-core'); ?>>
				<th scope="row">
					&nbsp;
				</th>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-slider', 'jquery-ui-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-spinner', 'jquery-ui-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-tabs', 'jquery-ui-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-tooltip', 'jquery-ui-core'); ?>
				</td>
			</tr>
		</table>
		<table class="form-table form-table-border">
			<tr<?php $igor->disabled('jquery-ui-core'); ?>>
				<th scope="row">
					<?php _e('Utilities', 'libraries'); ?>
				</th>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-widget', 'jquery-ui-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-position', 'jquery-ui-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-ui-mouse', 'jquery-ui-core'); ?>
				</td>
				<td width="21%">
			
				</td>
			</tr>
		</table>

		<table class="form-table form-table-border">
			<tr>
				<th scope="row">
					<?php _e('jQuery Effects', 'libraries'); ?>
				</th>
				<td colspan="2">
					<?php $igor->checkbox('jquery-effects-core'); ?>
				</td>
			</tr>
		</table>
		<table class="form-table form-table-border">
			<tr<?php $igor->disabled('jquery-effects-core'); ?>>
				<th scope="row">
					&nbsp;
				</th>
				<td width="21%">
					<?php $igor->checkbox('jquery-effects-blind', 'jquery-effects-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-effects-bounce', 'jquery-effects-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-effects-clip', 'jquery-effects-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-effects-drop', 'jquery-effects-core'); ?>
				</td>
			</tr>
			<tr<?php $igor->disabled('jquery-effects-core'); ?>>
				<th scope="row">
					&nbsp;
				</th>
				<td width="21%">
					<?php $igor->checkbox('jquery-effects-explode', 'jquery-effects-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-effects-fade', 'jquery-effects-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-effects-fold', 'jquery-effects-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-effects-highlight', 'jquery-effects-core'); ?>
				</td>
			</tr>
			<tr<?php $igor->disabled('jquery-effects-core'); ?>>
				<th scope="row">
					&nbsp;
				</th>
				<td width="21%">
					<?php $igor->checkbox('jquery-effects-pulsate', 'jquery-effects-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-effects-scale', 'jquery-effects-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-effects-shake', 'jquery-effects-core'); ?>
				</td>
				<td width="21%">
					<?php $igor->checkbox('jquery-effects-slide', 'jquery-effects-core'); ?>
				</td>
			</tr>
			<tr<?php $igor->disabled('jquery-effects-core'); ?>>
				<th scope="row">
					&nbsp;
				</th>
				<td width="21%">
					<?php $igor->checkbox('jquery-effects-transfer', 'jquery-ui-core'); ?>
				</td>
				<td width="21%">
				</td>
				<td width="21%">
				</td>
				<td width="21%">
				</td>
			</tr>
		</table>

	<?php do_settings_sections('theme-options'); ?>
	<?php submit_button(); ?>

	<p>
		<?php _e('Plugin to make work easier. Developed by Igor Kiselev in <a href="//www.justbenice.ru/">Just Be Nice</a>', 'libraries'); ?>
	</p>
</form>
</div>