<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'lezard');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'lezard');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'PTvert38!');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'OI1M7P>W9SVB|w9yLSLgn6b}w-F+$ZfF&e3Hx>Y8M:E52dpw55?~ <~WGCH7Q*t0');
define('SECURE_AUTH_KEY',  'h/4&GXh]cxLl2inFlpGMcaLVnk` @zvM2!rNP-}5XC-g*cb1kH.4+ScO2~z7d1$I');
define('LOGGED_IN_KEY',    'K;#_>. `+3XM2<?7hA2Z((>nv;BU5g6vk6o+3tG>f!kD +BhnM*{&)J$D!EeYyU{');
define('NONCE_KEY',        'o?TU#TalA1%$G(J]p$g|RIS5h[#o(0FkcNx;qV]i4;]]w/Dwsvwv0TT}X DZ+b>D');
define('AUTH_SALT',        'tpMtzrF=D_#/ECZ=gc|Ic?4#0cq;u._8h[y(X+zn{x8#[&aeOD(!23 x.[wuf7C|');
define('SECURE_AUTH_SALT', '&<wTb5O6T|t86+[}HN@h@?F.=>.~w$M:E)FYURSp~+NV*2r<NB3:iT[_#n5dr[hA');
define('LOGGED_IN_SALT',   'jRNCCCWsm*=>WmWFOS^%et^_P?XRE<*b?ln{I*m8$_Brs$7v9#5RTGV~f.fd*b0^');
define('NONCE_SALT',       '-L/_&=4}4JW`Ldr852E~Jp)XZe):10!=w,>N-w5s8CaE:^`@;MlNG9~kKd71m8af');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
