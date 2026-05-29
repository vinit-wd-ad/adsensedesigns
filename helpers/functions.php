<?php

function redirect($path, $params = [])
{
    $url = BASE_URL . ltrim($path, '/');

    // Query Params
    if (!empty($params)) {

        $url .= '?' . http_build_query($params);
    }

    header("Location: $url");
    exit;
}