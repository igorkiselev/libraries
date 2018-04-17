<?php

if (!defined('ABSPATH')) {
	exit;
}

$library = new stdClass();

$lib = array(
	'normalize' => array(
		'type' => 'style',
		'name' => 'normalize',
		'title' => 'Normalize.css',
		'src' => 'stylesheets/normalize.css',
		'ver' => '4.1.1c',
		'depend' => array(),
	),
	'justbenice' => array(
		'type' => 'style',
		'name' => 'justbenice',
		'title' => 'Justbenice.css',
		'description' => __('CSS grid from bootstrap 4 + styles needed for owlCarousel.', 'libraries'),
		'src' => 'stylesheets/justbenice.css',
		'ver' => '1.0.1',
		'depend' => array('normalize'),
	),
	'modernizr' => array(
		'type' => 'script',
		'name' => 'modernizr',
		'title' => 'Modernizr.js',
		'description' => __("Let's learn that HTML5 and CSS3 are user-friendly", 'libraries'),
		'link' => 'https://modernizr.com/',
		'src' => 'javascripts/modernizr.min.js',
		'ver' => '2.8.3',
		'depend' => array(),
	),
	'prefixfree' => array(
		'type' => 'script',
		'name' => 'prefixfree',
		'title' => 'Prefixfree.js',
		'description' => __('Eliminating the need to specify prefixes in styles.', 'libraries'),
		'link' => 'https://leaverou.github.io/prefixfree/',
		'src' => 'javascripts/prefixfree.min.js',
		'ver' => '1.0.7',
		'depend' => array(),
	),
	'pace' => array(
		'type' => 'script',
		'name' => 'pace',
		'title' => 'Pace.js',
		'description' => __('Automatic page loading indicator for the site with tracking of ajax-requests and the status of page loading (readyState).', 'libraries'),
		'link' => 'http://github.hubspot.com/pace/docs/welcome/',
		'src' => 'javascripts/pace.min.js',
		'ver' => '1.0.0',
		'depend' => array(),
	),
	'maskedinput' => array(
		'type' => 'script',
		'name' => 'maskedinput',
		'title' => 'MaskedInput.js',
		'description' => __('Allows you to do input fields with a mask.', 'libraries'),
		'link' => 'http://digitalbush.com/projects/masked-input-plugin/',
		'src' => 'javascripts/jquery/maskedinput.min.js',
		'ver' => '1.4.1',
		'depend' => array('jquery'),
	),
	'lazy' => array(
		'type' => 'script',
		'name' => 'lazy',
		'title' => 'Lazy.js',
		'description' => __('Library for progressive loading of images.', 'libraries'),
		'link' => 'http://jquery.eisbehr.de/lazy/',
		'src' => 'javascripts/jquery/jquery.lazy.min.js',
		'ver' => '1.7.5',
		'depend' => array('jquery'),
	),
	'isotope' => array(
		'type' => 'script',
		'name' => 'isotope',
		'title' => 'Isotope.js',
		'description' => __('A library for building blocks of different sizes one after another both horizontally and vertically with no spaces.', 'libraries'),
		'link' => 'http://isotope.metafizzy.co',
		'src' => 'javascripts/jquery/isotope.pkgd.min.js',
		'ver' => '3.0.1',
		'depend' => array('jquery'),
	),
	'isotope_masonry' => array(
		'type' => 'script',
		'name' => 'isotope_masonry',
		'title' => 'Masonry layout for isotope',
		'description' => __('Additional library to Isotope.js with the system of objects location.', 'libraries'),
		'link' => 'http://isotope.metafizzy.co',
		'src' => 'javascripts/jquery/isotope.masonryHorizontal.pkgd.min.js',
		'ver' => '2.0.0',
		'depend' => array('jquery','isotope'),
	),
	'isotope_cellsbyrow' => array(
		'type' => 'script',
		'name' => 'isotope_cellsbyrow',
		'title' => 'cellsByRows',
		'description' => __('cellsByRows layout mode for Isotope', 'libraries'),
		'link' => 'http://isotope.metafizzy.co/layout-modes/cellsbyrow.html',
		'src' => 'javascripts/jquery/isotope.cells-by-row.js',
		'ver' => '1.1.3',
		'depend' => array('jquery','isotope'),
	),
	'isotope_cellsbycolumn' => array(
		'type' => 'script',
		'name' => 'isotope_cellsbycolumn',
		'title' => 'cellsByColumns',
		'description' => __('cellsByColumn layout mode for Isotope', 'libraries'),
		'link' => 'http://isotope.metafizzy.co/layout-modes/cellsbycolumn.html',
		'src' => 'javascripts/jquery/isotope.cells-by-column.js',
		'ver' => '1.1.3',
		'depend' => array('jquery','isotope'),
	),
	'isotope_fitcolumns' => array(
		'type' => 'script',
		'name' => 'isotope_fitcolumns',
		'title' => 'fitColumns',
		'description' => __('fitColumns layout mode for Isotope', 'libraries'),
		'link' => 'http://isotope.metafizzy.co/layout-modes/fitcolumns.html',
		'src' => 'javascripts/jquery/isotope.fit-columns.js',
		'ver' => '1.1.3',
		'depend' => array('jquery','isotope'),
	),
	'isotope_horizontal' => array(
		'type' => 'script',
		'name' => 'isotope_horizontal',
		'title' => 'horizontal',
		'description' => __('horizontal layout mode for Isotope', 'libraries'),
		'link' => 'http://isotope.metafizzy.co/layout-modes/horiz.html',
		'src' => 'javascripts/jquery/isotope.horizontal.js',
		'ver' => '2.0.0',
		'depend' => array('jquery','isotope'),
	),
	'isotope_packery' => array(
		'type' => 'script',
		'name' => 'isotope_packery',
		'title' => 'packery',
		'description' => __('', 'libraries'),
		'src' => 'javascripts/jquery/isotope.packery-mode.pkgd.min.js',
		'ver' => '2.0.0',
		'depend' => array('jquery','isotope'),
	),
	'aspectratio' => array(
		'type' => 'script',
		'name' => 'aspectratio',
		'title' => 'aspectRatio.js',
		'description' => __('Alpha version of the library to preserve the aspect ratio for objects.', 'libraries'),
		'src' => 'javascripts/jquery/jquery.aspectratio.js',
		'ver' => '0.0.2a',
		'depend' => array('jquery'),
	),
	'stretchclass' => array(
		'type' => 'script',
		'name' => 'stretchclass',
		'title' => 'stretchClass.js',
		'description' => __('Alpha version of the library, which sets the width of the images to 100%, and the height of the auto. <br/> It takes into account the maximum width of the image from the width attribute, and if it is not set loads naturalWidth with ImagesLoaded.js', 'libraries'),
		'src' => 'javascripts/jquery/jquery.stretchclass.js',
		'ver' => '0.0.2a',
		'depend' => array('jquery','imagesloaded'),
	),
	'fullscreenclass' => array(
		'type' => 'script',
		'name' => 'fullscreenclass',
		'title' => 'fullScreenClass.js ',
		'description' => __("The Alpha version of the library, operates by opening windows on top of everything based on styles and allows an additional function of the window's properties.", 'libraries'),
		'src' => 'javascripts/jquery/jquery.fullscreenclass.js',
		'ver' => '0.0.1a',
		'depend' => array('jquery'),
	),
	'owlcarousel' => array(
		'type' => 'script',
		'name' => 'owlcarousel',
		'title' => 'owlCarousel.js',
		'description' => __('Slider for images.', 'libraries'),
		'link' => 'https://owlcarousel2.github.io/OwlCarousel2/',
		'src' => 'javascripts/jquery/owl.carousel.min.js',
		'ver' => 'v2.0.0-beta.2.4',
		'depend' => array('jquery'),
	),
	'animate' => array(
		'type' => 'style',
		'name' => 'animate',
		'title' => 'animate.css',
		'description' => __('The animation styles used by owlCarousel (can be used separately).', 'libraries'),
		'link' => 'https://daneden.github.io/animate.css/',
		'src' => 'stylesheets/animate.css',
		'ver' => '2.0.0',
		'depend' => array(),
	),
	'google_clustermarkers' => array(
		'type' => 'script',
		'name' => 'google_clustermarkers',
		'title' => 'GoogleClusterMarkers.js',
		'description' => __('A library that allows you to group markers on a map.', 'libraries'),
		'link' => 'https://github.com/googlemaps/js-marker-clusterer',
		'src' => 'javascripts/google/markerclusterer.min.js',
		'ver' => '1.0.0',
		'depend' => array('jquery','google-map'),

	),
	'google_infobubble' => array(
		'type' => 'script',
		'name' => 'google_infobubble',
		'title' => 'GoogleInfoBubble.js',
		'description' => __('Pop-ups when clicking on the marker.', 'libraries'),
		'link' => 'https://github.com/googlemaps/js-info-bubble',
		'src' => 'javascripts/google/infobubble.min.js',
		'ver' => '0.8.0',
		'depend' => array('jquery','google-map'),
	),
	'fullpage' => array(
		'type' => 'script',
		'name' => 'fullpage',
		'title' => 'Fullpage.js',
		'description' => __('Allows you to scroll page.', 'libraries'),
		'link' => 'https://github.com/alvarotrigo/fullPage.js',
		'src' => 'javascripts/jquery/jquery.fullpage.min.js',
		'ver' => '2.9.2',
		'depend' => array('jquery'),
	),
	'fullpage_scrolloverflow' => array(
		'type' => 'script',
		'name' => 'fullpage_scrolloverflow',
		'title' => 'Scrolloverflow.min.js',
		'description' => __('Scrolls everything that overflows in fullPage', 'libraries'),
		'src' => 'javascripts/jquery/scrolloverflow.min.js',
		'ver' => '5.2.0',
		'depend' => array('jquery'),
	),
	'jquery_ui_touch_punch' => array(
		'type' => 'script',
		'name' => 'jquery_ui_touch_punch',
		'title' => 'jQuery UI Touch Punch',
		'description' => __('Allows to drag manipulate elements on touch screens', 'libraries'),
		'src' => 'javascripts/jquery/jquery.ui.touch-punch.min.js',
		'ver' => '0.2.3',
		'depend' => array('jquery','jquery-ui-core','jquery-ui-widget','jquery-ui-mouse'),
	),
);



