<?
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$DIR_ = $_SERVER["DOCUMENT_ROOT"]. "/";
require($DIR_. "config.php");


if(!isset($_SESSION['userToken']))
{
	header ("Location: ../../index.php");
}

if(isset($_GET['update']))
{
	//$val = UpdateEmployeeData($_GET['IdNumber']);
    $val = UpdateEmployeeDetails($_GET['IdNumber']);
	//echo $val;
}


$result = GetEmployeesFromPositionTitleRoster($_GET['id'], $_SESSION['agencyid']);
$_SESSION['data'] = array();

if (isset($_GET['IdNumber']))
{

	$result1 = GetEmployeeRoster($_GET['IdNumber']);

	while ($row = $result1->fetch_assoc())
	{
		$_SESSION['data']['LastName'] = $row['LastName'];
		$_SESSION['data']['FirstName'] = $row['FirstName'];
		$_SESSION['data']['Email'] = $row['Email'];
		$_SESSION['data']['InteCareAgencyID'] = $row['InteCareAgencyID'];
		$_SESSION['data']['PositionTitle'] = $row['PositionID'];
		$_SESSION['data']['LocationCode'] = $row['LocationCode'];
        $_SESSION['data']['AgencyEmployeeID'] = $row['AgencyEmployeeID'];
        $_SESSION['data']['IdNumber'] = $row['IdNumber'];
        $_SESSION['data']['MHFRPID'] = $row['MHFRPID'];
        $_SESSION['data']['EmployeeType'] = $row['EmployeeType'];
        $_SESSION['data']['Active'] = $row['Active'];
        $_SESSION['data']['StartDate'] = $row['StartDate'];
        $_SESSION['data']['EndDate'] = $row['EndDate'];


		//$_SESSION['data']['FederalRevenueApplicable'] = $row['FederalRevenueApplicable'];
	}


}

