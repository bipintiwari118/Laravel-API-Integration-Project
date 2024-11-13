<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Form</title>
    <style>
        .form {
            width: 60%;
            margin: 0 auto;
            padding: 40px;

        }

        form {
            width: 50%;
        }

        h1 {
            padding-bottom: 30px;
        }

        .error {
            color: red;
        }

        p {
            width: 100%;
            padding: 10px;
            color: red;
            font-size: 19px;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="form">
        <h1>User Profile</h1>
        <button type="button" class="logout  btn btn-danger">Logout</button>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            $('.logout').click(function() {
                $.ajax({

                    url: "http://127.0.0.1:8000/api/logout",
                    type: "GET",
                    headers: {
                        'Authorization': localStorage.getItem('user_token')
                    },
                    success: function(data) {
                        if (data.success == true) {
                            localStorage.removeItem('user_token');
                            window.open('/login', '_self');
                        } else {
                            alert(data.msg);
                        }
                    }


                });

            });
        });


        var token = localStorage.getItem('user_token');

        if (window.location.pathname == '/login' || window.location.pathname == '/register') {
            if (token != null) {
                window.open('/profile', '_self');

            }

        } else {
            if (token == null) {
                window.open('/login', '_self');
            }

        }
    </script>
</body>

</html>
