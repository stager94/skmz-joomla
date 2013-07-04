<?php
defined('_JEXEC') or die('Restricted access');

function modChrome_fx( $module, &$params, &$attribs )
{
	if( !empty( $module->content) ) : ?>
		<div class="moduletable<?php echo $params->get('moduleclass_sfx');?>">
			<div class="tog">
				<?php if( $module->showtitle != 0 ) : ?>
					<h3><?php echo $module->title; ?></h3>
				<?php endif; ?>
			</div>
			<div class="cont">
				<?php echo $module->content; ?>
			</div>
		</div>
		<?php endif;
}
?>