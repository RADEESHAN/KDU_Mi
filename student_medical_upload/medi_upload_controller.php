<?php

require_once("medi_upload_model.php");

$conn = $db_obj->getConnection();

class mediController extends Medical
{
    public function addNewMedical($email,$id,$fname, $intake, $con,$dept, $sdate, $edate,$subdate,$missLec,$uimg)
    {
        $result1 = $this->setNewMedical($email,$id,$fname, $intake, $con,$dept, $sdate, $edate,$subdate,$missLec,$uimg);
        
        if ($result1) {
            $response = "Medical Added Successfully";
        } else {
            $response = "Something went wrong. Task failed!";
        }
        
        return $response;
    }
}

$mediCont_obj = new mediController($conn);

$request = isset($_REQUEST["type"]) ? $_REQUEST["type"] : "";

switch ($request) {
    case 'addmedical':
        $email = trim($_POST["email"]);
        $regno= trim($_POST["regno"]);
        $firstname= trim($_POST["firstname"]);
        $intake= trim($_POST["intake"]);
        $phonenumber= trim($_POST["phonenumber"]);
        $dept= trim($_POST["dept"]);
        $sdate= trim($_POST["sdate"]);
        $edate= trim($_POST["edate"]);
        $subdate= trim($_POST["subdate"]);
        $missLec= trim($_POST["missLec"]);
   
        if ($_FILES["uimg"]["name"] != "") {
            $uimg_name = $_FILES["uimg"]["name"];
            $uimg_name_unique = time() . "_" . $uimg_name;
        
            $file_tmp = $_FILES['uimg']['tmp_name'];
        
            $upload_directory = "./image/";
        
            if (!file_exists($upload_directory)) {
                mkdir($upload_directory, 0755, true); // Create the directory if it doesn't exist
            }
        
            if (move_uploaded_file($file_tmp, $upload_directory . $uimg_name_unique)) {
                $response = $mediCont_obj->addNewMedical($email, $regno, $firstname, $intake, $phonenumber, $dept, $sdate, $edate, $subdate, $missLec, $uimg_name_unique);
                header("Location: medi_upload_controller.php?response=$response");
                echo $response;
            } else {
                $response = "Failed to move the uploaded file.";
                echo $response;
            }
        } else {
            $uimg_name = "default_img.jpg";
        }
 }
?>