<?
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$DIR_ = $_SERVER["DOCUMENT_ROOT"] . "/";
require($DIR_. "config.php");


if(!isset($_SESSION['userToken']))
{
	header ("Location: index.php");		
}

if(isset($_GET['update']))
{
	$val = UpdateEmployeeAgencyData($_GET['IdNumber'], $_SESSION['period']);
	//echo $val;
}


$result = GetEmployeesFromPositionTitle($_GET['id'], $_SESSION['agencyid'], $_SESSION['period']);
$_SESSION['data'] = array();

if (isset($_GET['IdNumber']))
{
	
	$result1 = GetEmployee($_GET['IdNumber']);
	
	while ($row = $result1->fetch_assoc()) 
	{
		$_SESSION['data']['Period'] = $row['Period'];
		$_SESSION['data']['LastName'] = $row['LastName'];
		$_SESSION['data']['FirstName'] = $row['FirstName'];
		$_SESSION['data']['Email'] = $row['Email'];
		$_SESSION['data']['InteCareAgencyID'] = $row['InteCareAgencyID'];
		$_SESSION['data']['PositionTitle'] = $row['PositionTitle'];
		$_SESSION['data']['LocationCode'] = $row['LocationCode'];

		$_SESSION['data']['SalariesWages'] = $row['SalariesWages'];
		$_SESSION['data']['PayrollTaxFICA'] = $row['PayrollTaxFICA'];
		$_SESSION['data']['OtherFringe'] = $row['OtherFringe'];
		$_SESSION['data']['DuesFees'] = $row['DuesFees'];
		$_SESSION['data']['TravelTraining'] = $row['TravelTraining'];
		$_SESSION['data']['MaterialsSupplies'] = $row['MaterialsSupplies'];
		$_SESSION['data']['PurchasedServices'] = $row['PurchasedServices'];
		$_SESSION['data']['OtherExpenses'] = $row['OtherExpenses'];
		$_SESSION['data']['DSSSalariesWages'] = $row['DSSSalariesWages'];
		$_SESSION['data']['DSSFringeBenefits'] = $row['DSSFringeBenefits'];
		$_SESSION['data']['TotalCost'] = $row['TotalCost'];
		$_SESSION['data']['NetCost'] = $row['NetCost'];
		$_SESSION['data']['certified'] = $row['certified'];
		$_SESSION['data']['FederalRevenueApplicable'] = $row['FederalRevenueApplicable'];								
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
                    <p><a href="signout.php">signout</a></p>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h3>
                            <?= isset($_SESSION['userToken']) ? $_SESSION['userToken'] : '' ?>,
                                <?= isset($_SESSION['agency']) ? $_SESSION['agency'] : '' ?>
                        </h3>
                        <p><a href="main.php"> Time Study</a> > Employees
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
					
							if( GetCertifiedValue($row['IdNumber'], $_SESSION['period'])== "1")
							{ ?>
                                    <p><span class="glyphicon glyphicon-ok" style="color: rgb(26,255,0);">&nbsp;</span>
                                        <a href="detail.php?IdNumber=<?= $row['IdNumber'] ?>&id=<?= $_GET['id'] ?>&name=<?= $_GET['name'] ?>" style="color: white; font-size: small">
                                            <?= $row['LastName'] ?> ,
                                                <?= $row['FirstName'] ?>
                                        </a>
                                    </p>
                                    <?}
							else
							{ ?>
                                        <p><span class="glyphicon glyphicon-ok">&nbsp;</span>
                                            <a href="detail.php?IdNumber=<?= $row['IdNumber'] ?>&id=<?= $_GET['id'] ?>&name=<?= $_GET['name'] ?>" style="color: white; font-size: small">
                                                <?= $row['LastName'] ?> ,
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
                                    <div class="col-sm-6 text-right">
                                        <!--<input class="form-control form-rounded" widith="50px" type="button" name="editEmployee" id="editEmployee" value="View Employee" onclick="<? echo " window.location.href='view.php?email=" . $_SESSION['data']['Email'] . "' ";  ?>">
-->
                                    </div>
                                    <div class="col-sm-6 text-left">
                                        <?
						if((isset($_GET['IdNumber'])) &&($_SESSION['data']['certified'] == "1"))
						{
							
						
						?>
                                            <input class="form-control form-rounded" widith="50px" type="button" style="background-color: rgb(26,255,0)" onclick="changebutton();" name="cert" id="cert" value="CERTIFIED">
                                            <input type="hidden" id="certvalue" name="certvalue" value="1" />


                                            <?}
						else
						{ ?>
                                                <input class="form-control form-rounded" widith="50px" type="button" style="background-color: white" onclick="changebutton();" name="cert" id="cert" value="CERTIFIED">
                                                <input type="hidden" id="certvalue" name="certvalue" value="0" />
                                                <? } ?>
                                    </div>
                                </div>
                                <hr />

                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>Period</label><br />
                                        <input class="form-control form-rounded" type="text" name="period" id="period" disabled value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['Period'] : '' ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Last Name</label><br />
                                        <input class="form-control form-rounded" type="text" name="lastname" id="lastname" disabled value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['LastName'] : '' ?> ">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>First Name</label><br />
                                        <input class="form-control form-rounded" type="text" name="firstname" id="firstname" disabled value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['FirstName'] : '' ?>">
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>Position Title</label><br />
                                        <select name="PositionTitle" class="form-control form-rounded" disabled>
							<?php 
								echo "<option></option>";
								$positionresult = GetPositions($_SESSION['agencyid'], $_SESSION['period']);
								
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
                                    <div class="col-sm-4">
                                        <label>Agency ID</label><br />
                                        <input disabled class="form-control form-rounded" type="text" name="InteCareAgencyID" id="InteCareAgencyID" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['InteCareAgencyID'] : '' ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Location Code</label><br />
                                        <input disabled class="form-control form-rounded" type="text" name="LocationCode" id="LocationCode" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['LocationCode'] : '' ?>">
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Salary & Wages</label><br />
                                        <input class="form-control form-rounded" type="text" name="SalariesWages" id="SalariesWages" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['SalariesWages'] : '' ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Payroll Tax / FICA</label><br />
                                        <input class="form-control form-rounded" type="text" name="PayrollTaxFICA" id="PayrollTaxFICA" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['PayrollTaxFICA'] : '' ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Other Fringe	</label><br />
                                        <input class="form-control form-rounded" type="text" name="OtherFringe" id="OtherFringe" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['OtherFringe'] : '' ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Dues/Fees</label><br />
                                        <input class="form-control form-rounded" type="text" name="DuesFees" id="DuesFees" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['DuesFees'] : '' ?>">
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Travel/Training</label><br />
                                        <input class="form-control form-rounded" type="text" name="TravelTraining" id="TravelTraining" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['TravelTraining'] : '' ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Materials & Supplies</label><br />
                                        <input class="form-control form-rounded" type="text" name="MaterialsSupplies" id="MaterialsSupplies" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['MaterialsSupplies'] : '' ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Purchased Services</label><br />
                                        <input class="form-control form-rounded" type="text" name="PurchasedServices" id="PurchasedServices" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['PurchasedServices'] : '' ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Other</label><br />
                                        <input class="form-control form-rounded" type="text" name="OtherExpenses" id="OtherExpenses" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['OtherExpenses'] : '' ?>">
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Total Cost per Person</label><br />
                                        <input class="form-control form-rounded" type="text" name="TotalCost" id="TotalCost" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['TotalCost'] : '' ?>">
                                    </div>
                                </div>
                                <hr />
                                <p>FEDERAL REVENUE APPLICABLE</p>
                                <div class="row">

                                    <div class="col-sm-6">
                                        <label>Amount</label><br />
                                        <input class="form-control form-rounded" type="text" name="amount" id="amount" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['FederalRevenueApplicable']  : '' ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Describe, Type Source</label><br />
                                        <input class="form-control form-rounded" type="text" name="source" id="source" value="<?= (isset($_GET['IdNumber'])) ? '' : '' ?>">
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Net Cost	</label><br />
                                        <input class="form-control form-rounded" type="text" name="NetCost" id="NetCost" value="<?= (isset($_GET['IdNumber'])) ? $_SESSION['data']['NetCost'] : '' ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <p>&nbsp;</p>
                                </div>
                                <!--<div style="width: 5%; float:right"><span class="glyphicon glyphicon-remove-circle"></span></div>-->
                                <div class="row text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Update</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