$library->normalize = new stdClass();
	$library->normalize->type = 'style';
	$library->normalize->name = 'normalize';
	$library->normalize->title = 'Normalize.css';
	$library->normalize->src = 'stylesheets/normalize.css';
	$library->normalize->ver = '4.1.1c';
	$library->normalize->depend = array();

$library->justbenice = new stdClass();
	$library->justbenice->type = 'style';
	$library->justbenice->name = 'justbenice';
	$library->justbenice->title = 'Justbenice.css';
	$library->justbenice->description = __('CSS grid from bootstrap 4 + styles needed for owlCarousel.', 'libraries');
	$library->justbenice->src = 'stylesheets/justbenice.css';
	$library->justbenice->ver = '1.0.1';
	$library->justbenice->depend = array('normalize');

$library->modernizr = new stdClass();
	$library->modernizr->type = 'script';
	$library->modernizr->name = 'modernizr';
	$library->modernizr->title = 'Modernizr.js';
	$library->modernizr->description = __("Let's learn that HTML5 and CSS3 are user-friendly", 'libraries');
	$library->modernizr->link = 'https://modernizr.com/';
	$library->modernizr->src = 'javascripts/modernizr.min.js';
	$library->modernizr->ver = '2.8.3';
	$library->modernizr->depend = array();

