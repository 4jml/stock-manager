# config valid only for Capistrano 3.1
# lock '3.1.0'

set :application, '4JMLStockManager'

set :format, :pretty
set :log_level, :info
set :keep_releases, 2
set :pty, true

set :composer_install_flags, '--no-dev --prefer-dist --no-interaction --optimize-autoloader'
set :linked_files, %w{}
set :linked_dirs, %w{server/app/config/production server/public/data}

before 'deploy:starting', 'laravel:parameters'
after 'deploy:updated', 'laravel:migration'
before 'deploy:publishing', 'laravel:cache'
before 'deploy:publishing', 'laravel:permissions'
before 'deploy:publishing', 'npm:build'
after 'deploy:published', 'laravel:apc'
after 'deploy:finishing', 'deploy:cleanup'