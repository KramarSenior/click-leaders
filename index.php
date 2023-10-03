<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="resources/styles/index.css">

    <title>Document</title>
</head>
<body>

<section class="section-form">
    <div class="form-wrapper">
        <h1 class="form__title">
            Rejestracja
        </h1>
        <form action="ajax.php" method="post" id="register-form" class="form">
            <label class="form__label" for="name">
                <span class="form__input-text">Imię</span>
                <input class="form__input" type="text" name="name" placeholder="Enter your name">
                <span class="form__error">Pole wymagane</span>

            </label>

            <label class="form__label" for="lastname">
                <span class="form__input-text">Nazwisko</span>
                <input class="form__input" type="text" name="lastname" placeholder="Enter your lastname">
                <span class="form__error">Pole wymagane</span>
            </label>

            <label class="form__label" for="email">
                <span class="form__input-text">Email</span>
                <input class="form__input" type="text" name="email" placeholder="Enter your email">
                <span class="form__error">Pole wymagane</span>
            </label>

            <label class="form__label" for="password">
                <span class="form__input-text">Hasło</span>
                <input class="form__input" type="password" name="password" placeholder="Enter your password">
                <span class="form__error">Pole wymagane</span>
            </label>

            <label class="form__label --checkbox" for="acceptTerms">
                <span class="form__input-text">Akceptuję regulamin</span>
                <input class="form__input-checkbox" type="checkbox" id="acceptTerms" name="acceptTerms" value="">
                <span class="form__error">Pole wymagane</span>
            </label>

            <input class="form__submit" type="submit" name="submit" value="Submit">

        </form>
    </div>

</section>

<script src="resources/scripts/main.js"></script>

</body>
</html>

