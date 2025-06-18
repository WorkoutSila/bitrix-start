<?php

spl_autoload_register(function ($baseClassName) {
    $classPatch = preg_replace_callback(
        '#^(components\\\\[^\\\\]+\\\\)(\w+)(.*)$#',
        function ($matches) {
            $output = lcfirst($matches[2]);
            $output = preg_replace_callback('/[A-Z]/', function($match) {
                return '.' . strtolower($match[0]);
            }, $output);
            return $matches[1] . $output . $matches[3];
        }, $baseClassName);

    $classPatch = dirname(__DIR__,2) . '/local/' . str_replace('\\', '/', $classPatch) . '.php';
    if (file_exists($classPatch)) {
        require_once($classPatch);
        return true;
    }
});