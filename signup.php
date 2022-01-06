<?php 
 require_once $_SERVER['DOCUMENT_ROOT'] . "file_system/config.php";
 require_once FS_ROOT_URi . "/fs.php";
 $obj = new fs();
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
    <style>
    .signup-img {
        background: url(image/file.png);
        background-size: contain;
        /* background-repeat: no-repeat; */
    }
    </style>
</head>

<body>

    <div class="main">
        <div class="container">
            <div class="signup-content">
                <div class="signup-img">

                </div>
                <div class="signup-form">
                    <form method="POST" action="backend/signup.php" class="register-form" id="register-form" enctype="multipart/form-data">
                        <?php if (isset($_SESSION['success'])) { ?>
                            <div class="alert-info"><?=$_SESSION['success']?> <a href="index.php">Go to login</a></div><br>
                        <?php $_SESSION['success'] = null; } ?>
                        <h2>MUSFS - STUDENT registration form</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="fname">First Name :</label>
                                <input type="text" name="fname" id="fname" required />
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name :</label>
                                <input type="text" name="lname" id="lname" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number :</label>
                            <input type="text" name="phone" id="phone" placeholder="+255xxxxxxxxx">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address :</label>
                            <input type="email" name="email" id="email" required />
                        </div>
                        <div class="form-radio">
                            <label for="gender" class="radio-label">Gender :</label>
                            <div class="form-radio-item">
                                <input type="radio" name="gender" id="male" value="M" checked>
                                <label for="male">Male</label>
                                <span class="check"></span>
                            </div>
                            <div class="form-radio-item">
                                <input type="radio" name="gender" id="female" value="F">
                                <label for="female">Female</label>
                                <span class="check"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="state">ID Number :</label>
                                <div class="form-select">
                                    <input type="text" name="regno" id="state" placeholder="Reg #/Staff ID">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="prog">Programme :</label>
                                <div class="form-select">
                                    <select name="prog" id="prog">
                                        <option value disabled>-- Choose --</option>
                                        <?php foreach($obj->getProgramme() as $row) { ?>
                                            <option value="<?=$row['id']?>"><?=$row['title']?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of birth :</label>
                            <input type="date" name="dob" id="dob" placeholder="yyyy-mm-dd">
                        </div>
                        <div class="form-group">
                            <label for="marital">Marital status :</label>
                            <div class="form-select">
                                <select name="marital" id="marital">
                                    <option value=""></option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                </select>
                                <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password :</label>
                            <input type="password" name="pwd" id="pwd">
                        </div>
                        <div class="form-group">
                            <label for="cpwd">Confirm Password :</label>
                            <input type="password" name="cpwd" id="cpwd">
                        </div>
                        <div>
                            <h2>Uploads</h2>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="psize">Passport size :</label>
                                <input type="file" name="psize" id="psize">
                            </div>
                            <div class="form-group">
                                <label for="bcert">Birth certicate :</label>
                                <input type="file" name="bcert" id="bcert">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="fsix">Form six certificate :</label>
                                <input type="file" name="fsix" id="fsix">
                            </div>
                        </div>
                        <div class="form-submit">
                            <a href="index.php" id="">Go to login</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="submit" value="Submit Form" class="submit" name="submit" id="submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="js/default/jquery-3.3.1.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>