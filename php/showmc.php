<?php
    // Include the database connection file
    include('db/conection.php');

    // Sanitize user inputs
    $userCat = htmlspecialchars($_POST['userCat']);
    $userName = htmlspecialchars($_POST['userName']);
    $id = htmlspecialchars($_POST['id']);
    $class = htmlspecialchars($_POST['class']);
    $bulan = htmlspecialchars($_POST['bulan']);
    $tahun = htmlspecialchars($_POST['tahun']);

    // Prepare and execute the query securely using prepared statements
    $query = $conn->prepare("SELECT * FROM mc WHERE class = ? AND bulan = ? AND tahun = ? ORDER BY tahun DESC, bulan DESC, hari DESC");
    $query->bind_param("sss", $class, $bulan, $tahun);
    $query->execute();
    $result = $query->get_result();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Show MC Records</title>
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

            /* Style for the buttons */
            .table-container .resultButton {
                padding: 10px 20px;
                background-color: #007bff;
                color: white;
                border: none;
                cursor: pointer;
                border-radius: 4px;
                transition: background-color 0.3s ease; /* Smooth transition */
            }

            /* Hover effect for buttons */
            .table-container .resultButton:hover {
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
                margin-left: 135px; 
                font-family: comic sans ms;
            }
        </style>
</head>
<body>
    <div class="navbar">
        <marquee behavior="scroll" direction="left" scrollamount="5"><img src="../src/welckemaskinikehadiran.png" class="leftnav"></marquee>
        <div class="rightnav">
            <img src="../src/logo.png">
            <form name="form" method="post" action="mcpelajar.php">
                <input type="hidden" value="<?php echo $id ?>" name="id">
                <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                <input type="hidden" value="<?php echo $userName ?>" name="userName">
                <button type="submit" class="navhomebtn">BACK</button>
            </form>
        </div>
    </div>
    <div class="table-container">
        <h1>Rekod MC Murid</h1><br><br>
        <table class="mc-table" border="1">
            <thead>
                <tr>
                    <th>Tarikh</th>
                    <th>Nama Pelajar</th>
                    <th>MyKid</th>
                    <th>Kelas</th>
                    <th>Nama Guru</th>
                    <th>Sebab Tidak Hadir</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><center>" . htmlspecialchars($row['hari']) . " - " . htmlspecialchars($row['bulan']) . " - " . htmlspecialchars($row['tahun']) . "</center></td>";
                        echo "<td><center>" . htmlspecialchars($row['namaPelajar']) . "</center></td>";
                        echo "<td><center>" . htmlspecialchars($row['mykid']) . "</center></td>";
                        echo "<td><center>" . htmlspecialchars($row['class']) . "</center></td>";
                        echo "<td><center>" . htmlspecialchars($row['namaguru']) . "</center></td>";
                        echo "<td><center>" . htmlspecialchars($row['kehadiran']) . "</center></td>";
                ?>
                <td>
                    <center>
                        <form method="post" action="detailmc.php">
                            <input type="hidden" value="<?php echo $id ?>" name="id">
                            <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                            <input type="hidden" value="<?php echo $userName ?>" name="userName">
                            <input type="hidden" value="<?php echo htmlspecialchars($row['namaguru']) ?>" name="namaguru">
                            <input type="hidden" value="<?php echo htmlspecialchars($row['class']) ?>" name="class">
                            <input type="hidden" value="<?php echo htmlspecialchars($row['hari']) ?>" name="hari">
                            <input type="hidden" value="<?php echo htmlspecialchars($row['bulan']) ?>" name="bulan">
                            <input type="hidden" value="<?php echo htmlspecialchars($row['tahun']) ?>" name="tahun">
                            <input type="hidden" value="<?php echo htmlspecialchars($row['namaPelajar']) ?>" name="namaPelajar">
                            <input type="hidden" value="<?php echo htmlspecialchars($row['mykid']) ?>" name="mykid">
                            <input type="hidden" value="<?php echo htmlspecialchars($row['kehadiran']) ?>" name="kehadiran">
                            <input type="hidden" value="<?php echo htmlspecialchars($row['id']) ?>" name="mcid">
                            <button type="submit"class="resultButton">Bukti</button>
                        </form>
                    </center>
                </td>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='10'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
$conn->close();
?>
