<?php

    $config = [
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
    ];

    $mysqli = new mysqli(
        $config['host'],
        $config['user'],
        $config['password']
    );
    if($mysqli->connect_error) {
        die($mysqli->connect_error);
    }

    $sql= 'CREATE DATABASE IF NOT EXISTS gestione_libreria';
    $mysqli->query($sql);

    $sql = 'USE gestione_libreria';
    $mysqli->query($sql);

    $sql= 'CREATE TABLE IF NOT EXISTS libri(
        id INT AUTO_INCREMENT PRIMARY KEY,
        titolo VARCHAR(255) NOT NULL,
        autore VARCHAR(255) NOT NULL,
        anno_pubblicazione INT NOT NULL,
        genere VARCHAR(255) NOT NULL
    )';
    $mysqli->query($sql);

    //$sql= 'INSERT INTO libri(titolo, autore, anno_pubblicazione, genere) VALUES("Harry Potter e la pietra filosofale", "J.K. Rowling", 1997, "Fantasy")';
    // $mysqli->query($sql);
?>