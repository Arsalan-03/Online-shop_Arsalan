<div class="container">
    <h2>Catalog</h2>
    <div class="card-deck">
        <?php if (isset($products)) {
            foreach ($products as $product): ?>
        <form>
            <div class="card text-center">
                <a href="#">
                    <p class="card-text text-muted"><h1> <?php echo $product['name']; ?> </h1>
                    <img class="card-img-top" src=" <?php echo $product['image']; ?>" alt="Card image" style="width: 250px; height: 300px;>
                <div class="card-body">
                    <a href="#"><h4 class="card-title"><?php echo $product['info']; ?></h4></a>
                    <div class="card-footer">
                        <h2> <?php echo '$' . $product['price']; ?></h2>
                    </div>
            </div>
                    <button type="submit" class="registerbtn"> Купить </button>
            </a>
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

    .registerbtn {
        background-image: url("../images/icon.svg");
        background-size: 90px 97px;
    }
</style>