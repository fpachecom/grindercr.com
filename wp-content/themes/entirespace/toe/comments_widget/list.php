<div class="latest-reviews toeWidget six columns nopadding mobile-four">
    <?php if(!empty($this->instance['title'])) { ?>
        <h3 class="reviews-title toeWidgetTitle"><img src="<?php echo bloginfo('template_directory').'/img/star-little.png'; ?>" alt="" /><?php lang::_e($this->instance['title'])?></h3>
    <?php }?>
    <div id="toeCommentsWidgetContent<?php echo $this->uniqID?>" class="reviews-wrapper">
        <?php if (!empty($this->comments)) {?>
            <?php foreach ($this->comments as $c) {?>
                <div class="latest-review-item toeWidgetComment">
                    <?php if($this->instance['show_product_link']) { ?>
                    <div class="review-content-title toeWidgetCommentPostTitle">
                        <a href="<?php echo get_post_permalink($c['comment_post_ID'])?>"><?php echo $c['post_title']?></a>
                    </div>
                    <?php }?>
                    <?php if(!empty($c['toeRate']) && !empty($this->rateStarsCount)) {?>
                    <div class="rating toeCommentsWidgetRating" id="toeCommentsWidgetRating<?php echo $c['comment_ID']?>">
                        <ul class="toeRating">
                            <?php for($i = 1; $i <= $this->rateStarsCount; $i++) {?>
                            <li>
                                <a href="#" onclick="return false;" class="toeRatingLink<?php echo $i?> toeStarOff toeRateStarStatic"><?php echo $i?></a>
                            </li>
                            <?php }?>
                        </ul>
                        <script type="text/javascript">
                        // <!--
                        toeSetRating(<?php echo $c['toeRate']?>, 0, jQuery('#toeCommentsWidgetRating<?php echo $c['comment_ID']?>'));
                        // -->
                        </script>
                    </div>
                    <?php }?>
                    <div class="clear"></div>
                    <?php if(!empty($c['comment_author'])) {?>
                    <div class="author">
                        <?php lang::_e('by'); ?> <a href="<?php echo get_comment_link((object)$c)?>"><?php echo $c['comment_author']?></a>
                    </div>
                    <?php }?>
                    <div class="review-content toeCommentsWidgetComment">
                        <?php 
                            $commentContent = $c['comment_content'];
                            if(!empty($this->instance['comment_len']) && is_numeric($this->instance['comment_len']) && strlen($commentContent) > $this->instance['comment_len']) {
                                $commentContent = substr($commentContent, 0, $this->instance['comment_len']). '...';
                            }
                            echo $commentContent;
                        ?>
                    </div>
                </div>
            <?php }?>
        <?php }?>
        <!--<a href="#" class="leave-review-button styled-button">Leave a Review</a>-->
    </div>
</div><!-- End Latest Reviews -->