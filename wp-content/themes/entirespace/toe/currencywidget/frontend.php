<div class="toeWidget currency-widget">
    <?php if(!empty($this->title)) { ?>
        <div class="toeWidgetTitle widget-title"><?php lang::_e($this->title)?></div>
    <?php }?>
    <div id="toeCurrencyWidgetContent<?php echo $this->uniqID?>" class="currency">
        <?php foreach($this->all as $c) { ?>
        <?php if($this->default['id'] == $c['id']) {$currentClass = 'current-currency';} else {$currentClass = '';} ?>
            <a href="<?php echo uri::mod('currency', '', 'setCurrency', array('code' => $c['code'], 'redirect' => $this->redirect))?>" class="currency-item <?php echo $c['code'].' '.$currentClass; ?>"><?php lang::_e($c['code']); ?></a>
        <?php } ?>
    </div>
</div>