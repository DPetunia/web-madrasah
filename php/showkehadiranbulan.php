<?php
    // Include the database connection file
    include('db/conection.php');

    $userCat = $_POST['userCat'];
    $userName = $_POST['userName'];
    $id = $_POST['id'];

    // Fetch distinct classes from the database for the dropdown
    $classQuery = "SELECT DISTINCT class FROM att ORDER BY class ASC";
    $classResult = $conn->query($classQuery);
    
    $bulanQuery = "SELECT DISTINCT bulan FROM att ORDER BY STR_TO_DATE(CONCAT('1-', bulan, '-2020'), '%d-%M-%Y') ASC";
    $bulanResult = $conn->query($bulanQuery);
    
    $tahunQuery = "SELECT DISTINCT tahun FROM att ORDER BY STR_TO_DATE(CONCAT('1-', bulan, '-2020'), '%d-%M-%Y') ASC";
    $tahunResult = $conn->query($tahunQuery);

    // Get current date components
    $currentDate = getdate();
    $bulan = $currentDate['month'];
    $tahun = $currentDate['year'];
    // Convert month name to integer if necessary
    if (!is_numeric($bulan)) {
        $newbulan = date('m', strtotime($bulan));
    } else {
        $newbulan = intval($bulan);
    }

    // Calculate the number of days in the given month and year
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $newbulan, $tahun);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Show Kehadiran</title>
        <link rel="stylesheet" type="text/css" href="css/styles2.css">
        <link rel="icon" href="../src/logo.png">
        <script>
            function updateDays() {
                var bulan = document.getElementsByName('bulan')[0].value;
                var tahun = document.getElementsByName('tahun')[0].value;
                var daysDropdown = document.getElementsByName('hari')[0];
                
                // Clear existing options
                if(bulan != ""){
                    daysDropdown.innerHTML = '<option value="">-- Pilih Tarikh --</option>';
                }
                else{
                    daysDropdown.innerHTML = '<option value="">Pilih Bulan Dahulu</option>';
                }
                // Check if bulan and tahun are selected
                if (bulan && tahun) {
                    var month = new Date(Date.parse(bulan + " 1, " + tahun)).getMonth() + 1;
                    var daysInMonth = new Date(tahun, month, 0).getDate();
                    
                    // Populate days dropdown
                    for (var i = 1; i <= daysInMonth; i++) {
                        var option = document.createElement('option');
                        option.value = i;
                        option.text = i;
                        daysDropdown.add(option);
                    }
                }
            }
        </script>
        <style>
                /* Styling for the table container */
                .table-container {
                    margin: 20px auto;  /* Centering the container horizontally */
                    padding: 20px;
                    background-color: #f8f9fa;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    width: fit-content; /* Adjust width to content size */
                    text-align: center; /* Centering text */
                }

                /* Center form and its contents */
                .center-content {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    flex-direction: column; /* Stack children vertically */
                }

                /* Styling for the table */
                .tablekehadiran {
                    border-collapse: separate;
                    border-spacing: 0;
                    font-family: Arial, sans-serif;
                    margin: 0 auto; /* Centering the table */
                }

                /* Styling for the table cells */
                .tablekehadiran th, .tablekehadiran td {
                    padding: 12px;
                    text-align: left;
                    border: none;
                }

                /* Styling for the table headers */
                .tablekehadiran th {
                    background-color: #4CAF50;
                    color: white;
                }

                /* Styling for the form select inputs */
                .tablekehadiran select {
                    padding: 8px;
                    border-radius: 4px;
                    border: 1px solid #ccc;
                    font-size: 16px;
                }

                /* Styling for the submit button */
                .resultButton {
                    background-color: #007bff;
                    color: white;
                    border: none;
                    padding: 10px 20px;
                    font-size: 16px;
                    cursor: pointer;
                    border-radius: 5px;
                    transition: background-color 0.3s ease;
                }

                .resultButton:hover {
                    background-color: #0056b3;
                }

                .welcome-text {
                    text-align: center;
                    font-family: comic sans ms;
                }

                .table-container h2{
                    font-family: comic sans ms;
                }
        </style>
    </head>
    <body>
        <div class="navbar">
            <marquee behavior="scroll" direction="left" scrollamount="5"><img src="../src/welcanalisakehadiran.png" class="leftnav"></marquee>
            <div class="rightnav">
                <img src="../src/logo.png">
                <?php 
                    if($userCat == "admin"){
                ?>
                    <form name="form" method="post" action="chooseanalisis.php">
                        <input type="hidden" value="<?php echo $id ?>" name="id">
                        <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                        <input type="hidden" value="<?php echo $userName ?>" name="userName">
                        <button type="submit" class="navhomebtn">BACK</button>
                    </form>
                <?php
                    }
                    else{
                ?>
                <form name="form" method="post" action="selectstudentkehadiran.php">
                    <input type="hidden" value="<?php echo $id ?>" name="id">
                    <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                    <input type="hidden" value="<?php echo $userName ?>" name="userName">
                    <button type="submit" class="navhomebtn">BACK</button>
                </form>
            <?php
                }
            ?>
            </div>
        </div>
        <br><br>
        <div class="welcome-text">
            Selamat Datang : <?php echo $userName;?> ( <?php echo $userCat?> )
        </div>
        <br>
            <form method="post" action="showkehadirankeseluruhan.php">
            <center>
            <div class="table-container">
                <input type="hidden" value="<?php echo $id ?>" name="id">
                <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                <input type="hidden" value="<?php echo $userName ?>" name="userName">
                <table class="tablekehadiran">
                <h2>Analisa Kehadiran Harian</h2>
                    <tr>
                        <td>
                            Tarikh
                        </td>
                        <td>
                            :
                        </td>
                        <td colspan="4">
                            <select name="hari" required>
                                <option value="">Pilih Bulan Dahulu</option>
                            </select>
                            - 
                            <select name="bulan" required onchange="updateDays()">
                                <?php if ($bulanResult->num_rows > 0): ?>
                                    <option value="">-- Pilih Bulan --</option>
                                    <?php while ($BulanRow = $bulanResult->fetch_assoc()): ?>
                                        <option value="<?php echo htmlspecialchars($BulanRow['bulan']); ?>">
                                            <?php echo htmlspecialchars($BulanRow['bulan']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <option value="">-- Tiada data Bulan dalam database --</option>
                                <?php endif; ?>
                            </select>
                            - 
                            <select name="tahun" required onchange="updateDays()">
                                <?php if ($tahunResult->num_rows > 0): ?>
                                    <option value="">-- Pilih Tahun --</option>
                                    <?php while ($TahunRow = $tahunResult->fetch_assoc()): ?>
                                        <option value="<?php echo htmlspecialchars($TahunRow['tahun']); ?>" <?php if (!empty($tahun) && $tahun == $TahunRow['tahun']) echo 'selected'; ?>>
                                            <?php echo htmlspecialchars($TahunRow['tahun']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <option value="">-- Tiada data Tahun dalam database --</option>
                                <?php endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <center><button type="submit" class="resultButton">Seterusnya</button></center>
                        </td>
                    </tr>
                </table>
            </div>
            </center>
        </form>
    </body>
</html>
