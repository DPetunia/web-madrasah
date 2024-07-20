<?php
    // Include the database connection file
    include('db/conection.php');

    $userCat = $_POST['userCat'];
    $userName = $_POST['userName'];
    $id = $_POST['id'];
    $hari = $_POST['hari'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $class = $_POST['class'];
    $tarikh = $hari . " - " . $bulan . " - " . $tahun;

    // Fetch students from the database for the specified class
    $studentQuery = "SELECT NamaPelajar, MyKidPelajar FROM student WHERE class = '$class'";
    $studentResult = $conn->query($studentQuery);

    // Fetch existing attendance records from the att table
    $attendanceQuery = "SELECT NamaPelajar, MyKidPelajar, kehadiran FROM att WHERE hari='$hari' AND bulan='$bulan' AND tahun='$tahun' AND class='$class' AND NamaGuru='$userName'";
    $attendanceResult = $conn->query($attendanceQuery);

    // Create an associative array to store existing attendance data
    $attendanceData = [];
    while ($attendanceRow = $attendanceResult->fetch_assoc()) {
        $attendanceData[$attendanceRow['MyKidPelajar']] = $attendanceRow['kehadiran'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MADRASAH AN-NUR - KEHADIRAN PELAJAR</title>
        <link rel="stylesheet" type="text/css" href="css/styles2.css">
        <link rel="icon" href="../src/logo.png">
        <style>
            /* Styling for the table */
            .updatekehadiran {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                font-size: 18px;
                text-align: left;
            }

            /* Styling for the table header */
            .updatekehadiran th, .updatekehadiran td {
                padding: 12px 15px;
                border: 1px solid #ddd;
            }

            /* Styling for the table header */
            .updatekehadiran th {
                background-color: #f4f4f4;
                font-weight: bold;
            }

            /* Center the text in the table cells */
            .updatekehadiran td {
                text-align: center;
            }

            /* Styling for the select input */
            .updatekehadiran select {
                padding: 8px;
                border-radius: 4px;
                border: 1px solid #ccc;
                font-size: 16px;
                width: 100%;
            }

            /* Styling for the input text */
            .updatekehadiran input[type="text"] {
                width: 100%;
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
                margin-top: 20px;
            }

            .resultButton:hover {
                background-color: #0056b3;
            }

            .center-content {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            .table-container {
                margin: 20px auto;
                padding: 20px;
                background-color: #f8f9fa;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 90%;
                text-align: center;
            }

            .welcome-text {
                text-align: center;
                font-family: comic sans ms;
            }

            .button-row {
                text-align: center;
            }

            .table-container h2{
                font-family: comic sans ms;
            }
        </style>
    </head>
    <body>
        <div class="navbar">
            <marquee behavior="scroll" direction="left" scrollamount="5"><img src="../src/welckemaskinikehadiran.png" class="leftnav"></marquee>
            <div class="rightnav">
                <img src="../src/logo.png">
                <form name="form" method="post" action="studentkehadiran.php">
                    <input type="hidden" value="<?php echo $id ?>" name="id">
                    <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                    <input type="hidden" value="<?php echo $userName ?>" name="userName">
                    <button type="submit" class="navhomebtn">BACK</button>
                </form>
            </div>
        </div>
        <br><br>
        <div class="welcome-text">
        Selamat Datang : <?php echo $userName;?> ( <?php echo $userCat?> )
        </div>
        <br>
        <div class="table-container">
        <h2>Kehadiran Murid</h2>
            <table class="tablekehadiran">
                <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td><?php echo $class;?></td>
                    <td>Nama Guru</td>
                    <td>:</td>
                    <td><?php echo $userName;?></td>
                </tr>
                <tr>
                    <td>Tarikh</td>
                    <td>:</td>
                    <td><?php echo $tarikh;?></td>
                </tr>
            </table>
            <br>
            <form method="post" action="updatekenadiran.php">
                <input type="hidden" value="<?php echo $id ?>" name="id">
                <input type="hidden" value="<?php echo $userCat ?>" name="userCat">

                <input type="hidden" value="<?php echo $userName ?>" name="userName">
                <input type="hidden" value="<?php echo $class ?>" name="class">
                <input type="hidden" value="<?php echo $hari ?>" name="hari">
                <input type="hidden" value="<?php echo $bulan ?>" name="bulan">
                <input type="hidden" value="<?php echo $tahun ?>" name="tahun">
                <input type="hidden" value="<?php echo $tarikh ?>" name="tarikh">
                <table class="updatekehadiran">
                    <tr>
                        <th>Bil</th>
                        <th>Nama Pelajar</th>
                        <th>No. Mykid</th>
                        <th>Kehadiran</th>
                    </tr>
                    <?php
                    $bil = 1;
                    while ($studentRow = $studentResult->fetch_assoc()) {
                        $NamaPelajar = $studentRow['NamaPelajar'];
                        $mykid = $studentRow['MyKidPelajar'];
                        $kehadiran = isset($attendanceData[$mykid]) ? $attendanceData[$mykid] : '';
                        echo "<tr>";
                        echo "<td>" . $bil++ . "</td>";
                        echo "<td>".htmlspecialchars($NamaPelajar)."<input type='hidden' value=".htmlspecialchars($NamaPelajar)." name='namaPelajar' readonly></td>";
                        echo "<td>".htmlspecialchars($mykid)."<input type='hidden' value=".htmlspecialchars($mykid)." name='mykid' readonly></td>";
                        echo "<td>";
                        if ($kehadiran) {
                            echo "<input type='text' name='kehadiran[]' value='".htmlspecialchars($kehadiran)."'readonly>";
                        } else {
                            echo "<select name='kehadiran[]'>";
                            echo "<option value=''>-- Pilih Kehadiran --</option>";
                            echo "<option value='Hadir'" . ($kehadiran == 'Hadir' ? ' selected' : '') . ">Hadir</option>";
                            echo "<option value='TH'" . ($kehadiran == 'TH' ? ' selected' : '') . ">TH</option>";
                            echo "</select>";
                            echo "</td>";
                        }
                            echo "</tr>";
                    }
                    ?>
                </table>
                <center><button type="submit" class="resultButton">Kemaskini</button></center>
            </div>
        </form>
    </body>
</html>
