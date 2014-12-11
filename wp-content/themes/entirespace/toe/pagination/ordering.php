<span class="sorting-block">
    <?php lang::_e('Sort by')?>: 
    <?php 
        $currOrder = $_GET['orderby'];
        $currDest = $_GET['order'];
    ?>
    <?php foreach($this->orderByValues as $k => $v) { ?>
        <?php if($v['orderby'] == $currOrder) {$currClass = 'class="current-order"';} else {$currClass = '';} ?>
    <a href="<?php uri::_e(array('baseUrl' => $this->baseHrefForOrdering, 'orderby' => $v['orderby'], 'order' => 'DESC'));?>" <?php echo $currClass; ?>><?php lang::_e($v['label'])?></a>
    <?php foreach($v['desc'] as $order => $orderLabel) { ?>
        <?php if($order == $currDest) {$currClass = 'class="current-order"';} else {$currClass = '';} ?>
        <a href="<?php uri::_e(array('baseUrl' => $this->baseHrefForOrdering, 'orderby' => $v['orderby'], 'order' => $order))?>" <?php echo $currClass; ?>><?php lang::_e($orderLabel)?></a>
    <?php }?>
    <?php }?>
</span>