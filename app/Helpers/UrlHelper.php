<?php
if (!function_exists('previous_url')) {
    function previous_url()
    {
        return $_SERVER['HTTP_REFERER'] ?? base_url(); // Get the previous URL from the HTTP referer header
    }
}
