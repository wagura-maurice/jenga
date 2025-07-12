<?php

$containerFile = __DIR__ . '/vendor/laravel/framework/src/Illuminate/Container/Container.php';

if (file_exists($containerFile)) {
    $content = file_get_contents($containerFile);
    
    // Fix the getClass() deprecation
    $content = str_replace(
        '$class = $parameter->getClass();',
        '$class = $parameter->getType() && ! $parameter->getType()->isBuiltin() ? new \ReflectionClass($parameter->getType()->getName()) : null;',
        $content
    );
    
    // Fix the error message concatenation
    $content = str_replace(
        '"Unresolvable dependency resolving [$parameter] in class {$parameter->getDeclaringClass()->getName()}"',
        '"Unresolvable dependency resolving [$parameter] in class ".$parameter->getDeclaringClass()->getName()',
        $content
    );
    
    file_put_contents($containerFile, $content);
    echo "Container.php has been updated for PHP 7.4 compatibility.\n";
} else {
    echo "Container.php not found. Make sure you're running this from the project root.\n";
    exit(1);
}
