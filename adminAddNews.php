<?php
session_start();

//Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
 header("location: adminLogin.php");
}
require_once "config.php";

$title = $detail = $date = $game = $dest_path = "";
$title_err = $detail_err = $date_err = $game_err = $fileUpload_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate fullname
    if (empty(trim($_POST["title"]))) {
        $title_err = "Please enter news title.";
    } elseif (strlen(trim($_POST["title"])) > 90) {
        $title_err = "Title Shouldn't exceed 90 characters";
    } else {
        $title = $_POST["title"];
    }

    if (empty(trim($_POST["detail"]))) {
        $detail_err = "Please enter news details.";
    } elseif (strlen(trim($_POST["detail"])) > 600) {
        $detail_err = "Details Shouldn't exceed 600 characters";
    } else {
        $detail = $_POST["detail"];
    }

    if (empty(trim($_POST["date"]))) {
        $date_err = "Please enter news date.";
    } else {
        $date = $_POST["date"];
    }

    if (empty(trim($_POST["game"]))) {
        $game_err = "Please enter games or 'none' for no.";
    } elseif (strlen(trim($_POST["game"])) > 30) {
        $game_err = "Game Shouldn't exceed 30 characters";
    } else {
        $game = $_POST["game"];
    }

    if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] === UPLOAD_ERR_OK) {
        // get details of the uploaded file
        $fileTmpPath = $_FILES['fileUpload']['tmp_name'];
        $fileName = $_FILES['fileUpload']['name'];
        $fileSize = $_FILES['fileUpload']['size'];
        $fileType = $_FILES['fileUpload']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
        //check if file is inside the array of supported files
        if (in_array($fileExtension, $allowedfileExtensions)) {
            //sanitize file-name
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = "uploads/";
            $dest_path = $uploadFileDir . $newFileName;
            move_uploaded_file($fileTmpPath, $dest_path);
            $filemsg = "";
            //if file is not is not supported 
        } else {
            $fileTmpPath = "";
            $dest_path = "";
            $fileUpload_err = "File type is not supported";
        }
//if there is no uploaded file
    } else {
        $fileTmpPath = "";
        $dest_path = "";
        $fileUpload_err = "No image was uploaded";
    }

    if (empty($title_err) && empty($detail_err) && empty($date_err) && empty($game_err) && empty($fileUpload_err)) {
        $sql = "INSERT INTO news (title, detail, date, game, image) VALUES (?, ?, ?, ?, ?)";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("sssss", $param_title, $param_detail, $param_date, $param_game, $param_dest_path);
            $param_title = $title;
            $param_detail = $detail;
            $param_date = $date;
            $param_game = $game;
            $param_dest_path = $dest_path;
            if ($stmt->execute()) {
                // Redirect to login page
                echo "<script>alert('News Added Successfully! Redirecting to Admin News..');window.location.href='adminNews.php';</script>";
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
    $mysqli->close();
}
?>
<!DOCTYPE html>


<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <title>Add News</title>

        <style>
            * {
                padding: 0;
                box-sizing: border-box;
            }

            @keyframes fadeIn {
                0% {
                    opacity: 0;
                }
                100% {
                    opacity: 1;
                }
            }

            @font-face {
                font-family: "Kanit";
                src: url('Kanit-Regular.ttf');
            }

            body {
                background-color: black;
                font-family: "Kanit";
                animation: 3s fadeIn;
            }

            .announce-container {
                margin-bottom: 7%;
                margin-left: 20%;
                margin-right: 20%;
                padding-top: 6%;
            }

            .announce-container fieldset {
                border: none;
            }

            .announce-container fieldset h1 {
                color: white;
                text-transform: uppercase;
                font-size: 40px;
                border-bottom: 4px #0E399E solid;
                display: inline-block;
                margin-bottom: 5%;
            }

            .add-announ fieldset {
                border: none;
            }

            .add-announ h1 {
                font-size: 40px;
                color: white;
                text-transform: uppercase;
            }

            .add-announ {
                background-color: #084298;
                text-align: center;
                border-radius: 30px;
                padding-top: 5%;
                padding-bottom: 5%;
            }

            .add-announ .add-title label {
                display:block;
                font-size: 30px;
                width: 15%;
                margin: 0 auto;
                border-bottom: 3.5px black solid;
                text-transform: uppercase;
            }

            .add-announ .add-title input {
                margin-top: 3%;
                padding: 0.7%;
                background: #06357a;
                color: white;
                border: 1px #383838 solid;
                border-radius: 6px;
                font-size: 20px;
            }

            .add-announ .add-title input:focus {
                outline: none;
            }

            .add-announ .add-description label {
                display: block;
                font-size: 30px;
                width: 25%;
                margin: 0 auto;
                border-bottom: 3.5px black solid;
                text-transform: uppercase;
            }

            .add-announ .add-description textarea {
                padding: 1%;
                background: #06357a;
                color: white;
                font-size: 18px;
                border: 1px #383838 solid;
                border-radius: 10px;
            }

            .add-announ .add-description textarea:focus {
                outline: none;
            }

            .submit-cancel {
                text-align: center;
                margin-top: 4%;
            }

            .submit-cancel button{
                color: white;
                background-color: transparent;
                border: 3px rgba(0, 0, 255, 0.6) solid;
                border-radius: 20px;
                padding: 10px 20px;
                text-decoration: none;
                font-family: kanit;
                cursor:pointer;
                transition: all 0.5s;
            }


            .submit-cancel button:hover {
                background-color: rgba(0, 0, 255, 0.6);
                transition: all 0.5s;
            }

            input::file-selector-button {
                color: white;
         
                padding: 5px 10px 5px 10px;
                background-color: black;
                border: none;
                border-radius: 10px;
                cursor: pointer;
                font-family: kanit;
                  transition: all 0.25s;
            }
             input::file-selector-button:hover {
                
                color:rgba(0, 0, 255, 0.6);
                 transition: all 0.5s;
            }

            .invalid-feedback{

                color:rgb(220, 20, 60);
                font-size: 12px;
                margin:0;

            }
            .inputt{
                width:70%;
            }

            .fileinput{
                margin-top:20px;
            }

        </style>  
    </style>
</head>

<body>
    <?php
    include 'adminNav.php';
    ?>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" >
        <div class="announce-container">
            <fieldset>
                <h1>Add News</h1>
                <div class="add-announ">
                    <div class="add-title">
                        <label>Title</label>
                        <input type="text" id="announTitle" name="title" class="inputt <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>"required>
                    </div>
                    <h4 class="invalid-feedback"><?php echo $title_err; ?></h4>
                    <br/>
                    <div class="add-description">
                        <label for="announDesc">Details</label><br/>
                        <textarea rows="5" cols="60" id="announDesc" name="detail" class="<?php echo (!empty($detail_err)) ? 'is-invalid' : ''; ?>"><?=$detail?></textarea>
                    </div>
                    <h4 class="invalid-feedback"><?php echo $detail_err; ?></h4>
                    <div class="add-title">
                        <label for="announTitle">Date</label>
                        <input type="date" id="announTitle" name="date" class="<?php echo (!empty($date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date; ?>" required>
                    </div>
                    <h4 class="invalid-feedback"><?php echo $date_err; ?></h4>
                    <div class="add-title">
                        <label for="announTitle">Game</label>
                        <input type="text" id="announTitle" name="game" class="inputt <?php echo (!empty($game_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $game; ?>" required>
                    </div>
                    <h4 class="invalid-feedback"><?php echo $game_err; ?></h4>

                    <div class="fileinput" >
                        <label for="announTitle">Image</label>
                        <input type="file" name="fileUpload" id="fileUpload" class="<?php echo (!empty($fileUpload_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fileUpload; ?>"    >
                    </div>
                    <h4 class="invalid-feedback"><?php echo $fileUpload_err; ?></h4>

                </div>
                <div class="submit-cancel">
                    <button type="submit" >Submit</button>
                </div>
            </fieldset>
        </div>
    </form>
</body>
<?php include 'adminFooter.php' ?>
<script>

</script>
</html>
