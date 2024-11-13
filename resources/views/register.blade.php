<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Form</title>
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
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="form">
        <h1>User Register</h1>
        <form id="register_form">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
                <span class="error name_error"></span>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1">
                <span class="error email_error"></span>

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                <span class="error password_error"></span>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmed Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                <span class="error password_confirmation_error"></span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <p class="result"></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('#register_form').submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({

                    url: 'http://127.0.0.1:8000/api/register',
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        if (data.msg) {
                            $('#register_form')[0].reset();
                            $(".error").text(" ");
                            $('.result').text(data.msg);


                        } else {
                            printErrorMsg(data);
                        }
                    }
                });
            });

            function printErrorMsg(msg) {
                $(".error").text(" ");
                $.each(msg, function(key, value) {
                    if (key == 'password') {
                        if (value.length > 1) {
                            $(".password_error").text(value[0]);
                            $(".password_confirmation_error").text(value[1]);

                        } else {
                            if (value[0].includes('password confirmation')) {

                                $(".password_confirmation_error").text(value);

                            } else {
                                $(".password_error").text(value);

                            }

                        }

                    } else {
                        $("." + key + "_error").text(value);
                    }

                });

            }

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
