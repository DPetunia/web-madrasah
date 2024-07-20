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
?>
<!DOCTYPE html>
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

            .welcome-text {
                margin-left: 135px; 
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
                <form name="form" method="post" action="senaraiprofilstaff.php">
                    <input type="hidden" value="<?php echo $id ?>" name="id">
                    <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                    <input type="hidden" value="<?php echo $userName ?>" name="userName">
                    <button type="submit" class="navhomebtn">BACK</button>
                </form>
            </div>
        </div>
        <br><br>
        <form name="form" method="post" action="prosessaddstaff.php">
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
                            <input type="text" name="name" required placeholder="Nama Staff">
                        </td>
                        <td>
                            ID 
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="staffid" required placeholder="ID Staff">
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
                            <input type="text" name="ic" pattern="[0-9]{12}" required placeholder="010203040506">
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            BANGSA
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <select name="race" required>
                                <option value="">Pilih Bangsa</option>
                                <option value="Melayu">Melayu</option>
                                <option value="China">Cina</option>
                                <option value="India">India</option>
                                <option value="lain-lain">lain-lain</option>
                            </select>
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
                            <textarea name="addrss" placeholder="Alamat" required style="width: 400px; height: 113px;"></textarea>
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
                            <input type="text" name="phone" pattern="[0-9]{10,11}" required placeholder="0123456789" title="Phone number should be 10 or 11 digits">
                        </td>
                        <td>
                            EMAIL
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="email" name="email" required placeholder="user@gmail.com">
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
                            <select name="category" required>
                                <option value="">Pilih Kategori</option>
                                <option value="admin">admin</option>
                                <option value="staff">staff</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <br><br>
                            <center><button type="submit" class="resultButton">Tambah Staff</button></center>
                        </td>
                    </tr>
                </table>
            </div>
            </center>
        </form>
        <br><br>
    </body>
</html>