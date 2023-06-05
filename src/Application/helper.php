<?php

if (!function_exists('redirect')) {
    function redirect(string $path) {
        $url = sprintf('%s/%s', BASE_URL, $path);
        header("Location: {$url}");
    }
}

