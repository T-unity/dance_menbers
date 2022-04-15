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

// try {
//   get_db_data();
//   echo 'succeed';
// } catch ( PDOException $e ) {
//   exit("error occured: {$e->getMessage()}");
// } finally {
//   $db = null;
// }

?>

<form method="POST" action="sql">
  @csrf
  <input name="title" type="text" placeholder="タイトル">
  <input name="content" type="text" placeholder="本文を入力">
  <input name="user_id" type="hidden" value="6">

  <button type="submit">登録</button>
</form>

<?php
if (isset($_POST) & !empty($_POST)) {
  try {
    $db = get_db_data();

    $que = 'INSERT INTO posts(title, content, user_id) VALUES(:title, :content, :user_id)';
    $stt = $db->prepare($que);

    $stt->bindValue(':title', $_POST['title']);
    $stt->bindValue(':content', $_POST['content']);
    $stt->bindValue(':user_id', $_POST['user_id']);

    $stt->execute();
  } catch(PDOException $e) {
    exit("error occured::: {$e->getMessage()}");
  }
}
?>

@endsection
