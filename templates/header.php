<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles.css" type="text/css">
    <title>PIXELPIZZA</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a
        class="navbar-brand"
        href="#"
    >
        PIXELPIZZA
    </a>
    <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarTogglerDemo02"
        aria-controls="navbarTogglerDemo02"
        aria-expanded="false"
        aria-label="Toggle navigation"
    >
        <span class="navbar-toggler-icon"></span>
    </button>
    <div
        class="collapse navbar-collapse justify-content-end"
        id="navbarTogglerDemo02"
    >
        <a
            href=<?php echo $_SERVER['PHP_SELF'] !== '/phpizza/index.php' ? '/phpizza/index.php' : '/phpizza/add.php'; ?>
            class="btn brand"
        >
        <?php echo $_SERVER['PHP_SELF'] !== '/phpizza/index.php' ? 'Homepage' : 'Add a Pizza'; ?>
        </a>
    </div>
</nav>
