<?php
  error_reporting(E_ALL); ini_set('display_errors', 1);

  require "header.php"; 
  require './includes/db.inc.php';
  require './includes/empCookies.inc.php';
  require "nav-emp.php";
?>

<?php
    $totalPages = 70;
    if (isset($_GET["d"]) && $_GET["d"] != "") {
      $currentPage = intval($_GET["d"]);
      if ($currentPage > $totalPages) {
        header("Location: ./training-pdf?id=$mhfrpid&d=1");
      }
    } else {
      $currentPage = 0;
    }

    $prevPage = $currentPage - 1;
    $nextPage = $currentPage + 1;

    include "includes/pageCheck.inc.php";
?>

<?php if ($currentPage != $totalPages) : ?>
<div class="container-fluid page-training-pdf">
    <div class="row justify-content-center text-center align-items-center">
        <div class="col-1">
          <a <?php if ($currentPage != 1) { echo "href=./training-pdf?id=$mhfrpid&d=$prevPage"; } ?>><i class="fas fa-chevron-left <?php if ($currentPage == 1) { echo 'disabled'; } ?>"></i></a>
        </div>
        <div class="col-10">
          <?php /* if ($currentPage == 2 || $currentPage == 25) : */ ?>
            <?php /* include "docs/html/Time-Study-Training-HTML-$currentPage.php"; */ ?>
          <?php if ($currentPage == 14 || $currentPage == 35 || $currentPage == 68) : ?>
            <script>
              $(function() {
                $(".fa-chevron-right").hide();
              });
            </script>
          <?php include "docs/html/Time-Study-Training-HTML-$currentPage.php"; ?>
          <?php else : ?>
            <!--<iframe id="trainingPdf" src="docs/Time-Study-Training-PPT-<?php echo $currentPage; ?>.pdf"></iframe>-->
            <iframe id="trainingPdf" src="docs/TIME_STUDY_TRAINING_ONLINE_Q4_2019_Part<?php echo $currentPage; ?>.pdf"></iframe>
          <?php endif; ?>
        </div>
      <div class="col-1">
        <a <?php if ($currentPage != $totalPages) { echo "href=./training-pdf?id=$mhfrpid&d=$nextPage"; } ?>><i class="fas fa-chevron-right <?php if ($currentPage == $totalPages) { echo 'disabled'; } ?>"></i></a>
      </div>
  </div>
</div>
<?php endif; ?>

<?php require "footer.php"; ?>