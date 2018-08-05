<?php
    session_start();
    require("db_connect.php");
     $user=$_POST['user'];
     $pass=$_POST['pass'];
     $con=mysqli_connect($servername,$username,$password,$dbname);
            if (!$con)
            {
                die("Connection failed: " . mysqli_connect_error());
            }
            $query=mysqli_query($con,"SELECT * FROM login WHERE (user='$user' AND pass='$pass')");
            if ($query)
			{
				if(mysqli_num_rows($query)>=1)
				{

					while($row = mysqli_fetch_assoc($query))
					{
						$_SESSION["user"]=$row["user"];
						$_SESSION["pass"]=$row["pass"];
					}
			    $_SESSION['login_check']=TRUE;
					header("location:./main.php");
				}
				else
				{
			              $_SESSION['login_check']=FALSE;
			              echo "Not Authenicated";
				}
			}
			else
			{
			    echo "Error: <br>" . mysqli_error($con);
			}

			mysqli_close($con);


 ?>
