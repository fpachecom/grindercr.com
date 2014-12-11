<?php if($this->showFromPriceLabel) { ?>
    <?php lang::_e('From ')?>
<?php }?>
<?php echo frame::_()->getModule('currency')->display($this->price)?>

<?php if(isset($this->oldPrice)) { ?>
    <div class="old-price"><s><?php echo frame::_()->getModule('currency')->display($this->oldPrice)?></s></div>
<?php }?>
<?php if(!empty($this->specials) && is_single()) { ?>
<span class="special_labels">
<?php
    if(!empty($this->saleTpl)) { ?>
        <span><?php echo $this->saleTpl?>: </span>
<?php
    }
    foreach($this->specials as $s) {
        lang::_e($s['label']). '<br />';
    }
?>
</span>
<?php }?>