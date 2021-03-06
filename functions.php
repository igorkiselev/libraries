<?php

if (!defined('ABSPATH')) {
    exit;
}

$settings = get_option('additional_libraries');

if (!empty($settings['imagesloaded'])) {
    add_action('wp_enqueue_scripts', function () {
        wp_enqueue_script('imagesloaded');
    });
}

if (!empty($settings['google-map'])) {
    add_action('wp_enqueue_scripts', function () {
        global $settings;

        $link = 'http://maps.googleapis.com/maps/api/js?v=3.exp&language=ru&libraries=places';

        if (!empty($settings['google-map-key'])) {
            $link = $link.'&key='.$settings['google-map-key'];
        }

        if (!empty($settings['google-map-limit'])) {
            $array = explode(',', $settings['google-map-limit']);

            if (is_page($array)) {
                wp_enqueue_script('google-map', $link, array(), '3.0.0', true);
            }
        } else {
            wp_enqueue_script('google-map', $link, array(), '3.0.0', true);
        }
    });
}

if (!empty($settings['google-map-key']) && class_exists('acf')) {
    add_action('acf/init', function () {
        global $settings;

        acf_update_setting('google_api_key', $settings['google-map-key']);
    });

    add_filter('acf/fields/google_map/api', function ($api) {
        global $settings;

        $api['key'] = $settings['google-map-key'];

        return $api;
    });
}

if (!empty($settings['justbenice-editor'])) {
    add_action('after_setup_theme', function () {
        global $lib;
        add_editor_style(plugin_dir_url(__FILE__).$lib['justbenice']['src']);
    });
}

if (!empty($settings['google-analytics']) && !empty($settings['google-analytics-key'])) {
    add_action('wp_footer', function () {
        global $settings;

        echo '<script>'.
             '(function(b, o, i, l, e, r) {'.
                'b.GoogleAnalyticsObject = l;'.
                'b[l] || (b[l] = function() {'.
                    '(b[l].q = b[l].q || []).push(arguments)'.
                '});'.
                'b[l].l = +new Date;'.
                'e = o.createElement(i);'.
                'r = o.getElementsByTagName(i)[0];'.
                "e.src = '//www.google-analytics.com/analytics.js';".
                'r.parentNode.insertBefore(e, r)'.
            "}(window, document, 'script', 'ga'));".
            "ga('create', '".$settings['google-analytics-key']."');".
            "ga('send', 'pageview');".
        "</script>\n";
    });
}

if (!empty($settings['yandex-metrics']) && !empty($settings['yandex-metrics-key'])) {
    add_action('wp_footer', function () {
        global $settings;

        echo    '<!-- Yandex.Metrika counter -->'.
                    "<script type='text/javascript'>".
                    '(function(d, w, c) {'.
                        '(w[c] = w[c] || []).push(function() {'.
                            'try {'.
                                'w.yaCounter'.$settings['yandex-metrics-key'].' = new Ya.Metrika({'.
                                    'id: '.$settings['yandex-metrics-key'].','.
                                    'clickmap: true,'.
                                    'trackLinks: true,'.
                                    'accurateTrackBounce: true,'.
                                    'webvisor: true,'.
                                    'trackHash: true'.
                                '});'.
                            '} catch (e) {}'.
                        '});'.
                        "var n = d.getElementsByTagName('script')[0],".
                            "s = d.createElement('script'),".
                            'f = function() {'.
                                'n.parentNode.insertBefore(s, n);'.
                            '};'.
                        "s.type = 'text/javascript';".
                        's.async = true;'.
                        "s.src = 'https://mc.yandex.ru/metrika/watch.js';".
                        "if (w.opera == '[object Opera]') {".
                            "d.addEventListener('DOMContentLoaded', f, false);".
                        '} else {'.
                            'f();'.
                        '}'.
                    "})(document, window, 'yandex_metrika_callbacks');".
                    '</script>'.
                    '<noscript>'.
                    '<div>'.
                    "<img src='https://mc.yandex.ru/watch/45776769' style='position:absolute; left:-9999px;' alt='' />".
                    '</div>'.
                    '</noscript>'.
                '<!-- /Yandex.Metrika counter -->';
    });
}

