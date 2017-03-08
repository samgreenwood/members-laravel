#!/bin/bash
mysqladmin -u root drop members-laravel -f; mysqladmin -u root create members-laravel; php artisan migrate; php artisan db:seed --class DataImportSeeder;
