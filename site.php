<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonImage extends SppagebuilderAddons{

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

		//Options
		$image = (isset($this->addon->settings->image) && $this->addon->settings->image) ? $this->addon->settings->image : '';
		$alt_text = (isset($this->addon->settings->alt_text) && $this->addon->settings->alt_text) ? $this->addon->settings->alt_text : '';
		$position = (isset($this->addon->settings->position) && $this->addon->settings->position) ? $this->addon->settings->position : '';
		$link = (isset($this->addon->settings->link) && $this->addon->settings->link) ? $this->addon->settings->link : '';
		$target = (isset($this->addon->settings->target) && $this->addon->settings->target) ? 'target="' . $this->addon->settings->target . '"' : '';
		$open_lightbox = (isset($this->addon->settings->open_lightbox) && $this->addon->settings->open_lightbox) ? $this->addon->settings->open_lightbox : 0;
		$group = (isset($this->addon->settings->group) && $this->addon->settings->group) ? $this->addon->settings->group : '';
		$image_overlay = (isset($this->addon->settings->overlay_color) && $this->addon->settings->overlay_color) ? 1 : 0;

		$output = '';

		if($image) {
			$output  .= '<div class="sppb-addon sppb-addon-single-image ' . $position . ' ' . $class . '">';
			$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
			$output .= '<div class="sppb-addon-content">';
			$output .= '<div class="sppb-addon-single-image-container">';

			if($image_overlay) {
				$output .= '<div class="sppb-addon-image-overlay">';
				$output .= '</div>';
			}

			if($open_lightbox) {
				$output .= '<a class="cartonbox sppb-addon-image-overlay-icon" data-cb-type="img" data-cb-group="' . $group . '" data-cb-caption="'. $alt_text .'" data-mainclass="mfp-no-margins mfp-with-zoom" href="' . $image . '">+</a>';
			}

			if(!$open_lightbox) {
				$output .= ($link) ? '<a ' . $target . ' href="' . $link . '">' : '';
			}

			$output  .= '<img class="sppb-img-responsive" src="' . $image . '" alt="'. $alt_text .'">';

			if(!$open_lightbox) {
				$output .= ($link) ? '</a>' : '';
			}

			$output  .= '</div>';
			$output  .= '</div>';
			$output  .= '</div>';
		}

		return $output;
	}

	
	public function scripts() {
        $app = JFactory::getApplication();
        $base_path = JURI::base() . '/templates/' . $app->getTemplate() . '/js/';
        return array($base_path . 'cartonbox.min.js');
         }

	
	
	public function scripts() {
        $app = JFactory::getApplication();
        $base_path = JURI::base() . '/templates/' . $app->getTemplate() . '/css/';
        return array($base_path . 'cartonbox.min.css');
         }

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$open_lightbox = (isset($this->addon->settings->open_lightbox) && $this->addon->settings->open_lightbox) ? $this->addon->settings->open_lightbox : 0;
		$style = (isset($this->addon->settings->overlay_color) && $this->addon->settings->overlay_color) ? 'background-color: ' . $this->addon->settings->overlay_color . ';' : '';

		$css = '';
		if($open_lightbox && $style) {
			$css .= $addon_id . ' .sppb-addon-image-overlay{' . $style . '}';
		}

		return $css;

	}

}
