server 'dedibox', user: 'sysadmin', roles: %w{web app db}
set :repo_url, '/data/git/repositories/csia-4jml/stock-manager.git'
set :deploy_to, '/home/4jml/stock-manager/'