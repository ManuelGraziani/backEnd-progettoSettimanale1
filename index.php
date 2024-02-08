<?php

require_once'config.php';
require_once'gestione.php';

$libri= getAllBooks($mysqli);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <title>La mia libreria</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Libreria</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div >
                <button type="button" class="btn btn-primary ms-auto me-3 " data-mdb-ripple-init data-mdb-modal-init
                    data-mdb-target="#exampleModal">
                    Aggiungi libro
                </button>


            </div>

        </div>
    </nav>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
            <?php
        foreach ($libri as $key => $libro) {
            echo '<div class="col mt-2 mb-5 text-center">
                <div class="card mt-3 h-100" style="width: 18rem;">
                    <img src="./upload/' . $libro['copertina'] . '" class="card-img-top" alt="" style="height: 310px">
                    <div class="card-body">
                        <h5 class="card-title">' . $libro['titolo'] . '</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">' . $libro['autore'] . '</li>
                            <li class="list-group-item">' . $libro['anno_pubblicazione'] . '</li>
                            <li class="list-group-item">' . $libro['genere'] . '</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                    <a role="button" class="btn btn-warning me-3" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#modificaLibro' . $libro['id'] . '" data-mdb-ripple-color="dark"><i class="bi bi-pencil-square"></i></a>
                    <a role="button" class="btn btn-danger" href="gestione.php?action=delete&id='.$libro['id'].'"><i class="bi bi-x-lg"></i></a>
                    </div>
                </div>
            </div>';

            echo '<div class="modal fade" id="modificaLibro' . $libro['id'] . '" tabindex="-1" aria-labelledby="modaleUpdate" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modaleUpdate">Modifica i dati</h1>
                                    <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="gestione.php" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="' . $libro['id'] . '">
                                        <div class="mb-3">
                                            <label for="titoloLibro" class="form-label">Titolo</label>
                                            <input type="text" class="form-control" id="titoloLibro" aria-describedby="titoloLibro" name="titoloUp" value="' . $libro['titolo'] . '">
                                        </div>
                                        <div class="mb-3">
                                            <label for="autoreLibro" class="form-label">Autore</label>
                                            <input type="text" class="form-control" id="autoreLibro" name="autoreUp" value="' . $libro['autore'] . '">
                                        </div>
                                        <div class="mb-3">
                                            <label for="annoLibro" class="form-label">Anno di pubblicazione</label>
                                            <input type="number" step="1" min="1" max="2024" class="form-control" id="annoLibroUp" name="annoUp" value="' . $libro['anno_pubblicazione'] . '">
                                        </div>
                                        <div class="mb-3">
                                            <label for="genereLibro" class="form-label">Genere</label>
                                            <input type="text" class="form-control" id="genereLibro" name="genereUp" value="' . $libro['genere'] . '">
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Copertina</label>
                                            <input type="file" class="form-control" id="image" name="imageUp">
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Chiudi</button>
                                            <button type="submit" class="btn btn-primary" name="action" value="update">Aggiorna libro</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>';
        }
        ?>
        </div>
    </div>
    <div>
        <footer class="bg-dark text-center text-white text-lg-start">
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2024 Manuel Graziani
            </div>
        </footer>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js">
    </script>
</body>

</html>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Aggiungi un libro</h1>
                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="gestione.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="titolo" class="form-label">Titolo</label>
                        <input type="text" class="form-control" id="titolo" aria-describedby="emailHelp" name="titolo">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Autore</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="autore">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Anno</label>
                        <input type="number" step="1" class="form-control" id="exampleInputPassword1" name="anno">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Genere</label>
                        <input type="textd" class="form-control" id="exampleInputPassword1" name="genere">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Copertina</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-mdb-ripple-init
                            data-mdb-dismiss="modal">Chiudi</button>
                        <button type="submit" class="btn btn-primary">Aggiungi libro</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>