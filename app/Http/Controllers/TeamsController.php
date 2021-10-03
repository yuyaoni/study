<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team; //この行を上に追加
use App\User;//この行を上に追加
use Auth;//この行を上に追加
use Validator;//この行を上に追加
use App\Message;
use App\Record;

class TeamsController extends Controller
{
    public function index()
    {
        //チーム 全件取得
        //$teams = Team::orderBy('created_at','asc')->get();
        $teams = Team::paginate(12);
        
        return view('teams',[
            'teams'=> $teams
            ]);
    }
    
    public function store(Request $request)
    {
        //バリデーション 
        $validator = Validator::make($request->all(), [
            'team_name' => 'required|max:255'
        ]);
        
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        
        $file1 = $request->file('img1');
        if(!empty($file1))
        {
            $filename1 = $file1->getClientOriginalName();
            $move1 = $file1->move('../upload/', $filename1);
        }
        else
        {
            $filename1 = "";
        }
        
        $file2 = $request->file('img2');
        if(!empty($file1))
        {
            $filename2 = $file2->getClientOriginalName();
            $move2 = $file2->move('../upload/', $filename2);
        }
        else
        {
            $filename2 = "";
        }
        
        $file3 = $request->file('img3');
        if(!empty($file3))
        {
            $filename3 = $file3->getClientOriginalName();
            $move3 = $file3->move('../upload/', $filename3);
        }
        else
        {
            $filename3 = "";
        }
        
        //以下に登録処理を記述（Eloquentモデル）
        $teams = new Team;
        $teams->team_name = $request->team_name;
        $teams->movie_url = $request->movie_url;
        $teams->movie_url = $request->movie_url;
        $teams->teacher = $request->teacher;
        $teams->start_page1 = $request->start_page1;
        $teams->start_page2 = $request->start_page2;
        $teams->start_page3 = $request->start_page3;
        $teams->end_page1 = $request->end_page1;
        $teams->end_page2 = $request->end_page2;
        $teams->end_page3 = $request->end_page3;
        $teams->img1 = $filename1;
        $teams->img2 = $filename2;
        $teams->img3 = $filename3;
        $teams->user_id = Auth::id();//ここでログインしているユーザidを登録しています
        $teams->save();
        
        //多対多のリレーションもここで登録
        $teams->members()->attach( Auth::user() );
        
        return redirect('/');
        
    }
    
    public function join($team_id)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();
        
        //お気に入りする記事
        $team = Team::find($team_id);
        
        //リレーションの登録
        $team->members()->attach($user);
        
