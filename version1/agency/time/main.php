<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

session_start();

$DIR_ = $_SERVER["DOCUMENT_ROOT"]. "/";
require($DIR_. "config.php");


if(!isset($_SESSION['userToken']))
{
	header ("Location: index.php");		
}

$id =  GetAgencyID($_SESSION['userToken']);
$name = GetAgencyName($id);
$period = GetPeriod();
$_SESSION['agency'] = $name;
$_SESSION['agencyid'] = $id;
$_SESSION['period'] = $period;
$result = GetPositions($id, $period);

//var_dump($result); exit;
?>
    <html>

    <head>
        <title></title>
        <meta name="" content="">
        <link rel="stylesheet," href="css/styles.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <style>
            .round {
                border: 1px solid #a1a1a1;
                background: #3b5cb9;
                width: 250px;
                border-radius: 5px;
                margin: 4px
            }

            
        </style>

    </head>

    <body>

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p><a href="../../signout.php">signout</a></p>
                </div>
            </div>  
                <div class="row">
                    <div class="col-sm-12">
                        <h3>
                            <?= isset($_SESSION['userToken']) ? $_SESSION['userToken'] : '' ?>,
                                <?= isset($_SESSION['agency']) ? $_SESSION['agency'] : '' ?>
                        </h3>
                        <p><a href="../"> Home</a>
                            <!--<a href="#" class="btn btn-info btn-sm">
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                            <a href="#" class="btn btn-info btn-sm">
                                <span class="glyphicon glyphicon-minus"></span>
                            </a>-->
                        </p>

                    </div>
                </div>
                <div class="row text-right">
                    <div class="col-sm-12">

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10" style="color:white">
                        <div class="text-left"><a href="../../agency-export.php" target="_blank">Export Agency Data</a></div>

                        <?															

	while ($row = $result->fetch_assoc()) 
	{

	    
	?>
                            <div class="col-sm-3 round">
                                <div style="width: 95%; float:left">
                                    <label><a href="detail.php?id=<?= $row['PositionTitle'] ?>&name=<?= $row['positionName'] ?>" style="color: white; text-decoration: underline;"><?= $row['positionName'] ?></a></label>
                                    <p><span><?= GetCertifiedCount($row['PositionTitle'], $id, $period) ?></span> certified</p>
                                    <p><span><?= GetNonCertifiedCount($row['PositionTitle'], $id, $period) ?></span> needing certificates</p>
                                </div>
                                <!--<div style="width: 5%; float:right; color:green"><span class="glyphicon glyphicon-ok-circle"></span></div>-->
                            </div>
                            <? } ?>

                    </div>
                </div>
            
        </div>
    </body>

    </html>
