<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

session_start();

$DIR_ = $_SERVER["DOCUMENT_ROOT"] . "/";
require($DIR_ . "config.php");


if (!isset($_SESSION['userToken'])) {
    header("Location: ../../index.php");
}

$id = GetAgencyID($_SESSION['userToken']);
$name = GetAgencyName($id);
$period = GetPeriod();
$_SESSION['agency'] = $name;
$_SESSION['agencyid'] = $id;
$_SESSION['period'] = $period;

$result = GetRosterPositions($id);
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
        <script type="text/javascript">     
        function isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ( (charCode > 31 && charCode < 48) || charCode > 57) {
                    return false;
                }
                return true;
            }
            function GetURLParameter(sParam)
            {
                var sPageURL = window.location.search.substring(1);
                var sURLVariables = sPageURL.split('&');
                for (var i = 0; i < sURLVariables.length; i++) 
                {
                    var sParameterName = sURLVariables[i].split('=');
                    if (sParameterName[0] == sParam) 
                    {
                        return sParameterName[1];
                    }
                }
            }
            
            if(GetURLParameter('success') == 'true')
                    {
                        //show a success message that the new employee was created successfully.
                        alert("The new employee was created successfully");
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
                        <div>Roster Management</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h3>
<?= isset($_SESSION['userToken']) ? $_SESSION['userToken'] : '' ?>,
                            <?= isset($_SESSION['agency']) ? $_SESSION['agency'] : '' ?>
                        </h3>
                        <p><a href="../">Agency Home</a> | <a href="../../roster-export.php?agencyID=<? echo $_SESSION['agencyid'] ?>" target="_blank">Export Roster</a> 
                            <a href="new-employee.php" class="btn btn-info btn-sm">
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                            <!--a href="#" class="btn btn-info btn-sm">
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

                        <?															

                        while ($row = $result->fetch_assoc()) 
                        {


                        ?>
                        <div class="col-sm-3 round">
                            <div style="width: 95%; float:left">
                                <label><a href="detail.php?id=<?= $row['PositionID'] ?>&name=<?= $row['positionName'] ?>" style="color: white; text-decoration: underline;"><?= $row['positionName'] ?></a></label>
                                <p><span><?= GetActiveCount($row['PositionID'], $id, $period) ?></span> active employees</p>
                                <p><span><?= GetInactiveCount($row['PositionID'], $id, $period) ?></span> inactive employees</p>
                            </div>
                            <!--<div style="width: 5%; float:right; color:green"><span class="glyphicon glyphicon-ok-circle"></span></div>-->
                        </div>
                        <? } ?>
                        <div class="col-sm-3 round">
                            <div style="width: 95%; float:left">
                                <label><a href="#GAModal" data-toggle="modal" data-target="#GAModal" style="color: white; text-decoration: underline;">Non-Time Study Category</a></label>
                                <p>General Overhead Staff: <span><?= (empty(GetGeneralOverheadStaffCount($id)) ? '0' : GetGeneralOverheadStaffCount($id)) ?></span></p>
                                <p>Direct Services and Other: <span><?= (empty(GetDirectServicesAndOther($id)) ? '0' : GetDirectServicesAndOther($id)) ?></span></p>

                            </div>
                            <!--<div style="width: 5%; float:right; color:green"><span class="glyphicon glyphicon-ok-circle"></span></div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="GAModal" class="modal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
              <form class="form" method="post" action="updateEmployees.php">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Non-Time Study Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">


                        <div class="form-group">
                        <label for="usr">General Overhead Staff:</label>
                        <input type="text" class="form-control" id="GeneralOverheadStaff" name="GeneralOverheadStaff" onkeypress="return isNumber(event)" required value="<?= GetGeneralOverheadStaffCount($id); ?>">
                      </div>
                      <div class="form-group">
                        <label for="pwd">Direct Services and Other:</label>
                        <input type="text" class="form-control" id="DirectServicesAndOther" name="DirectServicesAndOther" onkeypress="return isNumber(event)" required value="<?= GetDirectServicesAndOther($id); ?>">
                      </div>
                           <input type="hidden" id="agencyid" name="agencyid" value="<?= $id ?>">
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
            </form>

          </div>
        </div>        
    </body>

</html>
