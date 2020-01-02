<?php
  require "../includes/adminCheck.inc.php";
  require "../includes/rosterLock.inc.php";
  require "../includes/costReport.inc.php";
  require "./header.php";
?>
<?php include "./nav.php"; ?>

<div class="page-admin">
  <div class="container">
    <div class="row justify-content-around text-center">
      <div class="wrapper col-12 col-md-5 mb-5">
        <h2 class="text-center">ROSTER MANAGEMENT</h2>
        <h5 class="text-center">Current Roster Status: <?php echo $rosterStatus; ?></h5>
        <form class="rosterForm" action="../includes/rosterLock.inc.php" method="post">
          <div class="form-group">
            <select class="form-control" name="lock-status">
              <option value="">SELECT CURRENT STATUS</option>
              <option value="locked">Lock</option>
              <option value="unlocked">Unlock</option>
            </select>
          </div>
          <button type="submit" name="roster-submit" class="btn standard mb-4">SUBMIT</button>
        </form>
        <p class="download"><a href="../includes/allAgencyRoster.inc.php">Download Rosters</a></p>
      </div>

      <div class="wrapper col-12 col-md-5 mb-5">
        <h2 class="text-center">EMPLOYEE TRAINING</h2>
        <a href="./emp-accounts.php?period=<?php echo $costReportStatus; ?>"><button type="button" class="btn standard mb-4">VIEW ACCOUNTS</button></a>
        <button type="button" class="btn standard mb-4" data-toggle="modal" data-target="#employeeModal">CREATE ACCOUNTS</button>
        <h5><i>This will create employee training accounts for the <?php echo $costReportStatus; ?> time period.</i></h5>
      </div>
    </div>

    <div class="row justify-content-around text-center">
      <div class="wrapper col-12 col-md-5 mb-5">
        <h2 class="text-center">COST REPORT</h2>
        <h5 class="text-center">Current Period: <?php echo $costReportStatus; ?></h5>
        <form class="costControlForm" action="../includes/costReport.inc.php" method="post">
          <div class="form-group">
            <select class="form-control" name="report-period">
              <option value="">SELECT CURRENT PERIOD</option>
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
          <button type="submit" name="report-submit" class="btn standard mb-4">SUBMIT</button>
        </form>
      </div>

      <div class="wrapper col-12 col-md-5 mb-5">
        <h2 class="text-center">TIME STUDY REPORT</h2>
        <form class="timeStudyForm" action="./tools/timestudyReport.inc.php" method="post">
          <div class="form-group">
            <select class="form-control" name="period">
              <option value="">SELECT PERIOD</option>
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
          <div class="form-group">
            <select class="form-control" name="agency">
              <option value="">SELECT AGENCY</option>
              <?php include '../includes/optionsAgency.inc.php'; ?>
            </select>
          </div>
          <button type="submit" name="study-submit" class="btn standard mb-4" disabled>EXPORT</button>
        </form>
      </div>
    </div>

    <div class="row justify-content-around text-center">
      <div class="wrapper col-12 col-md-4">
        <h2 class="text-center">AGENCY USERS</h2>
        <h5 class="text-center">Manage agency users</h5>
        <form class="costControlForm" action="newAgencyUser.php" method="post">
          <button type="submit" name="report-submit" class="btn standard mb-4">SUBMIT</button>
        </form>
      </div>
    </div>

    <!-- Account Confirm Modal -->
    <div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="employeeModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="employeeModalLabel">Confirm Account Creation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            This action will erase any previous accounts for the <?php echo $costReportStatus; ?> time period. Continue?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <!--<button type="button" class="btn btn-primary">Continue</button>-->
            <form action="./emp-training.php" method="post">
              <button type="submit" name="generate-submit" class="btn btn-primary">Continue</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>