?>
    <html>

    <head>
        <title></title>
        <meta name="" content="">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/styles.css">
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
            function changebutton() {
                var background = document.getElementById("cert").style.backgroundColor;

                if (background == "white") {
                    document.getElementById("cert").style.backgroundColor = "rgb(26,255,0)";
                    document.getElementById("certvalue").value = "1";

                }
                if (background == "rgb(26, 255, 0)") {
                    document.getElementById("cert").style.backgroundColor = "white";
                    document.getElementById("certvalue").value = "0";
                }

            }

        </script>

    </head>

    <body>

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p><a href="../../signout.php">signout</a></p>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <h3>
                            <?= isset($_SESSION['userToken']) ? $_SESSION['userToken'] : '' ?>,
                                <?= isset($_SESSION['agency']) ? $_SESSION['agency'] : '' ?>
                        </h3>
                        <p> <a href="../">Home</a> > <a href="main.php"> Rosters</a> > Employees
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12" style="color:white">
                        <div class="col-sm-3 roundcol1 scrll">
                            <div style="width: 80%; float:left">
                                <h3>
                                    <?= $_GET['name'] ?>
                                </h3>
                                <?

						while ($row = $result->fetch_assoc())
						{

							if( GetActiveStatus($row['IdNumber'])== "1")
							{ ?>
                                    <p><span class="glyphicon glyphicon-ok" style="color: rgb(26,255,0);">&nbsp;</span>
                                        <a href="detail.php?IdNumber=<?= $row['IdNumber'] ?>&id=<?= $_GET['id'] ?>&name=<?= $_GET['name'] ?>" style="color: white; font-size: small">
                                            <?= $row['LastName'] ?>,
                                                <?= $row['FirstName'] ?>
                                        </a>
                                    </p>
                                    <?}
							else
							{ ?>
                                        <p><span class="glyphicon glyphicon-ok">&nbsp;</span>
                                            <a href="detail.php?IdNumber=<?= $row['IdNumber'] ?>&id=<?= $_GET['id'] ?>&name=<?= $_GET['name'] ?>" style="color: white; font-size: small">
                                                <?= $row['LastName'] ?>,
                                                    <?= $row['FirstName'] ?>
                                            </a>
                                        </p>
                                        <?}
							} ?>
                            </div>
                            <!--				<div style="width: 20%; float:right;">
					<a href="#" >
			          <span class="glyphicon glyphicon-plus"></span>
			        </a>
			        <a href="#" >
			          <span class="glyphicon glyphicon-minus"></span>
			        </a>
					</div>-->
                        </div>

                        <div class="col-sm-8 roundcol2" style="color:#3b5cb9">
                            <form id="updateform" name="updateform" method="post" action="detail.php?update=true&IdNumber=<?= $_GET['IdNumber'] ?>&id=<?= $_GET['id'] ?>&name=<?= $_GET['name'] ?>">
                                <div class="row">
                                    <p>&nbsp;</p>
                                </div>


                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>Email</label><br />
                                        <input class="form-control form-rounded" type="text" name="email" id="email" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['Email'] : '' ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Last Name</label><br />
                                        <input class="form-control form-rounded" type="text" name="LastName" id="LastName" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['LastName'] : '' ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>First Name</label><br />
                                        <input class="form-control form-rounded" type="text" name="FirstName" id="FirstName" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['FirstName'] : '' ?>">
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>Position Title</label><br />
                                        <select name="PositionID" id="PositionID" class="form-control form-rounded">
							<?php
								echo "<option></option>";
								$positionresult = GetRosterPositions2($_SESSION['agencyid'], $_SESSION['period']);


								while ($positionrow = $positionresult->fetch_assoc()) {

                                    if (isset($_GET['IdNumber']))
									{
										if ($positionrow['PositionID'] == $_SESSION['data']['PositionTitle'])
										{
											echo "<option selected value='" . $positionrow['PositionID'] . "'>" . $positionrow['positionName'] . "</option>";
										}
										else
										{
											echo "<option value='" . $positionrow['PositionID'] . "'>" . $positionrow['positionName'] . "</option>";
										}
									}
									else
									{
										echo "<option value='" . $positionrow['PositionID'] . "'>" . $positionrow['positionName'] . "</option>";
									}

								}

								?>
							</select>

                                    </div>
                                    <div class="col-sm-4">
                                        <label>State ID</label><br />
                                        <input class="form-control form-rounded" type="text" name="InteCareAgencyID" id="InteCareAgencyID" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['InteCareAgencyID'] : '' ?>" readonly>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Location Code</label><br />
                                        <input class="form-control form-rounded" type="text" name="LocationCode" id="LocationCode" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['LocationCode'] : '' ?>">
                                    </div>
                                </div>
                                <hr />
                                <div class="row">

                                    <div class="col-sm-4">
                                        <label>MHFRPID</label><br />
                                        <input class="form-control form-rounded" type="text" name="MHFRPID" id="MHFRPID" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['MHFRPID'] : '' ?>" readonly>
                                    </div>

                                   <div class="col-sm-4">
                                        <label>Agency Employee ID</label><br />
                                        <input class="form-control form-rounded" type="text" name="AgencyEmployeeId" id="AgencyEmployeeId" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['AgencyEmployeeID'] : '' ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Employee Type</label><br />
                                        <select class="form-control form-rounded" name="EmployeeType" id="EmployeeType">
                                        <?php
								echo "<option></option>";
								$typeresult = GetEmployeeTypes();

								while ($typerow = $typeresult->fetch_assoc()) {
									if (isset($_GET['IdNumber']))
									{
										if ($typerow['employeeTypeID'] == $_SESSION['data']['EmployeeType'])
										{
											echo "<option selected value='" . $typerow['employeeTypeID'] . "'>" . $typerow['employeeTypeName'] . "</option>";
										}
										else
										{
											echo "<option value='" . $typerow['employeeTypeID'] . "'>" . $typerow['employeeTypeName'] . "</option>";
										}
									}
									else
									{
										echo "<option value='" . $typerow['employeeTypeID'] . "'>" . $typerow['employeeTypeName'] . "</option>";
									}

								}

								?>
                                        </select>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>Start Date</label><br />
                                        <input class="form-control form-rounded" type="text" name="StartDate" id="StartDate" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['StartDate'] : '' ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>End Date</label><br />
                                        <input class="form-control form-rounded" type="text" name="EndDate" id="EndDate" readonly value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['EndDate'] : '' ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Employee Status</label><br />

                                        <?php
                                            if (isset($_SESSION['data']['Active']))
                                            {
                                               if($_SESSION['data']['Active'])
                                                   echo '<input id="Active" name="Active" type="checkbox" checked value="1"> Active';
                                                else
                                                   echo '<input id="Active" name="Active" type="checkbox"> Active';
                                            }
                                        ?>

                                    </div>
                                </div>


                                <div class="row">
                                    <p>&nbsp;</p>
                                </div>
                                <!--<div style="width: 5%; float:right"><span class="glyphicon glyphicon-remove-circle"></span></div>-->
                                <div class="row text-center">
                                    <button type="submit" class="btn btn-primary btn-lg" <?= (IsLocked() == '1' ? 'disabled' : '') ?>>Update</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
