<?php
namespace App\Library;

use App\Models\Collect;
use App\Models\CollectLog;
use Goutte\Client as GoutteClient;
use Illuminate\Support\Facades\DB;

class CollectHelper{

    public function init()
    {
        $client = new GoutteClient();

        /*
         * column => 對應db欄位名稱
         * class => 目標網頁selector class
         * type => 新增type進行個別字串處理
         * */
        $columns = [
            ['column' => 'name', 'class' => '.TODAY_CONTENT h3', 'type' => 'name'],
            ['column' => 'general_score', 'class' => '.txt_green', 'type' => 'score'],
            ['column' => 'general_description', 'class' => 'div.TODAY_CONTENT > p:nth-child(3)', 'type' => 'description'],
            ['column' => 'love_score', 'class' => '.txt_pink', 'type' => 'score'],
            ['column' => 'love_description', 'class' => 'div.TODAY_CONTENT > p:nth-child(5)', 'type' => 'description'],
            ['column' => 'career_score', 'class' => '.txt_blue', 'type' => 'score'],
            ['column' => 'career_description', 'class' => 'div.TODAY_CONTENT > p:nth-child(7)', 'type' => 'description'],
            ['column' => 'money_score', 'class' => '.txt_orange', 'type' => 'score'],
            ['column' => 'money_description', 'class' => 'div.TODAY_CONTENT > p:nth-child(9)', 'type' => 'description'],
        ];
        $tempErrorMessage = [];

        DB::beginTransaction();
        try {
            // 共12星座
            foreach ( range(0, 11) as $idx => $value ){
                $url = 'https://astro.click108.com.tw/daily_10.php?iAstro=' . $idx;
                $crawler = $client->request('GET', $url);
                $createData = ['collect_date' => date('Y-m-d'), 'created_at' => date('Y-m-d H:i:s')];

                // 抓取欄位
                foreach ( $columns as $columnIdx => $column ){
                    $res = match ($column['type']) {
                        'name' => $this->dealWithName($crawler, $idx, $columns[$columnIdx]),
                        'score' => $this->dealWithScore($crawler, $idx, $columns[$columnIdx]),
                        default => $this->dealWithDefault($crawler, $idx, $columns[$columnIdx]),
                    };
                    $createData[$column['column']] = $res['data'];
                    if($res['errorMessage']){
                        $tempErrorMessage[] = $res['errorMessage'];
                    }
                }

                Collect::create($createData);
            }

            if (count($tempErrorMessage) > 0) {
                CollectLog::create(['message' => implode(', ', $tempErrorMessage), 'created_at' => date('Y-m-d H:i:s')]);
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            CollectLog::create(['message' => $ex->getMessage(), 'created_at' => date('Y-m-d H:i:s')]);
            DB::commit();
        }
    }

    /**
     * 抓取星座名稱"今日水瓶座解析"，取"水瓶座"
     * @param $crawler
     * @param $idx
     * @param $column
     * @return array
     */
    public function dealWithName($crawler, $idx, $column)
    {
        $res = ['data' => '', 'errorMessage' => ''];
        if ($crawler->filter($column['class'])->count() > 0) {
            $res['data'] = substr($crawler->filter($column['class'])->text(), 6, -6);
        } else {
            $errorMessage = "|編號:{$idx} - 欄位:{$column['column']}錯誤|";
            $res['errorMessage'] = $errorMessage;
        }
        return $res;
    }

    /**
     * 抓取星座評分"整體運勢★★★☆☆："，取"★★★☆☆"
     * @param $crawler
     * @param $idx
     * @param $column
     * @return array
     */
    public function dealWithScore($crawler, $idx, $column)
    {
        $res = ['data' => '', 'errorMessage' => ''];
        if ($crawler->filter($column['class'])->count() > 0) {
            $res['data'] = substr($crawler->filter($column['class'])->text(), 12, -3);
        } else {
            $errorMessage = "|編號:{$idx} - 欄位:{$column['column']}錯誤|";
            $res['errorMessage'] = $errorMessage;
        }
        return $res;
    }

    /**
     * @param $crawler
     * @param $idx
     * @param $column
     * @return array
     */
    public function dealWithDefault($crawler, $idx, $column)
    {
        $res = ['data' => '', 'errorMessage' => ''];
        if ($crawler->filter($column['class'])->count() > 0) {
            $res['data'] = $crawler->filter($column['class'])->text();
        } else {
            $errorMessage = "|編號:{$idx} - 欄位:{$column['column']}錯誤|";
            $res['errorMessage'] = $errorMessage;
        }
        return $res;
    }
}