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
    $namaPelajar = $_POST['namaPelajar'];
    $mykid = $_POST['mykid'];
    $kehadiran = $_POST['kehadiran'];
    $tarikh = $hari . " - " . $bulan . " - " . $tahun;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MADRASAH AN-NUR - KEHADIRAN PELAJAR</title>
        <link rel="stylesheet" type="text/css" href="css/styles2.css">
        <link rel="icon" href="../src/logo.png">
        <style>
        /* CSS styles for table container */
        .table-container {
            margin: 20px auto; /* Center the container horizontally */
            width: 80%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        /* Center content inside the table */
        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Center text within table cells */
        .table-container td {
            padding: 10px;
            text-align: left;
        }

        /* Style for the buttons */
        .table-container .submitbtn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease; /* Smooth transition */
            float: right; /* Align to the right */
        }

        /* Hover effect for buttons */
        .table-container .submitbtn:hover {
            background-color: #0056b3; /* Darker shade of blue on hover */
        }

        /* Style for input fields */
        .table-container input[type="text"],
        .table-container input[type="email"],
        .table-container select,
        .table-container textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .welcome-text {
            text-align: center; 
            font-family: comic sans ms;
        }
        .table-container h2 {
            text-align: center;
            font-family: comic sans ms;
        }
    </style>
    </head>
    <body>
        <div class="navbar">
            <marquee behavior="scroll" direction="left" scrollamount="5"><img src="../src/welckemaskinikehadiran.png" class="leftnav"></marquee>
            <div class="rightnav">
                <img src="../src/logo.png">
                <form name="form" method="post" action="studentmc.php">
                    <input type="hidden" value="<?php echo $id ?>" name="id">
                    <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                    <input type="hidden" value="<?php echo $userName ?>" name="userName">
                    <input type="hidden" value="<?php echo $class ?>" name="class">
                    <input type="hidden" value="<?php echo $hari ?>" name="hari">
                    <input type="hidden" value="<?php echo $bulan ?>" name="bulan">
                    <input type="hidden" value="<?php echo $tahun ?>" name="tahun">
                    <input type="hidden" value="<?php echo $tarikh ?>" name="tarikh">
                    <button type="submit" class="navhomebtn">BACK</button>
                </form>
            </div>
        </div>
        <br><br>
        <div class="welcome-text">
        Selamat Datang : <?php echo htmlspecialchars($userName);?> ( <?php echo htmlspecialchars($userCat);?> )
        </div>
        <br>
        <div class="table-container">
            <h2>MC Murid</h2>
            <table class="tablekehadiran">
                <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($class);?></td>
                    <td>Nama Guru</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($userName);?></td>
                </tr>
                <tr>
                    <td>Tarikh</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($tarikh);?></td>
                </tr>
            </table>
            </div>
            <div class="table-container">
            <table class="tablekehadiran">
                <tr>
                    <td>Nama Pelajar</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($namaPelajar);?></td>
                    <td>No. Mykid</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($mykid);?></td>
                </tr>
                <tr>
                    <td>Kehadiran</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($kehadiran);?></td>
                </tr>
            </table>
            <br>
            <form method="post" action="process_absence.php" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $id ?>" name="id">
                <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                <input type="hidden" value="<?php echo $userName ?>" name="userName">
                <input type="hidden" value="<?php echo $class ?>" name="class">
                <input type="hidden" value="<?php echo $hari ?>" name="hari">
                <input type="hidden" value="<?php echo $bulan ?>" name="bulan">
                <input type="hidden" value="<?php echo $tahun ?>" name="tahun">
                <input type="hidden" value="<?php echo $tarikh ?>" name="tarikh">
                <input type="hidden" value="<?php echo $namaPelajar ?>" name="namaPelajar">
                <input type="hidden" value="<?php echo $mykid ?>" name="mykid">
                <input type="hidden" value="<?php echo $kehadiran ?>" name="kehadiran">
                <table class="tablekehadiran">
                    <tr>
                        <td>Sebab Tidak Hadir</td>
                        <td>:</td>
                        <td>
                            <select name="sebab" required>
                                <option value="">Pilih Sebab</option>
                                <option value="MC">MC</option>
                                <option value="Wakil Sekolah">Wakil Sekolah</option>
                                <option value="Kecemasan">Kecemasan</option>
                                <option value="Lain-lain">Lain-lain</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Nyatakan MC/Surat (JPEG, PNG, GIF, etc.) - Size 1MB Only</td>
                        <td>:</td>
                        <td>
                            <input type="file" name="mc_image" accept="image/*" onchange="checkFileSize(this)" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <button type="submit" name="submit" class="submitbtn">Hantar</button>
                        </td>
                    </tr>
                </table>
            </form>
            <script>
                function checkFileSize(input) {
                    if (input.files.length > 0) {
                        const fileSize = input.files[0].size; // in bytes
                        const maxSize = 1024 * 1024; // 1MB in bytes

                        if (fileSize > maxSize) {
                            alert("File size exceeds the limit of 1MB. Please choose a smaller file.");
                            input.value = ''; // Clear the input field
                        }
                    }
                }
            </script>
        </div>
    </body>
</html>