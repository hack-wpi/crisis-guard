<?php
namespace Deployer;
require 'recipe/laravel.php';

// Configuration

set('repository', 'git@github.com:hack-wpi/shltr.git');
set('http_user', 'ubuntu');
set('branch', 'jhassler/feature/flare_api');
set('keep_releases', 3);

// Servers

server('production', '54.80.188.226')
    ->user('ubuntu')
    ->identityFile()
    ->forwardAgent()
    ->set('deploy_path', '/home/ubuntu/http');

// Tasks
/**
 * Deploy start, prepare deploy directory
 */
task('deploy:start', function() {
    cd('~');
    run("if [ ! -d {{deploy_path}} ]; then mkdir -p {{deploy_path}}; fi");
    cd('{{deploy_path}}');
    run("eval \"$(ssh-agent)\"");
})->setPrivate();

/**Set Storage chmod*/
task('deploy:storage', function() {
    cd('{{deploy_path}}');
    run('chmod -R 777 current/storage');
    run('chgrp -R www-data current/usrimg');
})->setPrivate();

/**
 * Migrate laravel
 */
task('deploy:laravel', function() {
    cd('{{deploy_path}}/current');
    run("cp /home/ubuntu/configs/.env.deploy ./.env");
    run("php artisan key:generate");
    run("php artisan migrate");
    run("php artisan passport:install");
})->setPrivate();

/**
 * Main task
 */
task('deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
    'deploy:vendors',
    'deploy:symlink',
    'deploy:storage',
    'deploy:laravel',
    'cleanup',
])->desc('Deploy your project');
before('deploy:prepare', 'deploy:start');
after('deploy:shared', 'deploy:writable');
after('deploy', 'success');
