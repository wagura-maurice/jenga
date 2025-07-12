# Apply PHP 7.4 compatibility patch

if [ -f "patches/laravel-5.4-php7.4-compat.patch" ]; then
patch -p1 -N < patches/laravel-5.4-php7.4-compat.patch || true
fi

# Clear all caches

/usr/bin/php7.4 artisan down
/usr/bin/php7.4 artisan cache:clear
/usr/bin/php7.4 artisan route:clear
/usr/bin/php7.4 artisan config:clear
/usr/bin/php7.4 artisan view:clear
/usr/bin/php7.4 artisan clear-compiled

# Regenerate optimized files

/usr/bin/php7.4 artisan optimize --force

# Update Composer autoloader

/usr/bin/php7.4 /usr/local/bin/composer dump-autoload --optimize

# Set proper permissions

chmod -R 755 storage bootstrap/cache
chmod -R 777 storage bootstrap/cache

# Bring application back up

/usr/bin/php7.4 artisan up
