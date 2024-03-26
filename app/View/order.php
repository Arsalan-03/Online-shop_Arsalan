<header>
    <h2>Checkout</h2>
</header>

<main>
    <section class="checkout-form">
        <form action="/order" method="POST">
            <h5>Contact information</h5>
            <div class="form-control">
                <label for="checkout-email">E-mail</label>
                <label style="color: red"><?php echo $errors['email'] ?? ''; ?></label>
                <div>
                    <span class="fa fa-envelope"></span>
                    <input type="email" id="email" name="email" placeholder="Enter your email...">
                </div>
            </div>
            <div class="form-control">
                <label for="phone">Phone</label>
                <label style="color: red"><?php echo $errors['postal'] ?? ''; ?></label>
                <div>
                    <span class="fa fa-phone"></span>
                    <input type="tel" name="phone" id="phone" placeholder="Enter your phone...">
                </div>
            </div>
            <br>
            <h5>Shipping address</h5>
            <div class="form-control">
                <label for="name">Full name</label>
                <label style="color: red"><?php echo $errors['name'] ?? ''; ?></label>
                <div>
                    <span class="fa fa-user-circle"></span>
                    <input type="text" id="name" name="name" placeholder="Enter your name...">
                </div>
            </div>
            <div class="form-control">
                <label for="address">Address</label>
                <label style="color: red"><?php echo $errors['address'] ?? ''; ?></label>
                <div>
                    <span class="fa fa-home"></span>
                    <input type="text" name="address" id="address" placeholder="Your address...">
                </div>
            </div>
            <div class="form-control">
                <label for="city">City</label>
                <label style="color: red"><?php echo $errors['city'] ?? ''; ?></label>
                <div>
                    <span class="fa fa-building"></span>
                    <input type="text" name="city" id="city" placeholder="Your city...">
                </div>
            </div>
            <div class="form-group">
                <div class="form-control">
                    <label for="country">Country</label>
                    <label style="color: red"><?php echo $errors['country'] ?? ''; ?></label>
                    <div>
                        <span class="fa fa-globe"></span>
                        <input type="text" name="country" id="country" placeholder="Your country..." list="country-list">
                        <datalist id="country-list">
                            <option value="China"></option>
                            <option value="USA"></option>
                            <option value="Russia"></option>
                            <option value="Japan"></option>
                            <option value="Mongolia"></option>
                        </datalist>
                    </div>
                </div>
                <div class="form-control">
                    <label for="postal">Postal code</label>
                    <label style="color: red"><?php echo $errors['postal'] ?? ''; ?></label>
                    <div>
                        <span class="fa fa-archive"></span>
                        <input type="numeric" name="postal" id="postal" placeholder="Your postal code...">
                    </div>
                </div>
            </div>
            <div class="form-control checkbox-control">
                <input type="checkbox" name="checkout-checkbox" id="checkout-checkbox">
                <label for="checkout-checkbox">Save this information for next time</label>
            </div>
            <div class="form-control-btn">
                <button>Continue</button>
            </div>
        </form>
    </section>
</main>


<style>
    header {
        text-align: center;
        margin-bottom: 40px;
    }

    header h2 {
        color: black;
    }

    main {
        max-width: 600px;
        margin: 0 auto;
        padding: 0 20px;
    }

    form {
        background-color: #f1f1f1;
        padding: 20px;
        border-radius: 5px;
    }

    form h5 {
        color: black;
        margin-bottom: 10px;
    }

    .form-control {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: black;
    }

    .form-control div {
        display: flex;
        align-items: center;
        background-color: white;
        border-radius: 5px;
        padding: 5px;
    }

    .form-control .fa {
        margin-right: 10px;
        color: #777;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="numeric"] {
        flex: 1;
        border: none;
        padding: 5px;
    }

    .checkbox-control {
        display: flex;
        align-items: center;
    }

    .checkbox-control label {
        margin-left: 5px;
        font-weight: normal;
        color: black;
    }

    .form-control-btn {
        text-align: center;
    }

    button {
        background-color: #0e4bf1;
        color: white;
        border: none;
        padding: 10px 20px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    button:hover {
        background-color: #0743ce;
    }
</style>
