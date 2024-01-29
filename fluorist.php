<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet"/>
    <title>Document</title>
    <style>
        .bg-image-vertical {
            position: relative;
            overflow: hidden;
            background-repeat: no-repeat;
            background-position: right center;
            background-size: auto 100%;
        }

        @media (min-width: 1025px) {
            .h-custom-2 {
                height: 100%;
            }
        }
    </style>
</head>
<body>
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black">
                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                        <form style="width: 23rem;" method="post">
                            <div class="form-outline mb-4">
                                <input type="text" id="name" class="form-control form-control-lg" name="name" />
                                <label class="form-label" for="name">Name</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="name" class="form-control form-control-lg" name="name" />
                                <label class="form-label" for="name">Name</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="email" id="email" class="form-control form-control-lg" name="email" />
                                <label class="form-label" for="email">Email address</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="tel" id="mobile" class="form-control form-control-lg" name="mobile" />
                                <label class="form-label" for="mobile">Mobile Number</label>
                            </div>

                            <div class="form-outline mb-4">
                                <textarea id="address" class="form-control form-control-lg" name="address"></textarea>
                                <label class="form-label" for="address">Address</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="number" id="advance_payment" class="form-control form-control-lg" name="advance_payment" />
                                <label class="form-label" for="advance_payment">Advance Payment</label>
                                <img src="./images/qr.png" alt="QR Code Image" height="200px">
                                <div id="payment-label" style="color: red;">For Payment</div>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="number" id="reference" class="form-control form-control-lg" name="reference" />
                                <label class="form-label" for="mobile">Payment reference id</label>
                            </div>

                            <div class="pt-1 mb-4">
                                <button class="btn btn-info btn-lg btn-block" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="images/home-bg2.jpg"
                        alt="bandevents image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $mobile = $_POST["mobile"];
        $address = $_POST["address"];
        $advancePayment = $_POST["advance_payment"];
        $reference = $_POST['reference'];
        $connection = mysqli_connect('localhost', 'root', '', 'contact_db');

        // Check the connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Insert data into the database
        $sql = "INSERT INTO fluorist (name, email, mobile, address, advance_payment,reference) VALUES (?, ?, ?, ?, ?,?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssds", $name, $email, $mobile, $address, $advancePayment, $reference);
        
        if ($stmt->execute()) {
            // Data successfully inserted
            echo "Thank you for contacting us!";
        } else {
            // Error handling if the insertion fails
            echo "Error: " . $sql . "<br>" . $connection->error;
        }

        // Close the database connection
        $stmt->close();
        $connection->close();
    }
    ?>
</body>
</html>