$library->prefixfree = new stdClass();
	$library->prefixfree->type = 'script';
	$library->prefixfree->name = 'prefixfree';
	$library->prefixfree->title = 'Prefixfree.js';
	$library->prefixfree->description = __('Eliminating the need to specify prefixes in styles.', 'libraries');
	$library->prefixfree->link = 'https://leaverou.github.io/prefixfree/';
	$library->prefixfree->src = 'javascripts/prefixfree.min.js';
	$library->prefixfree->ver = '1.0.7';
	$library->prefixfree->depend = array();

$library->pace = new stdClass();
	$library->pace->type = 'script';
	$library->pace->name = 'pace';
	$library->pace->title = 'Pace.js';
	$library->pace->description = __('Automatic page loading indicator for the site with tracking of ajax-requests and the status of page loading (readyState).', 'libraries');
	$library->pace->link = 'http://github.hubspot.com/pace/docs/welcome/';
	$library->pace->src = 'javascripts/pace.min.js';
	$library->pace->ver = '1.0.0';
	$library->pace->depend = array();

$library->maskedinput = new stdClass();
	$library->maskedinput->type = 'script';
	$library->maskedinput->name = 'maskedinput';
	$library->maskedinput->title = 'MaskedInput.js';
	$library->maskedinput->description = __('Allows you to do input fields with a mask.', 'libraries');
	$library->maskedinput->link = 'http://digitalbush.com/projects/masked-input-plugin/';
	$library->maskedinput->src = 'javascripts/jquery/maskedinput.min.js';
	$library->maskedinput->ver = '1.4.1';
	$library->maskedinput->depend = array('jquery');

