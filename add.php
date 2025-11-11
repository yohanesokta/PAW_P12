<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $location = $_POST['location'];

    $image = $_FILES['image']['name'];
    $target = './uploads/' . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO kariawan (nama, location, foto) VALUES ('$nama', '$location', '$image')";
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
  Nama: <input type='text' name='nama' required><br>
  Location: <input type='text' id="location" name='location' required><br>
  Image: <input type='file' name='image' required><br>
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
