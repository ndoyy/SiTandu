<?php
// Vercel hanya mengizinkan tulis ke /tmp
$storage = '/tmp/storage';
foreach (['framework/views', 'framework/cache/data', 'framework/sessions', 'logs'] as $dir) {
    if (!is_dir("$storage/$dir")) {
        mkdir("$storage/$dir", 0777, true);
    }
}
$_ENV['LARAVEL_STORAGE_PATH'] = $storage;
putenv("LARAVEL_STORAGE_PATH=$storage");

require __DIR__ . '/../public/index.php';
