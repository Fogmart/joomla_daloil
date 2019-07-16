<?php
/**
 * Flex @package Helix3 Framework
 * Template Name - Flex
 * @author Aplikko http://www.aplikko.com
 * @copyright Copyright (c) 2017 Aplikko
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct access
defined ('_JEXEC') or die ('restricted access');
include('devstages_libs.php');
$doc = JFactory::getDocument();
$app = JFactory::getApplication();
$menu = $app->getMenu()->getActive();

JHtml::_('jquery.framework');
JHtml::_('bootstrap.framework', true, true); //Force load Bootstrap
unset($doc->_scripts[$this->baseurl . '/media/jui/js/bootstrap.min.js']); // Remove joomla core bootstrap

//Load Helix
$helix3_path = JPATH_PLUGINS . '/system/helix3/core/helix3.php';

if (file_exists($helix3_path)) {
    require_once($helix3_path);
    $this->helix3 = helix3::getInstance();
} else {
    die('Please install and activate helix plugin');
}

// Remove the generator meta tag
if($this->params->get('remove_joomla_generator')) {
  $this->setGenerator(null);
}

//Coming Soon
if($this->helix3->getParam('comingsoon_mode')) header("Location: ".$this->baseUrl."?tmpl=comingsoon");

//Class Classes
$body_classes = '';
if ($this->helix3->getParam('sticky_header')) {
    $body_classes .= ' sticky-header';
}
$body_classes .= ($this->helix3->getParam('boxed_layout', 0)) ? ' layout-boxed' : ' layout-fluid';
if (isset($menu) && $menu) {
  if ($menu->params->get('pageclass_sfx')) {
    $body_classes .= ' ' . $menu->params->get('pageclass_sfx');
  }
}

//Body Background Image
if ($bg_image = $this->helix3->getParam('body_bg_image')) {

    $body_style = 'background-image: url(' . JURI::base(true) . '/' . $bg_image . ');';
    $body_style .= 'background-repeat: ' . $this->helix3->getParam('body_bg_repeat') . ';';
    $body_style .= 'background-size: ' . $this->helix3->getParam('body_bg_size') . ';';
    $body_style .= 'background-attachment: ' . $this->helix3->getParam('body_bg_attachment') . ';';
    $body_style .= 'background-position: ' . $this->helix3->getParam('body_bg_position') . ';';
    $body_style = 'body.site {background-color:'.$this->helix3->PresetParam('_bg').';' . $body_style . '}';

    $doc->addStyledeclaration($body_style);
} else {
	$body_style = 'body.site {background-color:'.$this->helix3->PresetParam('_bg').';}';
	$doc->addStyledeclaration($body_style);
}

//Boxed Layout Width
if ($this->params->get('boxed_layout') == 1) {
$boxed_background_color = '';
if ($this->params->get('boxed_background_color') != '') {
    $boxed_background_color = 'background-color:'.$this->helix3->getParam('boxed_background_color').';box-shadow:0 0 7px rgba(0,0,0,0.2);';
}
	//$boxed_layout_width = ' style="max-width:'.$this->helix3->getParam('boxed_layout_width').';'.$boxed_background_color.'"';
	$body_innerwrapper_overflow = '';

	if ($this->helix3->getParam('boxed_layout_spacing') != 0) {
		//$boxed_layout_spacing = 'border-radius:' . $this->helix3->getParam('boxed_layout_border_radius') . 'px;';
		$boxed_layout_spacing = 'margin:' . $this->helix3->getParam('boxed_layout_spacing') . 'px auto;';
		$boxed_layout_spacing .= $boxed_background_color;
		$boxed_layout_spacing .= 'max-width:'.$this->helix3->getParam('boxed_layout_width').';';
		$boxed_layout_spacing = 'body.layout-boxed .body-wrapper {margin:-' . $this->helix3->getParam('boxed_layout_spacing') . 'px auto 0;padding:' . $this->helix3->getParam('boxed_layout_spacing') . 'px 0 0;}body.layout-boxed .body-innerwrapper {' . $boxed_layout_spacing . '}
		';
		$doc->addStyledeclaration($boxed_layout_spacing);
	} else {
		$boxed_layout_spacing = $boxed_background_color;
		$boxed_layout_spacing .= 'max-width:'.$this->helix3->getParam('boxed_layout_width').';';
		$boxed_layout_spacing = 'body.layout-boxed .body-innerwrapper {' . $boxed_layout_spacing . '}
		';
		$doc->addStyledeclaration($boxed_layout_spacing);
	}
} else {
	$body_innerwrapper_overflow = ' body_innerwrapper_overflow';
}

//Body Font
$webfonts = array();

if ($this->params->get('enable_body_font')) {
    $webfonts['body'] = $this->params->get('body_font');
}

//Heading1 Font
if ($this->params->get('enable_h1_font')) {
    $webfonts['h1'] = $this->params->get('h1_font');
}

//Heading2 Font
if ($this->params->get('enable_h2_font')) {
    $webfonts['h2'] = $this->params->get('h2_font');
}

//Heading3 Font
if ($this->params->get('enable_h3_font')) {
    $webfonts['h3'] = $this->params->get('h3_font');
}

//Heading4 Font
if ($this->params->get('enable_h4_font')) {
    $webfonts['h4'] = $this->params->get('h4_font');
}

//Heading5 Font
if ($this->params->get('enable_h5_font')) {
    $webfonts['h5'] = $this->params->get('h5_font');
}

//Heading6 Font
if ($this->params->get('enable_h6_font')) {
    $webfonts['h6'] = $this->params->get('h6_font');
}

//Navigation Font
if ($this->params->get('enable_navigation_font')) {
    $webfonts['.sp-megamenu-parent'] = $this->params->get('navigation_font');
}

//Custom Font
if ($this->params->get('enable_custom_font') && $this->params->get('custom_font_selectors')) {
    $webfonts[$this->params->get('custom_font_selectors')] = $this->params->get('custom_font');
}

$this->helix3->addGoogleFont($webfonts);

//Custom CSS
if ($custom_css = $this->helix3->getParam('custom_css')) {
    $doc->addStyledeclaration($custom_css);
}

//Custom JS
if ($custom_js = $this->helix3->getParam('custom_js')) {
    $doc->addScriptdeclaration($custom_js);
}

// SmoothScroll.js
if ($this->params->get('smooth_scroll_version') == '0') {
	$smooth_scroll_js = '';
} else if ($this->params->get('smooth_scroll_version') == '2') {
	$smooth_scroll_js = 'SmoothScroll-1.4.6.js, ';
} else {
	$smooth_scroll_js = 'SmoothScroll.js, ';
}

//preloader & off-canvas animation
$doc->addScriptdeclaration("\nvar sp_preloader = '" . $this->params->get('preloader') . "';");
$doc->addScriptdeclaration("\nvar sp_offanimation = '" . $this->params->get('offcanvas_animation') . "';\n");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="it-rating" content="it-rat-e66f0c4219d681d05225d6ca8916b0b0" />
                <?php
                if ($favicon = $this->helix3->getParam('favicon')) {
                    $doc->addFavicon(JURI::base(true) . '/' . $favicon);
                } else {
                    $doc->addFavicon($this->helix3->getTemplateUri() . '/images/favicon.ico');
                }
                ?>
                <!-- head -->
                <jdoc:include type="head" />
                <?php
                $megabgcolor = ($this->helix3->PresetParam('_megabg')) ? $this->helix3->PresetParam('_megabg') : '#ffffff';
                $megabgtx = ($this->helix3->PresetParam('_megatx')) ? $this->helix3->PresetParam('_megatx') : '#333333';

                $preloader_bg = ($this->helix3->getParam('preloader_bg')) ? $this->helix3->getParam('preloader_bg') : 'rgba(245,245,245,0.43)';
                $preloader_tx = ($this->helix3->getParam('preloader_tx')) ? $this->helix3->getParam('preloader_tx') : '#f5f5f5';

				$header_height = ($this->helix3->PresetParam('_header_height')) ? $this->helix3->PresetParam('_header_height').'px' : '90px';
                $sticky_header_height = ($this->helix3->PresetParam('_sticky_header_height')) ? $this->helix3->PresetParam('_sticky_header_height').'px' : '75px';
				$stickybgcolor = ($this->helix3->PresetParam('_stickybg')) ? $this->helix3->PresetParam('_stickybg') : 'rgba(40,40,40,.8)';


                // load css, less and js
                $this->helix3->addCSS('bootstrap.min.css, font-awesome.min.css') // CSS Files
                        ->addJS('bootstrap.min.js, modernizr.js, '.$smooth_scroll_js.'matchheight.js, jquery.easing.min.js, jquery.nav.js, vm-cart.js, main.js') // JS Files
                        ->lessInit()->setLessVariables(array(
                            'preset' => $this->helix3->Preset(),
                            'bg_color' => $this->helix3->PresetParam('_bg'),
                            'text_color' => $this->helix3->PresetParam('_text'),
                            'major_color' => $this->helix3->PresetParam('_major'),
                            'megabg_color' => $megabgcolor,
                            'megatx_color' => $megabgtx,
                            'preloader_bg' => $preloader_bg,
                            'preloader_tx' => $preloader_tx,
                            'header_height' => $header_height,
                            'sticky_header_height' => $sticky_header_height,
							'stickybg_color' => $stickybgcolor,
                        ))
                        ->addLess('legacy/bootstrap', 'legacy')
                        ->addLess('master', 'template');

                //RTL
                if ($this->direction == 'rtl') {
                    $this->helix3->addCSS('bootstrap-rtl.min.css')
                            ->addLess('rtl', 'rtl');
                }

                $this->helix3->addLess('presets', 'presets/' . $this->helix3->Preset(), array('class' => 'preset'));

                //Before Head
                if ($before_head = $this->helix3->getParam('before_head')) {
                    echo $before_head . "\n";
           }
         ?>
    </head>
    <body class="<?php echo $this->helix3->bodyClass($body_classes); ?> off-canvas-menu-init">

    	<?php // added class "body-wrapper". It was only "off-canvas-menu-wrap" before. ?>
        <div class="body-wrapper off-canvas-menu-wrap">
            <div class="body-innerwrapper<?php echo $body_innerwrapper_overflow; ?>">
    			<?php $this->helix3->generatelayout(); ?>
            </div> <!-- /.body-innerwrapper -->
        </div> <!-- /.body-wrapper -->
        <!-- Off Canvas Menu -->
        <div class="offcanvas-menu">
            <a href="#" class="close-offcanvas"><i class="fa fa-remove"></i></a>
            <div class="offcanvas-inner">
                <?php if ($this->helix3->countModules('offcanvas')) { ?>
                    <jdoc:include type="modules" name="offcanvas" style="sp_xhtml" />
                    <?php } else { ?>
                    <p class="alert alert-warning">
                    <?php echo JText::_('HELIX_NO_MODULE_OFFCANVAS'); ?>
                    </p>
    <?php } ?>
            </div> <!-- /.offcanvas-inner -->
        </div> <!-- /.offcanvas-menu -->

        <?php
        if ($this->params->get('compress_css')) {
            $this->helix3->compressCSS();
        }

		$tempOption = $app->input->get('option');

		if ( $this->params->get('compress_js') && $tempOption != 'com_config' ) {
			$this->helix3->compressJS($this->params->get('exclude_js'));
		}

        //before body
        if ($before_body = $this->helix3->getParam('before_body')) {
            echo $before_body . "\n";
        }

        // Removes: jQuery(window).on('load', function() {new JCaption('img.caption');});
        if (isset($this->_script['text/javascript'])) {
            $this->_script['text/javascript'] = preg_replace('%jQuery\(\window\)\.on\(\'load\',\s*function\(\)\s*{\s*new\s*JCaption\(\'img.caption\'\);\s*}\);\s*%', '', $this->_script['text/javascript']);
            if (empty($this->_script['text/javascript']))
                unset($this->_script['text/javascript']);
        }

        // Removes Mootools library
        if($this->params->get('remove_mootools')) {
            unset($doc->_scripts[$this->baseurl . '/media/system/js/mootools-core.js']);
            unset($doc->_scripts[$this->baseurl . '/media/system/js/core.js']);
            unset($doc->_scripts[$this->baseurl . '/media/system/js/mootools-more.js']);
            unset($doc->_scripts[$this->baseurl . '/media/system/js/caption.js']);
        }
        // Custom fix for conflict with Mootools
        if($this->params->get('mootools_fix')) {
            $doc->addScriptDeclaration('window.addEvent("domready",function(){Element.prototype.hide=function(){}});');
        }
        ?>

        <jdoc:include type="modules" name="debug" />
        <!-- Preloader -->
        <jdoc:include type="modules" name="helixpreloader" />
        <div id="fading-header" style="display:none"></div>
    </body>
</html>
