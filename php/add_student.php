<?php
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
        <title>MADRASAH AN-NUR - PROFIL MURID</title>
        <link rel="stylesheet" type="text/css" href="css/styles2.css">
        <link rel="icon" href="../src/logo.png">
        <style>
            /* CSS styles for DP image */
            .dp-image {
                width: 150px; /* Adjust width as needed */
                height: 150px; /* Adjust height as needed */
                object-fit: cover; /* Ensure the image covers the entire area */
                border: 2px solid #ccc; /* Optional: Add a border around the image */
                box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Optional: Add a shadow for a lifted effect */
                margin-bottom: 20px; /* Optional: Add some space below the image */
            }

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
            }
        </style>
    </head>
    <body>
        <div class="navbar">
            <marquee behavior="scroll" direction="left" scrollamount="5">
                <img src="../src/welcprofilstudent.png" class="leftnav">
            </marquee>
            <div class="rightnav">
                <img src="../src/logo.png">
                <form name="form" method="post" action="senaraiprofilmurid.php">
                    <input type="hidden" value="<?php echo $id ?>" name="id">
                    <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                    <input type="hidden" value="<?php echo $userName ?>" name="userName">
                    <button type="submit" class="navhomebtn">BACK</button>
                </form>
            </div>
        </div>
        <br><br>
        <form name="form" method="post" action="prosessaddstudent.php">
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
                                    <u>MAKLUMAT PELAJAR</u>
                                </h1>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <center>
                                <img src="src/defaultDp.png" alt='DP Image' class='dp-image'>       
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            KELAS
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <select name="class" required>
                                <option value="">Pilih Kelas</option>
                                <option value="Siddiq">1A - Siddiq </option>
                                <option value="Amanah">1B - Amanah</option>
                                <option value="Abu Bakar">2A - Abu Bakar</option>
                                <option value="Umar">2B - Umar</option>
                                <option value="Iman">3A - Iman</option>
                                <option value="Islam">3B - Islam</option>
                                <option value="Firdaus">4A - Firdaus</option>
                                <option value="Naim">4B - Naim</option>
                                <option value="Sabar">5A - Sabar</option>
                                <option value="Ikhlas">5B - Ikhlas</option>
                                <option value="Ibnu Sinar">6A - Ibnu Sinar</option>
                                <option value="Ibnu Rushd">6B - Ibnu Rushd</option>
                            </select>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            NAMA PELAJAR
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="name" required placeholder="Nama Pelajar">
                        </td>
                        <td>
                            ID PELAJAR
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="studentid" required placeholder="ID Pelajar">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            NO.MYKID
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="ic" pattern="[0-9]{12}" required placeholder="010203040506">
                        </td>
                        <td>
                            NO.SURAT BERANAK
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="nosb" required placeholder="No.Surat Beranak">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            TEMPAT LAHIR
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="tempatlahir" required placeholder="Hospital .....">
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            AGAMA
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="agama" required placeholder="ISLAM">
                        </td>
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
                        <td colspan="6">
                            <br>
                                <h1>
                                    <u>MAKLUMAT PENJAGA</u>
                                </h1>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            NAMA PENJAGA
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="namapenjaga" required placeholder="Nama Penjaga">
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            NO.K/P
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="icpenjaga" pattern="[0-9]{12}" required placeholder="010203040506">
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            PEKERJAAN
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="pekerjaanpenjaga" required placeholder="Pekerjaan Penjaga">
                        </td>
                        <td>
                            PENDAPATAN KELUARGA
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <select name="pincome" required>
                                <option value="">Pilih Pendapatan</option>
                                <option value="RM 0 - RM 1000">RM 0 - RM 1000</option>
                                <option value="RM 1001 - RM 1500">RM 1001 - RM 1500</option>
                                <option value="RM 1501 - RM 2000">RM 1501 - RM 2000</option>
                                <option value="RM 2001 - RM 2500">RM 2001 - RM 2500</option>
                                <option value="RM 2501 - RM 3000">RM 2501 - RM 3000</option>
                                <option value="RM 3001 - RM 3500">RM 3001 - RM 3500</option>
                                <option value="RM 5501 - RM 4000">RM 5501 - RM 4000</option>
                                <option value="RM 4001 - RM 4500">RM 4001 - RM 4500</option>
                                <option value="RM 4501 - RM5000">RM 4501 - RM5000</option>
                                <option value="> RM 5001"> &gt; RM 5001</option>
                            </select>
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
                            HUBUNGAN DENGAN PELAJAR
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="hubungan" required placeholder="Ibu">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <br><br>
                            <center><button type="submit" class="resultButton">Tambah Pelajar</button></center>
                            <br><br>
                        </td>
                    </tr>
                </table>
            </div>
            </center>
        </form>
        <br><br>
    </body>
</html>