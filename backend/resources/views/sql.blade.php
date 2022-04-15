@extends('base')
@section('content')
<h1>SQLの実行</h1>

<?php

$dsn = 'mysql:dbname=laravel_local; host=db; charaset=utf8';
$user = 'phper';
$pass = 'secret';

try {
  $db = new PDO( $dsn, $user, $pass );
  echo 'succeed';
} catch ( PDOException $e ) {
  die("error occured: {$e->getMessage()}");
} finally {
  $db = null;
}

?>

@endsection
