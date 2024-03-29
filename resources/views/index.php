<!DOCTYPE html>
<html lang="hu_HU">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email küldő szolgáltatás</title>

    <!-- Komment -->

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>

    <!-- Bootstrap(ha kell, kell, ha nem, nem) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- AXIOS -->
    <!-- FONTOS! A main.js elé rakjuk! -->
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <!-- Saját Javascript -->
    <script type="module" src="main.js"></script>
    <!-- Saját css -->
    <link rel="stylesheet" href="stilus.css">
</head>

<body>
    <main>
        <header>
            <h1>Email küldő</h1>
        </header>
        <nav>
            <p></p>
        </nav>
        <article>
            <div id="tarolo"></div>
            <div id="fajlfeltoltes">
                <p>Csatolandó fájlok elküldése:</p>
            </div>
            <div id="buttons">
                <button type="submit" id="jsonCreate">Json fájl elkészítése</button>

                <button type="submit" id="emailSend">Email küldése</button>

            </div>
            <div>
                <p>Json fájl állapota: </p>
                <p id="jsonAllapot"></p>
                <p>Emailek állapota: </p>
                <p id="emailAllapot"></p>
            </div>

            <!-- <div id="csvFeltoltes">
                <p>Diákok és adataik feltöltése:</p>
            </div> -->

        </article>
        <footer>Minden jog fenntartva</footer>
    </main>
</body>

</html>