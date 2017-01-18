<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
@if(session('message'))
    <h4>{{ session('message') }}</h4>
@endif

<form method="POST" action="{{ route('users.store') }}">
    {{ csrf_field() }}

    <label>Name</label>
    <input type="text" name="name">
    <br>
    <label>Email</label>
    <input type="email" name="email">
    <br>
    <label>Password</label>
    <input type="password" name="password">
    <br>
    <label>Confirm Password</label>
    <input type="password" name="confirmPassword">

    <input type="submit" name="Submit">
</form>
</body>
</html>