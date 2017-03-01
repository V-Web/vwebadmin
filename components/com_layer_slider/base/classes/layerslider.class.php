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

// Get class files
include LS_ROOT_PATH.'/classes/class.ls.posts.php';
include LS_ROOT_PATH.'/classes/class.ls.sliders.php';

class LayerSlider {

	public $sources, $sliders, $posts, $autoupdate;

	function __construct() {

		// Get instances
		$this->posts   = new LS_Posts();

		// Do other stuff later
	}
}

?>
