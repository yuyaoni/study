@extends('layouts.app')
@section('sidebar')
   <div id="sidebar">
        <ul class="side-ul">
            <li>
            <a href="/mypage" class="side-icon icon1"><i class="fas fa-user"></i>　マイページ</a>
            </li>
            <li>
            <a href="/" class="side-icon icon2"><i class="fas fa-book-reader"></i>　中学1年数学</a>
            </li>
            <li>
            <!--<a href="/" class="side-icon icon3"><i class="fas fas fa-users"></i>　みんなの様子</a>-->
            <!--</li>-->
        </ul>
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </div>
@endsection
@section('content')
<div class="row">
    <div class="tangen">
        <h2 class="room_title">{{ $team->team_name}}</h2>
        <h5>{{ $team->teacher}} 先生</h5>
        <div class=”video”>
        <iframe width="645" height="360" src="{{$team->movie_url}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <table class="table table-striped task-table text_table">
           <!-- テーブルヘッダ -->
           <thead>
               <th>教科書１</th>
               <th>教科書２</th>
               <th>問題集</th>
           </thead>
           <!-- テーブル本体 -->
           <tbody>
               <tr>
                   <!-- 教科書 -->
                   <td class="table-text">
                       <div><img src="../upload/{{$team->img1}}" width="120"></div>
                       <div>ページ：P{{ $team->start_page1 }} ~ P{{ $team->end_page1 }}</div>
                   </td>
                    <!-- 問題集１ -->
                   <td class="table-text">
                       <div><img src="../upload/{{$team->img2}}" width="120"></div>
                       <div>ページ：P{{ $team->start_page2 }} ~ P{{ $team->end_page2 }}</div>
                   </td>
                    <!-- 問題集２ -->
                    <td class="table-text">
                       <div><img src="../upload/{{$team->img3}}" width="120"></div>
                       <div>ページ：P{{ $team->start_page3 }} ~ P{{ $team->end_page3 }}</div>
                    </td>
               </tr>
           </tbody>
       </table>
    </div>
</div>
<div class="chat_area">
    <div class="chat_text_area">
        <!--<h4 class="chat_area_title"> {{$messages->count()}}件のコメント</h4>-->
        <p class="padarea"></p>
        @foreach ($messages as $message)
            @if($team->id == $message->team_id)
                <p class="sender">{{$message->user_name}}</p>
                <div class="content_area">
                    <p class="content_text">{{$message->content}}</p>
                    @if($message->attached != "")
                    <img class="content_attached" src="../upload/{{$message->attached}}" width="120"></img>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
    <form enctype="multipart/form-data" action="{{url('send')}}" method="POST">
        @csrf
        <div>
            <input class="input_text" type="text" name="content" value="">
            <label class="upload-label">
                <input class="upload-file" type="file" name="attached">
                <i class="fas fa-folder-plus"></i>
            </label>
            <button class="text_send" type="submit">
                <i class="fas fa-paper-plane"></i>
            </button>
            <input type="hidden" name="team_id" value="{{$team->id}}">
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="user_name" value="{{Auth::user()->name}}">
        </div>
    </form>
</div>
@endsection

