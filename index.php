<?php  include "connection.php";
session_start();
//initializing variables to update the EmployeeDetails
    $Name = "";
    $EmployeeID = "";
    $Department = "";
    $Salary = "";
    $Gender = "";
    $MobileNumber = "";
    $City = "";
    $State = "";
    $Zipcode = "";

$id = 0;
$edit_state = false;

/*
inserting Employee Details into data base 
saving employee details in Employeedetails table
validating through EmployeeID

*/
if(isset($_POST['save']))
{  
    $query = " select EmployeeID from Employeedetails ";
    $data = mysqli_query($con,$query); 
    $employeeID = $_POST["EmployeeID"]; 
    $flag = 0;
    while($row=mysqli_fetch_assoc($data)){
        $EmployeeID = $row['EmployeeID'];
        if($employeeID == $EmployeeID){

            ?>
            <script type = "text/javascript" > 
            alert("Employee details Already exists") 
            window.location.href = "index.php";
            </script>
            <?php
            
 
            $flag = 1;
        }
    } 
//if the user enter proper details, they will be added to Employeedetails table in Database
    if($flag == 0)
    {
        if (isset($_POST['save']))
        {
            $Name = $_POST['Name'];
            $EmployeeID = $_POST['EmployeeID'] ;
            $Department = $_POST['Department'];
            $Salary = $_POST['Salary'];
            $Gender = $_POST['Gender'];
            $MobileNumber = $_POST['MobileNumber'];
            $City = $_POST['City'];
            $State = $_POST['State'];
            $Zipcode = $_POST['Zipcode'];

            $query = "insert into Employeedetails (Name,EmployeeID,Department,Salary,Gender,MobileNumber,City,State,Zipcode) values ('$Name','$EmployeeID','$Department','$Salary','$Gender','$MobileNumber','$City','$State','$Zipcode')";
            $data = mysqli_query($con, $query);

            if ($data)
            {
                ?>
                <script type = "text/javascript" > 
                alert("Employee Details are added to the Employee data form")  
                window.location.href = "index.php";
                </script>
                <?php
            }
        }
 
    }
}

//-----------delete records from Employeedetails form---------------
if (isset($_GET['delete']))
{
    $id = $_GET['delete'];
    
    $query = "delete from Employeedetails where Id = '$id'";
    $data = mysqli_query($con,$query);

    if ($data)
    {
        ?>
        <script type = "text/javascript" > 
        alert("Data Deleted") 
        window.location.href = "index.php";
        </script>
        <?php
    }
}

//-----------updating records to Employeedetails form---------------
if(isset($_POST['update']))
{
    $Name = ($_POST['Name']);
    $EmployeeID = ($_POST['EmployeeID']);
    $Department = $_POST['Department'];
    $Salary = $_POST['Salary'];
    $Gender = ($_POST['Gender']);
    $MobileNumber = ($_POST['MobileNumber']);
    $City = ($_POST['City']);
    $State = ($_POST['State']);
    $Zipcode = ($_POST['Zipcode']);
    $id = ($_POST['Id']);

    $query = "update Employeedetails set Name = '$Name', EmployeeID = '$EmployeeID', Department = '$Department', Salary = '$Salary', Gender = '$Gender', MobileNumber = '$MobileNumber', City = '$City', State = '$State', Zipcode = '$Zipcode' where Id = $id" ;
    $data = mysqli_query($con,$query);

    if ($data)
    {
        ?>
        <script type = "text/javascript" > 
        alert("Data Updated") 
        window.location.href = "index.php";
        </script>
        <?php
    }
    
}
?>


<?php 
//fetch the records to be updated
if (isset($_GET['edit']))
{
    $id = $_GET['edit'];
    $edit_state = true;
    $rec = mysqli_query($con, "select * from employeedetails where Id = $id");
    $record = mysqli_fetch_array($rec);
    $Name = $record['Name'];
    $EmployeeID = $record['EmployeeID'];
    $Department = $record['Department'];
    $Salary = $record['Salary'];
    $Gender = $record['Gender'];
    $MobileNumber = $record['MobileNumber'];
    $City = $record['City'];
    $State = $record['State'];
    $Zipcode = $record['Zipcode'];
    $id = $record['Id'];
}
?>

