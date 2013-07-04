<?php
/**
* Content code
* @package Adeptus El
* @Copyright (C) 2009 Adeptus
* @All rights reserved
* @version 1.0
*/
defined('_JEXEC') or die('Restricted access');
Error_Reporting(E_ERROR);
//parameters
$kol = $params->get('kol',30);
$minspeed = $params->get('minspeed',10);
$maxspeed = $params->get('maxspeed',50);
$melt = $params->get('melt','true');
//variables
$ipath = JURI::base().'/modules/mod_ael/mod_ael/images/';
?>
<script type="text/javascript">
	var snowflakes = {
		pics : [
		['<?php echo $ipath;?>/snow1.png',16,16],
		['<?php echo $ipath;?>/snow2.png',24,24],
		['<?php echo $ipath;?>/snow3.png',24,24]
	],
	track : function(x, y, top, ampl) {
		return {
			top : top + 2,
			x   : x + ampl * Math.sin(top / 20),
			y   : (top / this.screenHeight < 0.65) ? y + 2 : 1 + y + ampl * Math.cos(top / 25)
		};
	},
	quantity : <?php echo $kol;?>,
	minSpeed : <?php echo $minspeed;?>,
	maxSpeed : <?php echo $maxspeed;?>,
	isMelt : <?php echo $melt;?>,
	screenWidth : 0,
	screenHeight : 0,
	archive : [],
	timer : null,
	addHandler : function(object, event, handler, useCapture) {
		if (object.addEventListener) object.addEventListener(event, handler, useCapture);
		else if (object.attachEvent)object.attachEvent('on' + event, handler);
		else object['on' + event] = handler;
	},
	create : function(o, index) {
		var rand = Math.random();
		this.timer = null;
		this.o = o;
		this.index = index;
		this.ampl = 3 + 7*rand;
		this.type =  Math.round((o.pics.length - 1) * rand);
		this.width = o.pics[this.type][1];
		this.height = o.pics[this.type][2];
		this.speed = o.minSpeed + (o.maxSpeed - o.minSpeed) * rand;
		this.speed = 1000 / this.speed;
		this.deviation = o.maxDeviation * rand;
		this.x = o.screenWidth * rand - this.width;
		this.y = 0 - this.height;
		this.top = this.y;
		this.img = document.createElement('img');
		this.img.src = o.pics[this.type][0];
		this.img.style.top = this.y + 'px';
		this.img.style.position = 'absolute';
		this.img.style.zIndex = 10000;
		this.img.style.left = this.x + 'px';
		this.img.obj = this;
		if (o.isMelt) this.img.onmouseover = function() {
			clearTimeout(this.obj.timer);
			this.obj.timer = null;
			this.parentNode.removeChild(this);
		}
		document.body.appendChild(this.img);
		this.move();
	},
	init : function() {
		this.screenWidth = window.innerWidth ? window.innerWidth : (document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body.offsetWidth);
		this.screenWidth = navigator.userAgent.toLowerCase().indexOf('gecko') == -1 ? this.screenWidth : document.body.offsetWidth;
		this.screenHeight = window.innerHeight ? window.innerHeight : (document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.offsetHeight);
		this.screenScroll = (window.scrollY) ? window.scrollY : document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop;
		this.archive[this.archive.length] = new this.create(this, this.archive.length);
		clearTimeout(this.timer);
		this.timer = null
		this.timer = setTimeout(function(){snowflakes.init()}, 60000 / this.quantity);
	}
};
snowflakes.create.prototype = {
	move : function() {
		var newXY = this.o.track(this.x, this.y, this.top, this.ampl);
		this.x   = newXY.x;
		this.y   = newXY.y;
		this.top = newXY.top;
		if (this.y < this.o.screenHeight + this.o.screenScroll - this.height) {
			this.img.style.top  = this.y + 'px';
			this.x = this.x < this.o.screenWidth - this.width ? this.x : this.o.screenWidth - this.width;
			this.img.style.left = this.x + 'px';
			var index = this.index;
			this.timer = setTimeout(function(){snowflakes.archive[index].move()}, this.speed);
		} else {
			delete(this.o.archive[this.index]);
			this.img.parentNode.removeChild(this.img);
		}
	}
};
snowflakes.addHandler(window, 'load', function() {snowflakes.init();});
snowflakes.addHandler(window, 'resize', function() {snowflakes.init();});
</script>