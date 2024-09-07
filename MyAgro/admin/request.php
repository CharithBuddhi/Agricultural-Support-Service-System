<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#08025e] text-white">
   <div>
        <table class="border-2 table-fixed">
            <tr  class="border-2 ">
                <th>Name</th>
                <th>Type</th>
                <th>NIC</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Proof</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>charitha Budhika</td>
                <td>Supplier</td>
                <td>200200602164</td>
                <td>no 250,negambo,colombo,sri lanka</td>
                <td>badsnake1212@gmail.com</td>  
                <td>071784523</td>
                <td><img src="images/charitha" alt=""></td>
                <td>
                    <button>Approve</button>
                    <button>Delete</button>
                </td>
            </tr>
            
        </table>
   </div>
   <!-- <?php
                include 'db.php';
                $sql = "SELECT * FROM `request`";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    $name = $row['name'];
                    $type = $row['type'];
                    $nic = $row['nic'];
                    $address = $row['address'];
                    $email = $row['email'];
                    $phone = $row['phone'];
                    $proof = $row['proof'];
                    $id = $row['id'];
                    echo '<tr>
                    <td>'.$name.'</td>
                    <td>'.$type.'</td>
                    <td>'.$nic.'</td>
                    <td>'.$address.'</td>
                    <td>'.$email.'</td>
                    <td>'.$phone.'</td> 
                    <td>'.$proof.'</td>
                    <td><a href="delete.php?id='.$id.'">Delete</a></td>
                    </tr>';
                }
            ?> -->
</body>
</html>