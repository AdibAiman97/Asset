<?php
include "conn/conn.php";
error_reporting(0);
session_start();
if (empty($_SESSION['UserID']) AND empty($_SESSION['Password'])) {
    header('location:index.php');
} else {
?>

<!DOCTYPE html>
<html lang="en">

<!-- head -->
<?php include "layout/head.php";?>

<style>
    .table td img, .table th img {
        border-radius: 20%;
    }

    .table td img, .table th img {
        width: 150px;
        height: 150px;
    }

    .card-body::-webkit-scrollbar {
        width: 8px;
    }

    .card-body::-webkit-scrollbar-thumb {
        background-color: #ffaf00; /* Customize scrollbar color */
        border-radius: 10px;
    }

    .card-body::-webkit-scrollbar-track {
        background-color: #f1f1f1; /* Customize scrollbar track color */
        border-radius: 10px;
    }

    /* Ensure content fits in one page */
    @media print {
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact;
            overflow: hidden; /* Prevent scrolling in printed version */
        }

        .container-fluid {
            padding: 0;
            margin: 0;
        }

        .row, .card {
            margin: 0;
            padding: 5px;
            page-break-inside: avoid; /* Avoid breaking rows and cards across pages */
        }

        .page-wrapper, .body-wrapper {
            margin: 0;
            padding: 0;
            height: 100vh; /* Force content to fit within a page height */
            overflow: hidden;
        }

        .button-group {
            display: none !important; /* Ensure download button is hidden when printing */
        }
    }
	.sticky-btn {
		position: sticky;
		top: 10px; /* Distance from the top of the container */
		z-index: 1000; /* Ensure it stays above other elements */
	}

</style>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include "layout/top.php";?>
	
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
       <?php include "layout/menu.php";?>
	   
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <!-- Align the button to the right -->
                <div class="d-flex justify-content-end">
                  <button id="downloadBtn" class="btn btn-warning mr-3 mt-3" onclick="downloadPDF()">
                    <i class="mdi mdi-excel"></i> Save PDF
                  </button>

                     <!-- XLS Download Button -->
    <a href="download.php" class="btn btn-success mt-3">
        <i class="mdi mdi-file-excel"></i> Download XLS
    </a>
                </div>
                <div id="printable-section" class="card-body" style="max-height: 540px; overflow-y: auto;">
                  <h1 class="display-5 font-weight-bold">
                    <i class='menu-icon hgi-stroke hgi-qr-code-01'></i> List of QR Code Asset
                  </h1>
                  <div class="table-responsive mt-4">
                    <table class="table table-sm dataTable no-footer" role="grid">
                      <thead>
                        <tr>
                          <th>ID Asset</th>
                          <th>Categories</th>
                          <th>Sub Categories</th>
                          <th>Type</th>
                          <th>Brand / Model</th>
                          <th>Quantity</th>
                          <th>QR Code</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $sql = mysqli_query($conn, "SELECT * FROM asset ORDER BY asset_id ASC");
                        while ($row = mysqli_fetch_array($sql)) {
                            echo "<tr>
                                    <td><label class='badge badge-pill badge-warning'>$row[asset_id]</label></td>
                                    <td>$row[category]</td>
                                    <td>$row[sub_category]</td>
                                    <td>$row[type]</td>
                                    <td>$row[brand]</td>
                                    <td>$row[quantity]</td>
                                    <td><img src='qrcode/$row[qrcode]'></td>
                                  </tr>";
                        }
                      ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php include "layout/footer.php";?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <!-- plugins:js -->
  <!-- SCRIPT -->
  <?php include "layout/script.php";?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

  <script>
    function downloadPDF() {
        var element = document.getElementById('printable-section');

        html2pdf(element, {
            margin: 0.1,
            filename: 'QR Code Asset ' + '.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, logging: true, dpi: 192, letterRendering: true },
            jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
        });
    }
  </script>
</body>
</html>

<?php
}
?>
