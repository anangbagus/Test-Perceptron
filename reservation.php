<?php 
    session_start();
    require_once "functions.php";
    $id_tipe_kamar = $_GET["tipe_kamar"];
    if(isset($_POST["submit-booking"])) {
        $_SESSION["status_booking"] = reserve($id_tipe_kamar, $_POST);
        if (isset($_SESSION["status_booking"])) {
          header("location: reservation.php?tipe_kamar=$id_tipe_kamar");
          exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perceptron Hotel|Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="" alt="logo" width="30" height="24" />
            </a>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <!-- bagian ini aku bingung waktu mode hpnya, karna di css ku kasi margin di expand menu nya ikutan kena margin -->
                    <!-- <a class="navbar-brand" href="#">Navbar</a>
                        <button
                            class="navbar-toggler"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#navbarNav"
                            aria-controls="navbarNav"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                        >
                            <span class="navbar-toggler-icon"></span>
                        </button> -->
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Pricing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Blogs</a>
                            </li>
                            <li class="nav-item">
                                <button class="btn btn-outline-dark">Login</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </nav>

    <div class="container">
        <?php if(isset($_SESSION["status_booking"]) && $_SESSION["status_booking"]==1): ?>
            <div class="mt-4 alert alert-success alert-dismissible fade show" role="alert">
                <strong>Booking berhasil!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION["status_booking"]); ?>
        <?php endif; ?>
        <?php if(isset($_SESSION["status_booking"]) && $_SESSION["status_booking"]==2): ?>
            <div class="mt-4 alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Booking tidak berhasil! Kamar penuh!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION["status_booking"]); ?>
        <?php endif; ?>
        <?php if(isset($_SESSION["status_booking"]) && $_SESSION["status_booking"]==0): ?>
            <div class="mt-4 alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Terjadi permasalahan!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION["status_booking"]); ?>
        <?php endif; ?>
        <div class="bg-light my-5">
                <div class="row">
                    <div class="col">

                    </div>
                    <div class="col reservation-form">
                        <div class="text-center mt-3">
                            <h2>Reservation</h2>
                        </div>
                        <div class="">
                        <form class="" method="POST">
                            <div class="row justify-content-center">
                                <div class="col-11">
                                    <div class="form-group my-2">
                                        <label class="my-2" for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="nama" aria-describedby="emailHelp" placeholder="Enter Name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-11">
                                    <div class="form-group my-2">
                                        <label class="my-2" for="exampleInputPassword1">ID Number (NIK/Passport) </label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="NIK" placeholder="ID Number" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-11">
                                    <div class="form-group my-2">
                                        <label class="my-2" for="exampleInputPassword1">E-mail </label>
                                        <input type="email" class="form-control" name="email" id="exampleInputPassword1" placeholder="E-mail" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-11">
                                    <div class="form-group my-2">
                                        <label class="my-2" for="exampleInputPassword1">Phone Number</label>
                                        <input type="text" class="form-control" name="nomor_hp" id="exampleInputPassword1" placeholder="Phone Number" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row justify-content-center">
                                <div class="col-11">
                                    <div class="form-group my-2">
                                        <label class="my-2" for="exampleInputPassword1">Check-In</label>
                                        <input type="date" class="form-control" name="checkin" id="exampleInputPassword1" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row justify-content-center">
                                <div class="col-11">
                                    <div class="form-group my-2">
                                        <label class="my-2" for="exampleInputPassword1">Check-Out</label>
                                        <input type="date" class="form-control" name="checkout" id="exampleInputPassword1" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" name="submit-booking" class="btn btn-primary mt-3 mb-3">Book</button>
                            </div>
                        </form>
                        </div>
                    </div>  
                </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
<footer class="footer mt-auto py-3" id="footer">
    <div class="container" id="bawah">
        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <div class="row">
                    <div class="col-2">
                        <p class="fw-bold">Gallery</p>
                    </div>
                    <div class="col-2">
                        <p class="fw-bold">Service</p>
                    </div>
                    <div class="col-2">
                        <p class="fw-bold">Blogs</p>
                    </div>
                    <div class="col-2">
                        <p class="fw-bold">PERCEPTRON HOTELS</p>
                    </div>
                    <div class="col-2">
                        <p class="fw-bold">About Us</p>
                    </div>
                    <div class="col-2">
                        <p class="fw-bold">Contact Us</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-10">
                <hr id="garisFooter">
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-6">
                <div class="row justify-content-center">
                    <div class="col-1">
                        <h1 class="bi bi-facebook"></h1>
                    </div>
                    <div class="col-1">
                        <h1 class="bi bi-instagram"></h1>
                    </div>
                    <div class="col-1">
                        <h1 class="bi bi-whatsapp"></h1>
                    </div>
                    <div class="col-1">
                        <h1 class="bi bi-youtube"></h1>
                    </div>
                    <div class="col-1">
                        <h1 class="bi bi-github"></h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="akhirFooter">
            <div class="col-2">
                <p class="text-center">@ 2021</p>
            </div>
            <div class="col-2">
                <p class="text-center">Privacy-Terms</p>
            </div>
        </div>
    </div>
</footer>

</html>