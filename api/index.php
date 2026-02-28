<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Pastikan Vercel Temporary Folders (storage dan turunannya) telah dipaksa dibuat dan diberi izin tulis
    $compiledPath = '/tmp/storage/framework/views';
    $logsPath = '/tmp/storage/logs';
    $appPath = '/tmp/bootstrap/cache';

    foreach ([$compiledPath, $logsPath, $appPath] as $path) {
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
    }

    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    echo "<h1>Fatal Error dari Vercel:</h1>";
    echo "<pre>" . $e->getMessage() . "</pre>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
