<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;
use PDOException;

class SqlController extends Controller
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

  public function some()
  {
    return view('sql');
  }

  public function insert()
  {
    try {
      $db = $this->get_db_data();

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

  public function index()
  {
    $start = hrtime(true); // 計測開始時間

    try {
      $db = $this->get_db_data();
      $que = 'SELECT * FROM users';
      $stt = $db->prepare($que);
      // var_dump($stt->execute());
      // exit;
      $stt->execute();
      $all = $stt->fetchAll(PDO::FETCH_ASSOC);

      // var_dump($stt->fetchAll(PDO::FETCH_ASSOC));
      // exit;

    } catch(PDOException $e) {
      exit("error occured::: {$e->getMessage()}");
    }

    $end = hrtime(true); // 計測終了時間
    $nano_sec = $end - $start;
    $micro_sec = $nano_sec / 1000;
    $milli_sec = $micro_sec / 1000;
    $sec = $milli_sec / 1000;
    echo '処理時間:'. $nano_sec .'ナノ秒' . '<br>';
    echo '処理時間:'. $micro_sec .'マイクロ秒' . '<br>';
    echo '処理時間:'. $milli_sec .'ミリ秒' . '<br>';
    echo '処理時間:'. $sec .'秒' . '<br>';

    exit;
  }
}
