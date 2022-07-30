<?php include "connection.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<title>  Login form </title>
    <link rel = 'stylesheet' type="text/css" href="style.css">
</head>
<body> 
    <form  method = "POST" >
        
        <div class = "input-group">
            <label> EmailID </label>
            <input type = "Email" Name="EmailID" placeholder = "EmailID"  required > <br><br>
        </div>
        <div class = "input-group">
            <label> Password </label>
            <input type = "Password" Name="Password" placeholder = "Password"  required > <br><br>
        </div>
        <div class = "input-group">
            <button type = "Submit" name = "Login" class = "btn" > Login </button>   
        </div>
        <div class = "input-group">
            <button type = "Submit" name = "register" class = "btn"><a href="register.php"> Register </a></button>   
        </div>
    </form>      
</body>
</html>


<?php      
if(isset($_POST['Login']))
    {

        $email = $_POST['EmailID'];  
        $password = $_POST['Password'];  
    
        $sql="Select * from registrationdetails where Email='$email'";
        $result=mysqli_query($con,$sql);

        if($result)
        {
            $count = mysqli_num_rows($result);  
            if($count>0)
            {
                $row = mysqli_fetch_array($result);
                if(password_verify($password,$row['Password']))
                {
                    echo "Login successful";
                    header("location: index.php");
                } 
                else
                {
                    ?>
                        <script type = "text/javascript" > 
                        alert("Login failed. Invalid username or password.")  
                        window.location.href = "Login.php";
                        </script>
                    <?php
                } 

            }

        }
        
    }   
?> 

