<?php

namespace App\Http\Controllers;

use App\Models\Collect;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = [
            [
                'label' => '日期',
                'key'   => 'collect_date'
            ],
            [
                'label' => '星座名稱',
                'key'   => 'name'
            ],
            [
                'label' => '整體運勢評分',
                'key'   => 'general_score'
            ],
            [
                'label' => '整體運勢說明',
                'key'   => 'general_description'
            ],
            [
                'label' => '愛情運勢評分',
                'key'   => 'love_score'
            ],
            [
                'label' => '愛情運勢說明',
                'key'   => 'love_description'
            ],
            [
                'label' => '事業運勢評分',
                'key'   => 'career_score'
            ],
            [
                'label' => '事業運勢說明',
                'key'   => 'career_description'
            ],
            [
                'label' => '偏財運勢評分',
                'key'   => 'money_score'
            ],
            [
                'label' => '偏財運勢說明',
                'key'   => 'money_description'
            ],
            [
                'label' => '創建時間',
                'key'   => 'created_at'
            ],
        ];
        return view('home', ['collects' => Collect::orderBy('created_at', 'DESC')->get(), 'columns' => $columns]);
    }
}
