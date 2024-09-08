<?php
include 'db.php'; // Include the database connection

// Fetch all categories
$categories_stmt = $conn->prepare("SELECT * FROM categories");
$categories_stmt->execute();
$categories_result = $categories_stmt->get_result();

// Check if a category ID is provided in the URL
if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    // Prepare and execute the query to fetch products from the specified category
    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = ?");
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // If no category ID is provided, set products_result to NULL
    $result = NULL;
}
?>


<!DOCTYPE html>
<head>
    <title>Products</title>
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
    <style>.product-grid3{font-family:Roboto,sans-serif;text-align:center;position:relative;z-index:1}
        .product-grid3:before{content:"";height:81%;width:100%;background:#fff;border:1px solid rgba(0,0,0,.1);opacity:0;position:absolute;top:0;left:0;z-index:-1;transition:all .5s ease 0s}
        .product-grid3:hover:before{opacity:1;height:100%}
        .product-grid3 .product-image3{position:relative}
        .product-grid3 .product-image3 a{display:block}
        .product-grid3 .product-image3 img{width:100%;height:auto}
        .product-grid3 .pic-1{opacity:1;transition:all .5s ease-out 0s}
        .product-grid3 .pic-2{position:absolute;top:0;left:0;opacity:0;transition:all .5s ease-out 0s}
        .product-grid3 .social{width:120px;padding:0;margin:0 auto;list-style:none;opacity:0;position:absolute;right:0;left:0;bottom:-23px;transform:scale(0);transition:all .3s ease 0s}
        .product-grid3:hover .product-discount-label,.product-grid3:hover .product-new-label,.product-grid3:hover .title{opacity:0}
        .product-grid3 .social li{display:inline-block}
        .product-grid3 .social li a{color:#e67e22;background:#fff;font-size:18px;line-height:50px;width:50px;height:50px;border:1px solid rgba(0,0,0,.1);border-radius:50%;margin:0 2px;display:block;transition:all .3s ease 0s}
        .product-grid3 .social li a:hover{background:#e67e22;color:#fff}
        .product-grid3 .product-discount-label,.product-grid3 .product-new-label{background-color:#e67e22;color:#fff;font-size:17px;padding:2px 10px;position:absolute;right:10px;top:10px;transition:all .3s}
        .product-grid3 .product-content{z-index:-1;padding:15px;text-align:left}
        .product-grid3 .title{font-size:14px;text-transform:capitalize;margin:0 0 7px;transition:all .3s ease 0s}
        .product-grid3 .title a{color:#414141}
        .product-grid3 .price{color:#000;font-size:16px;letter-spacing:1px;font-weight:600;margin-right:2px;display:inline-block}
        .product-grid3 .price span{color:#909090;font-size:14px;font-weight:500;letter-spacing:0;text-decoration:line-through;text-align:left;display:inline-block;margin-top:-2px}
        .product-grid3 .rating{padding:0;margin:-22px 0 0;list-style:none;text-align:right;display:block}
        .product-grid3 .rating li{color:#ffd200;font-size:13px;display:inline-block}
        .product-grid3 .rating li.disable{color:#dcdcdc}
        @media only screen and (max-width:1200px){.product-grid3 .rating{margin:0}
        }
        @media only screen and (max-width:990px){.product-grid3{margin-bottom:30px}
        .product-grid3 .rating{margin:-22px 0 0}
        }
        @media only screen and (max-width:359px){.product-grid3 .rating{margin:0}
        }</style>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
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
                <a href="http://localhost/ecommerce/contact.php" class="nav-link">Contact us</a>
            </li>
        </ul>
    </nav>

<h1>Categories</h1>
<ul>
    <?php while ($category = $categories_result->fetch_assoc()): ?>
        <li>
            <a href="category.php?id=<?php echo $category['id']; ?>">
                <?php echo $category['NAME']; ?>
            </a>
        </li>
    <?php endwhile; ?>
</ul>

<h1>Products</h1>
<?php if ($result && $result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div>
        <div class="col-md-3 col-sm-6">
                    <div class="product-grid3">
                        <div class="product-image3">
                            <a href="#" class="pic1">
                            <?php echo file_get_contents($row['img']); ?>
                            </a>
                            <ul class="social">
                                <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">New</span>
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#"><?php echo $row['NAME']; ?></a></h3>
                            <div class="price">
                                 <?php echo $row['price']; ?>
                                <span>$75.00</span>
                            </div>
                            <ul class="rating">
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star "></li>
                                <li class="fa fa-star "></li>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No products found for this category.</p>
<?php endif; ?>

</body>
</html>
