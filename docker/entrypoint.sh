#!/usr/bin/env bash
set -e

echo "Starting..."

echo "alias art='php artisan'" >> ~/.bashrc
echo "alias art='php artisan'" >> /home/user/.bashrc

npm install

exec /usr/bin/supervisord -n -c /etc/supervisor/supervisord.conf
