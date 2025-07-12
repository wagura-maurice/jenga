<?php
// deploy.php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'jenga');

// Project repository
set('repository', 'git@github.com:wagura-maurice/jenga.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);
set('default_timeout', 150000);

// Shared files/dirs between deploys
add('shared_files', ['.env']);
add('shared_dirs', ['storage']);

// Writable dirs by web server
add('writable_dirs', ['bootstrap/cache', 'storage', 'storage/logs', 'storage/framework/cache', 'storage/framework/sessions', 'storage/framework/views']);

// Hosts
host('206.189.120.35')
    ->user('deployer')
    ->port(22)
    ->set('php_version', '7.4')
    ->identityFile('~/.ssh/id_rsa') // ssh on local machine that links to the deployer on VPS
    ->set('deploy_path', '/var/www/html/{{application}}');

// Specify the PHP and Composer paths for PHP 7.4
set('bin/php', function () {
    return '/usr/bin/php7.4';
});

set('bin/composer', function () {
    return '/usr/bin/php7.4 /usr/local/bin/composer';
});

// Tasks
task('build', function () {
    run('cd {{release_path}} && build');
});

// Laravel-specific tasks
task('release:application', function () {
    // Serve the app down for maintenance
    run('{{bin/php}} {{release_path}}/artisan down');

    // Clear and cache application data
    run('{{bin/php}} {{release_path}}/artisan cache:clear');
    run('{{bin/php}} {{release_path}}/artisan config:clear');
    run('{{bin/php}} {{release_path}}/artisan config:cache');
    run('{{bin/php}} {{release_path}}/artisan route:clear');
    run('{{bin/php}} {{release_path}}/artisan route:cache');
    run('{{bin/php}} {{release_path}}/artisan view:clear');

    // Create storage symlink
    run('{{bin/php}} {{release_path}}/artisan storage:unlink || true');
    run('{{bin/php}} {{release_path}}/artisan storage:link');

    // Optimize the framework
    // run('{{bin/php}} {{release_path}}/artisan optimize');

    // Run database migrations (uncomment if needed)
    // Note: Always back up data before running migrations in production.
    // run('{{bin/php}} {{release_path}}/artisan migrate:reset');
    // run('{{bin/php}} {{release_path}}/artisan migrate:fresh --seed --force');

    // Serve the app up
    run('{{bin/php}} {{release_path}}/artisan up');
})->once();

// Deployment Hooks
before('deploy:symlink', 'release:application');
after('deploy:failed', 'deploy:unlock');

// [Optional] Task to install npm dependencies and build assets
/* task('npm:build', function () {
    run('cd {{release_path}} && npm install && npm run production');
})->desc('Install npm dependencies and build assets'); */
