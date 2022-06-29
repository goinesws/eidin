<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form action="/login/auth" method="post">
        @csrf
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="email"
                placeholder="Enter email">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
        @dump(Auth::user())
    </form>
</body>
</html>
    
