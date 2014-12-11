<?php if (is_home() or is_single() or is_archive()): ?>
    
    <?php if ( is_active_sidebar( 'footerwidgets' ) ) : ?>
        <?php dynamic_sidebar( 'footerwidgets' ); ?>
    <?php endif; ?>
    
<?php endif; ?>
            <div class="clear"></div>
			</div><!-- End Main Wrapper -->
            <div class="clear"></div>
			
			<div id="footer" class="twelve columns">
				<div id="copyrights">
					<p><?php echo get_option('espace_copyright'); ?></p>
                    <?php if(get_option('espace_terms_link_show') == 'on'): ?>
					<a href="<?php echo get_option('espace_terms_link'); ?>"><?php lang::_e('Terms of Use Privacy Policy'); ?></a>
                    <?php endif; ?>
                </div>
				<div id="social">
					<ul>
                        <?php if( get_option('espace_gplus') != '' ): ?>
						<li class="gplus-btn"><a href="<?php echo get_option('espace_gplus'); ?>"><img src="<?php echo bloginfo('template_directory').'/img/gplus.png'; ?>" alt="<?php lang::_e('Add us on Google+!'); ?>" /></a></li>
						<?php endif; ?>
                        <?php if( get_option('espace_twitter') != '' ): ?>
						<li class="twitter-btn"><a href="<?php echo get_option('espace_twitter'); ?>"><img src="<?php echo bloginfo('template_directory').'/img/twitter.png'; ?>" alt="<?php lang::_e('Follow us on Twitter!'); ?>" /></a></li>
						<?php endif; ?>
                        <?php if( get_option('espace_flickr') != '' ): ?>
                        <li class="flickr-btn"><a href="<?php echo get_option('espace_flickr'); ?>"><img src="<?php echo bloginfo('template_directory').'/img/flickr.png'; ?>" alt="<?php lang::_e('Add us on Flickr'); ?>" /></a></li>
						<?php endif; ?>
                        <?php if( get_option('espace_facebook') != '' ): ?>
                        <li class="facebook-btn"><a href="<?php echo get_option('espace_facebook'); ?>"><img src="<?php echo bloginfo('template_directory').'/img/facebook.png'; ?>" alt="<?php lang::_e('Like us on Facebook'); ?>" /></a></li>
						<?php endif; ?>
                        <?php if( get_option('espace_tumblr') != '' ): ?>
                        <li class="tumblr-btn"><a href="<?php echo get_option('espace_tumblr'); ?>"><img src="<?php echo bloginfo('template_directory').'/img/tumblr.png'; ?>" alt="<?php lang::_e('Follow us on Tumblr'); ?>" /></a></li>
                        <?php endif; ?>
                    </ul>
				</div>
                <div class="clear"></div>
			</div><!-- End Footer -->
			<div class="clear"></div>
		</div><!-- End Container -->
        <?php wp_footer(); ?>
	</body>
</html>