<?php  
/*
 * Template Name: Contact us
 */
?>
<?php // Form Sending and checking
if(isset($_POST['submitted'])) {
    if(trim($_POST['contactName']) === '') {
        $nameError = lang::_('Please enter your name.');
        $hasError = true;
    } else {
        $name = trim($_POST['contactName']);
    }
 
    if(trim($_POST['email']) === '')  {
        $emailError = lang::_('Please enter your email address.');
        $hasError = true;
    } else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
        $emailError = lang::_('You entered an invalid email address.');
        $hasError = true;
    } else {
        $email = trim($_POST['email']);
    }
 
    if(trim($_POST['comments']) === '') {
        $commentError = lang::_('Please enter a message.');
        $hasError = true;
    } else {
        if(function_exists('stripslashes')) {
            $comments = stripslashes(trim($_POST['comments']));
        } else {
            $comments = trim($_POST['comments']);
        }
    }
 
    if(!isset($hasError)) {
        $emailTo = get_option('espace_email');
        if (!isset($emailTo) || ($emailTo == '') ){
            $emailTo = get_option('admin_email');
        }
        $subject = $_POST['subject'];
        $body = "Name: $name \n\nEmail: $email \nMessage: $comments";
        $headers = 'From: '.$name.' <'.$email.'>' . "\r\n";
            
        if(recapcha::_()->check()) { 
            mail($emailTo, $subject, $body, $headers);
            $emailSent = true;
        } else {$emailSent = false; $errMessage = lang::_('Error! Capcha is incorrect.');}
    }
 
} ?>
<?php get_header(); ?>
<div id="main-wrapper" class="product_categories">  
    <?php require_once (TEMPLATEPATH . '/functions/menu.php'); ?>
    
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
        <div class="product-text article row">
            <h1><?php the_title(); ?></h1>
            <?php the_content('Read more...'); ?>
            <div class="six columns">
                <?php if(isset($emailSent) && $emailSent == true) { ?>
                    <div class="thanks">
                        <p><?php lang::_e('Thanks, your email was sent successfully.'); ?></p>
                    </div>
                <?php } elseif($emailSent == false){ echo '<label class="error">'.$errMessage.'</label>';} $emailSent = false; ?>
                <form action="<?php the_permalink(); ?>" id="contactForm" class="contactform" method="post">
                    <input type="text" name="contactName" id="contactName" class="required" placeholder="<?php lang::_e('Your name'); ?>" />
                    <input type="text" name="email" id="email" class="required email" placeholder="<?php lang::_e('Email'); ?>" />
                    <input type="text" name="subject" id="subject" placeholder="<?php lang::_e('Subject'); ?>" />
                    <textarea name="comments" id="commentsText" class="required" placeholder="<?php lang::_e('Your Message'); ?>"></textarea>
                    <?php echo html::capcha()?>
                    <input class="submit" type="submit" value="<?php lang::_e('Send email'); ?>"/>
                    <input type="hidden" name="submitted" id="submitted" value="true" />
                </form>
            </div>
            
            <div class="six columns">
                <?php
                    $gmap_html = get_option('espace_gmap_html');
                    if ($gmap_html != ''): ?>
                <div id="gmap">
                    <?php echo $gmap_html; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
        </div>
    <?php endwhile; ?>
    <?php else : ?>
         <p><?php lang::_e('Sorry, but nothing found');?>.</p>
    <?php endif; ?>
<?php get_footer(); ?>