        return redirect('/');
        
    }
    
    //チーム編集画面表示
    public function edit (Team $team) {
            
       return view('teamsedit', ['team' => $team]);
            
    }
    
    //更新処理
    public function update (Request $request) {
            
             //バリデーション 
            $validator = Validator::make($request->all(), [
                'team_name' => 'required|max:255',
            ]);
            
            //バリデーション:エラー
            if ($validator->fails()) {
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
            }
            
            //対象のチームを取得
            $team = Team::find($request->id);
            $team->team_name = $request->team_name;
            $team->save();
            
            return redirect('/');
            
    }
    
    //詳細表示
    public function show(Team $team)
    {
        // メッセージを取得
        $messages = Message::get();
        
        return view('teamsdetail',[
            'team'=> $team,
            'messages' => $messages
            ]);
    }
    
    // ルーム作成画面表示
    public function show2()
    {
        return view('admin');
    }
    
    public function add(Request $request)
    {
        $file1 = $request->file('attached');
        if(!empty($file1))
        {
            $filename1 = $file1->getClientOriginalName();
            $move1 = $file1->move('../upload/', $filename1);
        }
        else
        {
            $filename1 = "";
        }
        
        $messages = new Message;
        $messages->content = $request->content;
        $messages->team_id = $request->team_id;
        $messages->user_id = $request->user_id;
        $messages->user_name = $request->user_name;
        $messages->attached = $filename1;
        $messages->save();
         
        $team_id = $request->team_id;
        
        return redirect('teams/'.$team_id);
    }
    
    public function showMypage()
    {
        $teams = Team::get();
        $records = Record::get();
        
        return view('mypage',[
        'teams'=> $teams,
        'records'=>$records,
        ]);
    }
    
    //目標登録処理
    public function savetarget (Request $request) 
    {
            
            //バリデーション 
            $validator = Validator::make($request->all(), [
                'target_time' => 'nullable|max:255',
                'target_page' => 'nullable|max:255',
            ]);
            
            //バリデーション:エラー
            if ($validator->fails()) {
                return redirect('/mypage')
                    ->withInput()
                    ->withErrors($validator);
            }
            
            $target = new Record;
            $target->user_id = $request->user_id;
            $target->date = $request->date1;
            $target->target_time = $request->target_time1;
            $target->target_page = $request->target_page1;
            $target->record_time = $request->record_time1;
            $target->record_page = $request->record_page1;
            $target->save();
            
            $target = new Record;
            $target->user_id = $request->user_id;
            $target->date = $request->date2;
            $target->target_time = $request->target_time2;
            $target->target_page = $request->target_page2;
            $target->record_time = $request->record_time2;
            $target->record_page = $request->record_page2;
            $target->save();
            
            $target = new Record;
            $target->user_id = $request->user_id;
            $target->date = $request->date3;
            $target->target_time = $request->target_time3;
            $target->target_page = $request->target_page3;
            $target->record_time = $request->record_time3;
            $target->record_page = $request->record_page3;
            $target->save();
            
            $target = new Record;
            $target->user_id = $request->user_id;
            $target->date = $request->date4;
            $target->target_time = $request->target_time4;
            $target->target_page = $request->target_page4;
            $target->record_time = $request->record_time4;
            $target->record_page = $request->record_page4;
            $target->save();
            
            $target = new Record;
            $target->user_id = $request->user_id;
            $target->date = $request->date5;
            $target->target_time = $request->target_time5;
            $target->target_page = $request->target_page5;
            $target->record_time = $request->record_time5;
            $target->record_page = $request->record_page5;
            $target->save();
            
            $target = new Record;
            $target->user_id = $request->user_id;
            $target->date = $request->date6;
            $target->target_time = $request->target_time6;
            $target->target_page = $request->target_page6;
            $target->record_time = $request->record_time6;
            $target->record_page = $request->record_page6;
            $target->save();
            
            $target = new Record;
            $target->user_id = $request->user_id;
            $target->date = $request->date7;
            $target->target_time = $request->target_time7;
            $target->target_page = $request->target_page7;
            $target->record_time = $request->record_time7;
            $target->record_page = $request->record_page7;
            $target->save();
            
            //ログイン中のユーザーを取得
            //$user = Auth::user();
            //お気に入りする記事
            //$record = Record::find($request->id);
            //リレーションの登録
            //$record->owners()->attach($user);
            
            return redirect('/mypage');
            
    }
    
    //進捗更新処理
    public function updaterecord (Request $request) 
    {
        //バリデーション 
        $validator = Validator::make($request->all(), [
            'record_time' => 'nullable|max:255',
            'record_page' => 'nullable|max:255',
        ]);
        
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/mypage')
                ->withInput()
                ->withErrors($validator);
        }
        
        //対象のユーザーを取得
        $record = Record::find($request->id);
        $record->target_time = $request->target_time;
        $record->target_page = $request->target_page;
        $record->record_time = $request->record_time;
        $record->record_page = $request->record_page;
        $record->save();
        
        return redirect('/mypage');
    }
    
    public function deleteRecord (Request $request) 
    {
        $records = new Record;
        
        $records->where('user_id', Auth::user()->id)->delete();
        
        return redirect('/mypage');
    }
}
