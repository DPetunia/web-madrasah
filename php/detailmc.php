<?php
    // Include the database connection file
    include('db/conection.php');

    // Sanitize and assign POST variables
    $userCat = $_POST['userCat'];
    $userName = $_POST['userName'];
    $id = $_POST['id'];
                    
    $namaguru = $_POST['namaguru'];
    $class = $_POST['class'];
    $hari = $_POST['hari'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $namaPelajar = $_POST['namaPelajar'];
    $mykid = $_POST['mykid'];
    $kehadiran = $_POST['kehadiran'];
    $mcid = $_POST['mcid'];

    // Fetch the record from the mc table
    $query = "SELECT * FROM mc WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $mcid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
?>
<html>
    <head>
        <title>MADRASAH AN-NUR - PROFIL MURID</title>
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

            /* Style for the header */
            .table-container h1 {
                font-size: 24px;
                color: #333;
                margin-bottom: 10px;
                text-align: center;
                font-family: comic sans ms;
            }
            .mc-image {
                max-width: 100%; /* Adjust as needed */
                max-height: 300px; /* Adjust height as needed */
                display: block;
                margin: auto; /* Center image horizontally */
                margin-top: 10px; /* Add top margin for spacing */
            }
        </style>
    </head>
    <body>
        <div class="navbar">
            <marquee behavior="scroll" direction="left" scrollamount="5"><img src="../src/welckemaskinikehadiran.png" class="leftnav"></marquee>
            <div class="rightnav">
                <img src="../src/logo.png">
                <form name="form" method="post" action="showmc.php">
                    <input type="hidden" value="<?php echo $id ?>" name="id">
                    <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                    <input type="hidden" value="<?php echo $userName ?>" name="userName">

                    <input type="hidden" value="<?php echo $class ?>" name="class">
                    <input type="hidden" value="<?php echo $bulan ?>" name="bulan">
                    <input type="hidden" value="<?php echo $tahun ?>" name="tahun">
                    <button type="submit" class="navhomebtn">BACK</button>
                </form>
            </div>
        </div>
        <br>
        <center>
        <div class="table-container">
            <table class="mctable">
            <h1>Rekod MC Murid</h1>
                <tr>
                    <td>Tarikh</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($hari . "-" . $bulan . "-" . $tahun);?></td>
                    <td class="selang">Nama Guru</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($namaguru);?></td>
                </tr>
                <tr>
                    <td>Nama Pelajar</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($namaPelajar);?></td>
                    <td class="selang">No.Mykid</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($mykid);?></td>
                </tr>
                <tr>
                    <td>Sebab Tidak Hadir</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($kehadiran);?></td>
                </tr>
                <tr>
                    <td>Bukti</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td colspan="6">
                        <?php
                        if (!empty($row['mc_image'])) {
                            echo "<img src='data:image/jpeg;base64," . base64_encode($row['mc_image']) . "' alt='MC Image' class='mc-image'>";
                        } else {
                            echo "No image";
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
        </center>
    </body>
    <br><br>
</html>
<?php
// Close the database connection
$conn->close();
?>
