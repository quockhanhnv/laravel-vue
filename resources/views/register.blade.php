<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
	<h2 align="center">Register Form</h2>

	<div align="center">
		<form action="/test-patch" method="post">
			@csrf
			@method('patch')
			<button>Submit</button>
		</form>
	</div>
</body>
</html>