<h1><?php lang::_e('Password Recovery')?></h1>
<form action="" method="post" onsubmit="toePasswordRecover(this); return false;">
	<?php lang::_e('Type down your email address and we\'ll send you recovery letter.')?><br /><br />
	<?php echo html::text('email', array('attrs' => 'placeholder="'.lang::_('Email').'"'))?><br />
	<?php echo html::capcha()?><br />
	<?php echo html::hidden('mod', array('value' => 'user'))?>
	<?php echo html::hidden('action', array('value' => 'passwordRecoverSendLink'))?>
	<?php echo html::hidden('reqType', array('value' => 'ajax'))?>
	<?php echo html::inputButton(array('value' => lang::_('Go Back'), 'attrs' => 'class="button fleft2" style="margin-top:0;" onclick="subScreen.clearAndHide(); return false;"'))?>
	<?php echo html::submit('recover', array('value' => lang::_('Recover'), 'attrs' => 'class="fleft2 button button-blue"'))?>
</form>
<div id="toePasswordForgotMsg"></div>