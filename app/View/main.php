<?php
if (empty($products)) {

    echo '<h1 style="color: red">Продуктов в Таблице нет</h1>';
}
?>

<div class="container">
    <h1 style="color: darkred">Online_shop "Ice-Cream" </h1>

    <a class="basket" href="http://localhost:81/cart" style="color: #0e4bf1; float: right; margin-left: 10px;">
        <img src="https://png.pngtree.com/element_our/20190531/ourlarge/pngtree-shopping-cart-convenient-icon-image_1287807.jpg" alt="Cart" style="width: 75px; height: 75px;">
        <?php if (isset($totalQuantity)): ?> <h2> <?php echo $totalQuantity . 'шт'; endif; ?> </h2>
    </a>

    <div class="card-deck">
        <?php if (isset($products)) {
            foreach ($products as $product): ?>
        <form action="/add-product" method="POST">
            <div class="card text-center">

                    <p class="card-text text-muted"><h1> <?php echo $product['name']; ?> </h1>
                    <img class="card-img-top" src=" <?php echo $product['image']; ?>" alt="Card image" style="width: 250px; height: 300px;>
                <div class="card-body">
                    <a href="#"><h4 class="card-title"><?php echo $product['info']; ?></h4></a>
                    <div class="card-footer">
                        <h2> <?php echo '$' . $product['price']; ?></h2>
                    </div>
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
<!--                    <div class="input-box">-->
<!--                        --><?php //echo $errors['quantity'] ?? ''; ?>
<!--                        <input type="text" name="quantity" placeholder="Количество">-->
<!--                    </div>-->
<!--                    <button class="image-button"></button>-->
            </div>
            <div class="input-box">
                <?php echo $errors['quantity'] ?? ''; ?>
                <input type="number" name="quantity"  min="1" max="10">
            </div>
            <button class="add-to-cart" id='test'>+</button>
        </form>
        <form action="/delete-product" method="POST">
            <input type="hidden" name="quantity" value="<?php echo $product['quantity'] ?? '1';?>">
            <input type="hidden" name="product_id" value="<?php echo $product['id'];  ?>">
            <button class="add-to-cart" id='test' value="">-</button>
        </form>

        </div>
        <?php endforeach; }?>

    <form action="/logout" method="POST">
        <button type="submit" class="logout"> <h1> Logout </h1></button>
    </form>

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

    .text-muted {
        font-size: 11px;
    }

    .card-footer{
        font-weight: bold;
        font-size: 18px;
        background-color: white;
    }

    .add-to-cart {
        border: none;
        cursor: pointer;
        display: block;
        margin: 1%;
        width: 10em;
        height: 2em;
        background: rgb(5, 5, 5);
        color: white;
        font-weight: bold;
        border-radius: 20px;
    }

    .add-to-cart:hover {
        background: #0e4bf1;
    }

    .add-to-cart:active {
        background: #0e4bf1;
    }

    .logout {
        background-color: #ff0000;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
    }

    .logout h1 {
        font-size: 18px;
        margin: 0;
    }
</style>