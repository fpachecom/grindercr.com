<script type="text/javascript">
// <!--
jQuery(document).ready(function(){
    var twittUrl = 'https://api.twitter.com/1/statuses/user_timeline.json?';
    twittUrl += 'include_entities=true&';
    twittUrl += 'include_rts=true&';
    twittUrl += 'screen_name=<?php echo $this->instance['username']?>&';
    twittUrl += 'count=<?php echo $this->instance['count']?>&';
	twittUrl += 'include_entities=1&'
    twittUrl += 'callback=?';
    try {
        jQuery.getJSON(twittUrl, function(data){
            try {
                if(data && jQuery(data).size()) {
                    var tweetsCount = jQuery(data).size();
                    var box = jQuery('#<?php echo $this->uniqBoxId?> .toeTwittData:first');
                    jQuery(box).css('display', '');
                    for(var i = 0; i < tweetsCount; i++) {
						var tweet = data[i].text.replace(/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig, function(url) {
							return '<a href="'+url+'" target="_blank">'+url+'</a>';
						}).replace(/B@([_a-z0-9]+)/ig, function(reply) {
							return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
						});
                        jQuery('#<?php echo $this->uniqBoxId?>').append(
                            jQuery(box).clone().html(tweet)
                        );
                    }
                }
            } catch(e) {}
        });
    } catch(e) {}
});
// -->
</script>
<div class="twitter-news six columns nopadding mobile-four">
<?php if(!empty($this->instance['title'])) { ?>
    <h3 class="twitter-news-title"><img src="<?php echo bloginfo('template_directory').'/img/twitter-dark.png'; ?>" alt="" /><?php echo $this->instance['title']?></h3>
<?php }?>
<div id="<?php echo $this->uniqBoxId?>" class="twitter-news-wrapper">
    <div class="toeTwittData twitter-news-item" style="display: none;"></div>
</div>
<a href="http://twitter.com/<?php echo $this->instance['username']?>" class="follow styled-button" target="_blank"><?php lang::_e('Follow'); ?></a>
</div><!-- End Twitter News -->

    