if (!empty($settings['filenames']) && !empty($settings['filenames-slug'])) {
    add_filter('sanitize_file_name', function ($filename) {
        global $settings;

        $slug = $settings['filenames-slug'];
        $info = pathinfo($filename);
        $ext = empty($info['extension']) ? '' : '.'.$info['extension'];
        $name = basename($filename, $ext);

        return $slug.'-'.$name.$ext;
    }, 10);
}

if (!empty($settings['lazy-srcset'])) {
    add_filter('wp_get_attachment_image_attributes', function ($atts, $attachment) {
        if (isset($atts['sizes'])) {
            $atts['data-sizes'] = $atts['sizes'];
        }
        unset($atts['sizes']);
        if (isset($atts['srcset'])) {
            $atts['data-srcset'] = $atts['srcset'];
        }
        unset($atts['srcset']);

        return $atts;
    }, 10, 2);
}

if (!empty($settings['lazy-brakepoints'])) {
    if (!empty($settings['lazy-brakepoints-sizes'])) {
        add_action('after_setup_theme', function () {
            global $settings;
            $array = explode(',', $settings['lazy-brakepoints-sizes']);
            if (!empty($array)) {
                foreach ($array as &$value) {
                    add_image_size($value.'w', $value, $value, false);
                }
            }
        });
    }
}

