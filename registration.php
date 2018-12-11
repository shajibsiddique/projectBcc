
<?php
session_start();
require_once 'admin/config/config.php';


//serve POST method, After successful insert, redirect to customers.php page.
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
    $data_to_store = filter_input_array(INPUT_POST);
    $db = getDbInstance();
    $last_id = $db->insert ('students', $data_to_store);
    
    if($last_id)
    {
		$_SESSION['success'] = "Student added successfully!";
		echo "Registered for course  successfull! We will call you after reviewing your application";
    	//header('location: index.php');
    	exit();
    }  
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>BCS Coaching Center</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/animate.css">
	<link href="css/animate.min.css" rel="stylesheet"> 
	<link href="css/style.css" rel="stylesheet" />	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>	
	<header id="header">
        <nav class="navbar navbar-default navbar-static-top" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                   <div class="navbar-brand">
						<a href="index.php"><h1>BCS</h1></a>
					</div>
                </div>				
                <div class="navbar-collapse collapse">							
					<div class="menu">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation"><a href="index.php">Home</a></li>
							<li role="presentation"><a href="services.php">Course</a></li>
							<li role="presentation"><a href="registration.php"  class="active">Registration</a></li>				
						</ul>
					</div>
				</div>		
            </div><!--/.container-->
        </nav><!--/nav-->		
	</header><!--/header-->	
	<div class="container">
	<div class="col-md-5">
            <div class="well">
			<h4>Register for Course</h4>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                       
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" >
                    </div>
                    <div class="form-group">
                        
                        <input type="text" name="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                       
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone">
                    </div>
                    <div class="form-group">
                       
                        <input type="text" name="address" class="form-control" id="address" placeholder="Address">
                    </div>
                    <div class="form-group">
                       
                        <input type="text" name="course" class="form-control" id="course" placeholder="Course">
					
					<input type="hidden" name="status" class="form-control" id="status" value="pending">
                    </div>
                    <div>
                  <input type="" name="test" class="form-control" id="test" placeholder="test">
                    </div>
                  
                    <button type="submit" class="btn btn-default">
                            <h4>Register for Course</h4>
                    </button>
                    <select style="color:black;">
                    <option value="test1">test1</option>
                    <option value="test2">test2</option>
                    <option value="test3">test3</option>

                    </select>
                </form>
            </div>
		</div>
	</div>
</body>
</html>
