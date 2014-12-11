<script type="text/javascript">
// <!--
    if(typeof(toeNavigationItems) == 'undefined') {
        var toeNavigationItems = new Array();
    }
    toeNavigationItems = <?php echo utils::jsonEncode($this->steps)?>;
    jQuery(document).ready(function(){
        var itemWasSelected = false;
        for(id in toeNavigationItems) {
            if(toeNavigationItems[id]['selected']) {
                toeSetNavigationSelected(id, 0);
                itemWasSelected = true;
            }
            if(!itemWasSelected)
                toeSetNavigationPassed(id);
        }
    });
// -->
</script>
<?php if(!frame::_()->getModule('pages')->isCart()): ?>
<div id="checkoutConteiner" style="padding-bottom: 80px;">
    <?php foreach($this->steps as $key => $s) { ?>
    <div class="toeCheckoutNavigationItem <?php echo $key?>">
        <div class="toeCheckoutNavigationItemPoint <?php echo $key?>">&nbsp;</div>
        <div class="toeCheckoutNavigationItemText"><?php echo $s['label']?></div>
    </div>
    <?php }?>
</div>
<div class="toeCheckoutNavigationSelected" style="display: none;">&nbsp;</div>
<?php endif; ?>