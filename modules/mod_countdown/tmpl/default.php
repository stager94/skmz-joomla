<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<div class="countdown<?php echo $params->get('moduleclass_sfx'); ?>">

<?php foreach ($list as $item) :?>
<?php if ($item->title) { ?>
	<span class="countdown_title"><?php echo $item->title; ?></span>
<?php } else {} ?>

<?php if ($item->displaydate) { ?>
	<span class="countdown_displaydate"><?php echo $item->displaydate; ?></span>
<?php } else {} ?>

<span class="countdown_daycount"><?php echo $item->daycount; ?></span>

<?php if ($item->dney) { ?>
	<span class="countdown_dney"><?php echo $item->dney; ?></span>
<?php } else {} ?>

<?php echo $item->DetailCount; ?>

<?php if ($item->DetailLink) { ?>
	<span class="countdown_link"><?php echo $item->DetailLink; ?></span>
<?php } else {} ?>

<?php
if ($item->JS_enable == '1') {
	echo countdounJS($item->JS_month, $item->JS_day, $item->JS_year, $item->JS_hour, $item->JS_min, $item->JS_endtime, $item->JS_offset);
} else {}
?>
<?php endforeach; ?>
</div>