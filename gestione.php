<?php

require_once "config.php";


$book = [
    "copertina" => isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '',
    "titolo" => isset($_REQUEST['titolo']) ? $_REQUEST['titolo'] : '',
    "autore" => isset($_REQUEST['autore']) ? $_REQUEST['autore'] : '',
    "anno_pubblicazione" => isset($_REQUEST['anno']) ? $_REQUEST['anno'] : '',
    "genere" => isset($_REQUEST['genere']) ? $_REQUEST['genere'] : '',
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


function updateBook($mysqli, $id, $titolo, $autore, $anno_pubblicazione, $genere)
{
    $sql = "UPDATE libri SET 
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
        updateBook($mysqli, $_POST['id'], $_POST['titoloUp'], $_POST['autoreUp'], $_POST['annoUp'], $_POST['genereUp']);
        exit(header('Location: index.php'));
    } else {
        addBook($mysqli, $book);
    }

} else if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'delete') {
    removeBook($mysqli, $_REQUEST['id']);
    exit(header('Location: index.php'));
}




?>


