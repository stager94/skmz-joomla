<?php
/**
* Version 1.2
* @Copyright Copyright (C) 2010- ofertaweb.ro
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
******/


// no direct access
defined('_JEXEC') or die('Restricted access');

require_once "process_date.php";

$myabsoluteurl=JURI::base();
$url = $myabsoluteurl.'modules/mod_cool_jquery_countdown/';



$document = &JFactory::getDocument();
$document->addScript( $url.'js/jquery-1.4.1.js' );
$document->addScript( $url.'js/jquery.lwtCountdown-0.9.5.js' );
$document->addScript( $url.'js/misc.js' );




//--------------- to do: put in in the xml-------------
$target_day = $params->get( 'target_day', '01' );
$target_month = $params->get( 'target_month', '01' );
$target_year = $params->get( 'target_year', '2011' );
$target_hour = $params->get( 'target_hour', '01' );
$target_minute = $params->get( 'target_minute', '01' );
$target_second = $params->get( 'target_second', '01' );

$message1=$params->get( 'message1', 'This is message 1' );
$message2=$params->get( 'message2', 'This is message 2' );
$message3=$params->get( 'message3', 'This is message 3' );

$style = $params->get( 'style', '1' );

if($style==1) $document->addStyleSheet( $url.'style/dark.css' );else $document->addStyleSheet( $url.'style/main.css' );




?>
	
	<div id="container">

		<h1><?php echo $message1; ?></h1>
		<h2 class="subtitle"><?php echo $message2; ?></h2>

		<!-- Countdown dashboard start -->
		<div id="countdown_dashboard">
			<div class="dash weeks_dash">
				<span class="dash_title">weeks</span>
				<div class="digit"><?=$date['weeks'][0]?></div>
				<div class="digit"><?=$date['weeks'][1]?></div>
			</div>

			<div class="dash days_dash">
				<span class="dash_title">days</span>
				<div class="digit"><?=$date['days'][0]?></div>
				<div class="digit"><?=$date['days'][1]?></div>
			</div>

			<div class="dash hours_dash">
				<span class="dash_title">hours</span>
				<div class="digit"><?=$date['hours'][0]?></div>
				<div class="digit"><?=$date['hours'][1]?></div>
			</div>

			<div class="dash minutes_dash">
				<span class="dash_title">minutes</span>
				<div class="digit"><?=$date['mins'][0]?></div>
				<div class="digit"><?=$date['mins'][1]?></div>
			</div>

			<div class="dash seconds_dash">
				<span class="dash_title">seconds</span>
				<div class="digit"><?=$date['secs'][0]?></div>
				<div class="digit"><?=$date['secs'][1]?></div>
			</div>

		</div>
		<!-- Countdown dashboard end -->

		<div class="dev_comment">
			<?php echo $message3; ?>
		</div>

		<script language="javascript" type="text/javascript">
			jQuery(document).ready(function() {
				$('#countdown_dashboard').countDown({
					targetDate: {
						'day': 		<?=$target_day?>,
						'month': 	<?=$target_month?>,
						'year': 	<?=$target_year?>,
						'hour': 	<?=$target_hour?>,
						'min': 		<?=$target_minute?>,
						'sec': 		<?=$target_second?>
					}
				});
				

			});
		</script>
	
	</div>



