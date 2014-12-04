<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'grindercrdb');

/** MySQL database username */
define('DB_USER', 'grindercr');

/** MySQL database password */
define('DB_PASSWORD', 'grindercr');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'D(=yzNwb^P<y!|Oh)APtoBbrYZb=QUlRlzwZxe|reoryQt(HF?<[pX=p>XSNPuk=n{vs|WyyDVe}inr@YFaABVFHWZ*|yq[}RoCg]QCeE^}pl>%=_K)%<gelYKE@I/pZ');
define('SECURE_AUTH_KEY', '_^mrGuWI{IO$IMs?OtzP=jw)sTXOmjsWOylS=O}SUw*HrYF?te&PiWcN}MDlGt%%)^|!;c$X_eOKY^n(a>%vCj*bIr)MP>_S-EK|NN$zze;Oc@KaTblrd*ZLhIAyqvFm');
define('LOGGED_IN_KEY', 't{J;f^?ysPnPv$c!<RtN=&/^QM+tS(g>{CrS[>@[STAFig{BbtPCtC?zT)dPG*sI]>f|rrHpWZ@r*jb??d>-a{J/D!%Vq_UOKb$cD_csXLJAW/Z<*Z$yVoNN%U(OzyBB');
define('NONCE_KEY', '-ZoToW!tT$R%*&r]TxwI_cewNir>_;lroD<L<NylZy_gtKb>p;i;$Wqf)f</PajN=qB-IY}@MewF&VJsRFm]S^nmLh<*-g-Q?I^+z=nUx>zc)e;HvJQck(R;OvAQ}Ga[');
define('AUTH_SALT', 'pgz^Ahnu>[b_rS}lTvKuh$CdPQi|)mKtz}<_hQuxf_aH;mcjUp@ecF}ypAR^)bKfHg%>X;Zx{AXI)dJj+IWSKHok=Zx>UgTMMF;!E(;$$%pKyH>UAI[BKo)&$MnRLbk>');
define('SECURE_AUTH_SALT', 'AAT&pxfp=e)sx;-C|E/g[$SXCLg][qPh}KMd$MW]LLJi!i[!BOyCd>^+QHcuhC!(Ukw+CfR&XxAVC}|YMiLCguFXpLJe?vna*trTl&}=Y]AY<{fk[V*ZGgK/P_GeBt=B');
define('LOGGED_IN_SALT', '-%]DuCURD%Q*=DOg_bs|ANJ&=_Vd{ZgzGWpA!Eb*Ct=Fv&OfCRqz>f>HzPjkv}R$MvdFbJIa<il=v@zQ|MT+|slYLfKN[wy}PO<Zl|hYVKT!ufGnwnH]+CC;wiQa_]o{');
define('NONCE_SALT', '<bp]=Kn/f{p_|YcYmsp>pS]eph!fmzpe|Z$<&n){<Jxr{H[*vu^>-yD*rgl$M?B$O&y)FYV%XYHzmekKp/MZN+zUkcpmHMNZWcyl>hlK}ltAZls)XgSJ{Dg(f}W)d[eq');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_lnqc_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

/**
 * Include tweaks requested by hosting providers.  You can safely
 * remove either the file or comment out the lines below to get
 * to a vanilla state.
 */
if (file_exists(ABSPATH . 'hosting_provider_filters.php')) {
	include('hosting_provider_filters.php');
}
