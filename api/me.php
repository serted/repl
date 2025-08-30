<?php
require_once __DIR__ . '/../inc/bootstrap.php';
header('Content-Type: application/json; charset=utf-8');
json_response(['user'=>current_user(), 'csrf'=>csrf_token()]);
