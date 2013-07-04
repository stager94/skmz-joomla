<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );
global $Itemid, $modules_list;

// menu code
$document	= &JFactory::getDocument();
$renderer	= $document->loadRenderer( 'module' );
$options	 = array( 'style' => "raw" );
$module	 = JModuleHelper::getModule( 'mod_mainmenu' );
$moduleLeft	 = JModuleHelper::getModule( 'mod_mainmenu' );
$moduleRight = JModuleHelper::getModule( 'mod_mainmenu' );
$topnav = false;
$leftnav = false;
$rightnav = false;
$subnav = false;

if ($mtype=="moomenu") :
	$module->params	= "menutype=$menu_name_top\nshowAllChildren=1\nclass_sfx=top";
	$topnav = $renderer->render( $module, $options );
	$moduleLeft->params	= "menutypeLeft=$menu_name_left\nshowAllChildren=1\nclass_sfx=top";
	$leftnav = $renderer->render( $moduleLeft, $options );
	$moduleRight->params = "menutypeRight=$menu_name_right\nshowAllChildren=1\nclass_sfx=top";
	$rightnav = $renderer->render( $moduleRight, $options );
endif;

function rok_isIe7() {
	$agent=$_SERVER['HTTP_USER_AGENT'];
	if (stristr($agent, 'msie 7')) return true;
	return false;
}

function rok_isIe6() {
	$agent=$_SERVER['HTTP_USER_AGENT'];
	if (stristr($agent, 'msie 6')) return true;
	return false;
}
?>

<script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template?>/js/moomenu.js"></script>
<script type="text/javascript">
	window.addEvent('domready', function() {
		new churchmoomenu($E('ul.menutop '), {
			bgiframe: false,
			delay: 500,
			animate: {
				props: ['height'],
				opts: {
					duration:700,
					fps: 300,
					transition: Fx.Transitions.Back.easeOut
				}
			}
		});
		new churchmoomenu($E('ul.menuleft'), {
			bgiframe: false,
			delay: 500,
			animate: {
				props: ['opacity', 'width', 'height'],
				opts: {
					duration:400,
					fps: 100,
					transition: Fx.Transitions.sineOut
				}
			}
		});
		new churchmoomenu($E('ul.menuright'), {
			bgiframe: false,
			delay: 500,
			animate: {
				props: ['opacity', 'width', 'height'],
				opts: {
					duration:400,
					fps: 100,
					transition: Fx.Transitions.sineOut
				}
			}
		});
	});
</script>