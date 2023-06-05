<?php

use Application\Entities\User;

if (!function_exists('redirect')) {
    function redirect(string $path): void
    {
        $url = sprintf('%s/%s', BASE_URL, $path);
        header("Location: {$url}");
    }

    if (!function_exists('setUserSession')) {
        function setUserSession(User $user): void
        {
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['email'] = $user->getEmail();
        }
    }
}

