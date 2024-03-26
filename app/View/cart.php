<?php
if (empty($userProducts)) {
    echo "Корзина пустая";
} ?>

<body>
<div id="w">
    <header id="title">
        <h1>Простой Магазин</h1>
    </header>
    <div id="page">
        <table id="cart">
            <thead>
            <tr>
                <th class="first">Photo</th>
                <th class="second">Quantity</th>
                <th class="third">Product</th>
                <th class="fourth">Line Total</th>
                <th class="fifth">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($userProducts)) {
                foreach ($userProducts as $userProduct):
            ?>
            <!-- shopping cart contents -->
            <tr class="productitm">

                <td><img src="<?php echo $userProduct->getProduct()->getImage(); ?>" alt="Card image" style="width: 55px; height: 65px; class="thumb"></td>
                <td> <h1 style="color: #161623"> <?php echo $userProduct->getQuantity(); ?> </h1></td>
                <td> <h2> <?php echo $userProduct->getProduct()->getName(); ?> </h2></td>
                <td> <?php echo '$' . $userProduct->getProduct()->getPrice() * $userProduct->getQuantity(); ?></td>
                <td><span class="remove"><img src="https://i.imgur.com/h1ldGRr.png" alt="X"></span></td>
            </tr>
            <?php endforeach;
            } ?>

            <!--subtotal -->

            <tr class="totalprice">
                <td class="light"><h1 style="color: navy"> Total: </h1></td>
                <td colspan="2">&nbsp;</td>
                <td colspan="2"><span class="thick"><h2 style="color: red"> <?php echo '$' . $totalPrice ?> </span> </h1></td>
            </tr>

            <!-- checkout btn -->
            <tr class="checkoutrow">
                <td colspan="5" class="checkout"><button id="submitbtn"> <a href="/order" style="color: black">Checkout Now!</a></button></td>
            </tr>

            <tr class="main">
                <td colspan="5" class="checkout"><button id="submitbtn"> <a href="/main" style="color: black">Main</a></button></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>

<style>
    @import url(https://fonts.googleapis.com/css?family=Fredoka+One);

    body {
        background-color: #f1f1f1;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    #w {
        max-width: 1200px;
        margin: 0 auto;
        background-color: #fff;
        margin-top: 50px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }

    #title {
        background-color: #0e4bf1;
        padding: 20px;
        text-align: center;
    }

    #title h1 {
        color: #fff;
        margin: 0;
    }

    #page {
        padding: 20px;
    }

    #cart {
        width: 100%;
        border-collapse: collapse;
    }

    #cart th, #cart td {
        padding: 10px;
    }

    #cart th {
        background-color: #0e4bf1;
        color: #fff;
        text-align: left;
    }

    #cart td {
        border-bottom: 1px solid #ddd;
    }

    .light {
        font-weight: lighter;
    }

    .totalprice {
        font-weight: bold;
        background-color: #f1f1f1;
    }

    .checkoutrow {
        text-align: right;
    }

    .main {
        text-align: left;
    }

    .checkout {
        padding: 20px 0;
    }

    .checkout button {
        background-color: #0e4bf1;
        color: #fff;
        border: none;
        padding: 10px 20px;
        text-transform: uppercase;
        font-weight: bold;
        cursor: pointer;
    }

    .checkout button a {
        color: #fff;
        text-decoration: none;
    }

    .remove {
        color: #f00;
        cursor: pointer;
    }

    .remove img {
        width: 15px;
        vertical-align: middle;
    }

    .remove:hover {
        text-decoration: underline;
    }
    </style>