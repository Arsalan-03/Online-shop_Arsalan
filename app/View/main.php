<?php
if (empty($products)) {

    echo '<h1 style="color: red">Продуктов в Таблице нет</h1>';
}
?>

<div class="container">
    <h1>Online Shop "Ice-Cream"</h1>

    <a class="basket" href="http://localhost:81/cart">
        <img src="https://png.pngtree.com/element_our/20190531/ourlarge/pngtree-shopping-cart-convenient-icon-image_1287807.jpg" alt="Cart">
        <?php if (isset($totalQuantity)): ?>
            <p class="totalQuantity"><?php echo $totalQuantity . ' шт'; ?></p>
        <?php endif; ?>
    </a>

    <div class="card-deck">
        <?php if (isset($products)) {
        foreach ($products as $product): ?>
        <div class="card">
            <h1><?php echo $product->getName(); ?></h1>
            <img class="card-img-top" src="<?php echo $product->getImage(); ?>" alt="Card image">
            <div class="card-body">
                <a href="#"><h4 class="card-title"><?php echo $product->getInfo(); ?></h4></a>
            </div>
            <div class="card-footer">
                <h2><?php echo '$' . $product->getPrice(); ?></h2>
            </div>
            <form action="/add-product" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>">
                <div class="input-box">
                    <?php echo $errors['quantity'] ?? ''; ?>
                    <input type="number" name="quantity" min="1" max="10">
                </div>
                <button class="add-to-cart">+</button>
            </form>
            <form action="/delete-product" method="POST">
                <?php echo $errors['product_id'] ?? ''; ?>
                <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>">
                <input type="hidden" name="quantity" value="1">
                <button class="add-to-cart">-</button>
            </form>
        </div>
        <?php endforeach;
        }?>
    </div>

    <form action="/logout" method="POST">
        <button type="submit" class="logout">Logout</button>
    </form>
</div>

<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        color: darkred;
        font-size: 32px;
        text-align: center;
        margin-bottom: 20px;
    }

    .basket {
        color: #0e4bf1;
        float: right;
        margin-left: 10px;
        text-decoration: none;
    }

    .basket img {
        width: 75px;
        height: 75px;
    }

    .totalQuantity {
        margin: 0;
        text-align: center;
        font-size: 20px;
        color: navy;
    }

    .card-deck {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .card {
        width: 250px;
        margin-bottom: 20px;
        padding: 10px;
        text-align: center;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        transition: transform 0.2s;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-img-top {
        width: 250px;
        height: 300px;
        object-fit: contain;
        margin-bottom: 10px;
    }

    .card-title {
        margin: 0;
        font-size: 18px;
    }

    .card-footer {
        margin-top: 10px;
        font-size: 20px;
        font-weight: bold;
    }

    input[type="number"] {
        width: 40px;
    }

    .add-to-cart {
        display: block;
        margin: 10px auto;
        width: 50px;
        height: 50px;
        font-size: 24px;
        text-align: center;
        background-color: #f1f1f1;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .add-to-cart:hover {
        background-color: #ddd;
    }

    .logout {
        display: block;
        margin: 20px auto;
        padding: 10px 20px;
        font-size: 18px;
        text-align: center;
        background-color: #f1f1f1;
        color: #333;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .logout:hover {
        background-color: #ddd;
    }

    body {
        background-image: url("https://new-retail.ru/upload/iblock/eb5/5qhpoziurrlcm839m1ajd7vq4lpt5yzn.webp");
        background-size: cover;
        background-position: center;
    }
</style>