<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;
use PDOException;

class SqlController extends Controller
{
  public function some()
  {
    return view('sql');
  }
  public function insert()
  {

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
      $db = get_db_data();

      $que = 'INSERT INTO posts(title, content, user_id) VALUES(:title, :content, :user_id)';
      $stt = $db->prepare($que);

      $stt->bindValue(':title', $_POST['title']);
      $stt->bindValue(':content', $_POST['content']);
      $stt->bindValue(':user_id', $_POST['user_id']);

      $stt->execute();

      redirect()->route('sql');
    } catch(PDOException $e) {
      exit("error occured::: {$e->getMessage()}");
    }

    return redirect()->back();
  }
}
