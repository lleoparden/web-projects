

<!DOCTYPE html>
<html lang="en">
<head>
    <title>contact us</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .navbar-brand {
            float: left;
            position: relative;
        }
        nav.main-navigation {
            position: relative;
            padding-bottom: 15px;
            padding-top: 5px;
        }

        nav.main-navigation ul.nav-list {
            padding-bottom: 20px;
            padding: 0;
            list-style: none;
            position: relative;
            text-align: right;
            margin-right: 20px;
        }

        .nav-list li.nav-list-item {
            display: inline-block;
            line-height: 40px;
            margin-left: 30px;
            margin-top: 15px;
        }

        a.nav-link {
            text-decoration: none;
            font-size: 18px;
            font-family: sans-serif;
            font-weight: 500;
            cursor: pointer;
            position: relative;
            color: #ffffff;
        }
        a.nav-link:hover {
            text-decoration: none;
            font-size: 18px;
            font-family: sans-serif;
            font-weight: 500;
            cursor: pointer;
            position: relative;
            color: #FF730D;
        }

        @keyframes FadeIn {
            0% {
                opacity: 0;
                -webkit-transition-duration: 0.8s;
                transition-duration: 0.8s;
                -webkit-transform: translateY(-10px);
                -ms-transform: translateY(-10px);
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                -webkit-transform: translateY(0);
                -ms-transform: translateY(0);
                transform: translateY(0);
                pointer-events: auto;
                transition: cubic-bezier(0.4, 0, 0.2, 1);
            }
        }

        .nav-list li {
            animation: FadeIn 1s cubic-bezier(0.65, 0.05, 0.36, 1);
            animation-fill-mode: both;
        }

        .nav-list li:nth-child(1) {
            animation-delay: .3s;
        }

        .nav-list li:nth-child(2) {
            animation-delay: .6s;
        }

        .nav-list li:nth-child(3) {
            animation-delay: .9s;
        }

        .nav-list li:nth-child(4) {
            animation-delay: 1.2s;
        }

        .nav-list li:nth-child(5) {
            animation-delay: 1.5s;
        }

        @keyframes fadeInUp {
            from {
                transform: translate3d(0, 40px, 0)
            }
            to {
                transform: translate3d(0, 0, 0);
                opacity: 1
            }
        }

        @-webkit-keyframes fadeInUp {
            from {
                transform: translate3d(0, 40px, 0)
            }
            to {
                transform: translate3d(0, 0, 0);
                opacity: 1
            }
        }

        .animated {
            animation-duration: 1s;
            animation-fill-mode: both;
            -webkit-animation-duration: 1s;
            -webkit-animation-fill-mode: both
        }

        .animatedFadeInUp {
            opacity: 0
        }

        .fadeInUp {
            opacity: 0;
            animation-name: fadeInUp;
            -webkit-animation-name: fadeInUp;
        }
        .call {
            background-color: white;
            color: black;
            padding: 10px;
        }
        .call:hover {
            background-color: #FF730D;
            color: white;
            text-decoration: none;
        }
        .contactus{
            background-color: #262626;
            color: white;
            padding: 10px;
            text-decoration: none;
            padding-bottom: 185px;
        }
    </style>
    <style>
        /*Font-awesome integration*/
@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
/*Google font integration*/
@import url('https://fonts.googleapis.com/css?family=Roboto');

#contact{
    background-color:#f1f1f1;
    font-family: 'Roboto', sans-serif;
}

#contact .well{
    margin-top:30px;
    border-radius:0;
}

#contact .form-control{
    border-radius: 0;
    border:2px solid #1e1e1e;
}

#contact button{
    border-radius:0;
    border:2px solid #1e1e1e;
}

#contact .row{
    margin-bottom:30px;
}

@media (max-width: 768px) { 
    #contact iframe {
        margin-bottom: 15px;
    }
    
}
    </style>

    <?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    $stmt->close();
}
?>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
    <nav class="main-navigation" style="background-color: #262626;">
        <div class="navbar-header animated fadeInUp">
            <a href="home.html" class="navbar-brand">
                <img src="https://cdn.discordapp.com/attachments/1266366410582392853/1266366532733243422/image.png?ex=66a4e33d&is=66a391bd&hm=3546ee6bff4d936a6df29b6976d2ed67ffe9ff9f3b65fbf1cd4cc80e34d0031d&" alt="logo" style="float: left;">
            </a>
        </div>
        <ul class="nav-list">
            <li class="nav-list-item">
                <a href="pricing.html" class="nav-link">Pricing</a>
            </li>
            <li class="nav-list-item">
                <a href="testimonials.html" class="nav-link">Products</a>
            </li>
            <li class="nav-list-item">
                <a href="personaltrainers.html" class="nav-link">About us</a>
            </li>
            <li class="nav-list-item">
                <a href="http://localhost/ecommerce/loginpage.php" class="nav-link">Log in</a>
            </li>
            <li class="nav-list-item">
                <a href="" class="nav-link">Contact us</a>
            </li>
        </ul>
    </nav>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <section id="contact">
        <div class="container">
          <div class="well well-sm">
            <h3><strong>Contact Us</strong></h3>
          </div>
          
          <div class="row">
            <div class="col-md-7">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1443325.1558141676!2d24.359130801725907!3d53.549156940255216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dd946e39117309%3A0x4060263dc3e35295!2sVytenio%20g.%2051%2C%20Vilnius%2C%2003209%20Vilniaus%20m.%20sav.%2C%20Lithuania!5e0!3m2!1sen!2seg!4v1722001884938!5m2!1sen!2seg" width="100%" height="315" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
      
            <div class="col-md-5">
                <h4><strong>Get in Touch</strong></h4>
              <form method="post" action="contact.php">
                <div class="form-group">
                  <input type="text" class="form-control" name="username" value="" placeholder="Name">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" value="" placeholder="E-mail">
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="3" placeholder="Message"></textarea>
                </div>
                <button class="btn btn-default" type="submit" name="button">
                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Submit
                </button>
              </form>
            </div>
          </div>
        </div>
      </section>
    <div>
</body>
</html>
