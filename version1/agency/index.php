<?

session_start(['cookie_lifetime' => 86400]);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$DIR_ = $_SERVER["DOCUMENT_ROOT"]. "/";
require($DIR_. "config.php");


if(!isset($_SESSION['userToken']))
{
	
    header ("Location: ../index.php");		
}

if(isset($_GET['email']))
{
    $employeeResults = GetEmployeeDetails($_GET['email']);
    
    $row = $employeeResults->fetch_assoc();
	
}

//var_dump(GetRosterStatus()); exit;
?>
    <html>

    <head>
        <title></title>
        <meta name="" content="">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/styles.css">
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
            function deactivate() {
                //TODO: code to deactivate the employee goes here
            }

            $(document).ready(function() {
                $('#submitButton').hide();
            });

        </script>


    </head>

    <body>
        <div class="content">
           <div class="row">
                   <div class="col-sm-12">
                    <p><a href="../signout.php">signout</a></p>
                </div>
                </div>
            <div class="row logo">
                <div class="col-sm-6">
                    <div class="header">
                        <img src="../images/intecare-logo.svg" alt="" style="max-width:200px;">
                    </div>
                </div>
            </div>

            <div class="row">
                <h2>Indiana Mental Health Funds Recovery Program</h2>
            </div>
            <div class="row">
                &nbsp;
            </div>
            <div class="row">
                <!--p>Aliquam viverra sed nunc at placerat. Cras blandit molestie lorem, vel sodales metus placerat et. Sed sodales finibus volutpat. Sed convallis lorem turpis, id laoreet nibh aliquam id. Sed accumsan aliquet lobortis. Quisque eu metus eget tellus tristique ultricies eu eu leo. Sed mi lacus, ornare quis velit sit amet, tristique blandit leo. Morbi nisl ligula, condimentum eu augue vel, egestas molestie nisl. Proin in libero dapibus, volutpat nisi eget, suscipit tortor.</p-->
            </div>
            <div class="row">
                &nbsp;
            </div>
            <div class="row">
                <div class="col-sm-6">
                   <?php
                        if(GetRosterStatus()== '0')
                            echo '<a class="btn-home" href="roster/main.php">Roster Management</a>';
                        else
                            echo  '<p>The application is currently closed for Roster Management.</p>';
                        ?>
                </div>
                <div class="col-sm-6">
                   
                   <?php  
                        if(GetTimeEntryStatus()== '1')
                          echo '<a class="btn-home" href="time/main.php">Cost Report</a><br><br><p>The current cost reporting period is <span style="color:red;"> ' . GetPeriod() . '</span></p>';
                        else
                            echo '<p>The application is currently closed for Cost Reporting.</p>';
                    ?>
                   
                </div>
            </div>

        </div>
    </body>
