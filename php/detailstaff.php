<html>
	<head>
        <title>MADRASAH AN-NUR - PROFIL STAFF</title>
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

            /* Style for delete button */
            .table-container .deleteButton {
                padding: 10px 20px;
                background-color: #ff4c4c; /* Red color for delete button */
                color: white;
                border: none;
                cursor: pointer;
                border-radius: 4px;
                transition: background-color 0.3s ease; /* Smooth transition */
                margin-left: 10px;
            }

            /* Hover effect for delete button */
            .table-container .deleteButton:hover {
                background-color: #cc0000; /* Darker shade of red on hover */
            }

            .welcome-text {
                margin-left: 135px; 
            }
        </style>
	</head>
	<body>
        <br>
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
            $userCat = $_POST['userCat'];
            $userName = $_POST['userName'];
            $id = $_POST['id'];
            
            $staffUserName = $_POST['staffUserName'];
            $UserId = $_POST['UserId'];
            $UserIc = $_POST['UserIc'];
            $UserAdd = $_POST['UserAdd'];
            $UserDOB = $_POST['UserDOB'];
            $UserAge = $_POST['UserAge'];
            $UserGender = $_POST['UserGender'];
            $UserSOB = $_POST['UserSOB'];
            $UserPhone = $_POST['UserPhone'];
            $UserEmail = $_POST['UserEmail'];
            $UserRace = $_POST['UserRace'];
            $category = $_POST['category'];
        ?>
		<form name="form" method="post" action="senaraiprofilstaff.php">
            <input type="hidden" value="<?php echo $id ?>" name="id">
            <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
            <input type="hidden" value="<?php echo $userName ?>" name="userName">
            <center>
            <div class="table-container">
                <table id="indextable">
                    <tr>
                        <td colspan="6">
                            <br>
                                <h1>
                                    <u>MAKLUMAT STAFF</u>
                                </h1>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            NAMA STAFF
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                        <input type="text" name="name" required value="<?php echo $staffUserName;?>" readonly>
                        </td>
                        <td>
                            ID 
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                        <input type="text" name="staffid" required placeholder="Staff ID" value="<?php echo $UserId;?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            NO.K/P
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                        <input type="text" name="ic" pattern="[0-9]{12}" required value="<?php echo $UserIc;?>" readonly>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            TARIKH LAHIR
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="dob" value="<?php echo $UserDOB;?>" required readonly>
                        </td>
                        <td>
                            UMUR
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="age" value="<?php echo $UserAge;?>" required readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            NEGERI KELAHIRAN
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="sob" value="<?php echo $UserSOB;?>" required readonly>
                        </td>
                        <td>
                            JANTINA
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="gender" value="<?php echo $UserGender;?>" required readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            BANGSA
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="race" required value="<?php echo $UserRace;?>" readonly>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            ALAMAT
                        </td>
                        <td>
                            : 
                        </td>
                        <td colspan="4">
                            <textarea name="addrss" placeholder="address" required style="width: 400px; height: 113px;" readonly><?php echo $UserAdd;?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            NO.TELEFON
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="phone" value="<?php echo $UserPhone;?>"required readonly>
                        </td>
                        <td>
                            EMAIL
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="email" name="email" required value="<?php echo $UserEmail;?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            KATEGORI
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="category" required value="<?php echo $category;?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <br>
                            <center>
                                <button type="submit" class="resultButton">Kembali</button>
                                <?php 
                                    if($userCat == "admin")
                                    {
                                ?>
                                    <button type="button" class="deleteButton" onclick="confirmDelete()">Buang</button>
                                <?php 
                                    }
                                ?>
                            </center>
                            <br>
                        </td>
                    </tr>
                </table>
            </div>
            </center>
        </form>
        <br>
        
        <script>
            function confirmDelete() {
                if (confirm('Are you sure you want to delete "<?php echo $staffUserName;?>" Data?')) {
                    // Create a form element
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'deleteRecord.php';

                    // Append hidden input fields to the form
                    var idField = document.createElement('input');
                    idField.type = 'hidden';
                    idField.name = 'id';
                    idField.value = '<?php echo $id ?>';
                    form.appendChild(idField);

                    var idField = document.createElement('input');
                    idField.type = 'hidden';
                    idField.name = 'from';
                    idField.value = 'staff';
                    form.appendChild(idField);

                    var userCatField = document.createElement('input');
                    userCatField.type = 'hidden';
                    userCatField.name = 'userCat';
                    userCatField.value = '<?php echo $userCat ?>';
                    form.appendChild(userCatField);

                    var userNameField = document.createElement('input');
                    userNameField.type = 'hidden';
                    userNameField.name = 'userName';
                    userNameField.value = '<?php echo $userName ?>';
                    form.appendChild(userNameField);

                    var IdPelajarField = document.createElement('input');
                    IdPelajarField.type = 'hidden';
                    IdPelajarField.name = 'UserId';
                    IdPelajarField.value = '<?php echo $UserId ?>';
                    form.appendChild(IdPelajarField);

                    // Append the form to the body and submit it
                    document.body.appendChild(form);
                    form.submit();
                }
            }
        </script>
	</body>
</html>