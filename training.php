<?php 
    //error_reporting(E_ALL); ini_set('display_errors', 1);

    require "header.php"; 
    require './includes/db.inc.php';
    require './includes/empCookies.inc.php';
    require "nav-emp.php";
?>

<div class="container-fluid page-training">
    <div class="row justify-content-center text-center">
        <div id="page-fit" class="wrapper col-12">
            <h2 class="text-center">EMPLOYEE TRAINING</h2>
            <a href="./training-pdf?id=<?php echo $mhfrpid; ?>">
                <button type="button" class="btn btn-outline-light col-12 col-md-6 mt-4">
                    <h3>TRAINING PDF</h3>
                </button>
            </a>
            <a href="./timestudy?id=<?php echo $mhfrpid; ?>">
                <button type="button" class="btn btn-outline-light col-12 col-md-6 mt-5">
                    <h3>TIME STUDY LOGS</h3>
                </button>
            </a>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>