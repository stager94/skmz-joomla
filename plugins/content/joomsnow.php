<?php
/**
 * @version	$Id: joomsnow.php 2008-12-12 00:00:00  eugenk $
 * @package	Joomla
 * @subpackage	Content
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license	GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

// Import library dependencies
jimport('joomla.event.plugin');

/**
 * Snow falling Plugin
 *
 * @package	Joomla
 * @subpackage	Content
 * @since 	1.5
 */
class plgContentJoomsnow extends JPlugin
{
	/**
	* Constructor
	*/
	function plgContentJoomsnow( &$subject )
	{
		parent::__construct( $subject );

		// load plugin parameters
		$this->_plugin = &JPluginHelper::getPlugin( 'content', 'joomsnow' );
		$this->_params = new JParameter( $this->_plugin->params );
		//var_dump($this->_params);

	}//function plgContentSnow

	/**
	* Plugin method with the same name as the event will be called automatically.
	*/
	function onBeforeDisplayContent(&$article, &$params)
	{
		global $mainframe;

		// Get the plugin parameters
		$snowmax=$this->_params->get('snowmax',35);
		$snowletter=$this->_params->get('snowletter','*');
		$sinkspeed=$this->_params->get('sinkspeed',0.6);
		$snowminsize=$this->_params->get('snowminsize',8);
		$snowmaxsize=$this->_params->get('snowmaxsize',22);
		$snowingzone=$this->_params->get('snowingzone',1);

		// Debug modus / Test the params
		/*
		echo "\$snowmax is $snowmax";
		echo "<br>";
		echo "\$snowletter is $snowletter";
		echo "<br>";
		echo "\$sinkspeed is $sinkspeed";
		echo "<br>";
		echo "\$snowminsize is $snowminsize";
		echo "<br>";
		echo "\$snowmaxsize is $snowmaxsize";
		echo "<br>";
		echo "\$snowingzone is $snowingzone";
		echo "<br>";
		*/
		// end of Debug modus

		// generate the JS for the HTML-header
		$headerscript = $this->plgContentgenerateJSHeader( $snowmax, $snowletter, $sinkspeed, $snowminsize, $snowmaxsize, $snowingzone );

		$document =& JFactory::getDocument();
		// add the JS to the document header
		$document->addScriptDeclaration( $headerscript );

		// generate the JS for the HTML-body
 		$bodyscript = $this->generateJSBody();

		// add the JS to the document body
		return $bodyscript;
	}//function onPrepareContent()

	/**
	* Plugin method to generate the JavaScript for the HTML-Header
	*/
	function plgContentgenerateJSHeader( $snowmax, $snowletter, $sinkspeed, $snowminsize, $snowmaxsize, $snowingzone )
	{
		$script=
			"/* free javascript from http://www.kostenlose-javascripts.de */
			// Anzahl der Schneeflocken (mehr als 30 - 40 nicht empfehlenswert)
			var snowmax= $snowmax;

			// Farben der Schneeflocken. Es können beliebig viele Farben angegeben werden
			var snowcolor=new Array(\"#AAAACC\",\"#DDDDFF\",\"#CCCCDD\",\"#F3F3F3\",\"#F0FFFF\");

			// Fonts, welche die Schneeflocken erzeugen. Beliebig viele Fonts ergänzbar
			var snowtype=new Array(\"Arial Black\",\"Arial Narrow\",\"Times\",\"Comic Sans MS\",\"Courier\");

			// Zeichen für die Schneeflocke (empfohlen: * )
			var snowletter=\"$snowletter\";

			// Fallgeschwindigkeit (empfohlen sind Werte zwischen 0.3 bis 2)
			var sinkspeed=$sinkspeed;

			// Minimale Größe der Schneeflocken
			var snowminsize=$snowminsize;

			// Maximale Größe der Schneeflocken
			var snowmaxsize=$snowmaxsize;

			/*  Schnee-Zone:
			** 1 für überall, 2 für Schneefall nur auf der linken Seite
			** 3 für Schneefall in der Mitte, 4 für Schneefall nur auf der rechten Seite */
			var snowingzone=$snowingzone;

			/*
			* Ab hier nichts mehr ändern *
			*/
			var snow=new Array();
			var marginbottom;
			var marginright;
			var timer;
			var i_snow=0;
			var x_mv=new Array();
			var crds=new Array();
			var lftrght=new Array();
			var browserinfos=navigator.userAgent ;
			var ie5=document.all&&document.getElementById&&!browserinfos.match(/Opera/);
			var ns6=document.getElementById&&!document.all;
			var opera=browserinfos.match(/Opera/);
			var browserok=ie5||ns6||opera;

			function randommaker(range) {
				rand=Math.floor(range*Math.random());
				return rand;
			}

			function initsnow() {
				if (ie5 || opera) {
					marginbottom = document.body.clientHeight;
					marginright = document.body.clientWidth;
				}
				else if (ns6) {
					marginbottom = window.innerHeight;
					marginright = window.innerWidth;
				}
				var snowsizerange=snowmaxsize-snowminsize;
				for (i=0;i<=snowmax;i++) {
					crds[i] = 0;
			    	lftrght[i] = Math.random()*15;
			    	x_mv[i] = 0.03 + Math.random()/10;
					snow[i]=document.getElementById(\"s\"+i);
					snow[i].style.fontFamily=snowtype[randommaker(snowtype.length)];
					snow[i].size=randommaker(snowsizerange)+snowminsize;
					snow[i].style.fontSize=snow[i].size;
					snow[i].style.color=snowcolor[randommaker(snowcolor.length)];
					snow[i].sink=sinkspeed*snow[i].size/5;
					if (snowingzone==1) {snow[i].posx=randommaker(marginright-snow[i].size);}
					if (snowingzone==2) {snow[i].posx=randommaker(marginright/2-snow[i].size);}
					if (snowingzone==3) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/4;}
					if (snowingzone==4) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/2;}
					snow[i].posy=randommaker(2*marginbottom-marginbottom-2*snow[i].size);
					snow[i].style.left=snow[i].posx;
					snow[i].style.top=snow[i].posy;
				}
				movesnow();
			}

			function movesnow() {
				for (i=0;i<=snowmax;i++) {
					crds[i] += x_mv[i];
					snow[i].posy+=snow[i].sink;
					snow[i].style.left=(snow[i].posx+lftrght[i]*Math.sin(crds[i])) + \"px\";
					snow[i].style.top=snow[i].posy + \"px\";

					if (snow[i].posy>=marginbottom-2*snow[i].size || parseInt(snow[i].style.left)>(marginright-3*lftrght[i])){
						if (snowingzone==1) {snow[i].posx=randommaker(marginright-snow[i].size);}
						if (snowingzone==2) {snow[i].posx=randommaker(marginright/2-snow[i].size);}
						if (snowingzone==3) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/4;}
						if (snowingzone==4) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/2;}
						snow[i].posy=0;
					}
				}
				var timer=setTimeout(\"movesnow()\",50);
			}

			for (i=0;i<=snowmax;i++) {
				document.write(\"<span id='s\"+i+\"' style='position:absolute;top:-\"+snowmaxsize+\"px;'>\"+snowletter+\"</span>\");
			}
			";
		return $script;

	}//function generateJSHeader

	/**
	* Plugin method to generate the JavaScript for the HTML-Body
	*/
	function generateJSBody ()
	{
		$bodyscript = "<script type=\"text/javascript\">\n
				<!--\n
					if (browserok) {\n
						window.onload=initsnow()\n
					}\n
				//-->\n
				</script>\n";
		return $bodyscript;

	}//function generateJSBody

}//class plgContentJoomsnow