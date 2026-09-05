<?php

// Prepare required storage directory structure in ephemeral /tmp for Vercel Serverless
$storage = '/tmp/storage';
$dirs = [
    $storage . '/framework/views',
    $storage . '/framework/cache',
    $storage . '/framework/cache/data',
    $storage . '/framework/sessions',
    $storage . '/logs',
    $storage . '/app/public',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Forward request to Laravel public index.php
require __DIR__ . '/../public/index.php';
