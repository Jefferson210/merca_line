<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'wp_mercaline');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '|3I74$5zkuLq|=h9zP4Z3P@(.d-m~dak~r%c6R|.lAXAMm[ZU}vy8S;gRL~nPFt$');
define('SECURE_AUTH_KEY', '4-V)Qxh!j?knmF/rr33r329jcbUI~HfvNo+4LR+-9oM||TfD~7_R?$9L_B>Y +|C');
define('LOGGED_IN_KEY', 'fq^ sz;I_S[?-4:?tSZ,(Lf0`]/jc~(^@(TT-_>4/`#KYZ&ETfC3L&M+_jqjDlyc');
define('NONCE_KEY', '^g+[9U|93X&s/-fa.,JdBZ&)-@[<l4rn<l$Ust@b57;?m+El1#E`-=+42onR`qvD');
define('AUTH_SALT', '(oP6@^*zBf7b8n/E+z;o?$H4lg2,jB,kly#VJ1@DIpN.i=t/]vHgyDG<!]mb1t+T');
define('SECURE_AUTH_SALT', '?#J|k/):BDnhd:QFs4=p3VW5Y[+Txe54yn%>|et2l7OJQk$yh2M?1Q:?%ujXM|w#');
define('LOGGED_IN_SALT', '>W>I:-6+iNQGn!DvJ#(9doI[0;+!Z9-+c#+G?o}!>&@6jhmnK79!A^X:_uZ=;YDv');
define('NONCE_SALT', 'QX:bu;Z(6&3<#++W{h,)WXdw$5@<76]!lvZtij?^E-:71N`U|igL}okH9|vc^iW-');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