<!DOCTYPE html>
<html>
<head>
	<title> Employee Details Form </title>
    <link rel = 'stylesheet' type="text/css" href="style.css">
</head>
<body>

    <form action = "index.php" method = "POST" >
    <input type = "hidden" name ="Id" value = "<?php echo $id; ?>" >
    <h1> Employee Registration Form </h1>
        <div class = "input-group">
            <label> Name </label>
            <input type = "text" Name="Name" placeholder = "Name" value = "<?php echo $Name; ?>" required > <br><br>
        </div>
        <div class = "input-group">
            <label> EmployeeID </label>
            <input type = "text" Name="EmployeeID" placeholder = "EmployeeID" value = "<?php echo $EmployeeID; ?>" required > <br><br>
        </div>
        <div class = "input-group">
            <label> Department </label>
            <input type = "text" Name="Department" placeholder = "Department" value = "<?php echo $Department; ?>" required > <br><br>
        </div>
        <div class = "input-group">
            <label> Salary </label>
            <input type = "text" Name="Salary" placeholder = "Salary" value = "<?php echo $Salary; ?>" required > <br><br>
        </div>
        <div class = "input-group">
            <label> Gender </label>
            <input type = "text" Name="Gender" placeholder = "Gender" value = "<?php echo $Gender; ?>" required > <br><br>
        </div>
        <div class = "input-group">
            <label> MobileNumber </label>
            <input type = "number" Name = "MobileNumber" placeholder = "Mobile Number" value = "<?php echo $MobileNumber; ?>" required > <br><br>
        </div>
        <div class = "input-group">
            <label> City </label>
            <input type = "text" Name = "City" placeholder = "City" value = "<?php echo $City; ?>" required > <br><br>
        </div>
        <div class = "input-group">
            <label> State </label>
            <input type = "text" Name = "State" placeholder = "State" value = "<?php echo $State; ?>" required > <br><br>
        </div>
        <div class = "input-group">
            <label> Zipcode </label>
            <input type = "text" Name = "Zipcode" placeholder = "Zipcode" value = "<?php echo $Zipcode; ?>" required > <br><br>
        </div>
        
        <div class = "input-group">
            <?php if ($edit_state == false): ?>
                <button type = "Submit" name = "save" class = "btn"> Save </button>   
            <?php else: ?>
                <button type = "Submit" name = "update" class = "btn"> Update </button>           
            <?php endif ?>
        </div>
        
    </form>


    <!-------------serachnig, sorting and display form------------------------->
    <form action = "index.php" method = "POST" >
    <input type = "hidden" name ="Id" value = "<?php echo $id; ?>" >
        <div class = "input-group">
            <select name="Selectoption"id="select">    
                <option value="Name">Name</option>
                <option value="Department"> Department</option>
                <option value="Salary">Salary</option>
            </select> 

            <button type ="submit" name="SORT" class="btn" >SORT</button>
            
        </div>
        
        <div >
            <input type="text" name="search" placeholder="Enter Name,EmpId,Dept or city">
            <button type ="submit"  name='search_btn' class="btn" >Search</button>            
        </div>
        <div >
            <?php echo "To display Employee Details click here"?>
            <button type ="submit"  name='display_btn' class="btn" >Display</button>            
        </div>
           
    </form>

    
<!---------------Displaying the Employee Details based on User Requirement------------------------->
    <table>
        <thead>
            <tr>                
                <th> Name </th>
                <th> EmployeeID </th>
                <th> Department </th>
                <th> Salary </th>
                <th> Gender </th>
                <th> MobileNumber </th>
                <th> City </th> 
                <th> State </th>
                <th> Zipcode </th>
                                   
                <th colspan = "2"> Action </th>
            </tr>
        </thead>
        <tbody>
