<?php
// When changing configuration settings at runtime, the following
// commands must be run BEFORE invoking session_start().
// Use only those directives that need changing.

ini_set('session.auto_start', '0');
ini_set('session.use_cookies', '1');
ini_set('session.use_only_cookies', '1');
ini_set('session.use_trans_sid', '0');
ini_set('session.cache_limiter', 'nocache');

// Comment out the following line if using PHP < 5.5.2
ini_set('session.use_strict_mode', '1');

ini_set('session.name', 'MySession');

// Cookie settings
ini_set('session.cookie_domain', '');
ini_set('session.cookie_path', '/');
ini_set('session.cookie_lifetime', '0');
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_secure', '0');


ini_set('session.gc_maxlifetime', '1440');
ini_set('session.gc_probability', '1');
ini_set('session.gc_divisor', '100');