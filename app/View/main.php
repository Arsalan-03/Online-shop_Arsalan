<?php
if (empty($products)) {

    echo '<h1 style="color: red">Продуктов в Таблице нет</h1>';
}
?>

<div class="container">
    <h2>Catalog</h2>

    <a class="basket" href="http://localhost:81/cart" style="color: green; float: right; margin-left: 10px;">
        <img src="https://png.pngtree.com/element_our/20190531/ourlarge/pngtree-shopping-cart-convenient-icon-image_1287807.jpg" alt="Cart" style="width: 100px; height: 100px;">
    </a>

    <div class="card-deck">
        <?php if (isset($products)) {
            foreach ($products as $product): ?>
        <form action="/main" method="POST">
            <div class="card text-center">

                    <p class="card-text text-muted"><h1> <?php echo $product['name']; ?> </h1>
                    <img class="card-img-top" src=" <?php echo $product['image']; ?>" alt="Card image" style="width: 250px; height: 300px;>
                <div class="card-body">
                    <a href="#"><h4 class="card-title"><?php echo $product['info']; ?></h4></a>
                    <div class="card-footer">
                        <h2> <?php echo '$' . $product['price']; ?></h2>
                    </div>
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <div class="input-box">
                        <?php echo $errors['quantity'] ?? ''; ?>
                        <input type="text" name="quantity" placeholder="Количество">
                    </div>
                    <button class="image-button"></button>
            </div>

        </form>

        </div>
        <?php endforeach; }?>


    <style>
    body {
        font-style: sans-serif;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }

    h3 {
        line-height: 3em;
    }

    .card {
        max-width: 16rem;
    }

    .card:hover {
        box-shadow: 1px 2px 10px lightgray;
        transition: 0.2s;
    }

    .card-header {
        font-size: 13px;
        color: gray;
        background-color: white;
    }

    .text-muted {
        font-size: 11px;
    }

    .card-footer{
        font-weight: bold;
        font-size: 18px;
        background-color: white;
    }

    .image-button {
        width: 85px;
        height: 50px;
        border: none;
        background-image: url('https://img.freepik.com/premium-vector/shopping-backet-icon-buy-sign-for-sale-web-site-shop-retail-market-and-commerce-store-symbol_87543-11125.jpg');
        background-size: cover;
    }
</style>