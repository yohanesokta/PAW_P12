<?php
include 'db.php';

$id = $_GET['id'] ?? '';
$data = mysqli_query($conn, "SELECT * FROM kariawan WHERE id='$id'");
if (mysqli_num_rows($data) > 0) {
    $data = mysqli_fetch_assoc($data);
} else {
    die("data tidak ada");
}


if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $location = $_POST['location'];
    $image = $_FILES['image']['name'];

    $target = './uploads/' . basename($image);
    if ($image == '') {
        $sql = "UPDATE kariawan SET nama='$nama', location='$location' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    } else if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "UPDATE kariawan SET nama='$nama', foto='$image', location='$location' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    } else {
        echo 'File upload failed!';
    }
}
?>
<h1>Absen Dulu Dong</h1>
<form method='POST' enctype='multipart/form-data'>
    Nama: <input type='text' name='nama' required value="<?= $data['nama'] ?>"><br>
    Location: <input type='text' id="location" name='location' required value="<?= $data['location'] ?>"><br>
    <img src="uploads/<?= $data['foto'] ?>" alt="" width="80"><br>
    Image: <input type='file' name='image'><br>
    <button type='submit' name='submit'>Save</button>
</form>
<script>
    const loc = document.getElementById("location");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, error);
        } else {
            alert("Geolocation browser tidak support");
        }
    }

    function success(position) {
        loc.value = position.coords.latitude + "," + position.coords.longitude;
    }

    function error() {
        alert("Posisi tidak diketahui");
    }

    const videoElement = document.getElementById('webcam-video');



    getLocation();
</script>