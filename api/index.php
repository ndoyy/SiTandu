<?php
// Vercel hanya mengizinkan tulis ke /tmp
$storage = '/tmp/storage';
foreach (['framework/views', 'framework/cache/data', 'framework/sessions', 'logs'] as $dir) {
    if (!is_dir("$storage/$dir")) {
        mkdir("$storage/$dir", 0777, true);
    }
}

$env = [
    'LARAVEL_STORAGE_PATH' => $storage,
    'VIEW_COMPILED_PATH'   => "$storage/framework/views",
    // cache bootstrap Laravel diarahkan ke /tmp (bootstrap/cache read-only di Vercel)
    'APP_SERVICES_CACHE'   => "$storage/services.php",
    'APP_PACKAGES_CACHE'   => "$storage/packages.php",
    'APP_CONFIG_CACHE'     => "$storage/config.php",
    'APP_ROUTES_CACHE'     => "$storage/routes.php",
    'APP_EVENTS_CACHE'     => "$storage/events.php",
];
foreach ($env as $key => $value) {
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
    putenv("$key=$value");
}

require __DIR__ . '/../public/index.php';
