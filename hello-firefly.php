<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://crosspc.com
 * @since             1.0.2
 * @package           Hello_Firefly
 *
 * @wordpress-plugin
 * Plugin Name:       Hello Firefly
 * Plugin URI:        http://wordpress.org/plugins/hello-firefly
 * Description:       Shun-SHENG duh gao-WAHN! Hello Firefly is a shiny way of perking you up without using batteries twixt your nethers.  It displays an inspiration quote from your favorite TV show of all time across the top of your admin area.  
* Version:           1.0.2
 * Author:            CaptainTightPants
 * Author URI:        http://crosspc.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hello-firefly
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function hello_firefly_get_line() {
	/** These are my favorite quotes from Firefly*/
	$lyrics = "Yessir, Captain Tight Pants
Do you know what the chain of command is here? It's the chain I go get and beat you with to show you who's in command.
FAY-FAY duh PEE-yen
Someone tries to kill you, you try to kill 'em right back
Shiny, let's go be bad guys!
My God, you're like a trained ape! Without the training
BUN tyen-shung duh ee-DWAY-RO
Dear diary: Today I was pompous and my sister was crazy... Today we were kidnapped by hill folk, never to be seen again. It was the best day ever
I swear by my pretty floral bonnet, I will end you
Also? I can kill you with my brain
I think everybody could stand to calm down a bit.
Gao yang jong duh goo yang
Terse? I can be terse. Once, in flight school, I was laconic
I cannot abide useless people
Book : Why when I talk about belief, why do you always assume I'm talking about God? 
Next time you want to stab me in the back, have the guts to do it to my face
Well, my days of not taking you seriously are certainly comin' to a middle
Please. We’re very close to true stupidity here.
Shiong mao niao
I've been out of the abbey two days. I've beaten a lawman senseless. Fallen in with criminals. I watched the captain shoot the man I swore to protect. And I'm not even sure if I think he was wrong. 
GRRRR! Curse your sudden but inevitable betrayal!
This place gives me an uncomfortableness.
Sweetie, we're crooks. If everything were right, we'd be in jail
Jayne, your mouth is talking. You might wanna look to that
I brought you some supper. But, if you'd *prefer* a lecture, I've a few very catchy ones prepped. Sin and hellfire. One has lepers. 
Shun-SHENG duh gao-WAHN
Book : I wasn't born a shepherd, Mal. 
Ten percent of nothing is, let me do the math here, nothing into nothing, carry the nothin'...
Sir? I think you have a problem with your brain being missing
Gun HOE-tze bee DIO-se
Well, you were busy trying to get yourself lit on fire. It happens.
The important thing is the spices. A man can live on packaged food from here ’til Judgment Day if he’s got enough rosemary.
Mal! Looks like we got some imminent violence! 
Yeah, and if wishes were horses we'd all be eatin' steak! 
So, she's added cussing and hurling-about of things to her repertoire. She really is a prodigy.
So then the Shepherd says to the Companion, 'Well, a good goat'll do that.'
Wuh duh ma huh tah duh fong kwong duh wai shung
No power in the 'verse can stop me.";

	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function hello_firefly() {
	$chosen = hello_firefly_get_line();
	echo "<p id='firefly'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_firefly' );

// We need some CSS to position the paragraph
function firefly_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#firefly {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 13px;
	}
	</style>
	";
}

add_action( 'admin_head', 'firefly_css' );

function plugin_add_settings_link( $links ) {
    $settings_link = '<a href="https://www.paypal.me/hellofirefly">' . __( 'Donate' ) . '</a>';
    array_push( $links, $settings_link );
  	return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'plugin_add_settings_link' );
