<script type="text/javascript">
// <!--
    if(typeof(toeSetNavigationSelected) != 'undefined') {
        toeSetNavigationSelected('confirnation');
        toeSetNavigationPassed(['cart', 'checkout']);
    }
// -->
</script>
<div>
    <?php foreach($this->blokSteps as $sKey => $sInfo) {
        if($sInfo['blokSteps']) continue;
        if(empty($this->$sKey)) continue;
    ?>
    <div class="toe_checkout_part_box fleft">
        <h1><?php lang::_e($sInfo['title'])?></h1>
        <?php echo $this->$sKey?>
    </div>
    <?php }?>
</div>
<div class="clear"></div>

<div class="fright">
    <div class="payInform" style="float: right;"><?php echo $this->processHtml?></div>
    <div style="float: left;"><a class="button" href="<?php echo frame::_()->getModule('pages')->getLink(array('mod' => 'checkout', 'action' => 'getAllHtml'))?>"><?php lang::_e('Back')?></a></div>
</div>