<?php

function current_url()
{
    return strtok($_SERVER['REQUEST_URI'], '?') . '?' . http_build_query($_GET);
}

function current_query()
{
    return http_build_query($_GET);
}

function redirect()
{
    $current_query = current_query();
    return "<script>window.location.href = 'index.php?{$current_query}';</script>";
}

function redirectHome()
{
    return "<script>window.location.href = 'index.php?page=home';</script>";
}

function redirectOther(string $query)
{
    return "<script>window.location.href = 'index.php?{$query}';</script>";
}
