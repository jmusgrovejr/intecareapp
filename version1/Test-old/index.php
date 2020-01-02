<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>

<head>
    <title></title>
    <meta name="" content="">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <script>
        $(document).ready(function() {
            $("#login").click(function() {
                var email = $("#email").val();
                var password = $("#password").val();
                // Checking for blank fields.
                if (email == '' || password == '') {
                    $('input[type="text"],input[type="password"]').css("border", "2px solid red");
                    $('input[type="text"],input[type="password"]').css("box-shadow", "0 0 3px red");
                    //alert("Please fill all fields...!!!!!!");
                } else {
                    $.post("process.php", {
                            email1: email,
                            password1: password
                        },
                        function(data) {
                            if (data == 'Invalid Email.......') {
                                $('input[type="text"]').css({
                                    "border": "2px solid red",
                                    "box-shadow": "0 0 3px red"
                                });
                                $('input[type="password"]').css({
                                    "border": "2px solid #00F5FF",
                                    "box-shadow": "0 0 5px #00F5FF"
                                });
                                alert(data);
                            } else if (data == 'Email or Password is wrong...!!!!') {
                                $('input[type="text"],input[type="password"]').css({
                                    "border": "2px solid red",
                                    "box-shadow": "0 0 3px red"
                                });
                                alert(data);
                            } else if (data == 'Successfully Logged in...') {
                                //$("form")[0].reset();
                                //$('input[type="text"],input[type="password"]').css({"border":"2px solid #00F5FF","box-shadow":"0 0 5px #00F5FF"});
                                
                                window.location.href = "http://intecareapp.com/agency";
                            } else {
                                alert(data);
                            }
                        });
                }
            });
        });
    </script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="header">
                <img src="images/intecare-logo.svg" alt="" class="logo">
            </div>
        </div>
        <div class="row title" >
            <h2>Indiana Mental Health Funds Recovery Program</h2>
        </div>

        <div class="row">
            <div class="main round">

                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h2>LOGIN</h2>
                    </div>
                </div>
                <div class="row">
                    <form class="form" method="post" action="#">
                        <div class="col-sm-4 text-right"><label>Email:</label></div>
                        <div class="col-sm-8"><input type="text" name="demail" id="email" value="a.johnson@bowencenter.org" required></div>
                        <div class="col-sm-12 text-center">&nbsp;</div>
                        <div class="col-sm-4 text-right"><label>Password:</label></div>
                        <div class="col-sm-8"><input type="password" name="password" id="password" required></div>
                        <div class="col-sm-12 text-center">&nbsp;</div>
                        <div class="col-sm-12 text-center"><input type="button" name="login" id="login" value="LOGIN"></div>
                        <div class="col-sm-12 text-center">&nbsp;</div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</body>

</html>
