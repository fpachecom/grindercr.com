<table id="gift-table">
<?php foreach($this->gifts['data'] as $g) { ?>
    <tr>
        <td>
            <?php if(!empty($g['img'])) { ?>
                <div class="thumb">
                <?php echo html::img($g['img'], 0)?>
                </div>
            <?php }?>
        </td>
        <td>
            <b><?php lang::_e($g['label'])?>:</b>
            <?php if(!empty($g['description'])) {?>
                <p><?php lang::_e(nl2br($g['description']))?></p>
            <?php }?>
        </td>
        <td>
        <?php 
            $giftContent = '';
            switch($g['type']) {
                case 'product':
                    echo $g['freeProductLink'];
                    break;
            }
            echo $giftContent;
        ?>
        </td>
    </tr>
<?php }?>
</table>