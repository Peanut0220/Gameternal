<?php
//dbsetup.php
# Kindly update the following variables to match your database setup
$username = 'Peanut';
$password = '123456';
$dbname = 'peanut';

#SQL Export file name in the same folder
$sql_export = 'sql_export.sql';

/* Attempt to connect to MySQL database */
mysqli_report(MYSQLI_REPORT_OFF);
$root_db = new mysqli('localhost', 'root', '');

// Check connection
if ($root_db) {
    $dbinfo['Root DB'] = "<span class='badge bg-success'>Connected Successfully</span>";
} else {
    $dbinfo['Root DB'] = "<span class='badge bg-danger'>Connect Error</span><br />" . $root_db->connect_error;
}

$DB_USERNAME = $root_db->real_escape_string("$username");
$DB_PASSWORD = $root_db->real_escape_string("$password");
$DB_NAME = '`' . $root_db->real_escape_string("$dbname") . '`';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['drop'])) {
    $sql = "DROP DATABASE IF EXISTS $DB_NAME;";
    $root_db->query($sql);
    if ($root_db->affected_rows) {
        $dbinfo['DB Name'] = "$dbname <span class='badge bg-dark'>Dropped</span>";
    } else {
        $dbinfo['DB Name'] = "$dbname<br />" . $root_db->error;
    }
    $sql = "DROP USER '$DB_USERNAME'@'%';";
    $root_db->query($sql);
    if (empty($root_db->error)) {
        $dbinfo['DB User'] = "$username <span class='badge bg-dark'>Dropped</span>";
    } else {
        $dbinfo['DB Name'] = "$dbname<br />" . $root_db->error;
    }
    $dbinfo['Action'] = "<a href='" . $_SERVER['PHP_SELF'] . "' class='btn btn-primary'>Check & Install Database</a>";
} else {
    $sql = "SELECT Db from mysql.db WHERE Db='$dbname'";
    $result = $root_db->query($sql);
    if ($result->num_rows == 0) {
        $sql = "CREATE DATABASE $DB_NAME;";
        $root_db->query($sql);
        if ($root_db->affected_rows) {
            $dbinfo['DB Name'] = "$dbname <span class='badge bg-success'>DB Created</span>";
        } else {
            $dbinfo['Root DB'] .= $root_db->error;
        }
        $sql = "CREATE USER '$DB_USERNAME'@'%';";
        $root_db->query($sql);
        if (empty($root_db->error)) {
            $dbinfo['DB Username'] = "$DB_USERNAME <span class='badge bg-success'>User $username created</span>";
        } else {
            $dbinfo['Root DB'] .= $root_db->error;
        }
        $sql = "GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USERNAME'@'%' IDENTIFIED BY '$DB_PASSWORD';";
        $root_db->query($sql);
        if (empty($root_db->error)) {
            $dbinfo['DB Password'] = "$DB_PASSWORD <span class='badge bg-success'>Password confirmed, Permission granted</span>";
        } else {
            $dbinfo['Root DB'] .= $root_db->error;
        }
    }
    $root_db->close();
    mysqli_report(MYSQLI_REPORT_OFF);
    $user_db = new mysqli('localhost', $DB_USERNAME, $DB_PASSWORD, $dbname);
    if ($user_db) {
        $dbinfo['User DB'] = "<span class='badge bg-success'>Connected Successfully</span>";
        if ($sqlimport = file_get_contents($sql_export)) {
            $dbinfo['SQL Import'] = "$sql_export <span class='badge bg-info'>File Found</span>";
            $sqlimport = remove_sql_lines($sqlimport);
            $dbinfo['SQL Import'] .= "<pre class='overflow-auto border m-2 p-2' style='width: 500px; height: 200px;'>$sqlimport</pre>";
            if ($user_db->multi_query($sqlimport)) {
                $dbinfo['SQL Import'] .= "<span class='badge bg-success'>SQL Import Success</span>";
            } else {
                $dbinfo['SQL Import'] .= "<pre class='bg-warning'>$user_db->error</pre>";
            }
        }
    } else {
        $dbinfo['User DB'] = $user_db->connect_error;
    }
    $dbinfo['Action'] = '<form action="" method="POST"><a onClick="location.reload()" class="btn btn-primary">Reload</a>    
            <input type="submit" name="drop" value="Drop Database" class="btn btn-warning">
        </form>';
}

function remove_sql_lines($sql) {
    $lines = explode("\n", $sql);
    $output = "";
    $linecount = count($lines);
    for ($i = 0; $i < $linecount; $i++) {
        if (!preg_match("/^(SET time_zone|\-\-|\/\*)/", $lines[$i])) {
            $output .= empty($lines[$i]) ? '' : "$lines[$i]\n";
        }
    }
    return $output;
}
?>

<html>
    <head>
        <title>Database Setup for Gameternal Assignment</title>
        <link href='https://bootswatch.com/_vendor/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
    </head>
    <body class='container m-4'>
        <h1>Database Setup for Gameternal Assignment</h1>
        <table class='table table-striped'>
            <?php
            foreach ($dbinfo as $th => $td) {
                echo "<tr><th>$th</th><td>$td</td></tr>";
            }
            ?>
        </table>
    </body>
</html>