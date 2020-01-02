<?php
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);

    require '../includes/db.inc.php';

    $period = $_GET['period'];

    $sql = "SELECT agencies.AgencyName, agency_employees.FirstName, agency_employees.LastName, agency_employees.Email, selected.mhfrpid FROM employee_selected AS selected INNER JOIN agency_employees ON agency_employees.MHFRPID = selected.mhfrpid INNER JOIN agencies ON agencies.AgencyId = agency_employees.InteCareAgencyID WHERE selected.time_period = ? ORDER BY agencies.AgencyName";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $period);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $agencyData = mysqli_fetch_all($result);

    $xls_filename = 'all_rosters_' . $period . '.xls';

    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=$xls_filename");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Excel Formatting
    $sep = "\t";

    // Add column names
    for ($i = 0; $i < $result->field_count; $i++) {
        echo $result->fetch_field_direct($i)->name . "\t";
    }

    print("\n");

    // Add data
    foreach ($agencyData as $data) {
        $schema_insert = "";
        for ($j = 0; $j < $result->field_count; $j++) {
            if (!isset($data[$j])) {
                $schema_insert .= "NULL" . $sep;
            } elseif ($data[$j] != "") {
                $schema_insert .= "$data[$j]" . $sep;
            } else {
                $schema_insert .= "" . $sep;
            }
        }
        $schema_insert = str_replace($sep . "$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";

        print(trim($schema_insert));
        print "\n";
    }
?>
