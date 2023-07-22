
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="gmrform_css.css" type="text/css" />
</head>

<body>
    <div class="login_form_container">
        <div class="login_form">
            <div class="gmr_logo">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTThU22LEED1r8_bWKjucfwibdSz1ztsLiwcH_2cAQ7&s.png" class="gmr_logo_img">
            </div>
            <h2>Login</h2>
            <form action="index_1_test.php" method="POST">
                <div class="input_group">
                    <i class="fa fa-user"></i>
                    <input type="text" placeholder="Login ID" class="input_text"  name="Loginid" autocomplete="off" />
                </div>
                <div class="input_group">
                    <i class='fa fa-address-card'></i>
                    <input type="text" placeholder="Username" class="input_text" name="Username" autocomplete="off" />
                </div>
                <div class="input_group">
                    <i class="fa fa-envelope"></i>
                    <input type="email" placeholder="Email" class="input_text" name="Email" autocomplete="off" />
                </div>
                <div class="input_group">
                    <i class='fa fa-users'></i>
                    <input type="text" placeholder="Department" class="input_text" name="Department"  autocomplete="off" />
                </div>
                <div class="input_group">
                    <i class="fa fa-unlock-alt"></i>
                    <input type="password" placeholder="Password" class="input_text" name="Password"  autocomplete="off" />
                </div>
                <input type="submit" class="login_button " name='submit'/>
            </form>
        </div>
    </div>
</body>

</html>