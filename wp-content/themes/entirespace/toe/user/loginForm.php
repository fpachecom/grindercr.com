<script type="text/javascript">
<!--
jQuery(document).ready(function(){
    jQuery('#toeLoginFormSubmit').click(function(){
        var data = jQuery('#toeLoginFormFields').serializeAnything({
            reqType: 'ajax',
            mod: 'user',
            action: 'postLogin'
        });
        jQuery(this).sendForm({
            msgElID: 'toeLoginMsg',
            data: data,
            inputsWraper: 'toeLoginFormFields',
            onSuccess: function(res) {
                if(!res.error && res.data.redirect) 
                   document.location.href = res.data.redirect;
            }
        });
        return false;
    });
});
-->
</script>
<?php if(!$this->fieldsOnly) {
    echo html::formStart('userLogin', array('method' => 'POST', 'attrs' => 'id="loginForm" onsubmit="return false;"'));
}?>
    <table id="toeLoginFormFields">
        <tr>
            <td>
                <div class="forminput">
                    <?php echo html::text('user_login', array('attrs' => 'placeholder="'.lang::_('Username').'"'))?>
                    <div class="toeErrorForField toe_<?php echo html::nameToClassId('user_login')?>"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="forminput">
                    <?php echo html::password('user_password', array('attrs' => 'placeholder="'.lang::_('Password').'"'))?>
                    <div class="toeErrorForField toe_<?php echo html::nameToClassId('user_password')?>"></div>
                </div>
            </td>
        </tr>
        <tr>
			<td><?php lang::_e('Remember Me')?>
				<?php echo html::checkbox('remember', array('value' => 1))?>
			</td>
		</tr>
        <tr>
        	<td>
                <div class="toePasswordForgotLinkBox">
                    <a href="#" class="toeForgotPasswordLink"><?php lang::_e('Forgot password?')?></a>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <?php if(!empty($this->toeReturn)) {
                    echo html::hidden('toeReturn', array('value' => $this->toeReturn));
                }?>
                <?php if(!empty($this->registrationLink)) {?>
                    <a href="<?php echo $this->registrationLink?>" class="button"><?php lang::_e('Register')?></a>
                <?php }?>
                <?php echo html::submit('login', array('value' => lang::_('Login'), 'attrs' => 'class="tcf_submit button blue-button" id="toeLoginFormSubmit"'))?>
            </td>
        </tr>
    </table>
    <br />
    <div id="toeLoginMsg"></div>
<?php if(!$this->fieldsOnly) {
    echo html::formEnd();
}?>