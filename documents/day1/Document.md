1. Route Trong Laravel
<form action="" method="post | get">
	<!-- Code -->
</form>

Route method
GET
	- param trong route

POST
	- param trong route

PUT (POST)
	- param trong route
	- @method('put')

DELETE
	- param trong route
	- @method('delete')
	- Chuc nang xoa
OPTIONS
	- param trong route
	- @method('options')
	- Request ajax

MATCH

PATCH
	- param trong route
	- @method('patch')

* Route Name
	- route('routeName');
	- route('routeName', ['paramName' => value, .....]);

* Artisan Command With Route

	php artisan route:list

* Tinker
	php artisan tinker

* Group Route
- prefix
- namespace?
- middleware
	+ Tao middleware
		php artisan make:middleware TestMiddleware