if (!empty($settings['owlcarousel-gallery'])) {
    add_shortcode('gallery', function ($attr) {
        $post = get_post();
        static $instance = 0;
        ++$instance;
        if (!empty($attr['ids'])) {
            if (empty($attr['orderby'])) {
                $attr['orderby'] = 'post__in';
            }
            $attr['include'] = $attr['ids'];
        }
        $output = apply_filters('post_gallery', '', $attr, $instance);
        if ($output != '') {
            return $output;
        }
        $html5 = current_theme_supports('html5', 'gallery');
        $atts = shortcode_atts(array(
            'order' => 'ASC',
            'orderby' => 'menu_order ID',
            'id' => $post ? $post->ID : 0,
            'itemtag' => $html5 ? 'figure'     : 'dl',
            'icontag' => $html5 ? 'div'        : 'dt',
            'captiontag' => $html5 ? 'figcaption' : 'dd',
            'columns' => 3,
            'size' => 'large',
            'include' => '',
            'exclude' => '',
            'link' => '',
            'autoplay' => false,
            'autoplayhoverpause' => false,
            'loop' => false,
            'autoplaytimeout' => 5000,
        ), $attr, 'gallery');

        $id = intval($atts['id']);

        if (!empty($atts['include'])) {
            $_attachments = get_posts(
                array(
                    'include' => $atts['include'],
                    'post_status' => 'inherit',
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',
                    'order' => $atts['order'],
                    'orderby' => $atts['orderby'],
                )
            );

            $attachments = array();

            foreach ($_attachments as $key => $val) {
                $attachments[$val->ID] = $_attachments[$key];
            }
        } elseif (!empty($atts['exclude'])) {
            $attachments = get_children(
                array(
                    'post_parent' => $id,
                    'exclude' => $atts['exclude'],
                    'post_status' => 'inherit',
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',
                    'order' => $atts['order'],
                    'orderby' => $atts['orderby'],
                )
            );
        } else {
            $attachments = get_children(
                array(
                    'post_parent' => $id,
                    'post_status' => 'inherit',
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',
                    'order' => $atts['order'],
                    'orderby' => $atts['orderby'],
                )
            );
        }

        if (empty($attachments)) {
            return '';
        }

        if (is_feed()) {
            $output = "\n";

            foreach ($attachments as $att_id => $attachment) {
                $output .= wp_get_attachment_link($att_id, $atts['size'], true)."\n";
            }

            return $output;
        }

        $itemtag = tag_escape($atts['itemtag']);

        $captiontag = tag_escape($atts['captiontag']);

        $icontag = tag_escape($atts['icontag']);

        $valid_tags = wp_kses_allowed_html('post');

        if (!isset($valid_tags[ $itemtag ])) {
            $itemtag = 'dl';
        }

        if (!isset($valid_tags[ $captiontag ])) {
            $captiontag = 'dd';
        }

        if (!isset($valid_tags[ $icontag ])) {
            $icontag = 'dt';
        }

        $columns = intval($atts['columns']);

        $autoplay = $atts['autoplay'];

        $autoplayhoverpause = $atts['autoplayhoverpause'];

        $autoplaytimeout = $atts['autoplaytimeout'];

        $loop = $atts['loop'];

        $itemwidth = $columns > 0 ? floor(100 / $columns) : 100;

        $selector = "carousel-{$instance}";

        $size_class = sanitize_html_class($atts['size']);

        $gallery_div = "<div id='$selector' data-items='{$columns}' data-autoplay='{$autoplay}' data-autoplaytimeout='{$autoplaytimeout}' data-autoplayhoverpause='{$autoplayhoverpause}' data-loop='{$loop}' class='content_gallery__carousel carousel carouselid-{$id} carousel-columns-{$columns} carousel-size-{$size_class}'>";

        $output = apply_filters('gallery_style', $gallery_div);

        $i = 0;

        foreach ($attachments as $id => $attachment) {
            $attr = (trim($attachment->post_excerpt)) ? array('aria-describedby' => "$selector-$id") : '';

            $theme = 0;

            if (get_field('theme', $id)) {
                $theme = get_field('theme', $id);
            }
            $default_attr = array('src' => ' ', 'class' => 'lazy stretch', 'data-theme' => $theme);

            if (!empty($atts['link']) && 'file' === $atts['link']) {
                $image_output = wp_get_attachment_link($id, $atts['size'], false, false, false, $default_attr);
            } elseif (!empty($atts['link']) && 'none' === $atts['link']) {
                $image_output = wp_get_attachment_image($id, $atts['size'], false, $default_attr);
            } else {
                $image_output = wp_get_attachment_link($id, $atts['size'], true, false, false, $default_attr);
            }

            $image_meta = wp_get_attachment_metadata($id);

            $orientation = '';

            if (isset($image_meta['height'], $image_meta['width'])) {
                $orientation = ($image_meta['height'] > $image_meta['width']) ? 'portrait' : 'landscape';
            }

            $output .= "<{$itemtag} class='carousel-item'>";

            $output .= $image_output;

            if ($captiontag && trim($attachment->post_excerpt)) {
                $output .= "
            
                    <{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
            
                    ".wptexturize($attachment->post_excerpt)."
            
                    </{$captiontag}>";
            }

            $output .= "</{$itemtag}>";
        }

        $output .= "</div>\n";

        return $output;
    });

    function acf_gallery($name = '')
    {
        if (!empty($name)) {
            $array = get_field($name, false, false);

            if (!empty($array)) {
                $shortcode = '['.'gallery ids="'.implode(',', $array).'" columns="1"]';

                echo do_shortcode($shortcode);
            } else {
                _e('No images set in the gallery', 'libraries');
            }
        }
    }

    add_action('print_media_templates', function () {
        ?>
		<script type="text/html" id="tmpl-custom-gallery-setting">
			<div style="padding-top:15px">
				<label class="setting">
					<span><?php _e('Autoplay', 'libraries'); ?></span>
					<input type="checkbox" data-setting="autoplay">
				</label>
				<label class="setting">
					<span><?php _e('Pause autoplay on hover', 'libraries'); ?></span>
					<input type="checkbox" data-setting="autoplayHoverPause">
				</label>
				<label class="setting">
					<span><?php _e('Loop', 'libraries'); ?></span>
					<input type="checkbox" data-setting="loop">
				</label>
				<label class="setting">
					<span><?php _e('Autoplay timeout', 'libraries'); ?></span>
					<input type="number" value="" data-setting="autoplayTimeout" style="float:left;" min="1000" max="10000">
				</label>
			</div>
		</script>

		<script>
			jQuery(document).ready(function(){
		
				_.extend(wp.media.gallery.defaults, {
					autoplayTimeout: "5000",
					autoplay: false,
					autoplayHoverPause: false,
					loop: false,
				});

				wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
					template: function(view){
						return wp.media.template('gallery-settings')(view)
						+ wp.media.template('custom-gallery-setting')(view);
					},
			
					update: function( key ) {
						var value = this.model.get( key ),
						$setting = this.$('[data-setting="' + key + '"]'),
						$buttons, $value;

				
						if ( ! $setting.length ) {
							return;
						}

						if ( $setting.is('input[type="text"], textarea') ) {
							if ( ! $setting.is(':focus') ) {
								$setting.val( value );
							}
						} else if ( $setting.is('input[type="checkbox"]') ) {
							$setting.prop( 'checked', !! value && 'false' !== value );
						} else {
							$setting.val( value ); // treat any other input type same as text inputs
						}
					},
				});
			});
		</script><?php
    });
}