$library->lazy = new stdClass();
	$library->lazy->type = 'script';
	$library->lazy->name = 'lazy';
	$library->lazy->title = 'Lazy.js';
	$library->lazy->description = __('Library for progressive loading of images.', 'libraries');
	$library->lazy->link = 'http://jquery.eisbehr.de/lazy/';
	$library->lazy->src = 'javascripts/jquery/jquery.lazy.min.js';
	$library->lazy->ver = '1.7.5';
	$library->lazy->depend = array('jquery');

$library->isotope = new stdClass();
	$library->isotope->type = 'script';
	$library->isotope->name = 'isotope';
	$library->isotope->title = 'Isotope.js';
	$library->isotope->description = __('A library for building blocks of different sizes one after another both horizontally and vertically with no spaces.', 'libraries');
	$library->isotope->link = 'http://isotope.metafizzy.co';
	$library->isotope->src = 'javascripts/jquery/isotope.pkgd.min.js';
	$library->isotope->ver = '3.0.1';
	$library->isotope->depend = array('jquery');

$library->isotope_masonry = new stdClass();
	$library->isotope_masonry->type = 'script';
	$library->isotope_masonry->name = 'isotope_masonry';
	$library->isotope_masonry->title = 'Masonry layout for isotope';
	$library->isotope_masonry->description = __('Additional library to Isotope.js with the system of objects location.', 'libraries');
	$library->isotope_masonry->link = 'http://isotope.metafizzy.co';
	$library->isotope_masonry->src = 'javascripts/jquery/isotope.masonryHorizontal.pkgd.min.js';
	$library->isotope_masonry->ver = '2.0.0';
	$library->isotope_masonry->depend = array('jquery','isotope');

$library->isotope_cellsbyrow = new stdClass();
	$library->isotope_cellsbyrow->type = 'script';
	$library->isotope_cellsbyrow->name = 'isotope_cellsbyrow';
	$library->isotope_cellsbyrow->title = 'cellsByRows';
	$library->isotope_cellsbyrow->description = __('cellsByRows layout mode for Isotope', 'libraries');
	$library->isotope_cellsbyrow->link = 'http://isotope.metafizzy.co/layout-modes/cellsbyrow.html';
	$library->isotope_cellsbyrow->src = 'javascripts/jquery/isotope.cells-by-row.js';
	$library->isotope_cellsbyrow->ver = '1.1.3';
	$library->isotope_cellsbyrow->depend = array('jquery','isotope');

$library->isotope_cellsbycolumn = new stdClass();
	$library->isotope_cellsbycolumn->type = 'script';
	$library->isotope_cellsbycolumn->name = 'isotope_cellsbycolumn';
	$library->isotope_cellsbycolumn->title = 'cellsByColumns';
	$library->isotope_cellsbycolumn->description = __('cellsByColumn layout mode for Isotope', 'libraries');
	$library->isotope_cellsbycolumn->link = 'http://isotope.metafizzy.co/layout-modes/cellsbycolumn.html';
	$library->isotope_cellsbycolumn->src = 'javascripts/jquery/isotope.cells-by-column.js';
	$library->isotope_cellsbycolumn->ver = '1.1.3';
	$library->isotope_cellsbycolumn->depend = array('jquery','isotope');

