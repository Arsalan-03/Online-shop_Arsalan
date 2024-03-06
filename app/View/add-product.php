<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <!-- CSS only -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"
    />
    <link
        rel="stylesheet"
        href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous"
    />
    <script
        src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"
    ></script>
    <title>Animated Card</title>
</head>
<body>
<div class="wrapper">
    <center>
        <div class="card" style="margin-top: 200px;">
            <div class="circle"></div>
            <div class="circle"></div>

            <div class="card-inner login">
                <form action="/add-product" method="POST">
                    <div class="input-box">
                        <input type="text" name="product_id" placeholder="Product-id">
                        <label style="color: red"><?php echo $errors['product_id'] ?? ''; ?></label>
                        <i class="fa fa-envelope"></i>
                    </div>

                    <div class="input-box">
                        <input type="text" name="quantity" placeholder="Quantity">
                        <label style="color: red"><?php echo $errors['quantity'] ?? ''; ?></label>
                        <i class="fa fa-lock"></i>
                    </div>

                    <button type="submit">Add product</button>

                </form>
            </div>

        </div>
    </center>

</div>


</body>
</html>
<style>
    body{
        margin: 0;
        padding: 0;
    }
    .wrapper{
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        background: rgb(0,0,0);
        background: linear-gradient(0deg, rgba(0,0,0,1) 0%, rgba(44,51,51,1) 100%);
    }
    .wrapper .card .card-inner #Title{
        margin-top: 150px;
        text-transform: uppercase;
    }

    .card {
        width: 300px;
        height: 400px;
        margin-top: 200px;
        background-color: #2C3333 !important;
        transition: all 0.2s;
        position: relative;
        cursor: pointer;
    }

    .card-inner {
        width: inherit;
        height: inherit;
        background: rgba(255,255,255,.05);
        box-shadow: 0 0 10px rgba(0,0,0,0.25);
        backdrop-filter: blur(10px);
        border-radius: 8px;
    }

    .card:hover {
        transform: scale(1.09);
    }

    .circle {
        width: 350px;
        height: 70px;
        background: radial-gradient(#b0e633, #53ef7d);
        border-radius: 8px;
        position: absolute;
        animation: move-up6 2s ease-in infinite alternate-reverse;
    }


    .circle:nth-child(1) {
        top: -3px;
        /* left: 220px; */
    }

    .circle:nth-child(2) {
        bottom: -10px;
        /* right: 220px; */
        animation-name: move-down1;
    }


    @keyframes move-up6 {
        to {
            transform: translateY(-10px);
        }
    }

    @keyframes move-down1 {
        to {
            transform: translateY(10px);
        }
    }

    @media (max-width:400px) {
        .login {
            width: 90%;
        }
    }
    .login {
        position: relative;
        width: 350px;
        padding: 30px;
        height: fit-content;
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 15px;
        z-index: 10;
        backdrop-filter: blur(25px);
        box-shadow: 10px 10px 40px rgba(0, 0, 0, 0.2),
        -10px -10px 40px rgba(0, 0, 0, 0.2);
    }
    .login h1 {
        font-size: 1.8rem;
        color: #fff;
        margin-bottom: 40px;
        margin-top: 0;
        text-align: center;
    }

    .login form {
        width: 100%;
        height: 100%;
        outline: none;
        border: none;
    }

    .login form .input-box {
        width: 100%;
        position: relative;
        margin-bottom: 30px;
        display: flex;
    }

    .login form .input-box input {
        width: 100%;
        border: none;
        padding: 1rem 2.7rem 1rem 1rem;
        border-radius: 10px;
        color: #fff;
        background-color: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.4);
    }

    .login form .input-box input::placeholder {
        color: #fff;
        font-size: 0.8rem;
        transition: 0.5s ease;
    }

    .login form .input-box input:focus::placeholder {
        opacity: 0;
    }

    .login form .input-box input:focus {
        outline: none;
    }

    .login form .input-box i {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        color: #fff;
        font-size: 1.2rem;
    }

    .login form .rembar {
        margin-bottom: 30px;
        width: 100%;
    }

    .login form .rembar input {
        appearance: none;
    }

    .login form .rembar label {
        color: #fff;
        position: relative;
        width: 100%;
        padding-left: 35px;
        font-size: 0.9rem;
    }

    .login form .rembar label::before {
        content: "";
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.2);
    }

    .login form .rembar label::after {
        content: "";
        position: absolute;
        left: 4px;
        top: 50%;
        transform: translateY(-50%);
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background-color: #fff;
        transition: 0.5 ease;
        opacity: 0;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
    }

    .login form .rembar input:checked + label::after {
        opacity: 1;
    }

    .login form button {
        width: 100%;
        border: none;
        padding: 1rem 1rem 1rem 2.7rem;
        border-radius: 10px;
        color: #fff;
        margin-bottom: 30px;
        background-color: #161623;
        border: 1px solid rgba(255, 255, 255, 0.4);
        transition: 0.5s ease;
        cursor: pointer;
        font-weight: 600;
    }

    .login form button:hover {
        background-color: #111;
    }

    .login form .links {
        width: 100%;
        display: flex;
        justify-content: space-between;
        gap: 15px;
    }

    .login form .links a {
        color: #fff;
        font-weight: 100;
        font-size: 0.7rem;
    }
</style>
