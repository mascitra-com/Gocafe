<!DOCTYPE html>
<html>
<head>
	<title>Foo Upload</title>
</head>
<body>
	<form method="POST" action="{{ url('foo/upload/store') }}" enctype="multipart/form-data">
	{{ csrf_field() }}
		<img src="{{route('foo/upload/get')}}" alt="image">
		<input type="file" name="avatar">
		<button type="submit">Submit</button>
	</form>
</body>
</html>