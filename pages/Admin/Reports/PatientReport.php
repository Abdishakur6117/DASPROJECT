<?php
session_start();

// Check if the user is logged in and has the 'Admin' role
if (!isset($_SESSION['user']) || $_SESSION['role'] != 'Admin') {
    // Redirect to login page if not logged in or not an Admin
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Regal Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../../vendors/base/vendor.bundle.base.css">
  <!-- end inject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="../../../vendors/select2/select2.min.css">
  <link rel="stylesheet" href="../../../vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../../css/style.css">
  <!-- end inject -->
  <link rel="shortcut icon" href="../../../images/favicon.png" />
  <!-- links assets -->
  <!-- <link rel="stylesheet" href="../assets/css/bootstrap.min.css" > -->
  <link rel="stylesheet" href="../../assets/css/jquery.dataTables.min.css" >
  <!-- end links assets -->
  <style>
    .footer {
    position: fixed;
    bottom: 0;
    width: calc(118% - 280px); /* Default width marka sidebar furan */
    transition: width 0.3s ease-in-out;
}
table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
  </style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../../partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search Projects.." aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown d-flex mr-4 ">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
              <!-- <i class="icon-cog"></i> -->
              <i class="icon-head"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Profile</p>
              <p class="mb-0 font-weight-normal float-left dropdown-header">Email: <?= htmlspecialchars($_SESSION['email']); ?></p>
              <a class="dropdown-item preview-item hover:cursor-pointer" href="../Profile/profile.php">               
                  <i class="icon-head"></i>
                  <span class="menu-title">Profile</span> 
              </a>
              <a class="dropdown-item preview-item cursor-pointer" href="../../../logout.php">
                  <i class="icon-inbox"></i> 
                  <span class="menu-title">Logout</span>
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav mt-5">
          <li class="nav-item">
            <a class="nav-link" href="../../../index.php">
              <i class="icon-box menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../../pages/Admin/Users/Users.php">
              <!-- <i class="icon-file menu-icon"></i> -->
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Users</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../../pages/Admin/Doctors/Doctors.php">
              <!-- <i class="icon-file menu-icon"></i> -->
              <span class="menu-title">Doctors</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../../pages/Admin/Patients/Patients.php">
              <!-- <i class="icon-pie-graph menu-icon"></i> -->
              <span class="menu-title">Patients</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <!-- <i class="icon-disc menu-icon"></i> -->
              <span class="menu-title">Appointments</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../../../pages/Admin/AcceptAppointment/Accept.php">Accept Appointment</a></li>
                <li class="nav-item"> <a class="nav-link" href="../../../pages/Admin/RejectAppointment/Reject.php">Reject Appointment</a></li>
                <li class="nav-item"> <a class="nav-link" href="../../../pages/Admin/Appointments/AllAppointment.php">All Appointment</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../../pages/Admin/Payments/Payments.php">
              <!-- <i class="icon-help menu-icon"></i> -->
              <span class="menu-title">Payments</span>
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <!-- <i class="icon-disc menu-icon"></i> -->
                <span class="menu-title">Reports</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="../../../pages/Admin/Reports/DoctorReport.php"> Doctor of Reports </a></li>
                  <li class="nav-item"> <a class="nav-link" href="../../../pages/Admin/Reports/PatientReport.php">Patient of  Report</a></li>
                </ul>
              </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="body">
            <h2>Search Doctor</h2>

              <label for="patient_name">Patient Name:</label>
              <input type="text" id="patient_name" placeholder="Enter Patient Name">
              <button onclick="searchPatient()">Search</button>

              <h3>Patient Details:</h3>
              
              <table id="patient_table" style="display: none;">
                  <thead>
                      <tr>
                          <th>Patient Name</th>
                          <th>DOB</th>
                          <th>Gender</th>
                          <th>Blood Type</th>
                          <th>Address</th>
                          <th>Registration Date</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody id="patient_info">
                  </tbody>
              </table>

          </div> 

        <!-- content-wrapper ends -->
        <!-- partial:../../../partials/_footer.html -->
        <!-- partial -->
      </div>
      <footer class="footer bg-light text-center py-3">
        <div class="container">
            <span class="text-muted">Copyright © bootstrap.com 2025</span>
        </div>
    </footer>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- script bootstrap -->
  <script src="../../assets/js/jquery-3.5.1.min.js" rel="stylesheet"></script>
  <script src="../../assets/js/jquery.dataTables.min.js" rel="stylesheet"></script>
 <!-- scripts -->
  <!-- container-scroller -->
   <!-- scripts -->

    <script>
        function searchPatient() {
          var patientName = $("#patient_name").val();

          if (patientName == "") {
              alert("Please enter  Patient Name.");
              return;
          }

          $.ajax({
              url: "report_action.php?url=getPatient",
              type: "POST",
              data: { patient_name: patientName,  },
              dataType: "json",
              success: function(response) {
                  if (response.status == "success") {
                      var patient = response.data;
                      var patientRow = "<tr>" +
                                          "<td>" + patient.fullName + "</td>" +
                                          "<td>" + patient.date_of_birth + "</td>" +
                                          "<td>" + patient.gender + "</td>" +
                                          "<td>" + patient.blood_type + "</td>" +
                                          "<td>" + patient.address + "</td>" +
                                          "<td>" + patient.registration_date + "</td>" +
                                          "<td><button class='generate_report_btn' data-patient='" + JSON.stringify(patient) + "'>Generate Report</button></td>" +
                                      "</tr>";
                      $("#patient_info").html(patientRow);
                      $("#patient_table").show();
                  } else {
                      $("#patient_info").html("<tr><td colspan='5' style='color:red;'>Patient not found.</td></tr>");
                      $("#patient_table").show();
                  }
              }
          });
       }

      $(document).on('click', '.generate_report_btn', function() {
          var patient = $(this).data("patient");
          
          if (patient && patient.patient_id) { // Ensure patient_id exists
              var reportUrl = "Patient.php?patient_id=" + encodeURIComponent(patient.patient_id) + 
                              "&fullName=" + encodeURIComponent(patient.fullName) +
                              // ... other parameters ...
                              "&registration_date=" + encodeURIComponent(patient.registration_date);
              window.open(reportUrl, "_blank");
          } else {
              alert("Patient ID is missing. Cannot generate report.");
          }
      });


    </script>


     <script src="../../assets/js/bootstrap.bundle.min.js" rel="stylesheet"></script>
   <!-- end scripts -->
  <!-- base:js -->
  <!-- <script src="../../../vendors/base/vendor.bundle.base.js"></script> -->
  <!-- end inject -->
  <!-- inject:js -->
  <script src="../../../js/off-canvas.js"></script>
  <script src="../../../js/hoverable-collapse.js"></script>
  <script src="../../../js/template.js"></script>
  <!-- end inject -->
  <!-- plugin js for this page -->
  <script src="../../../vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../../../vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../../../js/file-upload.js"></script>
  <script src="../../../js/typeahead.js"></script>
  <script src="../../../js/select2.js"></script>
  <!-- End custom js for this page -->
</body>

</html>
