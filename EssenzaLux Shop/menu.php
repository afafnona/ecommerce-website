<?php

include 'includes/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

include 'includes/add_cart.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EssenzaLux Shop</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Oswald:wght@400;700&display=swap" rel="stylesheet">

    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
      /* Reset and base */


/* Products Section */
.products {
  max-width: 1200px;
  margin: 0 auto 80px;
}

.products .title {
  font-family: 'Oswald', sans-serif;
  font-weight: 700;
  font-size: 2.4rem;
  color: #bfa26f;
  text-align: center;
  text-transform: uppercase;
  margin-bottom: 40px;
  text-shadow: 0 1px 5px rgba(191, 162, 111, 0.5);
}

/* Container Flex */
.products-container {
  display: flex;
  gap: 30px;
  flex-wrap: wrap;
}

/* Sidebar Categories */
.categories {
  background: #faf7f0;
  min-width: 230px;
  padding: 30px 25px;
  border-radius: 15px;
  box-shadow: 0 8px 30px rgba(191, 162, 111, 0.12);
  height: fit-content;
}

.categories h3 {
  font-family: 'Oswald', sans-serif;
  font-weight: 700;
  font-size: 1.7rem;
  color: #bfa26f;
  margin-bottom: 25px;
  border-bottom: 2px solid #bfa26f;
  padding-bottom: 10px;
  text-transform: uppercase;
  letter-spacing: 1.5px;
}

.categories ul {
  list-style: none;
}

.categories ul li {
  margin-bottom: 18px;
}

.categories ul li a {
  font-weight: 600;
  font-size: 1.1rem;
  color: #444;
  padding: 8px 15px;
  border-radius: 10px;
  display: block;
  border: 2px solid transparent;
  transition: all 0.3s ease;
  box-shadow: inset 0 0 0 transparent;
}

.categories ul li a:hover,
.categories ul li a.active {
  background-color: #bfa26f;
  color: #fff;
  border-color: #bfa26f;
  box-shadow: 0 8px 15px rgba(191, 162, 111, 0.45);
}

/* Product Boxes Container */
.box-container {
  flex: 1;
  display: flex;
  flex-wrap: wrap;
  gap: 25px;
  justify-content: flex-start;
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.4s ease, transform 0.4s ease;
}

.box-container.visible {
  opacity: 1;
  transform: translateY(0);
}

/* Empty and Loading messages */
.empty,
.loading,
.error {
  font-size: 1.2rem;
  color: #999;
  font-style: italic;
  margin-top: 50px;
  width: 100%;
  text-align: center;
}


/* Scroll to Top Button */
#scrollTopBtn {
  position: fixed;
  bottom: 35px;
  right: 35px;
  background-color: #bfa26f;
  color: #fff;
  border: none;
  border-radius: 50%;
  padding: 15px 17px;
  font-size: 22px;
  cursor: pointer;
  box-shadow: 0 8px 15px rgba(191, 162, 111, 0.7);
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.3s ease;
  z-index: 9999;
}

#scrollTopBtn.show {
  opacity: 1;
  pointer-events: auto;
}

#scrollTopBtn:hover {
  background-color: #8c6d2f;
  box-shadow: 0 12px 22px rgba(140, 109, 47, 0.8);
}

/* Responsive */
@media (max-width: 992px) {
  .products-container {
    flex-direction: column;
  }

  .categories {
    width: 100%;
    min-width: unset;
    margin-bottom: 30px;
  }

  .box-container {
    justify-content: center;
  }
}

@media (max-width: 480px) {
  body {
    padding: 10px;
    font-size: 14px;
  }

  .heading h3 {
    font-size: 1.8rem;
  }

  .products .title {
    font-size: 1.5rem;
  }

  .categories h3 {
    font-size: 1.3rem;
  }
}

        .box-container {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        .box-container.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <?php include 'includes/user_header.php'; ?>

    <!-- Banner Image Slider -->
    <div class="banner-slider">
        <div><img src="https://www.notino.hu/fotocache/gallery/ba/7/HB%20The%20Scent%20Intense_1017_BP%20Banner_web.jpg" alt="Banner 1"></div>
        <div><img src="https://cdn.notinoimg.com/c=85/images/gallery/ba/4/PL_Dior_Homme23_Desktop_1035x340.jpg" alt="Banner 2"></div>
        <div><img src="images/j.jpg" alt="Banner 3"></div>
    </div>

    <div class="heading">
        <h3>our products</h3>
        <p><a href="home.php">Home</a> <span> / Products</span></p>
    </div>

    <section class="products">
        <h1 class="title">latest products</h1>

        <div class="products-container" style="display: flex; gap: 20px; flex-wrap: wrap;">

            <!-- Sidebar with categories -->
            <aside class="categories" style="min-width: 200px; background: #f9f9f9; padding: 20px; border-radius: 10px;">
                <h3>Categories</h3>
                <ul id="category-list" style="list-style: none; padding-left: 0;">
                    <li style="margin: 10px 0;"><a href="#" class="category-filter" data-category="all">Tous les produits</a></li>
                    <?php
                    $stmt = $conn->prepare("SELECT DISTINCT category FROM products");
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<li style="margin: 10px 0;"><a href="#" class="category-filter" data-category="' . $row['category'] . '">' . $row['category'] . '</a></li>';
                    }
                    ?>
                </ul>
                <hr>
               
            </aside>

            <!-- Product boxes -->
            <div class="box-container visible" id="product-list" style="flex: 1; display: flex; flex-wrap: wrap; gap: 20px;">
                <?php
                $select_products = $conn->prepare("SELECT * FROM `products`");
                $select_products->execute();
                if ($select_products->rowCount() > 0) {
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                        include 'includes/product_box.php';
                    }
                } else {
                    echo '<p class="empty">no products added yet!</p>';
                }
                ?>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI for slider -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!-- Slick Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

    <!-- Initialize Sliders -->
    <script>
        $(document).ready(function () {
            $('.banner-slider').slick({
                dots: true,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: true,
                fade: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                pauseOnHover: false
            });

            

            // Category Filter
            const cache = {};
            $('.category-filter').on('click', function (e) {
                e.preventDefault();
                const category = $(this).data('category');

                if (cache[category]) {
                    $('#product-list').html(cache[category]).addClass('visible');
                    return;
                }

                $('#product-list').removeClass('visible').html('<p class="loading">Chargement des produits...</p>');

                $.ajax({
                    url: 'fetch_products.php',
                    method: 'POST',
                    data: { category },
                    success: function (response) {
                        $('#product-list').html(response).addClass('visible');
                        cache[category] = response;
                    },
                    error: function () {
                        $('#product-list').html('<p class="error">Erreur lors du chargement.</p>');
                    }
                });
            });
        });
    </script>

    <!-- Scroll to Top Button -->
    <button id="scrollTopBtn" title="Go to top">
        <i class="fas fa-arrow-up"></i>
    </button>
    <script>
        window.onscroll = function () { scrollFunction(); };
        function scrollFunction() {
            const scrollBtn = document.getElementById("scrollTopBtn");
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                scrollBtn.classList.add("show");
            } else {
                scrollBtn.classList.remove("show");
            }
        }
        document.getElementById('scrollTopBtn').addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>
</html>
