<?php
	$centerWidth = $tmplWidth;
        $left = $this->countModules( 'left' );
        //$sidebarleft = $this->countModules( 'sidebarleft' );
	$right = $this->countModules( 'right' ); 
        //$sidebarright = $this->countModules( 'sidebarright' ); 
	$newsflash = $this->countModules( 'newsflash' ); 
	$breadcrumb = $this->countModules('breadcrumb' );
        $messages = JFactory::getApplication()->getMessageQueue();
        
        $sidebarleft = $this->countModules('sidebarleft') && (JRequest::getCmd('view','') == 'article');
        $sidebarright = $this->countModules('sidebarright') && (JRequest::getCmd('view','') == 'article');
        
        if ($this->countModules( 'left' ) || $sidebarleft) {
            $leftcolgrid 	= $gridParams->leftwidth;
        } else {
         $leftcolgrid  = "0";
        }
        //if (($this->countModules('left') == 0) || ($this->countModules('sidebarleft') == 0 && JRequest::getVar( 'view' ) !== 'article')){
        // $leftcolgrid  = "0";
        //}
        if ($this->countModules( 'right' ) || $sidebarright) {
            $rightcolgrid 	= $gridParams->rightwidth;
        } else {
         $rightcolgrid  = "0";
        }
        //if ($this->countModules('right') == 0 || $this->countModules('sidebarright') == 0){
         //$rightcolgrid  = "0";
        //}

        $areaWidth =  100;
	$order = 'user7,user8,user9,user10,user11,user12';
	$columnArray = array(
		'user7' => '<jdoc:include type="modules" name="user7" style="xtc" />',
		'user8' => '<jdoc:include type="modules" name="user8" style="xtc" />',
		'user9' => '<jdoc:include type="modules" name="user9" style="xtc" />',
		'user10' => '<jdoc:include type="modules" name="user10" style="xtc" />',
		'user11' => '<jdoc:include type="modules" name="user11" style="xtc" />',
		'user12' => '<jdoc:include type="modules" name="user12" style="xtc" />'
	);
	$customWidths = '';
	$columnClass = '';
	$columnPadding = '';
	$debug = 0;
	$user6_12 = xtcBootstrapGrid($columnArray,$order,'',$columnClass);

	if ($left || $sidebarleft || $newsflash || $breadcrumb || $user6_12 || $right || $sidebarright || $messages || xtcCanShowComponent()) { ?>
        <div id="region3wrap" class="xtc-bodygutter">
        <div id="region3pad" class="xtc-wrapperpad">
	<div id="region3" class="row-fluid xtc-wrapper r3spacer">
        <?php if ($left || $sidebarleft) { ?> <div id="left" class="span<?php echo $leftcolgrid;?>"><?php if($sidebarleft ){ ?><jdoc:include type="modules" name="sidebarleft" style="xtc" /><?php } ?><jdoc:include type="modules" name="left" style="xtc" /></div><?php }?>
	<div class="center span<?php echo (12-$leftcolgrid-$rightcolgrid);?>">
        <?php if ($user6_12) { ?><div id="user6_10" class="clearfix r3spacer_top"><?php echo $user6_12;?></div><?php }?>
	<?php if ($newsflash) {?><div id="newsflash" class="r3spacer_top"><jdoc:include type="modules" name="newsflash" style="xtc" /></div><?php }?>
       <?php if ($breadcrumb) {?><div id="breadcrumbs" class="r3spacer_top"><jdoc:include type="modules" name="breadcrumb" style="xtc" /></div><?php }?>	
       <?php if ( $messages ) { ?><div id="message" class="r3spacer_top"><jdoc:include type="message" /></div><?php }?>
	<?php if ( xtcCanShowComponent() ) { ?><div id="component" class="r3spacer_top"><jdoc:include type="component" /></div><?php }?>
	</div>
	 <?php if ($right || $sidebarright) { ?><div id="right" class="span<?php echo $rightcolgrid;?>"><?php if( $sidebarright ){ ?><jdoc:include type="modules" name="sidebarright" style="xtc" /><?php } ?><jdoc:include type="modules" name="right" style="xtc" /></div><?php }?>
	</div>
        </div>
	</div>
	<?php }
?>