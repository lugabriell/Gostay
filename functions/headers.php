<?php
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("Referrer-Policy: strict-origin-when-cross-origin");
header("Permissions-Policy: geolocation=(), camera=(), microphone=()");

if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
}