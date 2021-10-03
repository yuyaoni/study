@extends('layouts.app')
@section('sidebar')
   <div id="sidebar">
        <ul class="side-ul">
            @if( Auth::check())
            <li>
            <a href="/mypage" class="side-icon icon1"><i class="fas fa-user"></i>　マイページ</a>
            </li>
            @endif
            <li>
            <a href="/" class="side-icon icon2"><i class="fas fa-book-reader"></i>　中学1年数学</a>
            </li>
            <li>
            <!--<a href="" class="side-icon icon3"><i class="fas fas fa-users"></i>　みんなの様子</a>-->
            <!--</li>-->
            <li>
            @if( Auth::check() && Auth::user()->name == "admin_study3" && Auth::user()->email == "yuyu889@me.com")
            <li>
            <a href="/admin" class="side-icon icon4"><i class="fas fa-plus-square"></i>　登録</a>
            </li>
            @endif
        </ul>
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </div>
@endsection
@section('content')
    <!-- Bootstrapの定形コード… -->
    <div class="card-body tangen">
        <!-- バリデーションエラーの表示に使用-->
    	@include('common.errors')
        <!-- バリデーションエラーの表示に使用-->
    </div>
    <!-- 全てのチームリスト -->
    @if (count($teams) > 0)
       <div class="card-body">
           <div class="card-body">
               <table class="table table-striped task-table main_table">
                   <!-- テーブルヘッダ -->
                   <thead>
                       <th>ルーム一覧</th>
                       <th>先生</th>
                       <!--<th>参加人数</th>-->
                       <th>ルームに参加</th>
                       @if( Auth::check() && Auth::user()->name == "test")
                       <th>編集</th>
                       @endif
                   </thead>
                   <!-- テーブル本体 -->
                   <tbody>
                       @foreach ($teams as $team)
                           <tr>
                               <!-- チーム名 -->
                               <td class="table-text">
                                   <div>{{ $team->team_name }}</div>
                               </td>
                                <!-- 先生の名前 -->
                               <td class="table-text">
                                   <div>{{ $team->teacher }}</div>
                               </td>
                                <!-- 所属人数 -->
                                <!--<td class="table-text">-->
                                <!--     //<div>{{ $team->members()->count() }}人参加中</div>-->
                                <!--</td>-->
                               <!-- 参加ボタン -->
                               <td class="table-text">
                                   @if(Auth::check())
                                   <a href="{{ url('teams/'.$team->id) }}" class="join_btn">参加</a>
                                   @else
                                   ログイン時のみ参加可能
                                   @endif
                               </td>
                               @if( Auth::check() && Auth::user()->name == "admin_study3" && Auth::user()->email == "yuyu889@me.com")
                                    <td class="table-text">
                                    　　<form action="{{ url('teamedit/'.$team->id) }}" method="GET">
                                    	{{ csrf_field() }}
                                    	<button type="submit" class="record_btn">
                                    	編集
                                    	</button>
                                    　　</form>	
                                    </td>
                               @endif
                           </tr>
                       @endforeach
                   </tbody>
               </table>
               <div class="row">
                    <div class="paginate">
                        {{$teams->links()}}
                    </div>
               </div>
           </div>
       </div>		
   @endif
@endsection