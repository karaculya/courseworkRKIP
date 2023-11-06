<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Motivation Test</title>
    <link href="/img/Logo.svg" rel="shortcut icon" type="image/svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="/styles/main.css" rel="stylesheet">
</head>

<body>
    <?php
    require 'blocks/config_db.php';

    $sth = $dbh->prepare("SELECT * FROM `mt-questions`");
    $sth->execute();
    $dt = $sth->fetchAll(PDO::FETCH_ASSOC);

    require "blocks/header.php"
    ?>

    <section class="bg-body-tertiary">
        <h4 class="p-3 text-center">Мотивационный тест</h4>
        <?php
        require "blocks/config_db.php";
        require "blocks/funs_test.php";

        if (isset($_POST['first_name'])) $firstName = $_POST['first_name'];

        if (isset($_POST['last_name'])) $lastName = $_POST['last_name'];

        $answers  = "";
        for ($i = 0; $i < 14; $i++) {
            $answers = $answers . $_POST[$i];
        }

        $motivationType = getMotivationType($answers);

        $isMotivationTest = true;
        if ($firstName != null && $lastName != null && $answers != 00000000000000) {
            $resMt = addToDbMT($firstName, $lastName, $answers, $motivationType);
            require "blocks/result_test.php";
        }
        ?>

        <div class="container">
            <form method="post">
                <fieldset class="form-group">
                    <input type="text" class="form-control mt-5 mb-3" placeholder="Введите ваше имя" id="first_name" name="first_name">
                </fieldset>
                <fieldset class="form-group">
                    <input type="text" class="form-control" placeholder="Введите вашу фамилию" id="last_name" name="last_name">
                </fieldset>

                <?php
                for ($i = 0; $i < 14; $i++) :
                ?>
                    <div class="form-check mt-5" style="font-weight: bold;"><?= $dt[$i]['question'] ?></div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name=<?= $i ?> value="1" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            <?= $dt[$i]['answer1'] ?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name=<?= $i ?> value="2" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            <?= $dt[$i]['answer2'] ?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name=<?= $i ?> value="3" id="flexRadioDefault3">
                        <label class="form-check-label" for="flexRadioDefault3">
                            <?= $dt[$i]['answer3'] ?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name=<?= $i ?> value="4" id="flexRadioDefault4">
                        <label class="form-check-label" for="flexRadioDefault4">
                            <?= $dt[$i]['answer4'] ?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name=<?= $i ?> value="5" id="flexRadioDefault5">
                        <label class="form-check-label" for="flexRadioDefault5">
                            <?= $dt[$i]['answer5'] ?>
                        </label>
                    </div>
                <?php endfor; ?>

                <button type="submit" class="btn btn-dark my-4">Отправить</button>
            </form>
        </div>
    </section>

    <?php require "blocks/footer.php" ?>

</body>

</html>