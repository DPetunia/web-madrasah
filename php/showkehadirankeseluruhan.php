<?php
    // Include the database connection file
    include('db/conection.php');

    $userCat = $_POST['userCat'];
    $userName = $_POST['userName'];
    $id = $_POST['id'];
    $hari = $_POST['hari'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

   // Specify the desired class order
   $classOrder = "'1A - Siddiq', '1B - Amanah', '2A - Abu Bakar', '2B - Umar', '3A - Iman', '3B - Islam', '4A - Firdaus', '4B - Naim', '5A - Sabar', '5B - Ikhlas', '6A - Ibnu Sinar', '6B - Ibnu Rushd'";

    // Fetch distinct classes from the database in the specified order
    $classQuery = "SELECT DISTINCT class FROM att ORDER BY FIELD(class, $classOrder)";
    $classResult = $conn->query($classQuery);

    // Fetch distinct attendance records for the specified class, month, and year
    $attQuery = "SELECT DISTINCT NamaPelajar, MyKidPelajar, class, kehadiran FROM att WHERE bulan='$bulan' AND tahun='$tahun' AND hari='$hari'";
    $attResult = $conn->query($attQuery);

    // Initialize arrays to store counts
    $attendanceCounts = [];
    while ($attRow = $attResult->fetch_assoc()) {
        $class = $attRow['class'];
        $kehadiran = $attRow['kehadiran'];
        $NamaPelajar = $attRow['NamaPelajar'];
        $MyKidPelajar = $attRow['MyKidPelajar'];

        // Fetch gender from student table
        $studentQuery = "SELECT Jantina FROM student WHERE NamaPelajar='$NamaPelajar' AND MyKidPelajar='$MyKidPelajar'";
        $studentResult = $conn->query($studentQuery);
        $studentRow = $studentResult->fetch_assoc();
        $jantina = $studentRow['Jantina'];

        // Initialize counts for each class if not already set
        if (!isset($attendanceCounts[$class])) {
            $attendanceCounts[$class] = [
                'hadir_lelaki' => 0,
                'hadir_perempuan' => 0,
                'TH_lelaki' => 0,
                'TH_perempuan' => 0,
                'bersebab_lelaki' => 0,
                'bersebab_perempuan' => 0,
            ];
        }

        // Increment counts based on attendance and gender
        if ($kehadiran == 'Hadir') {
            if ($jantina == 'Lelaki') {
                $attendanceCounts[$class]['hadir_lelaki']++;
            } else {
                $attendanceCounts[$class]['hadir_perempuan']++;
            }
        } elseif ($kehadiran == 'TH') {
            if ($jantina == 'Lelaki') {
                $attendanceCounts[$class]['TH_lelaki']++;
            } else {
                $attendanceCounts[$class]['TH_perempuan']++;
            }
        } else {
            if ($jantina == 'Lelaki') {
                $attendanceCounts[$class]['bersebab_lelaki']++;
            } else {
                $attendanceCounts[$class]['bersebab_perempuan']++;
            }
        }
    }

    // Calculate total counts
    $totalCounts = [
        'hadir_lelaki' => 0,
        'hadir_perempuan' => 0,
        'TH_lelaki' => 0,
        'TH_perempuan' => 0,
        'bersebab_lelaki' => 0,
        'bersebab_perempuan' => 0,
    ];

    foreach ($attendanceCounts as $class => $counts) {
        $totalCounts['hadir_lelaki'] += $counts['hadir_lelaki'];
        $totalCounts['hadir_perempuan'] += $counts['hadir_perempuan'];
        $totalCounts['TH_lelaki'] += $counts['TH_lelaki'];
        $totalCounts['TH_perempuan'] += $counts['TH_perempuan'];
        $totalCounts['bersebab_lelaki'] += $counts['bersebab_lelaki'];
        $totalCounts['bersebab_perempuan'] += $counts['bersebab_perempuan'];
    }

    $totalStudents = array_sum($totalCounts);
    $totalHadir = $totalCounts['hadir_lelaki'] + $totalCounts['hadir_perempuan'];
    $totalTH = $totalCounts['TH_lelaki'] + $totalCounts['TH_perempuan'];
    $totalBersebab = $totalCounts['bersebab_lelaki'] + $totalCounts['bersebab_perempuan'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Show Kehadiran</title>
        <link rel="stylesheet" type="text/css" href="css/styles2.css">
        <link rel="icon" href="../src/logo.png">
        <style>
            .welcome-text {
                text-align: center; 
                font-family: comic sans ms;
            }
            .table-container {
                margin: 20px;
                width: 90%;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: #f9f9f9;
                overflow-x: auto; /* Enable horizontal scrolling if needed */
            }

            .table-container table[border="1"] {
                width: 100%;
                border-collapse: collapse; /* Merge table borders */
                table-layout: fixed; /* Fixed table layout to prevent stretching */
            }

            .table-container table[border="1"] th,
            .table-container table[border="1"] td {
                padding: 8px;
                text-align: center;
                border: 1px solid #ccc; /* Ensure borders within the table */
                vertical-align: middle; /* Center align text vertically */
                white-space: nowrap; /* Prevent cell content from wrapping */
                overflow: hidden; /* Hide overflow content */
                text-overflow: ellipsis; /* Show ellipsis (...) for overflow text */
            }

            .table-container table[border="1"] th {
                background-color: #f2f2f2; /* Light grey background for headers */
            }

            .table-container table[border="1"] td {
                background-color: #fff; /* White background for table cells */
            }

            .table-container h2 {
                font-family: comic sans ms;
            }
        </style>
    </head>
    <body>
        <div class="navbar">
            <marquee behavior="scroll" direction="left" scrollamount="5"><img src="../src/welcanalisakehadiran.png" class="leftnav"></marquee>
            <div class="rightnav">
                <img src="../src/logo.png">
                <form name="form" method="post" action="showkehadiranbulan.php">
                    <input type="hidden" value="<?php echo htmlspecialchars($id); ?>" name="id">
                    <input type="hidden" value="<?php echo htmlspecialchars($userCat); ?>" name="userCat">
                    <input type="hidden" value="<?php echo htmlspecialchars($userName); ?>" name="userName">
                    <button type="submit" class="navhomebtn">BACK</button>
                </form>
            </div>
        </div>
        <br><br>
        <div class="welcome-text">
            Selamat Datang : <?php echo htmlspecialchars($userName); ?> ( <?php echo htmlspecialchars($userCat); ?> )
        </div>
        <br>
        <input type="hidden" value="<?php echo htmlspecialchars($id); ?>" name="id">
        <input type="hidden" value="<?php echo htmlspecialchars($userCat); ?>" name="userCat">
        <input type="hidden" value="<?php echo htmlspecialchars($userName); ?>" name="userName">
        <center>
        <div class="table-container">
        <h2>Analisa Kehadiran Harian</h2>
            <table class="mctable">
                <tr>
                    <td>Tarikh</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($hari) . " - " .  htmlspecialchars($bulan) . " - " .  htmlspecialchars($tahun); ?></td>
                </tr>
            </table>
            <br>
            <table border="1">
                <tr>
                    <td rowspan="2">
                        <center><b>Kelas</b></center>
                    </td>
                    <th colspan="3">
                        <center>Hadir</center>
                    </th>
                    <th colspan="3">
                        <center>TH</center>
                    </th>
                    <th colspan="3">
                        <center>Bersebab</center>
                    </th>
                    <th colspan="3">
                        <center>Keseluruhan</center>
                    </th>
                </tr>
                <tr>
                    <?php for ($x=1; $x<=4; $x++): ?>
                        <td>
                            <center>Lelaki</center>
                        </td>
                        <td>
                            <center>Perempuan</center>
                        </td>
                        <td>
                            <center>Jumlah</center>
                        </td>
                    <?php endfor; ?>
                </tr>
                <?php while ($classRow = $classResult->fetch_assoc()): 
                    $class = $classRow['class'];
                    $counts = $attendanceCounts[$class] ?? [
                        'hadir_lelaki' => 0,
                        'hadir_perempuan' => 0,
                        'TH_lelaki' => 0,
                        'TH_perempuan' => 0,
                        'bersebab_lelaki' => 0,
                        'bersebab_perempuan' => 0,
                    ];

                    // Fetch total count of students by gender for the class
                    $totalLQuery = "SELECT COUNT(*) as totalL FROM student WHERE Jantina = 'Lelaki' AND class = '$class'";
                    $totalLResult = $conn->query($totalLQuery);
                    $totalLRow = $totalLResult->fetch_assoc();
                    $totalL = $totalLRow['totalL'];

                    $totalPQuery = "SELECT COUNT(*) as totalP FROM student WHERE Jantina = 'Perempuan' AND class = '$class'";
                    $totalPResult = $conn->query($totalPQuery);
                    $totalPRow = $totalPResult->fetch_assoc();
                    $totalP = $totalPRow['totalP'];

                    // Calculate overall totals for the class
                    $totalinclass = $totalL + $totalP ;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($class); ?></td>
                    <td><center><?php echo $counts['hadir_lelaki']; ?></center></td>
                    <td><center><?php echo $counts['hadir_perempuan']; ?></center></td>
                    <td><center><?php echo $counts['hadir_lelaki'] + $counts['hadir_perempuan']; ?></center></td>
                    <td><center><?php echo $counts['TH_lelaki']; ?></center></td>
                    <td><center><?php echo $counts['TH_perempuan']; ?></center></td>
                    <td><center><?php echo $counts['TH_lelaki'] + $counts['TH_perempuan']; ?></center></td>
                    <td><center><?php echo $counts['bersebab_lelaki']; ?></center></td>
                    <td><center><?php echo $counts['bersebab_perempuan']; ?></center></td>
                    <td><center><?php echo $counts['bersebab_lelaki'] + $counts['bersebab_perempuan']; ?></center></td>
                    <td><center><?php echo $totalL; ?></center></td>
                    <td><center><?php echo $totalP; ?></center></td>
                    <td><center><?php echo $totalinclass; ?></center></td>
                </tr>
                <?php endwhile; ?>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <!-- <tr>
                    <td><b>Total</b></td>
                    <td><center><?php echo htmlspecialchars($totalCounts['hadir_lelaki']); ?></center></td>
                    <td><center><?php echo htmlspecialchars($totalCounts['hadir_perempuan']); ?></center></td>
                    <td><center><?php echo htmlspecialchars($totalHadir); ?></center></td>
                    <td><center><?php echo htmlspecialchars($totalCounts['TH_lelaki']); ?></center></td>
                    <td><center><?php echo htmlspecialchars($totalCounts['TH_perempuan']); ?></center></td>
                    <td><center><?php echo htmlspecialchars($totalTH); ?></center></td>
                    <td><center><?php echo htmlspecialchars($totalCounts['bersebab_lelaki']); ?></center></td>
                    <td><center><?php echo htmlspecialchars($totalCounts['bersebab_perempuan']); ?></center></td>
                    <td><center><?php echo htmlspecialchars($totalBersebab); ?></center></td>
                    <td>
                        <center>
                            <?php
                            // Fetch total count of students by gender for the class
                            $sumtotalLQuery = "SELECT COUNT(*) as sumtotalL FROM student WHERE Jantina = 'Lelaki'";
                            $sumtotalLResult = $conn->query($sumtotalLQuery);
                            $sumtotalLRow = $sumtotalLResult->fetch_assoc();
                            $sumtotalL = $sumtotalLRow['sumtotalL'];

                            echo $sumtotalL;
                            ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php
                            // Fetch total count of students by gender for the class
                            $sumtotalpQuery = "SELECT COUNT(*) as sumtotalP FROM student WHERE Jantina = 'Perempuan'";
                            $sumtotalpResult = $conn->query($sumtotalpQuery);
                            $sumtotalpRow = $sumtotalpResult->fetch_assoc();
                            $sumtotalP = $sumtotalpRow['sumtotalP'];

                            echo $sumtotalP;

                            ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php
                                $totalallStudents = $sumtotalL + $sumtotalP;
                                echo $totalallStudents;
                            ?>
                        </center>
                    </td>
                </tr> -->
            </table>
            <?php
                $percentageHadir = ($totalStudents > 0) ? ($totalHadir / $totalallStudents) * 100 : 0;
                $percentageTH = ($totalStudents > 0) ? ($totalTH / $totalallStudents) * 100 : 0;
                $percentageBersebab = ($totalStudents > 0) ? ($totalBersebab / $totalallStudents) * 100 : 0;
            ?>
            <br><br>
            <table border="1">
                <tr>
                    <td>Jumlah Murid Hadir</td>
                    <td><center><?php echo $totalHadir; ?> / <?php echo $totalallStudents; ?></center></td>
                    <td>Jumlah Murid TH</td>
                    <td><center><?php echo $totalTH; ?> / <?php echo $totalallStudents; ?></center></td>
                    <td>Jumlah Murid TH Bersebab</td>
                    <td><center><?php echo $totalBersebab; ?> / <?php echo $totalallStudents; ?></center></td>
                </tr>
                <tr>
                    <td>Peratus Murid Hadir</td>
                    <td><center><?php echo number_format($percentageHadir, 2) . '%'; ?></center></td>
                    <td>Peratus Murid TH</td>
                    <td><center><?php echo number_format($percentageTH, 2) . '%'; ?></center></td>
                    <td>Peratus Murid TH Bersebab</td>
                    <td><center><?php echo number_format($percentageBersebab, 2) . '%'; ?></center></td>
                </tr>
            </table>
        </div>
        </center>
    </body>
</html>