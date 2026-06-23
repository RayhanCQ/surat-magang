<?php

$conn = new mysqli("localhost", "root", "", "suratdb");
$result = $conn->query("SELECT * FROM mahasiswa"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Generate Surat</title>
</head>
<body>
    <h2>Generate Surat Magang</h2>
    <table border="1">
        <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>Aksi</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()):?>
            <tr>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['nim']; ?></td>
                <td><a href="generate.php?id=<?php echo $row['id']; ?>">Generate Surat</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>