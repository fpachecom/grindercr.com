<script type="text/javascript">
    if(typeof(toeBCWidgetBinded) == 'undefined')
        var toeBCWidgetBinded = false;
    var mustBeOpened<?php echo $this->uniqID?> = <?php echo utils::jsonEncode($this->mustBeOpened)?>;
    jQuery(document).ready(function(){
        var uniqID = '#toeBCWidgetContent<?php echo $this->uniqID?>';
        var toeBCWidgetShell = jQuery(uniqID+ ' .toeBCWidgetShell:first').clone();
        
        jQuery(uniqID).html('');
        listCategoriesToWidget(0, toeBCWidgetShell, <?php echo utils::jsonEncode($this->data)?>);
        jQuery(uniqID).html( toeBCWidgetShell );
        
        jQuery('.toeBCWidgetExpand').each(function(){
            if(jQuery.inArray(parseInt(jQuery(this).attr('href')), mustBeOpened<?php echo $this->uniqID?>) != -1) {
                toeExpandCategoryList(this);
            }
        });
    });
    jQuery(document).ready(function(){
        if(!toeBCWidgetBinded) {
            jQuery('.toeBCWidgetExpand').click(function(){
                toeExpandCategoryList(this);
                return false;
            });
            toeBCWidgetBinded = true;
        }
        jQuery('.toeBCWidgetShell').each(function(){
            if (jQuery(this).parent().hasClass('list-wrapper')){} else {jQuery(this).addClass('tree');}
        });
        
        var pageName = jQuery("#main-wrapper h1").text();
        jQuery(".list-wrapper ul li a").each(function(){
            if (jQuery(this).text() == pageName) jQuery(this).addClass('current-menu-item');
        });
    });
    if(typeof(listCategoriesToWidget) == 'undefined') {
        function listCategoriesToWidget(parentID, htmlShell, listData) {
            parentID = parseInt(parentID);
            var cell = jQuery(htmlShell).find('.toeBCWidgetItem:first').clone();
            var shellClone = jQuery(htmlShell).clone();
            jQuery(htmlShell).html('');
            var i = 0;
            for(i = 0; i < listData.length; i++) {
                if(parseInt(listData[i].parent) == parentID) {
                    var currCell = jQuery(cell).clone();
                    currCell.find('a.toeBCWidgetLink').html(listData[i].name).attr('href', listData[i].href);
                    if(parentID == 0 && listData[i].image) { //For first level only
                        currCell.find('a.toeBCWidgetImageLink').attr('href', listData[i].href);
                        currCell.find('a.toeBCWidgetImageLink img:first').attr('src', listData[i].image);
                    } else {
                        currCell.find('a.toeBCWidgetImageLink').remove();
                    }
					var productsCount = parseInt(listData[i].category_count)
                    if(productsCount) {
                        jQuery(currCell).find('.toeBCWidgetCountProducts').html(productsCount);
                    } else {
                        jQuery(currCell).find('.toeBCWidgetCountProductsShell').remove();
                    }
                    if(listData[i].haveChildren) {
                        var newShell = jQuery(shellClone).clone();
                        jQuery(currCell).append(newShell);
                        jQuery(newShell).hide();
                        currCell.find('a.toeBCWidgetExpand').attr('href', listData[i].cat_ID);
                        listCategoriesToWidget(listData[i].cat_ID, newShell, listData);
                    } else {
                        jQuery(currCell).find('.toeBCWidgetExpand').remove();
                    }
                    jQuery(htmlShell).append( currCell );
                }
            }
        }
    }
    if(typeof(toeExpandCategoryList) == 'undefined') {
        function toeExpandCategoryList(expandEl) {
            if(jQuery(expandEl).is('.toeExpanded')) {
                jQuery(expandEl).parents('.toeBCWidgetItem:first').find('.toeBCWidgetShell:first').slideUp(TOE_DATA.animationSpeed);
                jQuery(expandEl).html(' + ');
                jQuery(expandEl).removeClass('toeExpanded');
            } else {
                jQuery(expandEl).html(' - ');
                jQuery(expandEl).parents('.toeBCWidgetItem:first').find('.toeBCWidgetShell:first').slideDown(TOE_DATA.animationSpeed);
                jQuery(expandEl).addClass('toeExpanded');
            }
        }
    }
</script>
<div class="toeWidget">
    <?php if(!empty($this->title)) { ?>
        <div class="toeWidgetTitle"><?php lang::_e($this->title)?></div>
    <?php }?>
    <div id="toeBCWidgetContent<?php echo $this->uniqID?>" class="list-wrapper">
        <ul class="toeBCWidgetShell">
            <li class="toeBCWidgetItem">
                <a href="#" class="toeBCWidgetExpand"> + </a>
                <a href="#" class="toeBCWidgetLink"></a>
                <div class="toeBCWidgetCountProductsShell">
                    <span class="toeBCWidgetCountProducts"></span>
                </div>
            </li>
        </ul>
    </div>
</div>