if (!empty($settings['disable-emoji'])) {
    remove_action('wp_head', 'print_emoji_detection_script', 7);

    remove_action('admin_print_scripts', 'print_emoji_detection_script');

    remove_action('wp_print_styles', 'print_emoji_styles');

    remove_action('admin_print_styles', 'print_emoji_styles');

    remove_filter('the_content_feed', 'wp_staticize_emoji');

    remove_filter('comment_text_rss', 'wp_staticize_emoji');

    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    add_action('widgets_init', function () {
        global $wp_widget_factory;

        remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
    });
}

if (!empty($settings['disable-adminbar'])) {
    add_filter('show_admin_bar', '__return_false');
}

if (!empty($settings['disable-generator'])) {
    remove_action('wp_head', 'wp_generator');
}

if (!empty($settings['disable-rsslinks'])) {
    remove_action('wp_head', 'feed_links_extra', 3);

    remove_action('wp_head', 'feed_links', 2);

    remove_action('wp_head', 'rsd_link');

    remove_action('wp_head', 'wlwmanifest_link');
}

if (!empty($settings['disable-rellinks'])) {
    remove_action('wp_head', 'index_rel_link');

    remove_action('wp_head', 'parent_post_rel_link', 10, 0);

    remove_action('wp_head', 'start_post_rel_link', 10, 0);

    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
}

if (!empty($settings['disable-attachment-pages'])) {
    add_action('template_redirect', function () {
        if (is_attachment()) {
            global $post;
            if ($post && $post->post_parent) {
                wp_redirect(esc_url(get_permalink($post->post_parent)), 301);
                exit;
            } else {
                wp_redirect(esc_url(home_url('/')), 301);
                exit;
            }
        }
    });
}

if (!empty($settings['enable-navmenus'])) {
    add_action('admin_menu', function () {
        remove_submenu_page('themes.php', 'nav-menus.php');

        add_menu_page(__('Menus'), __('Menus'), 'manage_options', 'nav-menus.php', '', 'dashicons-list-view', 20);
    });
}

if (!empty($settings['content-the_title'])) {
    add_filter('the_title', function ($title) {
        if ($title == '') {
            return 'Нету заголовка';
        } else {
            return $title;
        }
    });
}

if (!empty($settings['header-wp_title'])) {
    add_filter('wp_title', function ($title) {
        return $title.esc_attr(get_bloginfo('name'));
    });
}

if (!empty($settings['header-wp_title-separator'])) {
    add_filter('document_title_separator', function ($sep) {
        global $settings;
        if (!empty($settings['header-wp_title-separator-character'])) {
            return ' '.$settings['header-wp_title-separator-character'].' ';
        }
    });
}

if (!empty($settings['featured-rss'])) {
    add_filter('the_excerpt_rss', function ($content) {
        global $post;

        if (has_post_thumbnail($post->ID)) {
            $content = '<div>'.get_the_post_thumbnail($post->ID, 'large', array('style' => 'margin-bottom: 1em;')).'</div>'.$content;
        }

        return $content;
    });

    add_filter('the_content_feed', function ($content) {
        global $post;

        if (has_post_thumbnail($post->ID)) {
            $content = '<div>'.get_the_post_thumbnail($post->ID, 'large', array('style' => 'margin-bottom: 1em;')).'</div>'.$content;
        }

        return $content;
    });
}

