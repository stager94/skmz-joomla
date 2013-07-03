<?php                                                                                               
	/**
	 * @copyright	Copyright (C) 2005 - 2007 Open Source Matters. All rights reserved.
	 * @license		GNU/GPL, see LICENSE.php
	 * Joomla! is free software. This version may have been modified pursuant
	 * to the GNU General Public License, and as distributed it includes or
	 * is derivative of works licensed under the GNU General Public License or
	 * other free or open source software licenses.
	 * See COPYRIGHT.php for copyright notices and details.
	 */
	 
	$live_site       = $mainframe->getCfg('live_site');
	$path = $this->baseurl.'/templates/'.$this->template;
	$menu_name_top 	 = "topmenu";
	$menu_name_left  = "keyconcepts";
	$menu_name_right = "topmenu";
	$mtype			 = "moomenu";
	$moo_bgiframe    = ($this->params->get("moo_bgiframe'","0") == 0)?"false":"true";
	$moo_delay       = $this->params->get("moo_delay", "500");
	$moo_duration    = $this->params->get("moo_duration", "700");
	$moo_fps         = $this->params->get("moo_fps", "300");
	$moo_transition  = $this->params->get("moo_transition", "Back.easeOut");

defined( '_JEXEC' ) or die ( 'Restricted access' );
define( 'YOURBASEPATH', dirname(__FILE__) );
JHTML::_( 'behavior.mootools' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
	<head>
        <meta name="google-site-verification" content="kHnQShHIKa1rYyx8uyq-jN5m8y34YIq2ODsH3DtvfxY" />
		<jdoc:include type="head" />
		<?php
			require(YOURBASEPATH .DS."menu_tools.php");
		?>
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/template.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/moomenu.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/horiz-menu.css" type="text/css" />
		<!--[if lte IE 6]>
			<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/ie6.css" rel="stylesheet" type="text/css" />
		<style type="text/css">
		#headerLogo, #mainLeftTp, #mainLeftBt, #mainFullTp, #mainFullBt, #footerTop, #footerBottom, .moduletable_headerBanners, .button, a.readon {behavior: url(<?php echo $path ?>/css/iepngfix.htc);}
		</style>
		<![endif]-->

	<?php if($this->params->get('show_effects')) : ?>
	<?php if( $this->params->get( 'modules_start') == 'open' ) :?>
	<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/site.js"></script>
	<?php else : ?>
	<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/site2.js"></script>
	<?php endif; ?>
    <?php endif; ?>
	</head>
	<body> 
	<div id="body">

      <div id="wrapper" style="z-index:1">
	     <!--LOGIN MODULE-->
	  	<jdoc:include type="modules" name="user7" style="xhtml" />
		 <div class="clear"></div>
		 
		 <div id="headerLogo">
		 <div id="headerLeft">
		 <div id="logo"><a href="index.php"><img src="<?php echo $path ?>/images/blank-lg.gif" alt="Home Page" /></a></div>	 
		 </div> <!--END HEADER LEFT-->
		 <div id="headerRight">
		 <!--BANNER IMAGES-->
		<jdoc:include type="modules" name="user6" style="xhtml" />
   	    </div><!--END HEADER RIGHT-->

		 <div class="clear"></div>
         <!-- TOP MENU -->
				<div id="horiz-menu" class="<?php echo $mtype; ?>">
                <jdoc:include type="modules" name="dropmenu" style="fx" />
					<?php if($mtype != "module") : ?>
						<?php echo $topnav; ?>
					<?php else: ?>
						<!--<jdoc:include type="modules" name="dropmenu" style="fx" />  -->
					<?php endif; ?>

			  </div><!--END TOP MENU-->
			  <!--SEARCH MODULE-->
		            <jdoc:include type="modules" name="user4" />	
		  	
	     </div><!--END HEADER LOGO-->
		 
         <div class="clear"></div>
		 
		
	  <?php if ($this->countModules ('right')) { ?>  
		<div id="contentWrap">
		
		<div id="mainLeft">
		<div id="mainLeftTp"></div>
		<div id="mainLeftContent">
		 <!--HOME PAGE IMAGE SLIDE SHOW-->
		<jdoc:include type="modules" name="user5" style="xhtml" />
		<div class="clear"></div>
		<jdoc:include type="message" /><jdoc:include type="component" />
		</div>
		<div id="mainLeftBt"></div>
       </div><!--END LEFT CONTENT -->

		<div id="rightColumn"><jdoc:include type="modules" name="right" style="fx" /></div>
	 
  
	    <?php }else{ ?>	
         <div id="mainFull">
		 <div id="mainFullTp"></div>
		 <div id="mainFullContent">
		<jdoc:include type="message" /><jdoc:include type="component" />
	    </div><!--END MAIN FULL CONTENT-->
		<div id="mainFullBt"></div>
		</div><!--END MAIN FULL-->
        <?php } ?>	
		
		<div class="clear"></div>	
				
     <div id="footer">
	 <div id="footerTop"></div>
	 <div id="footerMid">
	    <jdoc:include type="modules" name="left" style="fx" />
	  </div><!--END FOOTER MID-->
	  <div id="footerBottom"></div>
	 </div> <!--END FOOTER-->

	 <div class="clear"></div>
	 
	 <div id="copyright">
			<!-- COPYRIGHT INFO -->
         <b> ПAO "CKM3" Copyright &copy; 2007-2011 </b>
		</div><!--END COPYRIGHT -->
		
		</div><!--END CONTENT WRAP-->
		</div><!--END TEMPLATE WRAPPER-->
		
	
				
		<jdoc:include type="modules" name="debug" />
		
	</div> <!--END BODY ID-->		
	</body>
</html>