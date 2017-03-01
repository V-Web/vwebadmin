<?php
defined( '_JEXEC' ) or die;
JHtml::_('behavior.framework', true);
$document =JFactory::getDocument();
$app = JFactory::getApplication();
$menu = $app->getMenu();
if ($menu->getActive() == $menu->getDefault()) {
        $pageview = 'frontpage';
} else{ 
        $pageview = 'innerpage';
}
$user =JFactory::getUser();
$params = $templateParameters->group->$layout; // We got $layout from the index.php
// Use the Grid parameters to compute the main columns width
$grid = $params->xtcgrid;
$style = $params->xtcstyle;
$typo = $params->xtctypo;

//Group parameters from grid.xml
$gridParams = $templateParameters->group->$grid;
$styleParams = $templateParameters->group->$style;
$typoParams = $templateParameters->group->$typo;
$tmplWidth = 100;
// Start of HEAD
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="<?php echo $xtc->templateUrl; ?>css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $xtc->templateUrl; ?>css/bootstrap-responsive.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $xtc->templateUrl; ?>css/jquery.mmenu.all.css" type="text/css" />
<link href='https://fonts.googleapis.com/css?family=Exo:400,600,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Merriweather:400,700,400italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Merriweather+Sans:400,400italic,700' rel='stylesheet' type='text/css'>
<?php
// Include the CSS files using the groups as defined in the layout parameters
echo xtcCSS($params->xtctypo,$params->xtcgrid,$params->xtcstyle);

$document->addStyleSheet( $xtc->templateUrl.'css/css3effects.css', 'text/css');

// Get Xtc Menu library
$document->addScript($xtc->templateUrl.'js/xtcMenu.js'); 
$document->addScriptDeclaration("window.addEvent('load', function(){ xtcMenu(null, 'menu', 200, 50, 'h', new Fx.Transition(Fx.Transitions.Cubic.easeInOut), 90, false, false); });");
// Get the Template General Scripts file
//$document->addScript($xtc->templateUrl.'js/scripts.js');
?>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
<script type="text/javascript">jQuery.noConflict();</script>
<script src="<?php echo $xtc->templateUrl; ?>js/jquery.mmenu.min.all.js" type="text/javascript"></script>
  <script>
    (function ($) {
   $(document).ready(function() {
			$("#my-menu").mmenu();
			var API = $("#my-menu").data("mmenu");

			$("#menu-button").click(function() {
				API.open();
			});
		});
}(jQuery));
	</script>
<script src="<?php echo $xtc->templateUrl; ?>js/bootstrap.js" type="text/javascript"></script>
<jdoc:include type="head" />

<!-- GOOGLE ANALYTICS -->
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-34012917-1', 'v-web.nl');
  ga('send', 'pageview');

</script>
<!-- END GOOGLE ANALYTICS -->

</head>
<?php
// End of HEAD
// Start of BODY
?>
<body class="<?php echo $pageview;?>">
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/nl_NL/all.js#xfbml=1&appId=202503919925874";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
  
<div id="headerwrap" class="xtc-bodygutter">
    <div id="headerpad" class="xtc-wrapperpad">

<div id="header" class="clearfix row-fluid header">
  <div id="header-container" class="xtc-wrapper">
<div id="topwrap" class="clearfix">
  <div id="logo-div" class="clearfix xtc-wrapper row-fluid">
	<div id="logo"><a class="hideTxt" href="index.php"><?php echo $app->getCfg('sitename');?></a></div>
</div>
    <?php if ($this->countModules('top')) : ?>
       <div id="top">                           
        <jdoc:include type="modules" name="top" style="none"/>
       </div>
<?php endif; ?> 
</div>

<div id="menu" class="clearfix"><jdoc:include type="modules" name="menubarleft" style="raw" />	
    <?php if ($this->countModules('menuright2')) : ?>
       <div id="menuright2">                           
        <jdoc:include type="modules" name="menuright2" style="none"/>
       </div>
<?php endif; ?> 
    <?php if ($this->countModules('menuright1')) : ?>
       <div id="menuright1">                           
        <jdoc:include type="modules" name="menuright1" style="none"/>
       </div>
<?php endif; ?> 
    </div>
</div>
</div>
</div>
    </div>
   </div>

<?php
			// Draw the regions in the specified order
			$regioncfg = $gridParams->regioncfg;
			foreach (explode(",",$regioncfg) as $region) {
				if ($region == '') continue;
				require 'layout_includes/region'.$region.'.php';
			}
?>
<?php if ($this->countModules('footer')) : ?>
		<div id="footerwrap" class="xtc-bodygutter">
                <div id="footerwrappad" class="xtc-wrapperpad">
		<div id="footerpad" class="row-fluid xtc-wrapper"> <jdoc:include type="modules" name="footer" style="xtc"/></div>
	    </div>
                </div>
    
<?php endif; ?> 
<jdoc:include type="modules" name="debug" />
  <script>
  jQuery(function(){
  var menuOffset = jQuery('#headerwrap')[0].offsetTop;
  jQuery(document).bind('ready scroll',function() {
    var docScroll = jQuery(document).scrollTop();
    if(docScroll > 50) {
        jQuery('#headerwrap').addClass('fixed');
    } else {
      jQuery('#headerwrap').removeClass('fixed').removeAttr("width");
    }
   });
}); 
    </script>
</body>
</html>
<?php
// End of BODY
?>