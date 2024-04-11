<?php

error_reporting(E_ERROR | E_PARSE);
include "../partials/_header.php";
include "../partials/navigation.php";
$username = $_SESSION['user_data']['0'];
$email_data = $_SESSION['user_data']['3'];;

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include library files
require '../src/Exception.php';
require '../src/PHPMailer.php';
require '../src/SMTP.php';
$email = $_POST['email'];
if (isset($_POST['send'])) {
    try {
// Create an instance; Pass `true` to enable exceptions
        $mail = new PHPMailer(true);

// Server settings
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output
        $mail->isSMTP();                            // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';           // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                     // Enable SMTP authentication
        $mail->Username = 'kisdavid2004@gmail.com';       // SMTP username
        $mail->Password = 'xjpfweocgfqjigup';         // SMTP password
        $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                          // TCP port to connect to

        // Sender info
        $mail->setFrom($email, $username);

// Add a recipient
        $mail->addAddress('kisdavid2004@gmail.com', 'David');
// Set email format to HTML
        $mail->isHTML(true);

// Mail subject
        $mail->Subject = $_POST['subject'];

// Mail body content
        $mail->Body = $_POST['message'];

        $mail->send();
        echo
        "<script>
    alert('success');
    document.location.href='../index.php';
    </script>";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>
    <head>
        <title>Контакт</title>
        <link rel="stylesheet" href="../source/plugins/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    </head>
    <main>
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    </div>
                    <h4 class="text-center font-weight-bold">Зв’яжіться зі мною</h4>
                    <div class="col-lg-4">
                        <div class="pr-0 pr-lg-4">
                            <div class="content">
                                <div class="mt-5">
                                    <p class=" h3 mb-3 font-weight-normal"><a class="fa fa-mai text-dark "
                                                                              href="mailto:kisdavid2004@gmail.com">kisdavid2004@gmail.com</a>
                                    </p>
                                    <p class="mb-3"><a class="fa fa-mobile-phone text-dark"
                                                       href="tel:&#43;380634688509"> &#43;380634688509</a>
                                    </p>
                                    <p class="fas fa-city mb-2"> Закарпатська обл. м. Ужгород. вул.
                                        Українська
                                        19</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-4   ">
                        <form method="post" class="row">
                            <div class="col-md-6">
                                <?php
                                if (empty($username)) { ?>
                                    <input type="text" class="form-control mb-4" placeholder="Ім'я" name="name"
                                           id="name">
                                    <?php
                                } else { ?>
                                    <input type="text" class="form-control mb-4" placeholder="Ім'я" name="name"
                                           id="name" value="<?= $username ?>" readonly>
                                    <?php
                                } ?>
                            </div>
                            <div class="col-md-6">
                                <?php
                                if (empty($email_data)) { ?>
                                    <input type="email" class="form-control mb-4" placeholder="Ел. адреса" name="email"
                                           id="email">
                                    <?php
                                } else { ?>
                                    <input type="email" class="form-control mb-4" placeholder="Ел. адреса" name="email"
                                           id="email" value="<?= $email_data ?>" readonly>
                                    <?php
                                } ?>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control mb-4" placeholder="Тема"
                                       name="subject"
                                       id="subject">
                            </div>
                            <div class="col-12">
                            <textarea name="message" id="message" class="form-control mb-4"
                                      placeholder="Повідомлення..."
                                      rows="5"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-outline-primary" name="send" type="submit">Надсилати
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
include "../partials/_footer.php";
?>