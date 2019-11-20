<!DOCTYPE html>
<?php require("./config/config.php"); ?>
<html>

<head>
    <title><?= $masjidName ?> Registration Form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,500' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="./css/styles.css" />
    <link rel="shortcut icon" type="image/x-icon" href="kaba.ico">
</head>

<body>
<?php include ("navigation.php"); ?>
    <div class="container">

        <div class="row">

            <div class="col-xl-8 offset-xl-2">

                <h1><?= $masjidName ?> Community Registration Form</h1>

                <p class="lead">Please register to be added to the <?= $masjidName ?> community social and email groups, where important information like salaah timechanges and Masjid programs will be shared</p>

		<pre>
		</pre>

                <form id="registration-form" method="post" action="api/register.php" role="form">

                    <div class="messages"></div>

                    <div class="controls">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="form_name">Firstname *</label>
                                    <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname *" required="required"
                                        data-error="Firstname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="form_lastname">Lastname *</label>
                                    <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Please enter your lastname *" required="required"
                                        data-error="Lastname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="form_email">Email *</label>
                                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required"
                                        data-error="Valid email is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="form_phone">Phone *</label>
                                    <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Please enter your phone" required="required"
					data-error="Valid Contact Number is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="form_address">Address *</label>
                            <textarea id="form_address" name="address" class="form-control" placeholder="street address *" rows="3" required="required"
                                data-error="Please, add your address"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>


                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6Lebx5sUAAAAAEjjeMzttFXPqbl61Bi2SuL2HBrg" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                            <input class="form-control d-none" data-recaptcha="true" required data-error="Please complete the Captcha">
                            <div class="help-block with-errors"></div>
                        </div>


                        <input type="submit" class="btn btn-success btn-send" value="Send Registration">

                        <p class="text-muted">
                            <strong>*</strong> These fields are required.
			</p>

                    </div>

                </form>

            </div>
            <!-- /.8 -->

        </div>
        <!-- /.row-->

    </div>
    <!-- /.container-->

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="js/validator.js"></script>
    <script src="js/register.js"></script>
</body>

</html>
