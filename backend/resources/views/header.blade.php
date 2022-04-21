<?php
use Illuminate\Support\Facades\Auth;
?>

<header>
  <div class='globalNav'>
    <div class='inner'>
      <div class='contents__wrap'>
        <h1>
          <a href='/'>Dancers</a>
        </h1>
        <div class='contents__menu'>
          <ul class='contents__lists'>
            <li><a href="{{ route('dashboard') }}">ダッシュボード</a></li>
            <li><a href="{{ route('top') }}">トップページ</a></li>
            <li><a href="{{ route('posts.index') }}">投稿一覧</a></li>
            <li><a href="{{ route('posts.create') }}">新規投稿</a></li>
            <li><a href="{{ route('sql') }}">新規投稿（PDO）</a></li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="route('logout')"
                  onclick="event.preventDefault();
                  this.closest('form').submit();"
                >
                  {{ __('Log Out') }}
                </a>
              </form>
            </li>
            <li>Sign in as <?= Auth::user()->name; ?></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>
