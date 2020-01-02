<?
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$DIR_ = $_SERVER["DOCUMENT_ROOT"]. "/Test/";
require($DIR_. "config.php");


if(!isset($_SESSION['userToken']))
{
	header ("Location: login.php");		
}

if(isset($_GET['email']))
{
    $employeeResults = GetEmployeeDetails($_GET['email']);
    
    $row = $employeeResults->fetch_assoc();
	
}
if(isset($_GET['deactivate']))
{
	if(isset($_POST['email']))
    {
        $val = DeactivateEmployee($_POST['email']);
	   echo $val;
    } 
}
if(isset($_GET['updateEmail']))
{
    $val = UpdateEmployeeEmail($_POST['newEmail'], $_POST['email']);
    echo $val; exit;
    header('Location: view.php?email=' . $_POST['newEmail']);
}

?>
    <html>

    <head>
        <title></title>
        <meta name="" content="">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <style>
            .roundcol1 {
                border: 1px solid #a1a1a1;
                background: #3b5cb9;
                width: 220px;
                border-radius: 5px;
                margin: 4px
            }
            
            .roundcol2 {
                border: 1px solid #a1a1a1;
                background: #91b0dd;
                width: 850px;
                border-radius: 5px;
                margin: 4px
            }
            
            .scrll {
                overflow-y: auto;
                height: 800px;
            }

        </style>
        <script>
            function flipEdit() {
                //$('input').removeAttr('readonly');
                $('#editSection').show();
                $('#editButton').hide();
                $('#submitButton').show();

                var position = $('')
            }

            function deactivate() {
                //TODO: code to deactivate the employee goes here
            }

            $(document).ready(function() {
                $('#submitButton').hide();
                $('#editSection').hide();
            });

        </script>


    </head>

    <body>


        <div class="content">
            <div class="row">

                <div class="col-sm-6">
                    <h2 class="title">Indiana Mental Health Funds Recovery Program</h2>
                </div>
                <div class="col-sm-6">
                    <div class="header">
                        <img src="images/intecare-logo.svg" alt="" class="logo">
                    </div>
                </div>
            </div>


            <div class="col-sm-8 roundcol2" style="color:#3b5cb9">
                <form id="newEmployeeForm" name="newEmployeeForm" method="post">
                    <div class="row">
                        <p>&nbsp;</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-primary btn-sm" id="editButton" onclick="flipEdit()" type="button">Edit</button>
                            <button class="btn btn-primary btn-sm" id="submitButton" type="button">Update</button>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label>First Name</label><br />
                            <input class="form-control form-rounded" type="text" name="firstname" id="firstname" value="<? echo $row['FirstName']; ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label>Last Name</label><br />
                            <input class="form-control form-rounded" type="text" name="lastname" id="lastname" value="<? echo $row['LastName']; ?>" readonly>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Email</label><br />
                            <input class="form-control form-rounded" type="text" name="email" id="email" value="<? echo $row['Email']; ?>" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label>MHFRP ID</label><br />
                            <input class="form-control form-rounded" type="text" name="mhfrpid" id="mhfrpid" value="<? echo $row['MHFRPID']; ?>" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label>Agency Internal ID</label><br />
                            <input class="form-control form-rounded" type="text" name="mhfrpid" id="mhfrpid" value="<? echo $row['IdNumber']; ?>" readonly>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Position Title</label><br />
                            <input name="PositionTitle" class="form-control form-rounded" value="<? echo GetPositionTitle($row['PositionID']); ?>" readonly>


                        </div>
                        <div class="col-sm-4">
                            <label>Employee Type</label><br />

                            <input class="form-control form-rounded" type="text" name="employeeType" id="employeeType" value="<? echo GetEmployeeType($row['EmployeeType']); ?>" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label>Location Code</label><br />
                            <input class="form-control form-rounded" type="text" name="LocationCode" id="LocationCode" value="<? echo $row['LocationCode']; ?>" readonly>
                        </div>
                    </div>



                    <!--<div style="width: 5%; float:right"><span class="glyphicon glyphicon-remove-circle"></span></div>
                -->
                </form>
                <div id="editSection">
                    <hr />
                    <div class="row">
                        <div class="col-sm-12">
                            <h6>Update employee email address</h6>
                        </div>
                        <div class="col-sm-12">
                            <form action="view.php?updateEmail=true" method="post">
                               <input type="hidden" name="email" id="email" value=<? echo $row['Email']; ?> />
                                <input type="text," name="newEmail" id="newEmail" /> <input type="submit" value="submit">
                            </form>
                        </div>

                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-sm-12">
                            <h6>Change the employee's postion</h6>
                        </div>
                        <div class="col-sm-12">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-sm-6">

                                        <select name="PositionTitle" class="form-control form-rounded">
							<?php 
								echo "<option></option>";
								$positionresult = GetPositions();
								
								while ($positionrow = $positionresult->fetch_assoc()) {
									if (isset($_GET['IdNumber']))
									{									
										if ($positionrow['PositionTitle'] == $_SESSION['data']['PositionTitle'])
										{
											echo "<option selected value='" . $positionrow['PositionTitle'] . "'>" . $positionrow['positionName'] . "</option>";
										}
										else
										{
											echo "<option value='" . $positionrow['PositionTitle'] . "'>" . $positionrow['positionName'] . "</option>";
										}
									}
									else
									{
										echo "<option value='" . $positionrow['PositionTitle'] . "'>" . $positionrow['positionName'] . "</option>";
									}
								    
								}
								
								?>
							</select>

                                    </div>
                                    <div class="col-sm-6">

                                        <input type="submit" value="submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>

        </div>
        <hr>

    </body>
