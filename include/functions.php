<?php
// include/functions.php — unified entry
require_once __DIR__ . '/../inc/bootstrap.php';
function base_uri(): string { return '/dev'; }
function asset(string $path): string { return base_uri() . '/' . ltrim($path,'/'); }
function urlp(string $path=''): string { return base_uri() . '/' . ltrim($path,'/'); }