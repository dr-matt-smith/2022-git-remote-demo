<?php

// config/packages/security.php
use Symfony\Config\SecurityConfig;

return static function (SecurityConfig $security) {

$security->firewall('main')

->rememberMe()
->secret('%kernel.secret%')
->alwaysRememberMe(true);
};