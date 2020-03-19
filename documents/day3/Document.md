1. Blade View
	@extends('master_layout')

2. Migration
- Quản lý version database (tạo bảng, tạo cột, update cột, bảng)

* Config Connect Database
- Create table
	php artisan make:migration table_name
	Ex: php artisan make:migration create_courses_table

- Method up()
	php artisan migrate

- Method down()
	php artisan migrate:rollback