<!---------------Displaying All Employee Details when user clicks on display button------------------------->
            <?php                 
                if(isset($_POST['display_btn']))
                {
                    $query="select * from employeedetails";
                    $result=mysqli_query($con,$query);
                    if( mysqli_num_rows($result)>0)
                    {
                        while($row = mysqli_fetch_array($result)) { ?>

                            <tr>
                            <td><?php echo $row['Name'] ?></td>          
                            <td><?php echo $row['EmployeeID'] ?></td>
                            <td><?php echo $row['Department'] ?></td>
                            <td><?php echo $row['Salary'] ?></td>
                            <td><?php echo $row['Gender'] ?></td>
                            <td><?php echo $row['MobileNumber'] ?></td>
                            <td><?php echo $row['City'] ?></td>
                            <td><?php echo $row['State'] ?></td>
                            <td><?php echo $row['Zipcode'] ?></td>
                            <td>  <a class = "edit_btn" href = "index.php?edit=<?php echo $row['Id']; ?>" > Edit </a> </td> 
                        
                            <td> <a class = "del_btn" onclick ="return confirm('Are you sure, you want to delete this data')" href = "index.php?delete=<?php echo $row['Id']; ?>"> Delete</a> </td> 
                        
                            </tr>
                    <?php } 
                    }  
                    else{
                        ?>
                        <script type = "text/javascript" > 
                        alert("No Records to Display") 
                        window.location.href = "index.php";
                        </script>
                        <?php
                    }                  
                } 
            ?>   
   
   
<!---------------Displaying All Employee Details in Sorted order when user clicks on SORT button------------------------->
            
            <?php
                if(isset($_POST['SORT']))
                {
                    $sortbydata=$_POST['Selectoption'];
                    //$query="select * from Employeedetails order by $sortbydata ASC ";      //Bydefault sorting in Ascending order
                    $query="select * from Employeedetails order by $sortbydata DESC ";
                    $result=mysqli_query($con,$query);
                    if( mysqli_num_rows($result)>0)
                    {
                        while($row=mysqli_fetch_array($result)){ ?>

                        <tr>
                            <td><?php echo $row['Name'] ?></td>          
                            <td><?php echo $row['EmployeeID'] ?></td>
                            <td><?php echo $row['Department'] ?></td>
                            <td><?php echo $row['Salary'] ?></td>
                            <td><?php echo $row['Gender'] ?></td>
                            <td><?php echo $row['MobileNumber'] ?></td>
                            <td><?php echo $row['City'] ?></td>
                            <td><?php echo $row['State'] ?></td>
                            <td><?php echo $row['Zipcode'] ?></td>
                            <td>  <a class = "edit_btn" href = "index.php?edit=<?php echo $row['Id']; ?>" > Edit </a> </td> 
                
                            <td> <a class = "del_btn" onclick ="return confirm('Are you sure, you want to delete this data')" href = "index.php?delete=<?php echo $row['Id']; ?>"> Delete</a> </td> 
                
                        </tr>

                    <?php } 

                    } 
                    else{
                        ?>
                        <script type = "text/javascript" > 
                        alert("No Records to Display") 
                        window.location.href = "index.php";
                        </script>
                        <?php
                    } 
                }   
                    
            ?>

<!---------------Displaying Required Employee Details when user clicks on Search button------------------------->

            <?php
                  if(isset($_POST['search_btn']))
                  {
                    $value_filter=$_POST['search'];
                    $sql="SELECT * FROM Employeedetails WHERE CONCAT(Name,EmployeeID,Department,City) LIKE '%$value_filter%' ";
                    $result=mysqli_query($con,$sql);
                    if( mysqli_num_rows($result)>0)
                    {
                        while($row=mysqli_fetch_array($result)) {?>
                      
                        <tr>
                            <td><?php echo $row['Name'] ?></td>          
                            <td><?php echo $row['EmployeeID'] ?></td>
                            <td><?php echo $row['Department'] ?></td>
                            <td><?php echo $row['Salary'] ?></td>
                            <td><?php echo $row['Gender'] ?></td>
                            <td><?php echo $row['MobileNumber'] ?></td>
                            <td><?php echo $row['City'] ?></td>
                            <td><?php echo $row['State'] ?></td>
                            <td><?php echo $row['Zipcode'] ?></td>
                            <td>  <a class = "edit_btn" href = "index.php?edit=<?php echo $row['Id']; ?>" > Edit </a> </td> 
                
                            <td> <a class = "del_btn" onclick ="return confirm('Are you sure, you want to delete this data')" href = "index.php?delete=<?php echo $row['Id']; ?>"> Delete</a> </td> 
                
                        </tr>

                    <?php } 

                    }  
                    else{
                        ?>
                        <script type = "text/javascript" > 
                        alert("No Record Found") 
                        window.location.href = "index.php";
                        </script>
                        <?php
                    }
                } 
                                     
            ?>
        </tbody> 
        
    </table>
</body>