$library->isotope_fitcolumns = new stdClass();
	$library->isotope_fitcolumns->type = 'script';
	$library->isotope_fitcolumns->name = 'isotope_fitcolumns';
	$library->isotope_fitcolumns->title = 'fitColumns';
	$library->isotope_fitcolumns->description = __('fitColumns layout mode for Isotope', 'libraries');
	$library->isotope_fitcolumns->link = 'http://isotope.metafizzy.co/layout-modes/fitcolumns.html';
	$library->isotope_fitcolumns->src = 'javascripts/jquery/isotope.fit-columns.js';
	$library->isotope_fitcolumns->ver = '1.1.3';
	$library->isotope_fitcolumns->depend = array('jquery','isotope');

	$library->isotope_horizontal = new stdClass();
		$library->isotope_horizontal->type = 'script';
		$library->isotope_horizontal->name = 'isotope_horizontal';
		$library->isotope_horizontal->title = 'horizontal';
		$library->isotope_horizontal->description = __('horizontal layout mode for Isotope', 'libraries');
		$library->isotope_horizontal->link = 'http://isotope.metafizzy.co/layout-modes/horiz.html';
		$library->isotope_horizontal->src = 'javascripts/jquery/isotope.horizontal.js';
		$library->isotope_horizontal->ver = '2.0.0';
		$library->isotope_horizontal->depend = array('jquery','isotope');

		$library->isotope_packery = new stdClass();
			$library->isotope_packery->type = 'script';
			$library->isotope_packery->name = 'isotope_packery';
			$library->isotope_packery->title = 'packery';
			$library->isotope_packery->description = __('', 'libraries');
			$library->isotope_packery->src = 'javascripts/jquery/isotope.packery-mode.pkgd.min.js';
			$library->isotope_packery->ver = '2.0.0';
			$library->isotope_packery->depend = array('jquery','isotope');

$library->aspectratio = new stdClass();
	$library->aspectratio->type = 'script';
	$library->aspectratio->name = 'aspectratio';
	$library->aspectratio->title = 'aspectRatio.js';
	$library->aspectratio->description = __('Alpha version of the library to preserve the aspect ratio for objects.', 'libraries');
	$library->aspectratio->src = 'javascripts/jquery/jquery.aspectratio.js';
	$library->aspectratio->ver = '0.0.2a';
	$library->aspectratio->depend = array('jquery');

$library->stretchclass = new stdClass();
	$library->stretchclass->type = 'script';
	$library->stretchclass->name = 'stretchclass';
	$library->stretchclass->title = 'stretchClass.js';
	$library->stretchclass->description = __('Alpha version of the library, which sets the width of the images to 100%, and the height of the auto. <br/> It takes into account the maximum width of the image from the width attribute, and if it is not set loads naturalWidth with ImagesLoaded.js', 'libraries');
	$library->stretchclass->src = 'javascripts/jquery/jquery.stretchclass.js';
	$library->stretchclass->ver = '0.0.2a';
	$library->stretchclass->depend = array('jquery','imagesloaded');

$library->fullscreenclass = new stdClass();
	$library->fullscreenclass->type = 'script';
	$library->fullscreenclass->name = 'fullscreenclass';
	$library->fullscreenclass->title = 'fullScreenClass.js ';
	$library->fullscreenclass->description = __("The Alpha version of the library, operates by opening windows on top of everything based on styles and allows an additional function of the window's properties.", 'libraries');
	$library->fullscreenclass->src = 'javascripts/jquery/jquery.fullscreenclass.js';
	$library->fullscreenclass->ver = '0.0.1a';
	$library->fullscreenclass->depend = array('jquery');

