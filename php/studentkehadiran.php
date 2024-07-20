<?php
    // Include the database connection file
    include('db/conection.php');

    $userCat = $_POST['userCat'];
    $userName = $_POST['userName'];
    $id = $_POST['id'];

    // Specify the desired class order
    $classOrder = "'1A - Siddiq', '1B - Amanah', '2A - Abu Bakar', '2B - Umar', '3A - Iman', '3B - Islam', '4A - Firdaus', '4B - Naim', '5A - Sabar', '5B - Ikhlas', '6A - Ibnu Sinar', '6B - Ibnu Rushd'";

    // Fetch distinct classes from the database in the specified order
    $classQuery = "SELECT DISTINCT class FROM student ORDER BY FIELD(class, $classOrder)";
    $classResult = $conn->query($classQuery);

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
        <title>MADRASAH AN-NUR - KEHADIRAN PELAJAR</title>
        <link rel="stylesheet" type="text/css" href="css/styles2.css">
        <link rel="icon" href="../src/logo.png">
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
                .button-row {
                    text-align: center;
                }
                 /* Styling for the form input */
                .input-field {
                    padding: 8px;
                    border-radius: 4px;
                    border: 1px solid #ccc;
                    font-size: 16px;
                    width: 100%; /* Adjust width as needed */
                }
                .table-container h2 {
                    font-family: comic sans ms;
                }
        </style>
    </head>
    <body>
        <div class="navbar">
            <marquee behavior="scroll" direction="left" scrollamount="5"><img src="../src/welckemaskinikehadiran.png" class="leftnav"></marquee>
            <div class="rightnav">
                <img src="../src/logo.png">
                <form name="form" method="post" action="selectstudentkehadiran.php">
                    <input type="hidden" value="<?php echo $id?>" name="id">
                    <input type="hidden" value="<?php echo $userCat?>" name="userCat">
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
        <form method="post" action="updatekenadirankelas.php">
            <center>
            <div class="table-container">    
                <input type="hidden" value="<?php echo $id ?>" name="id">
                <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                <input type="hidden" value="<?php echo $userName ?>" name="userName">
                <input type="hidden" name="hari"value="<?php echo $hari;?>">
                <input type="hidden" name="bulan"value="<?php echo $bulan;?>">
                <input type="hidden" name="tahun"value="<?php echo $tahun;?>">
                <table class="tablekehadiran">
                <h2>Kehadiran Murid</h2>
                    <tr>
                        <td>
                            Kelas
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <select name="class" required>
                                <?php if ($classResult->num_rows > 0): ?>
                                    <option value="">-- Pilih Kelas --</option>
                                    <?php while ($classRow = $classResult->fetch_assoc()): ?>
                                        <option value="<?php echo htmlspecialchars($classRow['class']); ?>" <?php if (!empty($class) && $class == $classRow['class']) echo 'selected'; ?>>
                                            <?php echo htmlspecialchars($classRow['class']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <option value="">-- Tiada data Kelas dalam database --</option>
                                <?php endif; ?>
                            </select>
                        </td>
                        <td>
                            Nama Guru
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <input type="text" name="staffname" value="<?php echo $userName;?>" readonly class="input-field">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Tarikh
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <select name="hari" required>
                                <option value="">-- Pilih Tarikh --</option>
                                <?php
                                    for ($trh = 1; $trh <= $daysInMonth; $trh++) {
                                ?>
                                        <option value="<?php echo $trh?>"><?php echo $trh?></option>
                                <?php
                                    }
                                ?>
                            </select>
                             - <?php echo $bulan;?> - <?php echo $tahun;?>
                        </td>
                    </tr>
                    <tr class="button-row">
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
