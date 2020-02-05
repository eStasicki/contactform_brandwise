<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="main-form">
            <form id="ajaxForm" method="POST">
                <div class="form-group">
                    <label for="nameInput">Imię i nazwisko</label>
                    <input type="text" class="form-control" id="nameInput" name="nameInput">
                </div>
                <div class="form-group">
                    <label for="emailInput">Adres e-mail</label>
                    <input type="email" class="form-control" id="emailInput" name="emailInput">
                </div>
                <div class="form-group">
                    <label for="phoneInput">Numer telefonu</label>
                    <input type="text" class="form-control" id="phoneInput" data-mask="000-000-000" name="phoneInput">
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <button type="submit" class="btn btn-primary">Wyślij formularz</button>
                </div>
            </form>
        </div>
        <div id="formSuccess"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/localization/messages_pl.min.js"></script>
    <script>
        jQuery.validator.setDefaults({
            debug: false,
        });

        $("#ajaxForm").validate({
            ignore: ".ignore",
            rules: {
                nameInput: {
                    required: true,
                    minlength: 3
                },
                emailInput: {
                    required: true,
                    email: true,
                },
                phoneInput: {
                    required: true
                }
            },
            submitHandler: function (form) {
                $.post("success_page.php", $("#ajaxForm").serialize(), function(data) {
                    $(".main-form").remove();
                    $("#formSuccess").addClass("showed").html(data);
                });
            }
        });
    </script>

</body>

</html>