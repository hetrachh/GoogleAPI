<!DOCTYPE html>
<html>
<head>
	<title>Laravel</title>
</head>
<body>
		Welcome, {{$user->name}}
		
		<a href={{url('/logout')}}>Log out</a>
</body>
</html>