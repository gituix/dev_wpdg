<?php
/**
 * Il file base di configurazione di WordPress.
 *
 * Questo file definisce le seguenti configurazioni: impostazioni MySQL,
 * Prefisso Tabella, Chiavi Segrete, Lingua di WordPress e ABSPATH.
 * E' possibile trovare ultetriori informazioni visitando la pagina: del
 * Codex {@link http://codex.wordpress.org/Editing_wp-config.php
 * Editing wp-config.php}. E' possibile ottenere le impostazioni per
 * MySQL dal proprio fornitore di hosting.
 *
 * Questo file viene utilizzato, durante l'installazione, dallo script
 * rimepire i valori corretti.
 *
 * @package WordPress
 */

define('WP_MEMORY_LIMIT', '64M');

// ** Impostazioni MySQL - E? possibile ottenere questoe informazioni
// ** dal proprio fornitore di hosting ** //
/** Il nome del database di WordPress */
define('DB_NAME', 'dev_wordpress');

/** Nome utente del database MySQL */
define('DB_USER', 'wordpress');

/** Password del database MySQL */
define('DB_PASSWORD', 'wordpress');

/** Hostname MySQL  */
define('DB_HOST', '10.10.13.27');

/** Charset del Database da utilizare nella creazione delle tabelle. */
define('DB_CHARSET', 'utf8');

/** Il tipo di Collazione del Database. Da non modificare se non si ha
idea di cosa sia. */
define('DB_COLLATE', '');

/**#@+
 * Chiavi Univoche di Autenticazione e di Salatura.
 *
 * Modificarle con frasi univoche differenti!
 * E' possibile generare tali chiavi utilizzando {@link https://api.wordpress.org/secret-key/1.1/salt/ servizio di chiavi-segrete di WordPress.org}
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '}!t~gF<!|:=oX^ppk0T>Akp4G!B/z&}:V(|HgA53@g[y2H,2:Zz7z*%bOI6xmya:');
define('SECURE_AUTH_KEY',  'u]I>(2#.zTqXOqj,{jW1>1$E#d2:B}&A4U&^=#tzFe -m9IRHan{VJM^ZEK_4 ti');
define('LOGGED_IN_KEY',    '|wYa>2bIWRGH4)-haBn]|<i[u~UlD>XecZ,zGs$zfneV;+GT]=^W#@irUa,T0oL5');
define('NONCE_KEY',        '[(6cX_W7|R43-=Ig8b^s9B*jPK/2;9`QJN6NH`y_G!uEfwH@(1I`yAHbTRq|A+GR');
define('AUTH_SALT',        'c LBZ8LYzJ82^or6q6c!ELEpC?MoU,#v2xs}x]rCwN7j> eo)fG4_Xj7Z/>noTZS');
define('SECURE_AUTH_SALT', 'XexcFW{%f8uEGOh0mqKb%F^+[j~$ gk*#C1(]PhR3I{wao.Os/gvHHrMQz987cr*');
define('LOGGED_IN_SALT',   'ja.ZT`u1y{!}AVy8-v;7p_q| DgP#u77xNPBn$9>L3K>i1_%{>}P~kQ}b@K!5LD?');
define('NONCE_SALT',       'lFogAl&Raowze,+0?>@!RBWIZmD/^ja|0-|MczZTE,!^..~CV>x$ig.?pNRI$bTu');

/**#@-*/

/**
 * Prefisso Tabella del Database WordPress .
 *
 * E' possibile avere installazioni multiple su di un unico database if you give each a unique
 * fornendo a ciascuna installazione un prefisso univoco.
 * Solo numeri, lettere e sottolineatura!
 */
$table_prefix  = 'wp_';

/**
 * Lingua di Localizzazione di WordPress, di base Inglese.
 *
 * Modificare questa voce per localizzare WordPress. Occorre che nella cartella
 * wp-content/languages sia installato un file MO corrispondente alla lingua
 * selezionata. Ad esempio, installare de_DE.mo in to wp-content/languages ed
 * impostare WPLANG a 'de_DE' per abilitare il supporto alla lingua tedesca.
 *
 */
define('WPLANG', 'it_IT');

/**
 *
 * Modificare questa voce a TRUE per abilitare la visualizzazione degli avvisi
 * durante lo sviluppo.
 * E' fortemente raccomandato agli svilupaptori di temi e plugin di utilizare
 * WP_DEBUG all'interno dei loro ambienti di sviluppo.
 */
define('WP_DEBUG', false);

/* Finito, interrompere le modifiche! Buon blogging. */

/** Path assoluto alla directory di WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Imposta lle variabili di WordPress ed include i file. */
require_once(ABSPATH . 'wp-settings.php');