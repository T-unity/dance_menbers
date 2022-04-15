@extends('base')
@section('content')
<h1>SQLの実行</h1>

<?php
/**
 * PDOインスタンスを返却
 * @return obj
 */
function get_db_data(): PDO {
  $dsn = 'mysql:dbname=laravel_local; host=db; charaset=utf8';
  $user = 'phper';
  $pass = 'secret';
  // $pass = 'This is bad password';

  $db = new PDO( $dsn, $user, $pass );
  return $db;
}

try {
  get_db_data();
  echo 'succeed';
} catch ( PDOException $e ) {
  die("error occured: {$e->getMessage()}");
} finally {
  $db = null;
}

?>

@endsection
