<?php 
session_start();
include "config.php"; 

$search = "";

// Jika user melakukan pencarian
if (isset($_GET['search']) && $_GET['search'] != "") {
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    // Pecah input menjadi kata-kata
    $keywords = explode(" ", $search);

    // Siapkan kondisi LIKE per kata
    $conditions = [];
    foreach ($keywords as $word) {
        $word = trim($word);
        if ($word != "") {
            $conditions[] = "name LIKE '%$word%'";
        }
    }

    // Gabungkan kondisi pakai OR
    $where = implode(" OR ", $conditions);

    // Query dengan filter
    $sql = "SELECT * FROM product WHERE $where ORDER BY id DESC";

} else {
    // Jika tidak search, tampilkan semua produk
    $sql = "SELECT * FROM product ORDER BY id DESC";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>

    <!-- ====== CSS BASIC ====== -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        /* ========== NAVBAR STYLE (SAMA DENGAN INDEX.PHP) ========== */
        .header {
            width: 100%;
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .header-top {
            padding: 10px 0;
        }

        .header-top .container {
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .input-wrapper {
            flex: 1;
            display: flex;
            border: 1px solid #ddd;
            border-radius: 30px;
            overflow: hidden;
            background: #fff;
        }

        .search-field {
            flex: 1;
            border: none;
            padding: 12px 16px;
            outline: none;
            font-size: 15px;
        }

        .search-submit {
            background: none;
            border: none;
            padding: 0 18px;
            cursor: pointer;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .header-action-btn {
            font-size: 20px;
            cursor: pointer;
            background: none;
            border: none;
            color: #333;
            display: flex;
            align-items: center;
            position: relative;
        }

        .header-action-btn .btn-badge {
            position: absolute;
            top: -6px;
            right: -8px;
            background: #e63946;
            color: white;
            padding: 2px 6px;
            font-size: 11px;
            border-radius: 50%;
        }

        .btn-login, .btn-register {
            font-size: 14px;
            padding: 6px 10px;
            border-radius: 6px;
            background: #efefef;
            text-decoration: none;
        }


        /* ========== PRODUCT GRID ========== */
        h2 {
            text-align: center;
            margin: 25px 0;
            font-size: 28px;
            color: #333;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 25px;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        .shop-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: .2s ease;
        }

        .shop-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .card-banner {
            position: relative;
            width: 100%;
            height: 330px;
            overflow: hidden;
        }

        .card-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            opacity: 0;
            transition: .2s ease;
        }

        .shop-card:hover .card-actions {
            opacity: 1;
        }

        .action-btn {
            background: #fff;
            border: none;
            padding: 8px;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            cursor: pointer;
        }

        .card-content {
            padding: 15px;
        }

        .card-content .price .span {
            font-size: 18px;
            font-weight: bold;
            color: #e63946;
        }

        .card-title {
            display: block;
            font-size: 17px;
            font-weight: bold;
            color: #333;
            margin: 8px 0;
            text-decoration: none;
        }

        .rating-wrapper ion-icon {
            color: #ffc107;
        }

        .rating-text {
            font-size: 14px;
            color: #666;
        }

        /* Mobile navbar overlay */
        .overlay {
            display: none;
        }

        .clear-btn {
            display: flex;
            align-items: center;
            padding: 0 12px;
            cursor: pointer;
            font-size: 20px;
            color: #999;
            text-decoration: none;
        }

        .clear-btn:hover {
            color: #666;
        }

    </style>

    <!-- ICONS -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</head>
<body>

<!-- ===================================================== -->
<!-- =============== NAVBAR SIMPLIFIED =================== -->
<!-- ===================================================== -->
<header class="header">

    <div class="header-top">
        <div class="container">

            <!-- SEARCH -->



            <form action="product.php" method="GET" class="input-wrapper">

                <input 
                    type="search" 
                    name="search" 
                    placeholder="Search product"
                    class="search-field"
                    value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>"
                />

                <!-- Tombol Search -->
                <button type="submit" class="search-submit">
                    <ion-icon name="search-outline"></ion-icon>
                </button>

                <!-- Tombol Reset / Clear (X) -->
                <?php if (!empty($_GET['search'])): ?>
                    <a href="product.php" class="clear-btn">
                        <ion-icon name="close-circle-outline"></ion-icon>
                    </a>
                <?php endif; ?>

            </form>


            <!-- USER ACTIONS -->
            <div class="header-actions">

                <?php if (isset($_SESSION['user_id'])): ?>

                    <a href="profile.php" class="header-action-btn">
                        <ion-icon name="person-circle-outline"></ion-icon>
                    </a>

                <?php else: ?>

                    <a href="login.php" class="header-action-btn btn-login">Login</a>
                    <a href="register.php" class="header-action-btn btn-register">Register</a>

                <?php endif; ?>

                <a href="favorite.php" class="header-action-btn">
                    <ion-icon name="star-outline"></ion-icon>
                    <span class="btn-badge">
                        <?= isset($_SESSION['favorite']) ? count($_SESSION['favorite']) : 0 ?>
                    </span>
                </a>


                <a href="cart.php" class="header-action-btn">
                    <ion-icon name="bag-handle-outline"></ion-icon>
                    <span class="btn-badge">
                        <?= isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'qty')) : 0 ?>
                    </span>
                </a>


            </div>
        </div>
    </div>

</header>


<!-- ===================================================== -->
<!-- ================== PRODUCT LIST ===================== -->
<!-- ===================================================== -->


<h2>Semua Produk</h2>


<div class="product-grid">
    
    <?php while ($p = mysqli_fetch_assoc($result)) { ?>
        
        <div class="shop-card">
        <div class="card-banner">

            <a href="detail.php?id=<?= $p['id']; ?>">
                <img src="admin/product/upload/<?= $p['image']; ?>" alt="<?= $p['name']; ?>">
            </a>

            <div class="card-actions">
                <a href="cart_add.php?id=<?= $p['id']; ?>" class="action-btn">
                    <ion-icon name="bag-handle-outline"></ion-icon>
                </a>

                <a href="favorite_add.php?id=<?= $p['id']; ?>" class="action-btn">
                    <ion-icon name="star-outline"></ion-icon>
                </a>

                <button class="action-btn"><ion-icon name="repeat-outline"></ion-icon></button>
            </div>

        </div>

        <div class="card-content">
            <div class="price">
                <span class="span">Rp <?= number_format($p['price'], 0, ',', '.'); ?></span>
            </div>

            <h3>
                <a href="detail.php?id=<?= $p['id']; ?>" class="card-title">
                    <?= $p['name']; ?>
                </a>
            </h3>

            <div class="card-rating">
                <div class="rating-wrapper">
                    <?php for($i = 1; $i <= $p['rating']; $i++) { ?>
                        <ion-icon name="star"></ion-icon>
                    <?php } ?>
                </div>
                <p class="rating-text">5170 reviews</p>
            </div>
        </div>
    </div>

<?php } ?>

</div>

</body>
</html>
