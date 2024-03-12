<header>
    <h2 style="color: black">Checkout</h2>
</header>

<main>

    <section class="checkout-form">
        <form action="/order" method="POST">
            <h5 style="color: black">Contact information</h5>
            <div class="form-control">
                <label for="checkout-email">E-mail</label>
                <div>
                    <span class="fa fa-envelope"></span>
                    <input type="email" id="email" name="email" placeholder="Enter your email...">
                </div>
            </div>
            <div class="form-control">
                <label for="phone">Phone</label>
                <div>
                    <span class="fa fa-phone"></span>
                    <input type="tel" name="phone" id="phone" placeholder="Enter you phone...">
                </div>
            </div>
            <br>
            <h5 style="color: black">Shipping address</h5>
            <div class="form-control">
                <label for="name">Full name</label>
                <div>
                    <span class="fa fa-user-circle"></span>
                    <input type="text" id="name" name="name" placeholder="Enter you name...">
                </div>
            </div>
            <div class="form-control">
                <label for="address">Address</label>
                <div>
                    <span class="fa fa-home"></span>
                    <input type="text" name="address" id="address" placeholder="Your address...">
                </div>
            </div>
            <div class="form-control">
                <label for="city">City</label>
                <div>
                    <span class="fa fa-building"></span>
                    <input type="text" name="city" id="city" placeholder="Your city...">
                </div>
            </div>
            <div class="form-group">
                <div class="form-control">
                    <label for="country">Country</label>
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
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    body {
        font-family: "Poppins", sans-serif;
        height: 100vh;
        width: 70%;
        margin: 0px auto;
        padding: 50px 0px 0px;
        color: #4E5150;


        header {

            height: 5%;
            margin-bottom: 30px;

            > h3 {
                font-size: 25px;
                color: #4E5150;
                font-weight: 500;
            }

        }

        main {
            height: 85%;
            display: flex;
            column-gap: 100px;

            .checkout-form  {
                width: 50%;

                form {

                    h6 {
                        font-size: 12px;
                        font-weight: 500;
                    }

                    .form-control  {
                        margin: 10px 0px;
                        position: relative;
                        color: black;
                        color: red;

                        label:not([for="checkout-checkbox"]) {
                            display: block;
                            font-size: 10px;
                            font-weight: 500;
                            margin-bottom: 2px;
                        }

                        input:not([type="checkbox"]) {
                            width: 100%;
                            padding: 10px 10px 10px 40px;
                            border-radius: 10px;
                            outline: none;
                            border: .2px solid #4e515085;
                            font-size: 12px;
                            font-weight: 700;

                            &::placeholder {
                                font-size: 10px;
                                font-weight: 500;
                            }
                        }

                        label[for="checkout-checkbox"] {
                            font-size: 9px;
                            font-weight: 500;
                            line-height: 10px;
                        }

                        > div {
                            position: relative;

                            span.fa {
                                position: absolute;
                                top: 50%;
                                left: 0%;
                                transform: translate(15px, -50%);
                            }
                        }
                    }

                    .form-group {
                        display: flex;
                        column-gap: 25px;
                    }

                    .checkbox-control {
                        display: flex;
                        align-items: center;
                        column-gap: 10px;
                    }

                    .form-control-btn {
                        display: flex;
                        align-items: center;
                        justify-content: flex-end;

                        button {
                            padding: 15px 80px;
                            font-size: 15px;
                            color: #fff;
                            background: #050505;
                            border: 0;
                            border-radius: 7px;
                            letter-spacing: .5px;
                            font-weight: 200;
                            cursor: pointer;
                        }
                    }
                }
            }
                                img {
                                    width: 100%;
                                    object-fit: fill;
                                    border-radius: 10px;
                                }
                            }
                                    span {
                                        color: #4E5150;
                                        text-decoration: line-through;
                                        margin-left: 10px;
                                    }
                                }

                                    button {
                                        background: #E0E0E0;
                                        color: #828282;
                                        width: 15px;
                                        height: 15px;
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        border: 0;
                                        cursor: pointer;
                                        border-radius: 3px;
                                        font-weight: 500;
                                    }
                                }
                            }
                        }
                    }
                        p {
                            font-size: 10px;
                            font-weight: 500;
                        }
                    }
                }
            }
        }

        footer {

            height: 5%;
            color: #BDBDBD;
            display: -ms-grid;
            display: grid;
            place-items: center;
            font-size: 12px;

            a {
                text-decoration: none;
                color: inherit;
            }

        }

    }

    @media screen and (max-width: 1024px) {
        body {
            width: 80%;

            main {
                column-gap: 70px;
            }
        }
    }

    @media screen and (max-width: 768px) {
        body {
            width: 92%;

            main {
                flex-direction: column-reverse;
                height: auto;
                margin-bottom: 50px;

                .checkout-form {
                    width: 100%;
                    margin-top: 35px;
                }


            footer {
                height: 10%;
            }
        }
    }
</style>