if (!empty($settings['featured-admin-image'])) {
    function _add_post_admin_thumbnail_column($col)
    {
        $col['_thumb'] = __('Featured Image', 'libraries');

        return $col;
    }
    function _show_post_thumbnail_column($col, $id)
    {
        switch ($col) {
            case '_thumb':
            if (function_exists('the_post_thumbnail')):
                echo the_post_thumbnail('thumbnail');
            endif;
            break;
        }
    }
    add_filter('manage_posts_columns', '_add_post_admin_thumbnail_column', 2);
    add_filter('manage_pages_columns', '_add_post_admin_thumbnail_column', 2);
    add_action('manage_posts_custom_column', '_show_post_thumbnail_column', 5, 2);
    add_action('manage_pages_custom_column', '_show_post_thumbnail_column', 5, 2);
}

if (!empty($settings['functions-html5'])) {
    add_action('after_setup_theme', function () {
        add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
    });
}

if (!empty($settings['functions-post-thumbnails'])) {
    add_action('after_setup_theme', function () {
        add_theme_support('post-thumbnails');
    });
}

if (!empty($settings['functions-ischild'])) {
    function is_child($slug)
    {
        global $post;

        $child = get_page_by_path($slug);

        if ($child) {
            if (is_page() && ($post->post_parent == $child->ID || is_page($child->ID))) {
                return true;
            }
        }

        return false;
    }
}

if (!empty($settings['functions-bodyclass'])) {
    add_filter('body_class', function ($classes) {
        global $wpdb, $post;

        if (is_page() || is_single()) {
            $classes[] = get_post_type($post->ID).'-'.$post->post_name;
        }

        return $classes;
    });
}

if (!empty($settings['functions-nav-description'])) {
    add_filter('walker_nav_menu_start_el', function ($item_output, $item, $depth, $arg) {
        if (strlen($item->description) > 0) {
            $item_output .= sprintf('<p class="description">%s</p>', esc_html($item->description));
        }

        return $item_output;
    }, 10, 4);
}

if (!empty($settings['functions-escapekey'])) {
    add_action('wp_footer', function () {
        global $post;

        if (is_home() || is_archive() || is_search() || is_404()) {
            $link = '/wp-admin/edit.php';
        } else {
            $link = get_edit_post_link($post->ID, '');
        }

        if (!is_user_logged_in()) {
            $link = wp_login_url($link);
        }

        echo "<script>document.onkeydown = function(e) {if (e.keyCode == 27) {window.location.href = '".$link."';}};</script>\n";
    });
}


if (!empty($settings['settings-privateprefix'])) {
    add_filter('private_title_format', function ($content) {
        return '%s';
    });
}

