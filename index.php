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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>La mia libreria</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Libreria</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <table class="table mt-5 border">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Autore</th>
                    <th scope="col">Anno</th>
                    <th scope="col">Genere</th>
                    <th scope="col">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Aggiungi libro
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="gestione.php">
                                            <div class="mb-3">
                                                <label for="titolo" class="form-label">Titolo</label>
                                                <input type="titolo" class="form-control" id="titolo"
                                                    aria-describedby="emailHelp" name="titolo">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Autore</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1"
                                                    name="autore">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Anno</label>
                                                <input type="number" step="1" class="form-control"
                                                    id="exampleInputPassword1" name="anno">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Genere</label>
                                                <input type="textd" class="form-control" id="exampleInputPassword1"
                                                    name="genere">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
        foreach ($libri as $key =>$libro) {
            echo '<tr>
                <th scope="row">'.$libro['id'].'</th>
                <td>'.$libro['titolo'].'</td>
                <td>'.$libro['autore'].'</td>
                <td>'.$libro['anno_pubblicazione'].'</td>
                <td>'.$libro['genere'].'</td>
                <td class="d-flex justify-content-evenly">
                <a role="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modificaLibro' . $libro['id'] . '"><i class="bi bi-pencil-square"></i></a>
                <a role="button" class="btn btn-danger" href="gestione.php?action=delete&id='.$libro['id'].'"><i class="bi bi-x-lg"></i></a> </td>
            </tr>
            ';
            echo '<div class="modal fade" id="modificaLibro' . $libro['id'] . '" tabindex="-1" aria-labelledby="modaleUpdate" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Modifica i dati</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="gestione.php">
                                    <input type="hidden" name="id" value="' . $libro['id'] . '">
                                        <div class="mb-3">
                                            <label for="titoloLibro" class="form-label">Titolo</label>
                                            <input type="text" class="form-control" id="titoloLibro" aria-describedby="titoloLibro"
                                                name="titoloUp" value=" ' . $libro['titolo'] . '">
                                        </div>
                                        <div class="mb-3">
                                            <label for="autoreLibro" class="form-label">Autore</label>
                                            <input type="text" class="form-control" id="autoreLibro" name="autoreUp"
                                                value="' . $libro['autore'] . ' ">
                                        </div>
                                        <div class="mb-3">
                                            <label for="annoLibro" class="form-label">Anno di pubblicazione</label>
                                            <input type="number" step="1" min="1" max="2024" class="form-control" id="annoLibroUp" name="annoUp" value="' . $libro['anno_pubblicazione'] . '">
                                        </div>
                                        <div class="mb-3">
                                            <label for="genereLibro" class="form-label">Genere</label>
                                            <input type="text" class="form-control" id="genereLibro" name="genereUp"
                                                value=" ' . $libro['genere'] . ' ">
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                            <button type="submit" class="btn btn-primary" name="action" value="update">Aggiorna libro</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>';
        }
        ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>