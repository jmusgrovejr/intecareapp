<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require("functions.php");
require("otherFunctions.php");
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>

    <head>
        <title></title>
        <meta name="" content="">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


        <script>
            $(document).ready(function () {

                $("#lockform").submit(function () {

                    //alert('processing lock request');
                    var opt = $("#lockunlock").val();
                    //alert('new locked value is: ' + opt);
                    $.post("lockchanges.php", {option: opt})
                            .done(function () {
                                alert("Locking request is complete. Please refresh the page to update the Lock Status");
                            });
                });

                $("#initiate").click(function () {
                    var period = $("#initatePeriod").val();

                    // Checking for blank fields.
                    if (email == '' || password == '') {
                        $('input[type="text"],input[type="password"]').css("border", "2px solid red");
                        $('input[type="text"],input[type="password"]').css("box-shadow", "0 0 3px red");
                        //alert("Please fill all fields...!!!!!!");
                    } else {
                        $.post("initiateTimeStudy.php", {
                            period: period
                        },
                                function (data) {
                                    if (data == 'Invalid Email.......') {
                                        $('input[type="text"]').css({
                                            "border": "2px solid red",
                                            "box-shadow": "0 0 3px red"
                                        });
                                        $('input[type="password"]').css({
                                            "border": "2px solid #00F5FF",
                                            "box-shadow": "0 0 5px #00F5FF"
                                        });
                                        alert(data);
                                    } else if (data == 'Email or Password is wrong...!!!!') {
                                        $('input[type="text"],input[type="password"]').css({
                                            "border": "2px solid red",
                                            "box-shadow": "0 0 3px red"
                                        });
                                        alert(data);
                                    } else if (data == 'Successfully Logged in...') {
                                        //$("form")[0].reset();
                                        //$('input[type="text"],input[type="password"]').css({"border":"2px solid #00F5FF","box-shadow":"0 0 5px #00F5FF"});
                                        alert(data);
                                    } else {
                                        alert(data);
                                    }
                                });
                    }
                });
            });

        </script>
        <style>
            .round {
                width: 600px;
                max-width: 600px;
                padding-left: 20px;
                padding-top: 10px;
            }

        </style>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="header">
                    <img src="../images/intecare-logo.svg" alt="" class="logo">
                </div>
            </div>
            <div class="row title">
                <h2>Indiana Mental Health Funds Recovery Program</h2>
                <h4>Admin Control Panel</h4>
            </div>
            <div class="row">
                <div class="col-sm-10 text-center">
               <h3>Roster Management</h3>
               </div>
            </div>
            <div class="row">
                
                <div class="main round">
                    
                    <form class="form" name="lockform" id="lockform">
                        <div class="row">

                            <div class="col-sm-10">
                                <p>Use this form to lock/unlock add or edit functions on employees.</p>
                                <p>Roster management is currently <b><?= (IsLocked() == '1' ? 'Locked' : 'Unlocked') ?></b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 text-right"><label>Lock/Unlock Employees</label></div>

                            <div class="col-sm-4">
                                <select type="text" name="lockunlock" id="lockunlock" value="" required>
                                    <option value=""></option>
                                    <option value="1">Lock</option>
                                    <option value="0">Unlock</option>
                                </select>
                            </div>

                            <div class="col-sm-4 text-center"><input type="submit" name="lockunlockbutton" id="lockunlockbutton" value="Submit"></div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 text-center">&nbsp;</div>
                        </div>
                        
                        <div class="row">

                            <div class="col-sm-10">
                                <p>Use this link to export the current Rosters for all agencies</p>
                                <p> <a href="export-rosters.php" target="_blank">Download Rosters</a> </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>  
            <hr>
            <div class="row">
                <div class="main round">

                    <form class="form" method="post" action="initiateTimeStudy.php">
                        <div class="row">

                            <div class="col-sm-10">
                                <p>Use this form to set the current period of the Cost Report and open the site for data collection.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 text-right"><label>Cost Report Period</label></div>

                            <div class="col-sm-4">
                                <select type="text" name="initatePeriod" id="initatePeriod" value="" required>
                                    <option value=""></option>
                                    <option value="2017-Q2">2017-Q2</option>
                                    <option value="2017-Q3">2017-Q3</option>
                                    <option value="2017-Q4">2017-Q4</option>
                                    <option value="2018-Q1">2018-Q1</option>
                                    <option value="2018-Q2">2018-Q2</option>
                                    <option value="2018-Q3">2018-Q3</option>
                                    <option value="2018-Q4">2018-Q4</option>
                                    <option value="2019-Q1">2019-Q1</option>
                                    <option value="2019-Q2">2019-Q2</option>
                                    <option value="2019-Q3">2019-Q3</option>
                                    <option value="2019-Q4">2019-Q4</option>
                                    <option value="2020-Q1">2020-Q1</option>
                                    <option value="2020-Q2">2020-Q2</option>
                                    <option value="2020-Q3">2020-Q3</option>
                                    <option value="2020-Q4">2020-Q4</option>
                                </select>
                            </div>

                            <div class="col-sm-4 text-center"><input type="submit" name="initiate" id="initiate" value="Submit"></div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 text-center">&nbsp;</div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="main round">

                    <form class="form" method="post" action="/export.php">
                        <div class="row">

                            <div class="col-sm-10">
                                <p>Export time study data for the </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 text-right"><label>Time Study Period</label></div>

                            <div class="col-sm-4">
                                <select type="text" name="period" id="period" required>
                                    <?php
                                    echo "<option></option>";
                                    $periods = GetTimeStudyPeriods();
                                    //var_dump($periods); exit;
                                    while ($periodRow = $periods->fetch_assoc()) {

                                        if (isset($_GET['IdNumber'])) {
                                            if ($periodRow['period'] == GetPeriod()) {
                                                echo "<option selected value='" . $periodRow['period'] . "'>" . $periodRow['period'] . "</option>";
                                            } else {
                                                echo "<option value='" . $periodRow['period'] . "'>" . $periodRow['period'] . "</option>";
                                            }
                                        } else {
                                            echo "<option value='" . $periodRow['period'] . "'>" . $periodRow['period'] . "</option>";
                                        }
                                    }
                                    ?>

                                </select>                             
                            </div>

                            <div class="col-sm-4 text-center"><input type="submit" name="login" id="login" value="Submit"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 text-right"><label>Select Agency</label></div>

                            <div class="col-sm-4">
                                <select type="text" name="agency" id="agency" style="width: 200px" required>
                                    <?php
                                    echo "<option></option>";
                                    $agencies = GetAgencyAll();
                                   
                                    while ($agencyRow = $agencies->fetch_assoc()) {

                                        echo "<option value='" . $agencyRow['AgencyId'] . "'>" . $agencyRow['AgencyName'] . "</option>";
                                    }
                                    ?>

                                </select>                                
                            </div>

                            <div class="col-sm-4 text-center">&nbsp;</div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 text-center">&nbsp;</div>
                        </div>
                    </form>
                </div>
            </div>
          
                  
        </div>
    </body>

</html>
