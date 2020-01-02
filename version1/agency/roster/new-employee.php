<?
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$DIR_ = $_SERVER["DOCUMENT_ROOT"];
require($DIR_. "/config.php");


if(!isset($_SESSION['userToken']))
{
	header ("Location: login.php");		
}

if(isset($_GET['email']))
{
    $employeeResults = GetEmployeeDetails($_GET['email']);
    
    $row = $employeeResults->fetch_assoc();
	
}

?>
    <html>

    <head>
        <title></title>
        <meta name="" content="">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <style>
            .round {
                width: 800px;
                max-width: 800px;
                padding-left: 20px;
                padding-top: 10px;
                padding-right: 20px;
            }
            
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

                $("#createBtn").click(function() {                    
                    var email = $("#email").val();
                    var firstname = $("#firstname").val();
                    var lastname = $("#lastname").val();
                    var position = $("#PositionID").val();
                    var InteCareAgencyID = $("#InteCareAgencyID").val();
                    var locationCode = $("#LocationCode").val();
                    var mhfrpid = $("#mhfrpid").val();
                    var employeeType = $("#employeeType").val();
                    var AgencyEmployeeID = $("#AgencyEmployeeID").val();
                    var agencyId = $("#AgencyId").val();
                    //var IdNumber = $("#IdNumber").val();
                    
                    // Checking for blank fields.
                    if (email == '' || firstname == '' || lastname == '' || position == '' || mhfrpid == '' || employeeType =='') {
                        
                        alert("Please fill all fields...!!!!!!");
                        return false;
                    } else 
                    {
                         /*   
                            $.post("process-new-employee.php", {
                                   email: email,
                                   firstname: firstname,
                                   lastname: lastname,
                                   PositionID: position,
                                   agencyId: agencyId,
                                   LocationCode: locationCode,
                                   mhfrpid: mhfrpid,
                                   employeeType: employeeType,
                                   AgencyId: agencyId,
                                   IdNumber: IdNumber,
                                   AgencyEmployeeID: AgencyEmployeeID

                               },
                               function(data) {
                                
                               if(data == "New employee was successfully created")
                                   {
                                       $("#status").html(data);
                                       $("#status").show();
                                       //alert(data);
                                   }
                               else
                                   {
                                       $("#status").html(data);
                                       $("#status").show();
                                       //alert(data);
                                   }

                           });
                               
                           //return false;
 
             */

                    }
                    //alert("pause");
                });
            });

        </script>

    </head>

    <body>
        <div class="container">
            <div class="row">
               <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <p><a href="../../signout.php">signout</a></p>
                </div>
            </div>
            <div class="row title">
                <h2>Indiana Mental Health Funds Recovery Program</h2>
            </div>
            <div class="row">
                    <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                        <h3>
                            <?= isset($_SESSION['userToken']) ? $_SESSION['userToken'] : '' ?>,
                                <?= isset($_SESSION['agency']) ? $_SESSION['agency'] : '' ?>
                        </h3>
                        <p> <a href="../">Home</a> > <a href="main.php"> Rosters</a> > New Employee
                        </p>
                    </div>
                </div>
            <div class="row title">
                <h4>New Employee Form</h4>
                <div id="status" style="color:red"></div>
            </div>

            <div class="row">
                <div class="main round">


                    <div class="row">
                        <form id="newEmployeeForm" name="newEmployeeForm" action="process-new-employee.php" method="post">
                            <input type="hidden" name="AgencyId" id="AgencyId" value="<?= (isset($_SESSION['agencyid'])) ? $_SESSION['agencyid'] : '' ?>">
                            <div class="row">
                                <p>&nbsp;</p>
                            </div>


                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Email</label><br />
                                    <input class="form-control form-rounded" type="text" name="email" id="email" value="">
                                </div>
                                <div class="col-sm-4">
                                    <label>Last Name</label><br />
                                    <input class="form-control form-rounded" type="text" name="lastname" id="lastname" value="">
                                </div>
                                <div class="col-sm-4">
                                    <label>First Name</label><br />
                                    <input class="form-control form-rounded" type="text" name="firstname" id="firstname" value="">
                                </div>
                                

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Position Title</label><br />
                                    <select name="PositionID" id="PositionID" class="form-control form-rounded">
                                        <?php 
                                            echo "<option></option>";
                                            $positionresult = GetAllRosterPositions();

                                            while ($positionrow = $positionresult->fetch_assoc()) {

                                                echo "<option value='" . $positionrow['positionId'] . "'>" . $positionrow['positionName'] . "</option>";


                                            }

                                            ?>
							        </select>


                                </div>
                                <div class="col-sm-4">
                                    <label>Agency Employee ID</label><br />
                                    <input class="form-control form-rounded" type="text" name="AgencyEmployeeID" id="AgencyEmployeeID" value="">
                                </div>
                                <div class="col-sm-4">
                                    <label>Location Code</label><br />
                                    <input name="LocationCode" id="LocationCode" value="" class="form-control form-rounded">


                                </div>


                            </div>
                            <hr />
                            <div class="row">
                                <!--div class="col-sm-4">
                                    <label>ID Number</label><br />
                                    <input name="IdNumber" id="IdNumber" class="form-control form-rounded" value="">
                                    <p>Enter the MHFPRID of the employee being replaced (if applicable). <a href="main.php" target="_blank">Click here</a> to look up the MHFRPID of the employee that is being replaced.</p>


                                </div-->
                                <div class="col-sm-4">
                                    <label>MHFRP ID</label><br />
                                    <input class="form-control form-rounded" type="text" name="mhfrpid" id="mhfrpid" value="<?= GenerateID($_SESSION['agencyid']) ?>" readonly>
                                </div>
                                <div class="col-sm-4">
                                    <label>Employee Type</label><br />

                                    <select class="form-control form-rounded" type="text" name="employeeType" id="employeeType">
                                        <?php 
                                            echo "<option></option>";
                                            $positionresult = GetEmployeeTypes();

                                            while ($positionrow = $positionresult->fetch_assoc()) {

                                                echo "<option value='" . $positionrow['employeeTypeID'] . "'>" . $positionrow['employeeTypeName'] . "</option>";


                                            }
                                        ?>
                                    </select>
                                </div>

                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <button id="createBtn" type="submit" class="btn btn-primary btn-lg" <?= (IsLocked() == 'Yes' ? 'disabled' : '') ?> >Create</button>
                                </div>
                            </div>

                            <div class="row">
                                <p>&nbsp;</p>
                            </div>
                            <!--<div style="width: 5%; float:right"><span class="glyphicon glyphicon-remove-circle"></span></div>
                -->
                        </form>
                    </div>
                </div>
            </div>


        </div>


    </body>
