@extends('layouts.app')
@section('sidebar')
   <div id="sidebar">
        <ul class="side-ul">
            <li>
            <a href="/home" class="side-icon icon1"><i class="fas fa-user"></i>　マイページ</a>
            <!-- <a class="side-nav__link course-active " href="chart.php">受講中のコース</a> -->
            </li>
            <li>
            <a href="/" class="side-icon icon2"><i class="fas fa-book-reader"></i>　中学1年数学</a>
            </li>
            <!--<li>-->
            <!--<a href="select.php" class="side-icon icon3"><i class="fas fas fa-users"></i>　みんなの様子</a>-->
            <!--</li>-->
            <li>
            <a href="logout.php" class="side-icon icon4"><i class="fas fa-plus-square"></i>　登録</a>
            </li>
        </ul>
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </div>
@endsection
@section('content')
   <!-- 投稿フォーム -->
    @if( Auth::check())
    <div class="tangen">
        <p>単元登録フォーム【管理者用】</p>
        <!--<p>{{Auth::user()->name}}さん、ようこそ</p>-->
        <form enctype="multipart/form-data" action="{{ url('teams') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- チーム名 -->
            <div class="tangenregi">
                単元名
                <div class="col-sm-6">
                    <input type="text" name="team_name" class="form-control" value="">
                </div>
                講師名
                <div class="col-sm-6">
                    <input type="text" name="teacher" class="form-control" value="">
                </div>
                動画URL
                <div class="col-sm-6">
                    <input type="text" name="movie_url" class="form-control" value="">
                </div>
                問題集1画像
                <div class="col-sm-6">
                    <input type="file" name="img1" class="form-control" value="">
                </div>
                問題集1開始ページ
                <div class="col-sm-6">
                    <input type="text" name="start_page1" class="form-control" value="">
                </div>
                問題集1終了ページ
                <div class="col-sm-6">
                    <input type="text" name="end_page1" class="form-control" value="">
                </div>
                問題集2画像
                <div class="col-sm-6">
                    <input type="file" name="img2" class="form-control" value="">
                </div>
                問題集2開始ページ
                <div class="col-sm-6">
                    <input type="text" name="start_page2" class="form-control" value="">
                </div>
                問題集2終了ページ
                <div class="col-sm-6">
                    <input type="text" name="end_page2" class="form-control" value="">
                </div>
                問題集3画像
                <div class="col-sm-6">
                    <input type="file" name="img3" class="form-control" value="">
                </div>
                問題集3開始ページ
                <div class="col-sm-6">
                    <input type="text" name="start_page3" class="form-control" value="">
                </div>
                問題集3終了ページ
                <div class="col-sm-6">
                    <input type="text" name="end_page3" class="form-control" value="">
                </div>
            </div>
            <!--　登録ボタン -->
            <div>
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
    @endif
@endsection