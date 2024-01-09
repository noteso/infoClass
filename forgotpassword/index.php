<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
    <title>Forgot Password || infoClass</title>
</head>
<body>
    <!-- Sign in card -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-5 border border-opacity-25 border-secondary shadow-lg rounded-4 my-5">
                <div class="text-center text-primary">
                    <h1 class="text-secondary my-4">info<span class="text-bg-primary rounded-2">Class</span></h1>
                    <h2 class="text-primary my-3">Forgot Password</h2>
                    <p class="text-muted">Enter email to find your account.</p>
                </div>
                <form action="./emailvalidation/" method="post" class="container justify-content-center">
                    <div class="mx-2">
                       <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" autocomplete="off" required>
                            <label for="email">Email address</label>
                        </div>
                    </div> 
                    <input type="submit" value="submit" class="btn btn-lg btn-primary mb-4 float-end">
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>