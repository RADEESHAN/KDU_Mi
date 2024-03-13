                                                                       <!--farmer_model------>


<!--database ekka ganudenu karana dewal krnne meke-->

<?php

require_once("db_connection.php");  // db connection eka methanata gannwa
   
class Medical
{
    private $conn; // connection eka
    private $table = "medicalapply";  //table eka
   
    
    

    public function __construct($conn) // uda nikan db eka gattata ba mekath one aniwa   //$conn db connection eken gnna eka constructor para meter ekakin danwa
    {
        $this->conn = $conn; // gatta eka mekata assign kara gnnwa
    }

    // form eke data db ekata add krna wada krnne meke
    protected function setNewMedical($email,$regno,$firstname, $intake, $phonenumber,$dept, $sdate, $edate,$subdate,$missLec,$uimg)
    {

        $sql = "INSERT INTO $this->table(email,regno,firstname,intake,phonenumber,dept,	sdate,edate,subdate,misslec,ufile,DocStatus,HODstatus,ARstatus) " .
            "VALUES('$email','$regno','$firstname', '$intake',' $phonenumber','$dept', '$sdate',' $edate','$subdate','$missLec','$uimg','pending','pending','pending')";
       
       $result   = $this->conn->query($sql);

    
        return $result;
    }

    
  }

?>