<?php
function childtheme_favicon() { ?>
    <link rel="shortcut icon" href="<?php echo bloginfo('stylesheet_directory') ?>/images/favicon.ico">
<?php }
 
add_action('wp_head', 'childtheme_favicon');

function wpsites_add_remove_user_contact_fields( $contactmethods ) {
 
$contactmethods['blank1'] = 'Blank1'; //first 3 blanks are removed by easy-admin-profile.js in businessfindertheme
$contactmethods['blank2'] = 'Blank2';
$contactmethods['blank3'] = 'Blank3'; 
$contactmethods['twitter'] = 'Twitter';
$contactmethods['facebook'] = 'Facebook';
$contactmethods['Youtube'] = 'YouTube';
$contactmethods['linkedin'] = 'LinkedIn';
$contactmethods['skype'] = 'Skype';
$contactmethods['googleplus'] = 'Google Plus';
$contactmethods['test'] = 'Test veld';
 
//unset($contactmethods['aim']);
//unset($contactmethods['yim']);
//unset($contactmethods['jabber']);
 
return $contactmethods;
}
 
add_filter('user_contactmethods','wpsites_add_remove_user_contact_fields',10,1);
?>