<?php 
if (!defined('ABSPATH')) {
	exit;
}

		function _builtin_size($path){
			if (file_exists(plugin_dir_path(__FILE__).$path)) {
				return round(filesize(plugin_dir_path(__FILE__).$path) / 1024, 2).' KB';
			}
		}
		function _checkbox($name) {
			global $lib;
			$settings = get_option('additional_libraries');
			if (!empty($name)) { ?>
					<label>
						<input name="additional_libraries[<?php echo $lib[$name]['name']; ?>]" type="checkbox" value="1" <?php (!empty($settings[$lib[$name]['name']]) ? checked('1', $settings[$lib[$name]['name']]) : false); ?> />
						<strong><?php echo $lib[$name]['title']; ?></strong>
						<small>(<?php if (!empty($lib[$name]['src'])) { ?>+<?php echo _builtin_size($lib[$name]['src']); } ?>, <?php if (!empty($lib[$name]['ver'])) { ?>v <?php echo $lib[$name]['ver']; } ?>)</small>
					</label>
					
					<?php if (!empty($lib[$name]['description'])) { ?>
						<p class="description">
							<?php echo $lib[$name]['description']; ?>
							<?php if (!empty($lib[$name]['link'])) { ?>
								<a href="<?php echo $lib[$name]['link']; ?>" class="dashicons dashicons-editor-help" target="_blank"></a>
							<?php  }  ?>
						</p>
					<?php  }  ?>
				
					
				
				<?php 
			}
		}
		function _custom_checkbox($key, $title = '', $description = '', $link = '') {
			
			$settings = get_option('additional_libraries');
			
			?><label><input name="additional_libraries[<?php echo $key; ?>]" type="checkbox" value="1" <?php (isset($settings[$key]) ? checked('1', $settings[$key]) : false); ?> /> <strong><?php echo $title; ?></strong></label><?php
			
			if ($description) { ?><p class="description"><?php echo $description; ?><?php if ($link) { ?> <a href="<?php echo $link; ?>" class="dashicons dashicons-editor-help" target="_blank"></a><?php } ?></p><?php }
			} 
		
		function _custom_input($key, $depend = '', $placeholder='', $description = '', $link = '') {
			
			$settings = get_option('additional_libraries');
			
			?><input type="text" class="regular-text code" name="additional_libraries[<?php echo $key; ?>]"<?php
			
			if ($depend) { disabled(1, empty($settings[$depend]), true); }
			
			if (!empty($settings[$key])) { ?> value="<?php echo $settings[$key]; ?>"<?php } 
			
			if ($placeholder) { ?> placeholder="<?php echo $placeholder; ?>"<?php } ?> /><?php
			
			if ($link) { ?><span class="description"><?php echo $link; ?></span><?php  }
			
			if ($description) { ?><p class="description"><?php echo $description; ?></p><?php } 
		}
		
		global $lib;
		
		
		?>
		
		<div class="wrap">
			
			<pre><?php //var_dump($wp_scripts); ?></pre>
			
			<style>
				.form-table.form-table-border{
					border-top:1px Solid #fff;
				}
				.form-table.form-table-google{
					background-color:#fff;
					border-radius:20px;
				}
				.disabled{
					opacity: 0.3;
				}
				.form-table td{ vertical-align:top}
				.form-table th{width:15%;}
				
				p.description{width:80%;}
			</style>
	
			<h1><?php _e('Additional libraries', 'libraries'); ?></h1>
			
			<form method="post" action="options.php">
				
			<?php settings_fields('libraries'); ?>
			
			<?php $settings = get_option('additional_libraries'); ?>
			
			<table class="form-table">
				<tr>
					<th scope="row">
						<?php _e('Styles', 'libraries'); ?>
					</th>
					<td width="42%">
						<?php _checkbox('normalize'); ?>
					</td>
					<td width="42%">
						<?php _checkbox('justbenice'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row">
						&nbsp;
					</th>
					<td width="42%">
						<?php _custom_checkbox('editor-css-normalize', __('Load normalize.css styles in WYSIWYG-editor', 'libraries'), __('', 'libraries')); ?>
					</td>
					<td width="42%">
						<?php _custom_checkbox('justbenice-editor', __('Load justbenice.css styles in WYSIWYG-editor', 'libraries'), __('', 'libraries')); ?>
					</td>
				</tr>
			</table>
			
			<table class="form-table form-table-border">
				<tr>
					<th scope="row">
						<?php _e('JS Libraries', 'libraries'); ?>
					</th>
					<td width="42%">
						<?php _checkbox('modernizr'); ?>
					</td>
					<td width="42%">
						<?php _checkbox('prefixfree'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row">
						&nbsp;
					</th>
					<td width="42%">
						<?php _checkbox('pace'); ?>
					</td>
					<td width="42%">
						<?php _custom_checkbox('imagesloaded', 'ImagesLoaded.js ', __('Allows you to check the loading of the image in the specified places. Now included in the list of basic wordpress scripts.', 'libraries'), 'http://imagesloaded.desandro.com'); ?>
					</td>
				</tr>
			</table>
			
			<table class="form-table form-table-border">
				<tr>
					<th scope="row"><?php _e('Libraries based on jQuery', 'libraries'); ?></th>
					<td><?php _checkbox('jquerymask'); ?></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td><?php _checkbox('jquery_ui_touch_punch'); ?></td>
				</tr>
			</table>
			
			<table class="form-table form-table-border">
				<tr>
					<th scope="row">
						<?php _e('.lazy js library', 'libraries'); ?>
					</th>
					<td width="42%">
						<?php _checkbox('lazy'); ?>
						<p>
							<details>
								<summary><?php _e('Code example', 'libraries'); ?></summary>
								<pre>jQuery('.lazy').Lazy({</pre>
								<pre>	scrollDirection: 'vertical',</pre>
								<pre>	effect: 'fadeIn',</pre>
								<pre>	visibleOnly: true,</pre>
								<pre>	onError: function(element) {</pre>
								<pre>		console.log('error loading ' + element.data('src'));</pre>
								<pre>	}</pre>
								<pre>});</pre>
							</details>
						</p>
					</td>
					<td width="42%">
						<?php _custom_checkbox('lazy-srcset', 'Change image attributes for Lazy.js', __('Adding data- to srcset & sizes in image attributes. Allows Lazy.js to load images responsive.', 'libraries')); ?>
					</td>
				</tr>
				<tr>
					<th scope="row">
						&nbsp;
					</th>
					<td colspan="2">
						<?php _custom_checkbox('lazy-brakepoints', 'Additional brakepoints', __('Add custom set of sizes to srcset in images.', 'libraries')); ?>
					</td>
				</tr>
				<tr<?php if (empty($settings['lazy-brakepoints'])) { ?> class="disabled"<?php } ?>>
					<th scope="row">
						&nbsp;
					</th>
					<td colspan="2">
						<?php _custom_input('lazy-brakepoints-sizes', 'lazy-brakepoints', __('Sizes divided by comma', 'libraries'), __('Add image sizes you want to be generated and displayed in srcset.', 'libraries'), ''); ?>
						<p class="description">
							<small><strong><?php _e('Currently egistered sizes:', 'libraries'); ?></strong> 
								<?php foreach (get_intermediate_image_sizes() as $size) { echo '<span>'.$size.'</span> '; } ?>
							</small>
						</p>
					</td>
				</tr>
			</table>
			
			<table class="form-table form-table-border">
				<tr>
					<th scope="row"><?php _e('Fullpage scroller', 'libraries'); ?></th>
					<td width="42%"><?php _checkbox('fullpage'); ?></td>
					<td width="42%"><?php _checkbox('fullpage_scrolloverflow'); ?></td>
				</tr>
			</table>
			
			<table class="form-table form-table-border">
				<tr>
					<th scope="row"><?php _e('Isotope block builder', 'libraries'); ?></th>
					<td colspan="2"><?php _checkbox('isotope'); ?></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td width="42%"><?php _checkbox('isotope_masonry'); ?></td>
					<td width="42%"><?php _checkbox('isotope_fitcolumns'); ?></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td width="42%"><?php _checkbox('isotope_cellsbyrow'); ?></td>
					<td width="42%"><?php _checkbox('isotope_cellsbycolumn'); ?></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td width="42%"><?php _checkbox('isotope_horizontal'); ?></td>
					<td width="42%"><?php _checkbox('isotope_packery'); ?></td>
				</tr>
			</table>
			
			<table class="form-table form-table-border">
				<tr>
					<th scope="row"><?php _e('owlCarousel slider', 'libraries'); ?></th>
					<td width="42%">
						<?php _checkbox('owlcarousel'); ?>
					</td>
					<td width="42%">
						<?php _custom_checkbox('owlcarousel-gallery', __('Change default gallery to owl', 'libraries'), __('Function that changes the default wordpress gallery layout to owlcarousel.', 'libraries')); ?>
					</td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td colspan="2"><?php _checkbox('animate'); ?></td>
				</tr>
			</table>
			
			<table class="form-table form-table-border">
				<tr>
					<th scope="row"><?php _e('Beta libraries by Just Be Nice', 'libraries'); ?></th>
					<td><?php _checkbox('aspectratio'); ?></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td>
						<?php _checkbox('stretchclass'); ?>
						<p>
							<pre>jQuery('img').stretch();</pre>
						</p>
					</td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td><?php _checkbox('fullscreenclass'); ?>
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
						<?php _custom_checkbox('google-map', __('Google Maps', 'libraries'), __('Loads remote API, so you can create google maps on your website.', 'libraries'), ''); ?>
					</td>
				</tr>
				<tr<?php if (empty($settings['google-map'])) { ?> class="disabled"<?php } ?>>
					<th scope="row">
							&nbsp;
						</th>
						<td colspan="2">
							<?php _custom_input('google-map-key', 'google-map', __('API Key', 'libraries'), '', '<a href="https://developers.google.com/maps/documentation/javascript/">'.__('Get key', 'libraries').'</a>'); ?>
							
						</td>
				</tr>
				<tr<?php if (empty($settings['google-map'])) { ?> class="disabled"<?php } ?>>
					<th scope="row">&nbsp;</th>
					<td colspan="2">
						<?php _custom_input('google-map-limit', 'google-map', __('Page IDs divided by comma', 'libraries'), __('Limit pages where to load the remote library. Leave empty if not needed', 'libraries'), ''); ?>
					</td>
				</tr>
				<tr>
					<td colspan="3" style="padding:0px"><hr /></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td width="42%">
						<?php _checkbox('google_clustermarkers'); ?>
					</td>
					<td width="42%">
						<?php _checkbox('google_infobubble'); ?>
					</td>
				</tr>
				<tr>
					<td colspan="3" style="padding:0px"><hr /></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td colspan="2">
						<?php _custom_checkbox('google-analytics', __('Google Analytics', 'libraries'), __('A script to track visitor statistics in Google Analytics.', 'libraries'), 'http://analytics.google.com'); ?>
				</td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td colspan="2">
						<?php _custom_input('google-analytics-key', 'google-analytics', __('UA-#######-##', 'libraries'), '', ''); ?>
					</td>
				</tr>
			</table>
			
			<table class="form-table form-table-yandex" >
				<tr>
					<th scope="row"><?php _e('Yandex', 'libraries'); ?></th>
					<td>
						<?php _custom_checkbox('yandex-metrics', __('Yandex Metrics', 'libraries'), __('A script to track visitor statistics in Yandex Metrics.', 'libraries'), 'http://metrika.yandex.ru'); ?>
				</td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td>
						<?php _custom_input('yandex-metrics-key', 'yandex-metrics', __('########', 'libraries'), '', ''); ?>
					</td>
				</tr>
			</table>
			
			<table class="form-table form-table-border">
				<tr>
					<th scope="row">&nbsp;</th>
					<td>
						<?php _custom_checkbox('filenames', __('Filename prefix', 'libraries'), __('Set prefix for filenames that are uploaded to wordpress.', 'libraries')); ?>
					</td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td>
						<?php _custom_input('filenames-slug', 'filenames', '', '', ''); ?>
					</td>
				</tr>
			</table>
			
			<table class="form-table form-table-border">
				<tr>
					<th scope="row">
						<?php _e('Убираем из &#60;head&#47;&#62;', 'libraries'); ?>
					</th>
					<td width="42%">
						<?php _custom_checkbox('disable-emoji', __('Remove emoji support', 'libraries'), __('Убирать из &#60;head&#47;&#62; стили и скрипты для обработки emoji на сайте.', 'libraries')); ?>
					</td>
					<td width="42%">
						<?php _custom_checkbox('disable-generator', __('Remove generator meta', 'libraries'), __('Убирать из &#60;head&#47;&#62; информацию про систему администрирования и версию.', 'libraries')); ?>
					</td>
				</tr>
				<tr>
					<th scope="row">
						&nbsp;
					</th>
					<td width="42%">
						<?php _custom_checkbox('disable-rsslinks', __('RSS фиды', 'libraries'), __('Убирать из &#60;head&#47;&#62; ссылки на RSS фиды сайта (будут продажлать работать если просто дописать /feed), а также xml для блог-клиентов.', 'libraries')); ?>
					</td>
					<td width="42%">
						<?php _custom_checkbox('disable-rellinks', __('REL ссылки', 'libraries'), __('Убирать из &#60;head&#47;&#62; ссылки на главную страницу, на первую запись, на предыдущую и следующую запись, связь с родительской записью и короткую ссылку к текущей странице.', 'libraries')); ?>
					</td>
				</tr>
			</table>
			<table class="form-table form-table-border">
				<tr>
					<th scope="row">
						<?php _e('Интерфейс вордпресса', 'libraries'); ?>
					</th>
					<td width="42%">
						<?php _custom_checkbox('disable-adminbar', __('Remove administrator bar', 'libraries'), __('Скрывать панель администратора на сайте.', 'libraries')); ?>
					</td>
					<td width="42%">
						<?php _custom_checkbox('enable-navmenus', __('Переместить пункт меню в основное меню', 'libraries'), __('', 'libraries')); ?>
					</td>
				</tr>
			</table>
			<table class="form-table form-table-border">
				<tr>
					<th scope="row">
						Обработка контента
					</th>
					<td width="42%">
						<?php _custom_checkbox('content-the_title', __('«Нет заголовка»', 'libraries'), __('Отображать фразу «Нет заголовка» в the_title, когда заголовок у поста или страницы пуст.', 'libraries')); ?>
					</td>
					<td width="42%">
						<?php _custom_checkbox('header-wp_title', __('Название сайта в заголовке', 'libraries'), __('Отображать название сайта (компании) в заголовке после назнваия страницы (wp_title).', 'libraries')); ?>
					</td>
				</tr>
			</table>
			<table class="form-table form-table-border">
				<tr>
					<th scope="row">
						RSS
					</th>
					<td>
						<?php _custom_checkbox('featured-rss', __('Featured to RSS', 'libraries'), __('Добавить в начале каждой записи RSS потока изображение поста', 'libraries')); ?>
					</td>
				</tr>
			</table>
			<table class="form-table form-table-border">
				<tr>
					<th scope="row">
						Поддержка для тем
					</th>
					<td width="42%">
						<?php _custom_checkbox('functions-html5', __('HTML5 разметка', 'libraries'), __('Включает поддержку html5 разметки для списка комментариев, формы комментариев, формы поиска, галереи и т.д.', 'libraries')); ?>
					</td>
					<td width="42%">
						<?php _custom_checkbox('functions-post-thumbnails', __('Миниатюра к посту', 'libraries'), __('Позволяет устанавливать миниатюру посту.', 'libraries')); ?>
					</td>
				</tr>
			</table>
			<table class="form-table form-table-border">
				<tr>
					<th scope="row">
						Functions
					</th>
					<td width="42%">
						<?php _custom_checkbox('functions-ischild', __('Функция is_child()', 'libraries'), __('Дополнительная сверка является ли страница, подстраницей кого-то.', 'libraries')); ?>
					</td>
					<td width="42%">
						<?php _custom_checkbox('functions-bodyclass', __('Класс в &#60;body&#47;&#62;', 'libraries'), __('Указывать в классах страницы ее название (slug).', 'libraries')); ?>
					</td>
				</tr>
				<tr>
					<th scope="row">
						&nbsp;
					</th>
					<td width="42%">
						<?php _custom_checkbox('functions-nav-description', __('Описание пункта меню', 'libraries'), __('Показывать в параграфе описание ссылки в wp_nav_menu.', 'libraries')); ?>
					</td>
					<td width="42%">
						<?php _custom_checkbox('functions-escapekey', __('Редактор при нажатии ESC', 'libraries'), __('Открывать редактирование страницы при нажатии ESC.', 'libraries')); ?>
					</td>
				</tr>
			</table>

			
			
			<?php do_settings_sections('theme-options'); ?>
			
			<?php submit_button(); ?>
			
			<p><?php _e('Plugin to make work easier. Developed by Igor Kiselev in <a href="//www.justbenice.ru/">Just Be Nice</a>', 'libraries'); ?></p>
			
		</form>
		
	</div>