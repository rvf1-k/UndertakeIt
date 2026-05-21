<?php

function current_url()
{
    return strtok($_SERVER['REQUEST_URI'], '?') . '?' . http_build_query($_GET);
}