<?php
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo "Invalid request method. Please use POST.";
        echo "<meta http-equiv='refresh' content='0;url=index.php'>";
        exit;
    }
    
    // Include the database connection file
    include('db/conection.php');

    // Sanitize and assign POST variables
    $userCat = htmlspecialchars($_POST['userCat']);
    $userName = htmlspecialchars($_POST['userName']);
    $id = htmlspecialchars($_POST['id']);

    // Fetch staff data from the database
    $staffQuery = "SELECT * FROM staff WHERE UserId != 'admin' AND UserId != '$id'";
    if (!empty($searchStaff)) {
        $staffQuery .= " WHERE UserName LIKE '%$searchStaff%'";
    }
    $staff = $conn->query($staffQuery);

    // Fetch admin data from the database
    $adminQuery = "SELECT * FROM admn WHERE UserId != 'admin' AND UserId != '$id'";
    if (!empty($searchAdmin)) {
        $adminQuery .= " WHERE UserName LIKE '%$searchAdmin%'";
    }
    $admin = $conn->query($adminQuery);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MADRASAH AN-NUR - PROFIL STAFF</title>
        <link rel="stylesheet" type="text/css" href="css/styles2.css">
        <link rel="icon" href="../src/logo.png">
        <style>
            /* General styles for the table container */
            .table-container {
                margin: 20px auto;
                width: 80%;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: #f9f9f9;
                margin-bottom: 30px; /* Add some space between the containers */
            }

            /* Styles for table elements */
            .table-container table {
                width: 100%;
                border-collapse: collapse;
            }

            .table-container td, .table-container th {
                padding: 10px;
                text-align: left;
                border: 1px solid #ccc; /* Add border for the table cells */
            }

            /* Header styles */
            .table-container h2 {
                font-size: 24px;
                color: #333;
                margin-bottom: 10px;
                text-align: center;
                font-family: comic sans ms;
            }

            /* Button styles */
            .table-container .resultButton {
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                border: none;
                cursor: pointer;
                border-radius: 4px;
            }

            button[type="submit"] {
                padding: 8px 16px;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                text-align: center;
                margin-top: 20px; /* Add some space above the button */
            }

            button[type="submit"]:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class="navbar">
            <marquee behavior="scroll" direction="left" scrollamount="5">
                <img src="../src/welcprofilstaff.png" class="leftnav">
            </marquee>
            <div class="rightnav">
                <img src="../src/logo.png">
                <form name="form" method="post" action="dashboard.php">
                    <input type="hidden" value="<?php echo $id ?>" name="id">
                    <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                    <button type="submit" class="navhomebtn">HOME</button>
                </form>
            </div>
        </div>
        <br><br>
        <div class="table-container">
            <h2>Senarai Guru</h2><br>
            <?php if ($staff->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Bil</th>
                    <th>Nama</th>
                    <th>ID</th>
                    <th>IC</th>
                    <th>Password</th>
                    <th></th>
                </tr>
                <?php
                $counter = 1;
                while ($row = $staff->fetch_assoc()):
                ?>
                    <tr>
                        <td><center><?php echo $counter; ?></center></td>
                        <td><center><?php echo htmlspecialchars($row['UserName']); ?></center></td>
                        <td><center><?php echo htmlspecialchars($row['UserId']); ?></center></td>
                        <td><center><?php echo htmlspecialchars($row['UserIc']); ?></center></td>
                        <td><center><?php echo htmlspecialchars($row['UserIc']); ?></center></td>
                        <td>
                            <center>
                                <form method="post" action="detailstaff.php">
                                    <input type="hidden" value="<?php echo $id ?>" name="id">
                                    <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                                    <input type="hidden" value="<?php echo $userName ?>" name="userName">
                                    <input type="hidden" name="staffUserName" value="<?php echo htmlspecialchars($row['UserName']); ?>">
                                    <input type="hidden" name="UserId" value="<?php echo htmlspecialchars($row['UserId']); ?>">
                                    <input type="hidden" name="UserIc" value="<?php echo htmlspecialchars($row['UserIc']); ?>">
                                    <input type="hidden" name="UserAdd" value="<?php echo htmlspecialchars($row['UserAdd']); ?>">
                                    <input type="hidden" name="UserDOB" value="<?php echo htmlspecialchars($row['UserDOB']); ?>">
                                    <input type="hidden" name="UserAge" value="<?php echo htmlspecialchars($row['UserAge']); ?>">
                                    <input type="hidden" name="UserGender" value="<?php echo htmlspecialchars($row['UserGender']); ?>">
                                    <input type="hidden" name="UserSOB" value="<?php echo htmlspecialchars($row['UserSOB']); ?>">
                                    <input type="hidden" name="UserPhone" value="<?php echo htmlspecialchars($row['UserPhone']); ?>">
                                    <input type="hidden" name="UserEmail" value="<?php echo htmlspecialchars($row['UserEmail']); ?>">
                                    <input type="hidden" name="UserRace" value="<?php echo htmlspecialchars($row['UserRace']); ?>">
                                    <input type="hidden" name="category" value="Guru">
                                    <button type="submit">Detail</button>
                                </form>
                            </center>
                        </td>
                    </tr>
                <?php
                $counter++;
                endwhile;
                ?>
            </table>
        </div>
        <?php else: ?>
            <p>Tiada Guru dalam database....</p>
        <?php endif; ?>
        <br>
        <div class="table-container">
            <h2>Senarai Admin</h2><br>
            <?php if ($admin->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Bil</th>
                    <th>Nama</th>
                    <th>ID</th>
                    <th>IC</th>
                    <th>Password</th>
                    <th></th>
                </tr>
                <?php
                $counter = 1;
                while ($row = $admin->fetch_assoc()):
                ?>
                    <tr>
                        <td><center><?php echo $counter; ?></center></td>
                        <td><center><?php echo htmlspecialchars($row['UserName']); ?></center></td>
                        <td><center><?php echo htmlspecialchars($row['UserId']); ?></center></td>
                        <td><center><?php echo htmlspecialchars($row['UserIc']); ?></center></td>
                        <td><center><?php echo htmlspecialchars($row['UserIc']); ?></center></td>
                        <td>
                            <center>
                                <form method="post" action="detailstaff.php">
                                    <input type="hidden" value="<?php echo $id ?>" name="id">
                                    <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                                    <input type="hidden" value="<?php echo $userName ?>" name="userName">
                                    <input type="hidden" name="staffUserName" value="<?php echo htmlspecialchars($row['UserName']); ?>">
                                    <input type="hidden" name="UserId" value="<?php echo htmlspecialchars($row['UserId']); ?>">
                                    <input type="hidden" name="UserIc" value="<?php echo htmlspecialchars($row['UserIc']); ?>">
                                    <input type="hidden" name="UserDOB" value="<?php echo htmlspecialchars($row['UserDOB']); ?>">
                                    <input type="hidden" name="UserAge" value="<?php echo htmlspecialchars($row['UserAge']); ?>">
                                    <input type="hidden" name="UserGender" value="<?php echo htmlspecialchars($row['UserGender']); ?>">
                                    <input type="hidden" name="UserSOB" value="<?php echo htmlspecialchars($row['UserSOB']); ?>">
                                    <input type="hidden" name="UserPhone" value="<?php echo htmlspecialchars($row['UserPhone']); ?>">
                                    <input type="hidden" name="UserEmail" value="<?php echo htmlspecialchars($row['UserEmail']); ?>">
                                    <input type="hidden" name="UserRace" value="<?php echo htmlspecialchars($row['UserRace']); ?>">
                                    <input type="hidden" name="UserAdd" value="<?php echo htmlspecialchars($row['UserAdd']); ?>">
                                    <input type="hidden" name="category" value="Admin">
                                    <button type="submit">Detail</button>
                                </form>
                            </center>
                        </td>
                    </tr>
                <?php
                $counter++;
                endwhile;
                ?>
            </table>
            <?php else: ?>
                <p>Tiada Admin dalam database selain anda...</p>
            <?php endif; ?>
            <br>
        </div>
            <form method="post" action="add_staff.php" style="text-align: center;">
                <input type="hidden" value="<?php echo $id ?>" name="id">
                <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                <input type="hidden" value="<?php echo $userName ?>" name="userName">
                <button type="submit">Tambah Staff</button>
            </form>
    </body>
</html>
