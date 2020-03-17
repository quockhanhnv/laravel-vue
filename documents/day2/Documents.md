* Controller
- Cách tạo:
	php artisan make:controller ControllerName
	Ex: UserController
		ProductController

- Load view
	view('viewPath');

- Truyền dữ liệu từ controller -> view

- Sử dụng Middleware trong controller

* Các cú pháp của blade engine
- {{ $content }}: echo "content" // In dữ liệu ra
	-> Hạn chế được lỗi bảo mật XSS

  {!! !!}: In dữ liệu ra và có active thẻ html
  -> Không bảo mật

- if else trong blade
	@if ()
		// code
	@endif

	-------------
	@if ()
		// code
	@else
		// code
	@endif

@php
	$a = functionName();
@endphp

@while(condition)

@endwhile