if (!empty($settings['opengraph'])) {
	if (function_exists('acf_add_options_page')) {
	    acf_add_options_page(
	        array(
	            'page_title' => __('Options', 'libraries' ),
	        )
	    );
	}
	if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5b49c254e292f',
		'title' => 'Пост SEO',
		'fields' => array(
			array(
				'key' => 'field_5b49c254e6e81',
				'label' => 'Описание страницы',
				'name' => 'description',
				'type' => 'textarea',
				'instructions' => 'Введите описание страницы, которое будет отображаться в поле &#60;meta name&#61;&#34;description&#34;&#62;. Если оставить поле пустым — то будет отображаться текст из цитаты (the_excerpt) к странице / записи.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 4,
				'new_lines' => '',
			),
			array(
				'key' => 'field_5b49c254e6e8f',
				'label' => 'Ключевые слова',
				'name' => 'keywords',
				'type' => 'taxonomy',
				'instructions' => 'Добавьте ключевые слова к полю &#60;meta name&#61;&#34;keywords&#34;&#62;. Ключевые слова берутся из тэгов к сайту.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'taxonomy' => 'post_tag',
				'field_type' => 'multi_select',
				'allow_null' => 1,
				'add_term' => 1,
				'save_terms' => 1,
				'load_terms' => 1,
				'return_format' => 'object',
				'multiple' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
	
	acf_add_local_field_group(array(
		'key' => 'group_5b49d728f09fd',
		'title' => 'Настройки сайта SEO',
		'fields' => array(
			array(
				'key' => 'field_5b49d72900adf',
				'label' => 'Основное описание сайта',
				'name' => 'description',
				'type' => 'textarea',
				'instructions' => 'Эта информация будет отображаться в &#60;meta name&#61;&#34;description&#34;&#62; на главной страницу.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 2,
				'new_lines' => '',
			),
			array(
				'key' => 'field_5b49d72900aff',
				'label' => 'Основные ключевые слова',
				'name' => 'keywords',
				'type' => 'textarea',
				'instructions' => 'Ключевые слова будут отображаться на всех страницах в &#60;meta name&#61;&#34;keywords&#34;&#62; после персональных. Подряд через запятую с пробелом.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 2,
				'new_lines' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-options',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
	
	endif;
	
	add_action('wp_head', function(){
	
		if (get_field('description') || get_field('description', 'option')) :
			
			?><meta name="description" content="<?php the_field('description', ( (is_front_page() ) ? 'option' : '') ); ?>"><?php
			
		endif;
		
		if (get_field('keywords') || get_field('keywords', 'option')) :
			
			?><meta name="keywords" content="<?php
	
				if(!is_front_page() && get_field('keywords')):
			
					foreach ( get_field('keywords') as $keyword ):
				
						echo $keyword->name.', ';
					
					endforeach;
				
				endif;
			
			the_field('keywords', 'option');
	
			?>"><?php
			
		endif; 
	
	});
	
    add_action('after_setup_theme', function () {
        add_image_size('facebook', 1200, 630, true);
    });

    add_filter('language_attributes', function ($og) {
        return $og.' '.'xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
    });

    add_action('wp_head', function () {
        if (is_single()) {
            global $post;

            echo '<meta property="og:title" content="'.esc_attr(get_bloginfo('name')).', '.get_the_title().'" />'."\n",
                '<meta property="og:type" content="article" />'."\n",
                '<meta property="og:image" content="'.get_the_post_thumbnail_url($post->ID, 'facebook').'" />'."\n",
                '<meta property="og:url" content="'.get_permalink().'" />'."\n",
                '<meta property="og:description" content="'.get_the_excerpt().'" />'."\n",
                '<meta property="og:site_name" content="'.get_bloginfo('name').'" />'."\n";
        }
    });
}

if (!empty($settings['custom-filetypes'])) {
    add_filter('upload_mimes', function ($mime_types) {
        $mime_types['svg'] = 'image/svg+xml';

        return $mime_types;
    }, 1, 1);
}

if (!empty($settings['media_oembed_filter'])) {
    function remove_controls($code)
    {
        if (strpos($code, 'youtu.be') !== false || strpos($code, 'youtube.com') !== false):
            $args = [
                'controls' => 0,
                'hd' => 1,
                'autohide' => 1,
                'rel' => 0,
                'showinfo' => 0,
                'modestbranding' => 1,
				'enablejsapi' => 1,
            ];

        $params = '&version=3';

        foreach ($args as $arg => $value) {
            $params .= '&'.$arg.'='.$value;
        }

        $return = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", '$1'.$params, $code);

        return $return; elseif (strpos($code, 'vimeo.com') !== false):

            $args = [
                'title' => 0,
                'byline' => 0,
                'portrait' => 0,
				'api' => 1,
            ];

        $params = '?';

        foreach ($args as $arg => $value) {
            $params .= $arg.'='.$value.'&';
        }

        $return = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", '$1'.$params, $code);

        return $return; elseif (strpos($code, 'mixcloud.com') !== false):

                $args = [
                    'hide_cover' => 1,
                    'mini' => 1,
                    'hide_artwork' => 1,
                ];

        $params = '?';

        foreach ($args as $arg => $value) {
            $params .= $arg.'='.$value.'&';
        }

        $return = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", '$1'.$params, $code);

        return $return;
        endif;

        return $code;
    }

    add_filter('embed_handler_html', 'remove_controls');
    add_filter('embed_oembed_html', 'remove_controls');
}

class IgorKiselev {

	private function check_file_size($path = null, $namespace = null, $buildin = true){
		
		$result = "";
		
		if ($buildin):
			
			$wp_scripts = wp_scripts();
			
			foreach ($wp_scripts->registered as $key => $value):
				
				if (strstr($value->handle, $namespace)):
					
					if ($value->handle != 'jquery'):
						
						$result = round( filesize('../'.$value->src) / 1024, 2);
					
					endif;
					
				endif;
				
			endforeach;
			
		else:
			
			if (!empty($path) && file_exists(plugin_dir_path(__FILE__).$path) ):
				
				$result = round( filesize(plugin_dir_path(__FILE__).$path) / 1024, 2);
			
			endif;
			
		endif;
		
		return $result . __('KB', 'libraries');
		
	}
	
	public function checkbox($name = null, $depend = ''){
		
		global $lib;

		$settings = get_option('additional_libraries');

		if (!empty($name)):
			
			$return = "";
			
			$return .= "<label>";
			
			$return .= " <input name=\"additional_libraries[$name]\" type=\"checkbox\" value=\"1\" ".( ($depend) ? disabled(1, empty($settings[$depend]), false) : false )." ".( (!empty($settings[$name]) ) ? checked('1', $settings[$name], false) : false)." />";
			
			$return .= " <strong>".$lib[$name]['title']."</strong>";
			
			$return .= " <small>(".( !empty($lib[$name]['src']) ? '+'.$this->check_file_size($lib[$name]['src'], '' ,false) : $this->check_file_size('', $name ,true))." ".( !empty($lib[$name]['ver']) ? ", v".$lib[$name]['ver'] : false).")</small>";
			
			$return .= "</label>";
			
			$return .= (!empty($lib[$name]['description'])) ? "<p class=\"description\">".$lib[$name]['description'].(!empty($lib[$name]['link']) ? "<a href=\"".$lib[$name]['link']."\" class=\"dashicons dashicons-editor-help\" target=\"_blank\"></a>" : false)."</p>" : false;
			
			echo $return;
			
		endif;
		
	}
	public function customcheckbox($key, $title = '', $description = '', $link = ''){
		
		$settings = get_option('additional_libraries');
		
		if (!empty($key)):
			
			$return = "";
			
			$return .= "<label>";
			
			$return .= " <input name=\"additional_libraries[$key]\" type=\"checkbox\" value=\"1\" ".( (!empty($settings[$key]) ) ? checked('1', $settings[$key], false) : false)." />";
			
			$return .= " <strong>".$title."</strong>";
			
			$return .= "</label>";
			
			$link = ($link) ? "<a href=\"".$link."\" class=\"dashicons dashicons-editor-help\" target=\"_blank\"></a>" : false;
			
			$return .= ($description) ? "<p class=\"description\">".$description . $link ."</p>" : false;
			
			echo $return;
			
			
		endif;
	}
	
	public function custominput($key, $depend = '', $placeholder = '', $description = '', $link = ''){
		
	    $settings = get_option('additional_libraries');
		
		$return = "";
		
		$return .= "<input type=\"text\" class=\"regular-text code\" name=\"additional_libraries[$key]\" ".( ($depend) ? disabled(1, empty($settings[$depend]),false) : false )." ".( (!empty($settings[$key])) ? "value=\"$settings[$key]\"" : false )." ".( ($placeholder) ? "placeholder=\"$placeholder\"" : false )."/>";
		
		$return .= ($link) ? " <span class=\"description\">".$link ."</span>" : false;
		
		$return .= ($description) ? "<p class=\"description\">".$description ."</p>" : false;
		
		echo $return;

	}
	public function disabled($depend){
		
	    $settings = get_option('additional_libraries');
	    echo (empty($settings[$depend])) ? ' class="disabled"' : false;

	}
}

?>