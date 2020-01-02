<?php
    require "../includes/adminCheck.inc.php";
    require "header.php";
    require "../includes/agencyUsersList.inc.php";

?>

<div class="page-employees">
    <div id="app">
        <?php include "nav.php"; ?>
        <div class="pt-4 employees-page-container container">

            <h3>Agency Users<a href="javascript:addAgencyModal();" target="_self" class="btn float-right pr-0 btn-link">+ Add New</a></h3>

            <hr>
            <div class="row justify-content-between pb-2 pt-2">
                <div class="mb-3 col-sm-12 col-md-12 col-lg-6 col-xl-5 col-12">
                    <select id="positionSelect" class="form-control custom-select position-select">
                            <option value="0" selected>Search By Agency</option>
                            <?php include '../includes/optionsAgency.inc.php'?>
                    </select>
                </div>

            </div>


            <?php echo "<script>function getAgencyUserData(email) { $('#systemIdForm' + email).submit(); }</script>"; ?>
            <?php foreach ($employeeInfo as $index=>$employee) : ?>
            <?php if ($employeeInfo[0][0] === 'empty') : ?>
                <div class="row justify-content-center">
                    <h3>No employees found.</h3>
                </div>
            <?php else : ?>
            <?php
                $systemId = $employee[$index][0];
                $email = $employee[$index][1];
                $lastname = ucfirst(strtolower($employee[$index][2]));
                $firstname = ucfirst(strtolower($employee[$index][3]));
                $idNumber = $employee[$index][4];
                $positionId = $employee[$index][5];
                $mhfrpId = $employee[$index][6];
                $agencyEmployeeId = $employee[$index][7];
                $intecareAgencyId = $employee[$index][8];
                $locationCode = $employee[$index][9];
                $employeeType = $employee[$index][10];
                $active = $employee[$index][11];
                $startDate = $employee[$index][12];
                $endDate = $employee[$index][13];
                $positionName = $employee[$index][15];

                $firstname = implode("-", array_map("ucfirst", explode("-", $firstname)));
                $firstname = implode("'", array_map("ucfirst", explode("'", $firstname)));
                $firstname = implode(" ", array_map("ucfirst", explode(" ", $firstname)));
                $firstname = implode("Mc", array_map("ucfirst", explode("Mc", $firstname)));
                $lastname = implode("-", array_map("ucfirst", explode("-", $lastname)));
                $lastname = implode("'", array_map("ucfirst", explode("'", $lastname)));
                $lastname = implode(" ", array_map("ucfirst", explode(" ", $lastname)));
                $lastname = implode("Mc", array_map("ucfirst", explode("Mc", $lastname)));
                $firstinitial = substr($firstname, 0, 1);
                $lastinitial = substr($lastname, 0, 1);
            ?>
            <div class="row pb-3">
                <div class="col">
                    <div class="card pt-0 pb-0 shadow">
                        <div class="card-body">
                            <div class="row pr-5">
                                <div class="col-md-1 col-lg-1 col-2">
                                    <button type="button" class="btn btn-secondary initials-container">
                                        <?php echo $firstinitial . $lastinitial; ?>
                                    </button>
                                    <form id="systemIdForm<?php echo $systemId; ?>" class="d-none" action="employee-edit.php" method="post">
                                        <input type="text" name="systemId" value="<?php echo $systemId; ?>">
                                    </form>
                                </div>
                                <div class="hover-pointer col-md-4 col-lg-3 col-5">
                                    <p class="pt-2 mb-0">
                                        <?php echo $firstname . ' ' . $lastname; ?>
                                    </p>
                                </div>
                                <div class="hover-pointer d-none d-md-block col-md-4 col-lg-4 col-5">
                                    <p class="pt-2 mb-0">
                                        <?php echo $email; ?>
                                    </p>
                                </div>
                                <div class="hover-pointer d-none d-lg-block col-md-4 col-lg-4 col-5">
                                    <p class="pt-2 mb-0">
                                        <div class="round">
                                            <input type="checkbox" id="checkbox<?php echo $index; ?>" <?php if ($active == 1) { echo 'checked'; } ?>/>
                                            <label for="checkbox"></label><span class="checkbox-label"><?php if ($active != 1) { echo 'Not '; } ?>Active</span>
                                        </div>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <div id="employee-collapse-<?php echo $index; ?>" class="employee-panel collapse">
                                        <div class="row justify-content-end pt-4">
                                            <div class="col-md-11 col-10">
                                                <div class="row">
                                                    <div class="mb-3 col-sm-6 col-md-4 col-12">
                                                        <span class="employee-field-label font-weight-bold">Position<br></span><?php echo $positionName; ?>
                                                    </div>
                                                    <div class="mb-3 col-sm-6 col-md-4 col-12">
                                                        <span class="employee-field-label font-weight-bold">State ID<br></span><?php echo $intecareAgencyId; ?>
                                                    </div>
                                                    <div class="mb-3 col-sm-6 col-md-4 col-12">
                                                        <span class="employee-field-label font-weight-bold">Location Code<br></span><?php echo $locationCode; ?>
                                                    </div>
                                                    <div class="mb-3 col-sm-6 col-md-4 col-12">
                                                        <span class="employee-field-label font-weight-bold">MHRFP ID<br></span><?php echo $mhfrpId; ?>
                                                    </div>
                                                    <div class="mb-3 col-sm-6 col-md-4 col-12">
                                                        <span class="employee-field-label font-weight-bold">Agency Employee ID<br></span><?php echo $agencyEmployeeId; ?>
                                                    </div>
                                                    <div class="mb-3 col-sm-6 col-md-4 col-12">
                                                        <span class="employee-field-label font-weight-bold">Employee ID<br></span><?php echo $idNumber; ?>
                                                    </div>
                                                    <div class="mb-3 col-sm-6 col-md-4 col-12">
                                                        <span class="employee-field-label font-weight-bold">Start Date<br></span><?php echo $startDate; ?>
                                                    </div>
                                                    <div class="mb-3 col-sm-6 col-md-4 col-12">
                                                        <span class="employee-field-label font-weight-bold">End Date<br></span><?php echo $endDate; ?>
                                                    </div>
                                                    <?php if ($rosterStatus == "Unlocked") : ?>
                                                    <div class="mb-3 col-sm-6 col-md-4 col-12">
                                                        <a href="javascript:getAgencyUserData(<?php echo $systemId; ?>);" id="editDetails" class="btn mt-2 pl-4 pr-4 btn-outline-primary btn-md">
                                                            Edit Details
                                                        </a>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn employee-collapse-toggle mr-3 btn-outline-secondary btn-sm" data-count="<?php echo $index; ?>">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-chevron-up fa-w-14">
                                        <path fill="currentColor" d="M240.971 130.524l194.343 194.343c9.373 9.373 9.373 24.569 0 33.941l-22.667 22.667c-9.357 9.357-24.522 9.375-33.901.04L224 227.495 69.255 381.516c-9.379 9.335-24.544 9.317-33.901-.04l-22.667-22.667c-9.373-9.373-9.373-24.569 0-33.941L207.03 130.525c9.372-9.373 24.568-9.373 33.941-.001z" class=""></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; endforeach; ?>
        </div>
    </div>
</div>

<?php require "includes/agencyModalAdd.inc.php"; ?>

<?php require "footer.php"; ?>
