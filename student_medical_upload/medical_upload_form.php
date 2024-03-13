
 <?php
$response = isset($_GET["response"]) ? $_GET["response"] : "";
$status = isset($_GET["res_status"]) ? $_GET["res_status"] : "";
$email = isset($_SESSION["otp"]) ? $_SESSION["otp"]["email"] : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Entry</title>
    <!-- Include CSS and JS libraries -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../assests/fontawesome/fontawesome-free-5.15.3-web/css/all.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.js" integrity="sha384-VhH3ZaP1K0jHLadPhO2Jeveq5paL+3nAI7a99P2n9DzloWp5rr3w9Aa0bPEJ3hqD6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.css" integrity="sha384-ItwE8LS4yjq/7F6znuHx3pU5vc9AosD8MVc/qWGofoSg5vVqx2fr6of2l8S7BfGt" crossorigin="anonymous">
</head>
<body>
    <!-- Response Alert -->
    <div class="container">
        <?php if ($status == "1") { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 style="color: green;"><?php echo $response; ?></h3>
            </div>
        <?php } else if ($status == "0") { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 style="color: red;"><?php echo $response; ?></h3>
            </div>
        <?php } ?>
    </div>
    <!-- Response Alert End -->

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">Enter your details for Apply Medical.</h1>
            </div>
            <div class="card-body">
                <form id="medi_upload_form" enctype="multipart/form-data" method="POST" action="medi_upload_controller.php?type=addmedical">
                <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Email <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label"> Register Number <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="text" name="regno" id="regno" class="form-control" required onblur="getUserData()">
                            </div>
                        
                        </div>




                        <!--fname and lname-->
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Full Name <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="text" name="firstname" id="firstname" class="form-control" required>
                            </div>
                            <div class="col-sm-2 text-muted">
                            <label for="intakeSelect" class="control-label">Intake <i class="text-danger">*</i></label>
                        </div>
                        <div class="col-sm-4 text-muted">
                            <select name="intake" id="intakeSelect" class="form-control" required>
                                <option value="intake39">Intake 39</option>
                                <option value="intake38">Intake 38</option>
                                <option value="intake37">Intake 37</option>
                                <option value="intake40">Intake 40</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        </div>



                        <!--contact number-->
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Contact Number <i class="text-danger">*</i>
                                </label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">0</span>
                                    </div>
                                    <input type="number" name="phonenumber" id="phonenumber" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-2 text-muted">
                            <label for="deptSelect" class="control-label">Department <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                            <select name="dept" id="deptSelect" class="form-control" required>
                            <option value="IT">IT</option>
                            <option value="department2">QS</option>
                            <option value="servay">servay</option>
                            <option value="Archi">Archi</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                        </div>


                        <h5 >Absent Time period</h5>
                            <div class="row">
                            <div class="col">
                            <label for="">Start date</label>
                                <input id= "sdate" name="sdate" type="date" class="form-control" required>
                            </div>
                            <div class="col">
                            <label for="">End date</label>
                                <input name="edate" type="date" class="form-control" required>
                            </div>
                            </div>


                            <div class="row mt-3">
                            <div class="col-sm-6 text-muted">
                                <label for="">Submit date</label>
                                <input name="subdate" type="date" class="form-control" required>
                                </div>
                            <div class="col-sm-6 text-muted">
                                <label for="" class="control-label">Miss Lectures <i class="text-danger">*</i></label>
                                <div class="col">
                                 <textarea class="form-control" name="missLec" id="missLec" rows="2" required></textarea>
                                </div>
                             </div>

                        
                             </div>



                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Medical File</label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="file" name="uimg" id="uimg" class="form-control-file" onchange="readURL(this);">
                                <!-- Image Preview -->
                                <div>
                                    <img id="prev_img" alt="">
                                </div>
                                <!-- Preview End -->
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-4 text-muted">
                                <button id="submit" type="submit" class="btn btn-block button text-white text-uppercase btn btn-primary"><i class="fad fa-save"></i>&nbsp; &nbsp; Upload</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#medi_upload_form").on("submit", function (e) {
                e.preventDefault(); // Prevent form submission to perform client-side validation

                let email = $("#email").val();
                let regno = $("#regno").val();
                let phonenumber = $("#phonenumber").val();
                let sdate = new Date($("#sdate").val());
                let edate = new Date($("#edate").val());
                let subdate = new Date($("#subdate").val());
                const emailPattern = /^[a-zA-Z0-9._%+-]+@(gmail\.com|kdu\.ac\.lk)$/i;
                const regnoPattern = /^[CMDBIS][IQTARC]+[0-9]{2}\/[0-9]{4}$/;
                const phonenumberPattern = /^(07[012678][0-9]{7})$/;
                const today = new Date();

                if (!emailPattern.test(email)) {
                    Swal.fire("Please enter a valid email", "", "error");
                    return;
                }

                if (!regnoPattern.test(regno)) {
                    Swal.fire("Please enter a valid Registration Number", "", "error");
                    return;
                }

                if (!phonenumberPattern.test(phonenumber)) {
                    Swal.fire("Enter a valid Phone Number", "", "error");
                    return;
                }

                if (sdate > today) {
                    Swal.fire("Enter a valid start date", "", "error");
                    return;
                }

                if (edate > today || edate < sdate) {
                    Swal.fire("Enter a valid end date", "", "error");
                    return;
                }

                if (subdate.toDateString() !== today.toDateString()) {
                    Swal.fire("Enter a valid submit date", "", "error");
                    return;
                }

                // If all validations pass, submit the form
                this.submit();
            });

            // Image preview code (unchanged)
            function readURL(input) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        $("#prev_img").attr("src", e.target.result).width(80).height(70);
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $("#prev_img").attr("src", "");
                }
            }
        });
    </script>

</body>
</html>