<?php 


if( ! defined( 'ABSPATH' ) ) exit;

	global $library;
	
		// Функции для корректной работы плагина
		
		function _builtin_size($path){
			
			if (file_exists(plugin_dir_path( __FILE__ ).$path)) {
				
				return round(filesize(plugin_dir_path( __FILE__ ).$path) / 1024, 2).' KB';
				
			}
			
		}
		
		function _checkbox($name){
			
			global $library;
			
			if( property_exists($library, $name ) ) {
				
				$obj = $library->$name;
				
				$id = 'libraries-'.$obj->name;
				
				?>
				
				<label for="<?php echo $id; ?>">
					
					<input id="<?php echo $id; ?>" name="<?php echo $id; ?>" type="checkbox" value="1" <?php checked( '1', get_option($id) ); ?> />
					
					<strong><?php echo $obj->title; ?></strong> <small>(<?php if(property_exists($obj, 'src' )){?>+<?php echo _builtin_size($obj->src); } ?>, <?php if(property_exists($obj, 'ver' )){?>v <?php echo $obj->ver; } ?>)</small>
					
					<?php if(property_exists($obj, 'description' )){ ?>
						
					<p class="description">
					
						<?php echo $obj->description; ?>
					
						<?php if(property_exists($obj, 'link' )){ ?>
					
							<a href="<?php echo $obj->link; ?>" class="dashicons dashicons-editor-help" target="_blank"></a>
					
						<?php } ?>
					
					</p>
					
					<?php } ?>
					
				</label>
				
				<?php 
			}else{
				echo 'Error';
			}
		}
		
		function _custom_checkbox($key, $title = '', $description = '', $link = ''){
			
			$id = 'libraries-'.$key;
			
			?>
			
			<label for="<?php echo $id; ?>">
				
				<input id="<?php echo $id; ?>" name="<?php echo $id; ?>" type="checkbox" value="1" <?php checked( '1', get_option($id) ); ?> />
				
				<strong><?php echo $title; ?></strong> 
				
				<?php if($description){ ?>
					
				<p class="description">
				
					<?php echo $description; ?>
				
					<?php if($link){ ?>
				
						<a href="<?php echo $link; ?>" class="dashicons dashicons-editor-help" target="_blank"></a>
				
					<?php } ?>
				
				</p>
				
				<?php } ?>
				
			</label>
			<?php 
			
		}
		
		?><div class="wrap">
		
			<style>
				.form-table.form-table-border{
					border-top:1px Solid #fff;
				}
				.form-table.form-table-google{
					background-color:#fff;
					border-radius:20px;
				}
			</style>
			
			<h2><?php _e('Additional libraries','libraries'); ?></h2>
			
			<form method="post" action="options.php">
				
			<?php settings_fields( 'libraries' ); ?>
			
			<table class="form-table">
				<tr>
					<th scope="row">
						<?php _e('Styles','libraries'); ?>
					</th>
					<td><?php _checkbox('normalize'); ?></td>
				</tr>
				<tr>
					<th scope="row">
						&nbsp;
					</th>
					<td><?php _checkbox('justbenice'); ?></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td>
						<label for="libraries-justbenice-editor">
							<input id="libraries-justbenice-editor" name="libraries-justbenice-editor" type="checkbox" value="1" <?php checked( '1', get_option('libraries-justbenice-editor') ); ?> />
							<?php _e('Load justbenice.css styles, in WYSIWYG-editor.','libraries')?>
						</label>
					</td>
				</tr>
			</table>
			<table class="form-table form-table-border">
				<tr>
					<th scope="row"><?php _e('JS Libraries', 'libraries'); ?></th>
					<td><?php _checkbox('modernizr'); ?></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td><?php _checkbox('prefixfree'); ?></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td><?php _checkbox('pace'); ?></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td>
						<?php _custom_checkbox('imagesloaded','ImagesLoaded.js ',__('Allows you to check the loading of the image in the specified places. Now included in the list of basic wordpress scripts.','libraries'),'http://imagesloaded.desandro.com'); ?>
					</td>
				</tr>
			</table>
			<table class="form-table form-table-border">
				<tr>
					<th scope="row"><?php _e('Libraries based on jQuery', 'libraries'); ?></th>
					<td><?php _checkbox('maskedinput'); ?></td>
				</tr>
				<tr>
					<th scope="row"></th>
					<td><?php _checkbox('jquery_ui_touch_punch'); ?></td>
				</tr>
			</table>
			<table class="form-table form-table-border">
				<tr>
					<th scope="row"><?php _e('.lazy js library','libraries'); ?></th>
					<td><?php _checkbox('lazy'); ?>
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
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td><?php _custom_checkbox('lazy-srcset','Change image attributes for Lazy.js',__('Adding data- to srcset & sizes in image attributes. Allows Lazy.js to load images responsive.','libraries')); ?></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td><?php _custom_checkbox('lazy-brakepoints','Additional brakepoints',__('Add custom set of sizes to srcset in images.','libraries')); ?></td>
				</tr>
				<tr<?php if(!get_option( 'libraries-lazy-brakepoints' )){?> style="opacity:.3"<?php } ?>>
					<th scope="row">&nbsp;</th>
					<td>
						<input type="text" class="regular-text code" name="libraries-lazy-brakepoints-sizes" <?php disabled( 1, !get_option( 'libraries-lazy-brakepoints' ), true ); ?> value="<?php echo get_option( 'libraries-lazy-brakepoints-sizes' ); ?>" placeholder="<?php _e('Sizes divided by comma', 'libraries'); ?>" />
						<p class="description">
							<?php _e('Add image sizes you want to be generated and displayed in srcset.', 'libraries'); ?>
						</p>
						<p class="description"><small> <b><?php _e('Currently egistered sizes:', 'libraries'); ?></b> 
								<?php
									foreach(get_intermediate_image_sizes() as $key){
										echo "<span>".$key."</span> ";
									}
								?>
							</small>
						</p>
					</td>
				</tr>
			</table>
			<table class="form-table form-table-border">
				<tr>
					<th scope="row"><?php _e('Fullpage scroller', 'libraries'); ?></th>
					<td><?php _checkbox('fullpage'); ?></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td><?php _checkbox('fullpage_scrolloverflow'); ?></td>
				</tr>
			</table>
			<table class="form-table form-table-border">
				<tr>
					<th scope="row"><?php _e('Isotope block builder', 'libraries'); ?></th>
					<td><?php _checkbox('isotope'); ?></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td><?php _checkbox('isotope_masonry'); ?></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td><?php _checkbox('isotope_cellsbyrow'); ?></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td><?php _checkbox('isotope_cellsbycolumn'); ?></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td><?php _checkbox('isotope_fitcolumns'); ?></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td><?php _checkbox('isotope_horizontal'); ?></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td><?php _checkbox('isotope_packery'); ?></td>
				</tr>
			</table>
			<table class="form-table form-table-border">
					<tr>
						<th scope="row"><?php _e('owlCarousel slider', 'libraries'); ?></th>
						<td><?php _checkbox('owlcarousel'); ?></td>
					</tr>
					<tr>
						<th scope="row">&nbsp;</th>
						<td><?php _checkbox('animate'); ?></td>
					</tr>
					<tr>
						<th scope="row">&nbsp;</th>
						<td>
							<?php _custom_checkbox('owlcarousel-gallery',__('Change default gallery to owl', 'libraries'),__('Function that changes the default wordpress gallery layout to owlcarousel.','libraries')); ?>
					</td>
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
					<td>
						<?php _custom_checkbox('google-map',__('Google Maps', 'libraries'),__('Loads remote API, so you can create google maps on your website.','libraries'),''); ?>
					</td>
				</tr>
				<tr<?php if(!get_option( 'libraries-google-map' )){ ?> style="opacity:.3"<?php } ?>>
					<th scope="row">&nbsp;</th>
					<td>
						<input type="text" class="regular-text code" name="libraries-google-map-key" <?php disabled( 1, !get_option( 'libraries-google-map' ), true ); ?> value="<?php echo get_option( 'libraries-google-map-key' ); ?>" placeholder="<?php _e('API Key', 'libraries'); ?>"  />
						<span class="description"><a href="https://developers.google.com/maps/documentation/javascript/"><?php _e('Get key', 'libraries'); ?></a></span>
					</td>
				</tr>
				<tr<?php if(!get_option( 'libraries-google-map' )){?> style="opacity:.3"<?php } ?>>
					<th scope="row">&nbsp;</th>
					<td>
						<input type="text" class="regular-text code" name="libraries-google-map-limit" <?php disabled( 1, !get_option( 'libraries-google-map' ), true ); ?> value="<?php echo get_option( 'libraries-google-map-limit' ); ?>" placeholder="<?php _e('Page IDs divided by comma', 'libraries'); ?>" />
						<p class="description">
							<?php _e('Limit pages where to load the remote library. Leave empty if not needed', 'libraries'); ?>
						</p>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding:0px"><hr /></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td style="padding:0px">
						<table width="100%">
							<tr>
								<td width="50%"><?php _checkbox('google_clustermarkers'); ?></td>
								<td width="50%"><?php _checkbox('google_infobubble'); ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding:0px"><hr /></td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td>
						<?php _custom_checkbox('google-analytics',__('Google Analytics', 'libraries'),__('A script to track visitor statistics in Google Analytics.','libraries'),'http://analytics.google.com'); ?>
				</td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td>
						<input type="text" class="regular-text code" name="libraries-google-analytics-key" <?php disabled( 1, !get_option( 'libraries-google-analytics' ), true ); ?> value="<?php echo get_option( 'libraries-google-analytics-key' ); ?>" placeholder="<?php _e('UA-#######-##', 'libraries'); ?>"  />
					</td>
				</tr>
			</table>
			<table class="form-table form-table-yandex" >
				<tr>
					<th scope="row"><?php _e('Yandex', 'libraries'); ?></th>
					<td>
						<?php _custom_checkbox('yandex-metrics',__('Yandex Metrics', 'libraries'),__('A script to track visitor statistics in Yandex Metrics.','libraries'),'http://metrika.yandex.ru'); ?>
				</td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td>
						<input type="text" class="regular-text code" name="libraries-yandex-metrics-key" <?php disabled( 1, !get_option( 'libraries-yandex-metrics' ), true ); ?> value="<?php echo get_option( 'libraries-yandex-metrics-key' ); ?>" placeholder="<?php _e('########', 'libraries'); ?>"  />
					</td>
				</tr>
			</table>
			
			<table class="form-table form-table-custome">
				<tr>
					<th scope="row">&nbsp;</th>
					<td>
					<?php _custom_checkbox('filenames',__('Filename prefix', 'libraries'),__('Set prefix for filenames that are uploaded to wordpress.','libraries')); ?>
					</td>
				</tr>
				<tr>
				<th scope="row">&nbsp;</th>
				<td>
					<input type="text" class="regular-text code" name="libraries-filenames-slug" <?php disabled( 1, !get_option( 'libraries-filenames' ), true ); ?> value="<?php echo get_option( 'libraries-filenames-slug' ); ?>" placeholder=""  />
				</td>
			</tr>
			
			<table class="form-table form-table-border">
					<tr>
						<th scope="row"><?php _e('Functions', 'libraries'); ?></th>
						<td>
							<?php _custom_checkbox('disable-emoji',__('Remove emoji support', 'libraries'),__('Убирать из <head/> стили и скрипты для обработки emoji на сайте.','libraries')); ?>
					</td>
					</tr>
					<tr>
						<th scope="row">&nbsp;</th>
						<td>
							<?php _custom_checkbox('disable-adminbar',__('Remove administrator bar', 'libraries'),__('Скрывать панель администратора на сайте.','libraries')); ?>
					</td>
					</tr>
					<tr>
						<th scope="row">&nbsp;</th>
						<td>
							<?php _custom_checkbox('disable-generator',__('Remove generator meta', 'libraries'),__('Убирать из <head/> информацию про систему администрирования и версию.','libraries')); ?></td>
					</tr>
					<tr>
						<th scope="row">&nbsp;</th>
						<td>
							<?php _custom_checkbox('disable-rsslinks',__('RSS фиды', 'libraries'),__('Убирать из <head/> ссылки на RSS фиды сайта (будут продажлать работать если просто дописать /feed), а также xml для блог-клиентов.','libraries')); ?></td>
					</tr>
					<tr>
						<th scope="row">&nbsp;</th>
						<td>
							<?php _custom_checkbox('disable-rellinks',__('REL ссылки', 'libraries'),__('Убирать из <head/> ссылки на главную страницу, на первую запись, на предыдущую и следующую запись, связь с родительской записью и короткую ссылку к текущей странице.','libraries')); ?></td>
					</tr>
					<tr>
						<th scope="row">&nbsp;</th>
						<td>
							<?php _custom_checkbox('enable-navmenus',__('Переместить пункт меню в основное меню', 'libraries'),__('','libraries')); ?></td>
					</tr>
					
					<tr>
						<th scope="row">&nbsp;</th>
						<td>
							<?php _custom_checkbox('content-the_title',__('«Нет заголовка»', 'libraries'),__('Отображать фразу «Нет заголовка» в the_title, когда заголовок у поста или страницы пуст.','libraries')); ?></td>
					</tr>
					
					<tr>
						<th scope="row">&nbsp;</th>
						<td>
							<?php _custom_checkbox('
					header-wp_title',__('Название сайта в заголовке', 'libraries'),__('Отображать название сайта (компании) в заголовке после назнваия страницы (wp_title).','libraries')); ?></td>
					</tr>
					
					<tr>
						<th scope="row">&nbsp;</th>
						<td>
							<?php _custom_checkbox('
					featured-rss',__('Featured to RSS', 'libraries'),__('Добавить в начале каждой записи RSS потока изображение поста','libraries')); ?></td>
					</tr>
					
					<tr>
						<th scope="row">&nbsp;</th>
						<td>
							<?php _custom_checkbox('
					functions-html5',__('HTML5 разметка', 'libraries'),__('Включает поддержку html5 разметки для списка комментариев, формы комментариев, формы поиска, галереи и т.д.','libraries')); ?></td>
					</tr>
					
					<tr>
						<th scope="row">&nbsp;</th>
						<td>
							<?php _custom_checkbox('
					functions-post-thumbnails',__('Миниатюра к посту', 'libraries'),__('Позволяет устанавливать миниатюру посту.','libraries')); ?></td>
					</tr>
					
					<tr>
						<th scope="row">&nbsp;</th>
						<td>
							<?php _custom_checkbox('
					functions-ischild',__('Функция is_child()', 'libraries'),__('Дополнительная сверка является ли страница, подстраницей кого-то.','libraries')); ?></td>
					</tr>
					
					<tr>
						<th scope="row">&nbsp;</th>
						<td>
							<?php _custom_checkbox('
					functions-bodyclass',__('Класс в <body/>', 'libraries'),__('Указывать в классах страницы ее название (slug).','libraries')); ?></td>
					</tr>
					
					<tr>
						<th scope="row">&nbsp;</th>
						<td>
							<?php _custom_checkbox('
					functions-nav-description',__('Описание пункта меню', 'libraries'),__('Показывать в параграфе описание ссылки в wp_nav_menu.','libraries')); ?></td>
					</tr>
					
					<tr>
						<th scope="row">&nbsp;</th>
						<td>
							<?php _custom_checkbox('
					functions-escapekey',__('Редактор при нажатии ESC', 'libraries'),__('Открывать редактирование страницы при нажатии ESC.','libraries')); ?></td>
					</tr>
					
					<tr>
						<th scope="row">&nbsp;</th>
						<td>
							<?php _custom_checkbox('
					editor-css-normalize',__('Normalize.css, в WYSIWYG-редактор', 'libraries'),__('','libraries')); ?></td>
					</tr>
					
			</table>
			
			
			<?php do_settings_sections("theme-options"); ?>
			
			<?php submit_button(); ?>
			
			<p><?php _e('Plugin to make work easier. Developed by Igor Kiselev in <a href="//www.justbenice.ru/">Just Be Nice</a>', 'libraries'); ?></p>
			
		</form>
		
	</div>