<?php
/*-------------------------------------------------------------------------
# com_layer_slider - com_layer_slider
# -------------------------------------------------------------------------
# @ author    John Gera, George Krupa, Janos Biro, Balint Polgarfi
# @ copyright Copyright (C) 2015 Offlajn.com  All Rights Reserved.
# @ license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# @ website   http://www.offlajn.com
-------------------------------------------------------------------------*/
?><?php
defined('_JEXEC') or die;

class OfflajnGenerator{

	var $_data;
	var $_variables;
	var $_slider;
	var $_slider_counter;
	var $post;

	function __construct($data) {
		$this->post = false;
		$this->_data = $data;
		$this->_slider_counter = 0;
		$this->url = JURI::root(true);
		if ($this->url !="/") $this->url.="/";
		$parts = explode("_",get_class($this));
		$this->generator_name = strtolower($parts[1]);
	}

	function multiSelect($selectorname, $items, $filter=""){
		$selectorname = 'post_'.$selectorname;
		$output = '<select data-param="'.$selectorname.'" name="'.$selectorname.'[]" class="multiple" multiple="multiple">';
		if (strlen($filter)){
			if (isset($this->_data[$selectorname]) && in_array('0', $this->_data[$selectorname])|| empty($this->_data[$selectorname]))
				$output.= '<option value="0" selected="selected" >Don\'t filter '.$filter.'</option>';
			else
				$output.= '<option value="0">Don\'t filter '.$filter.'</option>';
		}
		foreach($items as $item) {
			if(isset($this->_data[$selectorname]) && in_array($item['id'], $this->_data[$selectorname])){
				$output.= '<option value="'.$item['id'].'" selected="selected">'.ucfirst($item['name']).'</option>';
			} else {
				$output.= '<option value="'.$item['id'].'">'.ucfirst($item['name']).'</option>';
			}
		}
		$output.= '</select>';
		return $output;
	}

	function simpleSelect($selectorname, $items ){
		$selectorname = 'post_'.$selectorname;
		$output = '<select data-param="'.$selectorname.'" name="'.$selectorname.'" >';
		foreach($items as $item) {
			if(isset($this->_data[$selectorname]) && $item['id'] == $this->_data[$selectorname]){
				$output.= '<option value="'.$item['id'].'" selected="selected">'.ucfirst($item['name']).'</option>';
			} else {
				$output.= '<option value="'.$item['id'].'">'.ucfirst($item['name']).'</option>';
			}
		}
		$output.= '</select>';
		return $output;
	}

	function getMultiSelectIntData($selectorname){
		if (isset($this->_data['post_'.$selectorname]))
			return array_map('intval',$this->_data['post_'.$selectorname]);
		else
			return array('0'=>'0');
	}

	function getMultiSelectStringData($selectorname){
		if (isset($this->_data['post_'.$selectorname]))
			return $this->_data['post_'.$selectorname];
		else
			return array('0'=>'0');
	}

	function getSimpleSelectStringData($selectorname){
		if (isset($this->_data['post_'.$selectorname]))
			return $this->_data['post_'.$selectorname];
		else
			return "";
	}

	function generateList(){
		$html = '';
		foreach($this->_variables AS $name => $desc){
			$html.='<li><span data-help="'.$desc.'">['.$name.']</span></li>';
			if ($name == "url"){
				$html.='<li data-placeholder="<a href=&quot;[url]&quot;>Read more</a>"><span>[link]</span></li>';
			}
		}
		return $html;
	}

	function getSliderCounter(){
		return $this->_slider_counter;
	}

	function setSliderCounter($id){
		$this->_slider_counter = $id;
	}

	function getWithFormat($str, $textlength = 0) {
		if (!isset($this->_slider)){
			$this->_slider = $this->getData();
		}
		if ($textlength == 0)
			$textlength = 5000;

		$content = $str;
		preg_match_all('/\[(.*?)\]/', $str, $matches);
		if(isset($matches[1])){
			foreach ($matches[1] as $attr) {
				if (isset($this->_slider[$this->_slider_counter][$attr]))
					$content=str_replace("[".$attr."]",$this->_slider[$this->_slider_counter][$attr],$content);
			}
			if ( preg_match('/<(img|video|div|a|h.|p)[>\s]/',$content))
				return $content;
			else
				return substr($content, 0, $textlength);
		}else{
			return $str;
		}
	}

}

?>