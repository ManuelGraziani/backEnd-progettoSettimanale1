<?php

require_once "config.php";


$book = [
    "copertina" => isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '',
    "titolo" => isset($_REQUEST['titolo']) ? $_REQUEST['titolo'] : '',
    "autore" => isset($_REQUEST['autore']) ? $_REQUEST['autore'] : '',
    "anno_pubblicazione" => isset($_REQUEST['anno']) ? $_REQUEST['anno'] : '',
    "genere" => isset($_REQUEST['genere']) ? $_REQUEST['genere'] : '',

    "copertinaUp" => isset($_FILES['imageUp']['name']) ? $_FILES['imageUp']['name'] : '',
    "titoloUp" => isset($_REQUEST['titoloUp']) ? $_REQUEST['titoloUp'] : '',
    "autoreUp" => isset($_REQUEST['autoreUp']) ? $_REQUEST['autoreUp'] : '',
    "annoUp" => isset($_REQUEST['annoUp']) ? $_REQUEST['annoUp'] : '',
    "genereUp" => isset($_REQUEST['genereUp']) ? $_REQUEST['genereUp'] : ''
];

function getAllBooks($mysqli)
{
    $libri = [];
    $sql = "SELECT * FROM libri;";
    $res = $mysqli->query($sql);
    if ($res) {
        while ($row = $res->fetch_assoc()) {
            $libri[] = $row;
        }
    }
    return $libri;
}


function addBook($mysqli, $book)
{
    $copertina = $book['copertina'];
    $titolo = $book['titolo'];
    $autore = $book['autore'];
    $anno_pubblicazione = $book['anno_pubblicazione'];
    $genere = $book['genere'];

    $target_dir = "./upload/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $sql = "INSERT INTO libri (copertina, titolo, autore, anno_pubblicazione, genere) 
                VALUES ('$copertina', '$titolo', '$autore', '$anno_pubblicazione', '$genere')";
    if (!$mysqli->query($sql)) {
        echo ($mysqli->error);
    } else {
        echo 'Record aggiunto con successo!!!';
    }
    header('location: index.php');
}

function removeBook($mysqli, $id)
{
    if (!$mysqli->query('DELETE FROM libri WHERE id = ' . $id)) {
        echo ($mysqli->connect_error);
    } else {
        echo 'Libro rimosso con successo!';
    }
}


function updateBook($mysqli, $id, $book)
{
    $copertina = $book['copertinaUp'];
    $titolo = $book['titoloUp'];
    $autore = $book['autoreUp'];
    $anno_pubblicazione = $book['annoUp'];
    $genere = $book['genereUp'];

    $target_dir = "./upload/";
    $target_file = $target_dir . basename($_FILES["imageUp"]["name"]);
    move_uploaded_file($_FILES["imageUp"]["tmp_name"], $target_file);

    $sql = "UPDATE libri SET 
                        copertina='" . $copertina . "',
                        titolo = '" . $titolo . "', 
                        autore = '" . $autore . "',
                        anno_pubblicazione = '" . $anno_pubblicazione . "',
                        genere = '" . $genere . "'
                        WHERE id = " . $id;
    if (!$mysqli->query($sql)) {
        echo ($mysqli->connect_error);
    } else {
        echo 'Libro modificato con successo!';
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] === 'update') {
        updateBook($mysqli, $_POST['id'], $book);
        exit(header('Location: index.php'));
    } else {
        addBook($mysqli, $book);
    }

} else if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'delete') {
    removeBook($mysqli, $_REQUEST['id']);
    exit(header('Location: index.php'));
}