$library->owlcarousel = new stdClass();
	$library->owlcarousel->type = 'script';
	$library->owlcarousel->name = 'owlcarousel';
	$library->owlcarousel->title = 'owlCarousel.js';
	$library->owlcarousel->description = __('Slider for images.', 'libraries');
	$library->owlcarousel->link = 'https://owlcarousel2.github.io/OwlCarousel2/';
	$library->owlcarousel->src = 'javascripts/jquery/owl.carousel.min.js';
	$library->owlcarousel->ver = 'v2.0.0-beta.2.4';
	$library->owlcarousel->depend = array('jquery');

$library->animate = new stdClass();
	$library->animate->type = 'style';
	$library->animate->name = 'animate';
	$library->animate->title = 'animate.css';
	$library->animate->description = __('The animation styles used by owlCarousel (can be used separately).', 'libraries');
	$library->animate->link = 'https://daneden.github.io/animate.css/';
	$library->animate->src = 'stylesheets/animate.css';
	$library->animate->ver = '2.0.0';
	$library->animate->depend = array();

$library->google_clustermarkers = new stdClass();
	$library->google_clustermarkers->type = 'script';
	$library->google_clustermarkers->name = 'google_clustermarkers';
	$library->google_clustermarkers->title = 'GoogleClusterMarkers.js';
	$library->google_clustermarkers->description = __('A library that allows you to group markers on a map.', 'libraries');
	$library->google_clustermarkers->link = 'https://github.com/googlemaps/js-marker-clusterer';
	$library->google_clustermarkers->src = 'javascripts/google/markerclusterer.min.js';
	$library->google_clustermarkers->ver = '1.0.0';
	$library->google_clustermarkers->depend = array('jquery','google-map');

$library->google_infobubble = new stdClass();
	$library->google_infobubble->type = 'script';
	$library->google_infobubble->name = 'google_infobubble';
	$library->google_infobubble->title = 'GoogleInfoBubble.js';
	$library->google_infobubble->description = __('Pop-ups when clicking on the marker.', 'libraries');
	$library->google_infobubble->link = 'https://github.com/googlemaps/js-info-bubble';
	$library->google_infobubble->src = 'javascripts/google/infobubble.min.js';
	$library->google_infobubble->ver = '0.8.0';
	$library->google_infobubble->depend = array('jquery','google-map');

$library->fullpage = new stdClass();
	$library->fullpage->type = 'script';
	$library->fullpage->name = 'fullpage';
	$library->fullpage->title = 'Fullpage.js';
	$library->fullpage->description = __('Allows you to scroll page.', 'libraries');
	$library->fullpage->link = 'https://github.com/alvarotrigo/fullPage.js';
	$library->fullpage->src = 'javascripts/jquery/jquery.fullpage.min.js';
	$library->fullpage->ver = '2.9.2';
	$library->fullpage->depend = array('jquery');

$library->fullpage_scrolloverflow = new stdClass();
	$library->fullpage_scrolloverflow->type = 'script';
	$library->fullpage_scrolloverflow->name = 'fullpage_scrolloverflow';
	$library->fullpage_scrolloverflow->title = 'Scrolloverflow.min.js';
	$library->fullpage_scrolloverflow->description = __('Scrolls everything that overflows in fullPage', 'libraries');
	$library->fullpage_scrolloverflow->src = 'javascripts/jquery/scrolloverflow.min.js';
	$library->fullpage_scrolloverflow->ver = '5.2.0';
	$library->fullpage_scrolloverflow->depend = array('jquery');

$library->jquery_ui_touch_punch = new stdClass();
	$library->jquery_ui_touch_punch->type = 'script';
	$library->jquery_ui_touch_punch->name = 'jquery_ui_touch_punch';
	$library->jquery_ui_touch_punch->title = 'jQuery UI Touch Punch';
	$library->jquery_ui_touch_punch->description = __('Allows to drag manipulate elements on touch screens', 'libraries');
	$library->jquery_ui_touch_punch->src = 'javascripts/jquery/jquery.ui.touch-punch.min.js';
	$library->jquery_ui_touch_punch->ver = '0.2.3';
	$library->jquery_ui_touch_punch->depend = array('jquery','jquery-ui-core','jquery-ui-widget','jquery-ui-mouse');
