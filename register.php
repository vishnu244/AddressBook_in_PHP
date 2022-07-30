<?php include "connection.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Registration Form</title>
</head>
<body>

    <form method="post" >
        <input type="text" name="FirstName" class="form-control"  placeholder="Enter First Name" pattern="[A-Z]{1}[a-z]{2,}" title = "FirstName should start with capital letter" required><br><br>
        <input type="text" name="LastName" class="form-control" pattern="[A-Z]{1}[a-z]{2,}"placeholder="EnterLast Name" ><br><br>
        <input type="Email" name="Email" class="form-control" placeholder="Enter Email" pattern="^[0-9a-zA-Z]+@[a-zA-Z]+.[a-z]{3}$" title="Check the Email format" required><br><br>
        <input type="Password" name="Password" class="form-control"  placeholder="Enter Password" pattern="^(?=.*[@#$%0-9A-Z])[@#$%0-9a-zA-Z]{8,}$" title="Password should be minimum of 8 characters" required><br><br>
        <input type="Password" name="ConfirmPassword" class="form-control" placeholder="Confirm Password" pattern="^(?=.*[@#$%0-9A-Z])[@#$%0-9a-zA-Z]{8,}$" title="Password should be minimum of 8 characters" required><br><br>
        <input type="num" name="MobileNumber" class="form-control"  placeholder="Enter Mobile Number" pattern="[0-9]{10}" title="Mobile number should have 10 digits" required><br><br>
            
        <button type = "Submit" name = "register" class = "btn"> Register  </button>   <br><br>
        <button type = "Submit" name = "Login" class = "btn" ><a href = "Login.php"> Login </a> </button>   <br><br>

    </form>
</body>
</html>

<!-- validating through Email -->
<?php 
if(isset($_POST['register']))
{
    $query = "select Email from registrationdetails";
    $result1 = mysqli_query($con, $query);
    $email = $_POST["Email"];
    $flag = 0;
    while($row=mysqli_fetch_assoc($result1))
    {
        $Email = $row['Email'];
        if($email == $Email)
        {
            ?>
            <script type = "text/javascript" > 
            alert("Email Already exists")  
            window.location.href = "register.php";
            </script>
            <?php
            $flag = 1;
        }
    }

    if($flag == 0)
    {
        if (isset($_POST['register']))
        {
            $fname  = $_POST['FirstName'];
            $lname  = $_POST['LastName'];
            $email  = $_POST['Email'];

            if($_POST['Password'] == $_POST['ConfirmPassword'])
            {
                $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
                $c_password = password_hash($_POST['ConfirmPassword'], PASSWORD_DEFAULT);
                $mobile     = $_POST['MobileNumber'];

                $query = "insert into registrationdetails (FirstName,LastName,Email,Password,ConfirmPassword,MobileNumber)values('$fname','$lname','$email','$password','$c_password','$mobile')";
                $data = mysqli_query($con, $query);

                if($data)
                {
                    ?>
                    <script type = "text/javascript"  > 
                    alert("User Data added")  
                    window.location.href = "Login.php";
                    </script>
                    <?php
                    
                }
                else
                {
                echo "failed";
                }
            }
            else
            {
                ?>
                    <script type = "text/javascript" > 
                    alert("Password and confirm Password should be same")  
                    window.location.href = "register.php";
                    </script>
                    <?php
            }
        }
    }
}


?>