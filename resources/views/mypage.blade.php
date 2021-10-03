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
            <!--<li>-->
            <!--<a href="" class="side-icon icon3"><i class="fas fas fa-users"></i>　みんなの様子</a>-->
            <!--</li>-->
            <li>
            @if( Auth::check() && Auth::user()->name == "test")
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
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        @if($records->isEmpty())
            var data = google.visualization.arrayToDataTable([
              ['Week', '学習時間', 'ページ数', '学習時間（目標）', 'ページ数（目標）'],
              ['月',  0,      0,       0,     0],
              ['火',  0,      0,       0,     0],
              ['水',  0,      0,       0,     0],
              ['木',  0,      0,       0,     0],
              ['金',  0,      0,       0,     0],
              ['土',  0,      0,       0,     0],
              ['日',  0,      0,       0,     0]
            ]);
        @else
            {{$cnt=0}}
            @foreach ($records as $record)
                @if(Auth::user()->id == $record->user_id)
                    var data = google.visualization.arrayToDataTable([
                      ['Week', '学習時間', 'ページ数', '学習時間（目標）', 'ページ数（目標）'],
                      ['月',  {{$records[$cnt]->record_time}},      {{$records[$cnt]->record_page}},       {{$records[$cnt]->target_time}},     {{$records[$cnt]->target_page}}],
                      ['火',  {{$records[$cnt + 1]->record_time}},      {{$records[$cnt + 1]->record_page}},       {{$records[$cnt + 1]->target_time}},     {{$records[$cnt + 1]->target_page}}],
                      ['水',  {{$records[$cnt + 2]->record_time}},      {{$records[$cnt + 2]->record_page}},       {{$records[$cnt + 2]->target_time}},     {{$records[$cnt + 2]->target_page}}],
                      ['木',  {{$records[$cnt + 3]->record_time}},      {{$records[$cnt + 3]->record_page}},       {{$records[$cnt + 3]->target_time}},     {{$records[$cnt + 3]->target_page}}],
                      ['金',  {{$records[$cnt + 4]->record_time}},      {{$records[$cnt + 4]->record_page}},       {{$records[$cnt + 4]->target_time}},     {{$records[$cnt + 4]->target_page}}],
                      ['土',  {{$records[$cnt + 5]->record_time}},      {{$records[$cnt + 5]->record_page}},       {{$records[$cnt + 5]->target_time}},     {{$records[$cnt + 5]->target_page}}],
                      ['日',  {{$records[$cnt + 6]->record_time}},      {{$records[$cnt + 6]->record_page}},       {{$records[$cnt + 6]->target_time}},     {{$records[$cnt + 6]->target_page}}],
                    ]);
                    @break
                @else
                    var data = google.visualization.arrayToDataTable([
                      ['Week', '学習時間', 'ページ数', '学習時間（目標）', 'ページ数（目標）'],
                      ['月',  0,      0,       0,     0],
                      ['火',  0,      0,       0,     0],
                      ['水',  0,      0,       0,     0],
                      ['木',  0,      0,       0,     0],
                      ['金',  0,      0,       0,     0],
                      ['土',  0,      0,       0,     0],
                      ['日',  0,      0,       0,     0]
                    ]);
                @endif
            {{$cnt++}}
            @endforeach
        @endif

        var options = {
          <!--title : '学習の進捗',-->
          <!--vAxis: {title: 'Cups'},-->
          <!--hAxis: {title: 'Month'},-->
          seriesType: 'bars',
          series: {2: {type: 'line'}, 3: {type: 'line'}},
          backgroundColor: 'transparent',
          colors: ['#ffb6c1', '#5f9ea0', '#db7093', '#008080']
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <h5 class="chart_title">学習の進捗</h5>
    <div id="chart_div" class="chart"></div>
  </body>
  </div>
    @if($records->isEmpty())
    <h5 class="progress_title">記録</h5>
    <table class="table progress_table" bgcolor="#f5f5f5">
           <!-- テーブルヘッダ -->
           <thead>
               <th></th>
               <th>学習時間(目標)</th>
               <th>ページ数(目標)</th>
               <th>　 目標登録 　</th>
               <th>　 学習時間 　</th>
               <th>　 ページ数 　</th>
               <th>　 実績登録 　</th>
           </thead>
           <!-- テーブル本体 -->
           <tbody>
                <form action="{{url('target')}}" method="POST">
                @csrf
                <tr>
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <th>月</th>
                        <td class="table-text">
                            <input class="record_txt" type="text" name="target_time1" value="">
                        </td>
                        <td class="table-text">
                            <input class="record_txt" type="text" name="target_page1" value="">
                        </td>
                        <input type="hidden" name="date1" value="1">
                        <input type="hidden" name="record_time1" value="0">
                        <input type="hidden" name="record_page1" value="0">
                        <td class="table-text">
                            <i class="arrow fas fa-arrow-down"></i>
                        </td>
                    <td class="table-text"></td>
                    <td class="table-text"></td>
                    <td class="table-text"></td>
                </tr>
                <tr>
                    <th>火</th>
                    <td class="table-text">
                        <input class="record_txt" type="text" name="target_time2" value="">
                    </td>
                    <td class="table-text">
                        <input class="record_txt" type="text" name="target_page2" value="">
                    </td>
                    <input type="hidden" name="date2" value="2">
                    <input type="hidden" name="record_time2" value="0">
                    <input type="hidden" name="record_page2" value="0">
                    <td class="table-text">
                        <i class="arrow fas fa-arrow-down"></i>
                    </td>
                    <td class="table-text"></td>
                    <td class="table-text"></td>
                    <td class="table-text"></td>
                </tr>
                <tr>
                    <th>水</th>
                    <td class="table-text">
                        <input class="record_txt" type="text" name="target_time3" value="">
                    </td>
                    <td class="table-text">
                        <input class="record_txt" type="text" name="target_page3" value="">
                    </td>
                    <input type="hidden" name="date3" value="3">
                    <input type="hidden" name="record_time3" value="0">
                    <input type="hidden" name="record_page3" value="0">
                    <td class="table-text">
                        <i class="arrow fas fa-arrow-down"></i>
                    </td>
                    <td class="table-text"></td>
                    <td class="table-text"></td>
                    <td class="table-text"></td>
                </tr>
                <tr>
                    <th>木</th>
                    <td class="table-text">
                        <input class="record_txt" type="text" name="target_time4" value="">
                    </td>
                    <td class="table-text">
                        <input class="record_txt" type="text" name="target_page4" value="">
                    </td>
                    <input type="hidden" name="date4" value="4">
                    <input type="hidden" name="record_time4" value="0">
                    <input type="hidden" name="record_page4" value="0">
                    <td class="table-text">
                        <i class="arrow fas fa-arrow-down"></i>
                    </td>
                    <td class="table-text"></td>
                    <td class="table-text"></td>
                    <td class="table-text"></td>
                </tr>
                <tr>
                    <th>金</th>
                    <td class="table-text">
                        <input class="record_txt" type="text" name="target_time5" value="">
                    </td>
                    <td class="table-text">
                        <input class="record_txt" type="text" name="target_page5" value="">
                    </td>
                    <input type="hidden" name="date5" value="5">
                    <input type="hidden" name="record_time5" value="0">
                    <input type="hidden" name="record_page5" value="0">
                    <td class="table-text">
                        <i class="arrow fas fa-arrow-down"></i>
                    </td>
                    <td class="table-text"></td>
                    <td class="table-text"></td>
                    <td class="table-text"></td>
                </tr>
                <tr>
                    <th>土</th>
                    <td class="table-text">
                        <input class="record_txt" type="text" name="target_time6" value="">
                    </td>
                    <td class="table-text">
                        <input class="record_txt" type="text" name="target_page6" value="">
                    </td>
                    <input type="hidden" name="date6" value="6">
                    <input type="hidden" name="record_time6" value="0">
                    <input type="hidden" name="record_page6" value="0">
                    <td class="table-text">
                        <i class="arrow fas fa-arrow-down"></i>
                    </td>
                    <td class="table-text"></td>
                    <td class="table-text"></td>
                    <td class="table-text"></td>
                </tr>
                <tr>
                    <th>日</th>
                    <td class="table-text">
                        <input class="record_txt" type="text" name="target_time7" value="">
                    </td>
                    <td class="table-text">
                        <input class="record_txt" type="text" name="target_page7" value="">
                    </td>
                    <input type="hidden" name="date7" value="7">
                    <input type="hidden" name="record_time7" value="0">
                    <input type="hidden" name="record_page7" value="0">
                    <td class="table-text">
                        <button class="record_btn" type="submit">登録</button>
                    </td>
                    <td class="table-text"></td>
                    <td class="table-text"></td>
                    <td class="table-text"></td>
                </tr>
                </form>
           </tbody>
       </table>
    @else
        @php
        $tmp=0
        @endphp
        @foreach ($records as $record)
            @if(Auth::user()->id == $record->user_id )
            @php
            $tmp++
            @endphp
            @endif
        @endforeach
        @if($tmp==0)
            <h5 class="progress_title">記録</h5>
            <table class="table progress_table" bgcolor="#f5f5f5">
               <!-- テーブルヘッダ -->
               <thead>
                   <th></th>
                   <th>学習時間(目標)</th>
                   <th>ページ数(目標)</th>
                   <th>　 目標登録 　</th>
                   <th>　 学習時間 　</th>
                   <th>　 ページ数 　</th>
                   <th>　 実績登録 　</th>
               </thead>
               <!-- テーブル本体 -->
               <tbody>
                    <form action="{{url('target')}}" method="POST">
                    @csrf
                    <tr>
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <th>月</th>
                            <td class="table-text">
                                <input class="record_txt" type="text" name="target_time1" value="">
                            </td>
                            <td class="table-text">
                                <input class="record_txt" type="text" name="target_page1" value="">
                            </td>
                            <input type="hidden" name="date1" value="1">
                            <input type="hidden" name="record_time1" value="0">
                            <input type="hidden" name="record_page1" value="0">
                            <td class="table-text">
                                <i class="arrow fas fa-arrow-down"></i>
                            </td>
                        <td class="table-text"></td>
                        <td class="table-text"></td>
                        <td class="table-text"></td>
                    </tr>
                    <tr>
                        <th>火</th>
                        <td class="table-text">
                            <input class="record_txt" type="text" name="target_time2" value="">
                        </td>
                        <td class="table-text">
                            <input class="record_txt" type="text" name="target_page2" value="">
                        </td>
                        <input type="hidden" name="date2" value="2">
                        <input type="hidden" name="record_time2" value="0">
                        <input type="hidden" name="record_page2" value="0">
                        <td class="table-text">
                            <i class="arrow fas fa-arrow-down"></i>
                        </td>
                        <td class="table-text"></td>
                        <td class="table-text"></td>
                        <td class="table-text"></td>
                    </tr>
                    <tr>
                        <th>水</th>
                        <td class="table-text">
                            <input class="record_txt" type="text" name="target_time3" value="">
                        </td>
                        <td class="table-text">
                            <input class="record_txt" type="text" name="target_page3" value="">
                        </td>
                        <input type="hidden" name="date3" value="3">
                        <input type="hidden" name="record_time3" value="0">
                        <input type="hidden" name="record_page3" value="0">
                        <td class="table-text">
                            <i class="arrow fas fa-arrow-down"></i>
                        </td>
                        <td class="table-text"></td>
                        <td class="table-text"></td>
                        <td class="table-text"></td>
                    </tr>
                    <tr>
                        <th>木</th>
                        <td class="table-text">
                            <input class="record_txt" type="text" name="target_time4" value="">
                        </td>
                        <td class="table-text">
                            <input class="record_txt" type="text" name="target_page4" value="">
                        </td>
                        <input type="hidden" name="date4" value="4">
                        <input type="hidden" name="record_time4" value="0">
                        <input type="hidden" name="record_page4" value="0">
                        <td class="table-text">
                            <i class="arrow fas fa-arrow-down"></i>
                        </td>
                        <td class="table-text"></td>
                        <td class="table-text"></td>
                        <td class="table-text"></td>
                    </tr>
                    <tr>
                        <th>金</th>
                        <td class="table-text">
                            <input class="record_txt" type="text" name="target_time5" value="">
                        </td>
                        <td class="table-text">
                            <input class="record_txt" type="text" name="target_page5" value="">
                        </td>
                        <input type="hidden" name="date5" value="5">
                        <input type="hidden" name="record_time5" value="0">
                        <input type="hidden" name="record_page5" value="0">
                        <td class="table-text">
                            <i class="arrow fas fa-arrow-down"></i>
                        </td>
                        <td class="table-text"></td>
                        <td class="table-text"></td>
                        <td class="table-text"></td>
                    </tr>
                    <tr>
                        <th>土</th>
                        <td class="table-text">
                            <input class="record_txt" type="text" name="target_time6" value="">
                        </td>
                        <td class="table-text">
                            <input class="record_txt" type="text" name="target_page6" value="">
                        </td>
                        <input type="hidden" name="date6" value="6">
                        <input type="hidden" name="record_time6" value="0">
                        <input type="hidden" name="record_page6" value="0">
                        <td class="table-text">
                            <i class="arrow fas fa-arrow-down"></i>
                        </td>
                        <td class="table-text"></td>
                        <td class="table-text"></td>
                        <td class="table-text"></td>
                    </tr>
                    <tr>
                        <th>日</th>
                        <td class="table-text">
                            <input class="record_txt" type="text" name="target_time7" value="">
                        </td>
                        <td class="table-text">
                            <input class="record_txt" type="text" name="target_page7" value="">
                        </td>
                        <input type="hidden" name="date7" value="7">
                        <input type="hidden" name="record_time7" value="0">
                        <input type="hidden" name="record_page7" value="0">
                        <td class="table-text">
                            <button class="record_btn" type="submit">登録</button>
                        </td>
                        <td class="table-text"></td>
                        <td class="table-text"></td>
                        <td class="table-text"></td>
                    </tr>
                    </form>
               </tbody>
           </table>
        @else
        <h5 class="progress_title">記録
            <form action="{{url('delete')}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="delete_btn" type="submit">すべての記録を消去</button>
            </form>
        </h5>
        <table class="table progress_table" bgcolor="#f5f5f5">
           <!-- テーブルヘッダ -->
           <thead>
               <th></th>
               <th>学習時間(目標)</th>
               <th>ページ数(目標)</th>
               <th>　 目標登録 　</th>
               <th>　 学習時間 　</th>
               <th>　 ページ数 　</th>
               <th>　 実績登録 　</th>
           </thead>
           <!-- テーブル本体 -->
           <tbody>
               <tr>
                    <th>月</th>
                    <form action="{{url('record')}}" method="POST">
                        @csrf
                        @foreach ($records as $record)
                            @if(Auth::user()->id == $record->user_id && $record->date == 1)
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="target_time" value="{{$record->target_time}}">
                                </td>
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="target_page" value="{{$record->target_page}}">
                                </td>
                                <input type="hidden" name="record_time" value="{{$record->record_time}}">
                                <input type="hidden" name="record_page" value="{{$record->record_page}}">
                                <input type="hidden" name="id" value="{{$record->id}}">
                            @endif
                        @endforeach
                        <td class="table-text">
                            <button class="record_btn" type="submit">登録</button>
                        </td>
                    </form>
                    <form action="{{url('record')}}" method="POST">
                        @csrf
                        @foreach ($records as $record)
                            @if(Auth::user()->id == $record->user_id && $record->date == 1)
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="record_time" value="{{$record->record_time}}">
                                </td>
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="record_page" value="{{$record->record_page}}">
                                </td>
                                <input type="hidden" name="target_time" value="{{$record->target_time}}">
                                <input type="hidden" name="target_page" value="{{$record->target_page}}">
                                <input type="hidden" name="id" value="{{$record->id}}">
                            @endif
                        @endforeach
                        <td class="table-text">
                            <button class="record_btn" type="submit">登録</button>
                        </td>
                    </form>
                </tr>
                <tr>
                    <th>火</th>
                    <form action="{{url('record')}}" method="POST">
                        @csrf
                        @foreach ($records as $record)
                            @if(Auth::user()->id == $record->user_id && $record->date == 2)
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="target_time" value="{{$record->target_time}}">
                                </td>
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="target_page" value="{{$record->target_page}}">
                                </td>
                                <input type="hidden" name="record_time" value="{{$record->record_time}}">
                                <input type="hidden" name="record_page" value="{{$record->record_page}}">
                                <input type="hidden" name="id" value="{{$record->id}}">
                            @endif
                        @endforeach
                        <td class="table-text">
                            <button class="record_btn" type="submit">登録</button>
                        </td>
                    </form>
                    <form action="{{url('record')}}" method="POST">
                        @csrf
                        @foreach ($records as $record)
                            @if(Auth::user()->id == $record->user_id && $record->date == 2)
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="record_time" value="{{$record->record_time}}">
                                </td>
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="record_page" value="{{$record->record_page}}">
                                </td>
                                <input type="hidden" name="target_time" value="{{$record->target_time}}">
                                <input type="hidden" name="target_page" value="{{$record->target_page}}">
                                <input type="hidden" name="id" value="{{$record->id}}">
                            @endif
                        @endforeach
                        <td class="table-text">
                            <button class="record_btn" type="submit">登録</button>
                        </td>
                    </form>
                </tr>
                <tr>
                    <th>水</th>
                    <form action="{{url('record')}}" method="POST">
                        @csrf
                        @foreach ($records as $record)
                            @if(Auth::user()->id == $record->user_id && $record->date == 3)
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="target_time" value="{{$record->target_time}}">
                                </td>
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="target_page" value="{{$record->target_page}}">
                                </td>
                                <input type="hidden" name="record_time" value="{{$record->record_time}}">
                                <input type="hidden" name="record_page" value="{{$record->record_page}}">
                                <input type="hidden" name="id" value="{{$record->id}}">
                            @endif
                        @endforeach
                        <td class="table-text">
                            <button class="record_btn" type="submit">登録</button>
                        </td>
                    </form>
                    <form action="{{url('record')}}" method="POST">
                        @csrf
                        @foreach ($records as $record)
                            @if(Auth::user()->id == $record->user_id && $record->date == 3)
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="record_time" value="{{$record->record_time}}">
                                </td>
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="record_page" value="{{$record->record_page}}">
                                </td>
                                <input type="hidden" name="target_time" value="{{$record->target_time}}">
                                <input type="hidden" name="target_page" value="{{$record->target_page}}">
                                <input type="hidden" name="id" value="{{$record->id}}">
                            @endif
                        @endforeach
                        <td class="table-text">
                            <button class="record_btn" type="submit">登録</button>
                        </td>
                    </form>
                </tr>
                <tr>
                    <th>木</th>
                    <form action="{{url('record')}}" method="POST">
                        @csrf
                        @foreach ($records as $record)
                            @if(Auth::user()->id == $record->user_id && $record->date == 4)
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="target_time" value="{{$record->target_time}}">
                                </td>
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="target_page" value="{{$record->target_page}}">
                                </td>
                                <input type="hidden" name="record_time" value="{{$record->record_time}}">
                                <input type="hidden" name="record_page" value="{{$record->record_page}}">
                                <input type="hidden" name="id" value="{{$record->id}}">
                            @endif
                        @endforeach
                        <td class="table-text">
                            <button class="record_btn" type="submit">登録</button>
                        </td>
                    </form>
                    <form action="{{url('record')}}" method="POST">
                        @csrf
                        @foreach ($records as $record)
                            @if(Auth::user()->id == $record->user_id && $record->date == 4)
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="record_time" value="{{$record->record_time}}">
                                </td>
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="record_page" value="{{$record->record_page}}">
                                </td>
                                <input type="hidden" name="target_time" value="{{$record->target_time}}">
                                <input type="hidden" name="target_page" value="{{$record->target_page}}">
                                <input type="hidden" name="id" value="{{$record->id}}">
                            @endif
                        @endforeach
                        <td class="table-text">
                            <button class="record_btn" type="submit">登録</button>
                        </td>
                    </form>
                </tr>
                <tr>
                    <th>金</th>
                    <form action="{{url('record')}}" method="POST">
                        @csrf
                        @foreach ($records as $record)
                            @if(Auth::user()->id == $record->user_id && $record->date == 5)
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="target_time" value="{{$record->target_time}}">
                                </td>
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="target_page" value="{{$record->target_page}}">
                                </td>
                                <input type="hidden" name="record_time" value="{{$record->record_time}}">
                                <input type="hidden" name="record_page" value="{{$record->record_page}}">
                                <input type="hidden" name="id" value="{{$record->id}}">
                            @endif
                        @endforeach
                        <td class="table-text">
                            <button class="record_btn" type="submit">登録</button>
                        </td>
                    </form>
                    <form action="{{url('record')}}" method="POST">
                        @csrf
                        @foreach ($records as $record)
                            @if(Auth::user()->id == $record->user_id && $record->date == 5)
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="record_time" value="{{$record->record_time}}">
                                </td>
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="record_page" value="{{$record->record_page}}">
                                </td>
                                <input type="hidden" name="target_time" value="{{$record->target_time}}">
                                <input type="hidden" name="target_page" value="{{$record->target_page}}">
                                <input type="hidden" name="id" value="{{$record->id}}">
                            @endif
                        @endforeach
                        <td class="table-text">
                            <button class="record_btn" type="submit">登録</button>
                        </td>
                    </form>
                </tr>
                <tr>
                    <th>土</th>
                    <form action="{{url('record')}}" method="POST">
                        @csrf
                        @foreach ($records as $record)
                            @if(Auth::user()->id == $record->user_id && $record->date == 6)
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="target_time" value="{{$record->target_time}}">
                                </td>
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="target_page" value="{{$record->target_page}}">
                                </td>
                                <input type="hidden" name="record_time" value="{{$record->record_time}}">
                                <input type="hidden" name="record_page" value="{{$record->record_page}}">
                                <input type="hidden" name="id" value="{{$record->id}}">
                            @endif
                        @endforeach
                        <td class="table-text">
                            <button class="record_btn" type="submit">登録</button>
                        </td>
                    </form>
                    <form action="{{url('record')}}" method="POST">
                        @csrf
                        @foreach ($records as $record)
                            @if(Auth::user()->id == $record->user_id && $record->date == 6)
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="record_time" value="{{$record->record_time}}">
                                </td>
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="record_page" value="{{$record->record_page}}">
                                </td>
                                <input type="hidden" name="target_time" value="{{$record->target_time}}">
                                <input type="hidden" name="target_page" value="{{$record->target_page}}">
                                <input type="hidden" name="id" value="{{$record->id}}">
                            @endif
                        @endforeach
                        <td class="table-text">
                            <button class="record_btn" type="submit">登録</button>
                        </td>
                    </form>
                </tr>
                <tr>
                    <th>日</th>
                    <form action="{{url('record')}}" method="POST">
                        @csrf
                        @foreach ($records as $record)
                            @if(Auth::user()->id == $record->user_id && $record->date == 7)
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="target_time" value="{{$record->target_time}}">
                                </td>
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="target_page" value="{{$record->target_page}}">
                                </td>
                                <input type="hidden" name="record_time" value="{{$record->record_time}}">
                                <input type="hidden" name="record_page" value="{{$record->record_page}}">
                                <input type="hidden" name="id" value="{{$record->id}}">
                            @endif
                        @endforeach
                        <td class="table-text">
                            <button class="record_btn" type="submit">登録</button>
                        </td>
                    </form>
                    <form action="{{url('record')}}" method="POST">
                        @csrf
                        @foreach ($records as $record)
                            @if(Auth::user()->id == $record->user_id && $record->date == 7)
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="record_time" value="{{$record->record_time}}">
                                </td>
                                <td class="table-text">
                                    <input class="record_txt" type="text" name="record_page" value="{{$record->record_page}}">
                                </td>
                                <input type="hidden" name="target_time" value="{{$record->target_time}}">
                                <input type="hidden" name="target_page" value="{{$record->target_page}}">
                                <input type="hidden" name="id" value="{{$record->id}}">
                            @endif
                        @endforeach
                        <td class="table-text">
                            <button class="record_btn" type="submit">登録</button>
                        </td>
                    </form>
                </tr>
           </tbody>
       </table>
       @endif
    @endif
    </div>
    <div class="news_area">
        <h5 class="news_title">お知らせ</h5>
        <div>
        <p class="news_post_date">2021.10.03</p>
        <p class="news_content_title">[イベント]「好き」を生かす学校だけに頼らない学び</p>
        <p class="news_content_text">開催日時：10月17日（水）２０:００〜２１:００</p>
        <img class="news_content_img" src="../..upload/event.png" width="25%"></img>
        </div>
    </div>
@endsection