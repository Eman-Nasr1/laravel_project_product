<!-- resources/views/products.blade.php -->  
<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Register</title>  
    <link href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>  
<body> 
<h2>Welcome to the Dashboard</h2>
<p>You are logged in!</p>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button class="btn btn-primary " type="submit">Logout</button>
</form>

</body>  
</html>
