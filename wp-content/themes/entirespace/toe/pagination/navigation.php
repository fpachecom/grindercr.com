<?php
if($this->wp_query->max_num_pages > 1) {    //If this is not first page?>
    <?php //Navigation?>
    <?php if($this->paged == 0) $this->paged = 1; //bug fix ?>
    <div id="<?php echo $this->nav_id; ?>">
        <?php lang::_e('Page:'); ?>
        <?php if($this->paged != 1) {?>
            <?php $img = '<img src="'.get_bloginfo('template_directory').'/img/rarr.png" />'; ?>
            <span class="nav-previous"><?php previous_posts_link($img); ?></span>
        <?php }?>
<?php for($i = 1; $i <= $this->wp_query->max_num_pages; $i++) { ?>
        <?php if($this->paged != $i) {?>
        <a href="<?php echo get_pagenum_link($i)?>">
        <?php } else {echo '<span>';}?>
        <?php echo $i?>
        <?php if($this->paged != $i) {?>
        </a>
        <?php } else {echo '</span>';}?>
<?php }?>
        <?php if($this->paged != $this->wp_query->max_num_pages) {  //If this is not last page?>
        <?php $img = '<img src="'.get_bloginfo('template_directory').'/img/larr.png" />'; ?>
        <span class="nav-next"><?php next_posts_link($img); ?></span>
        <?php }?>
    </div><!-- #nav-above -->


<?php }