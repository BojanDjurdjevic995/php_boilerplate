<?php
require_once '../config/config.php';
use App\Controllers\Request;
use App\Models\News;
if (Request::isAjax())
{
    $r = new Request();
    $request = new Request();
    $sql = '';
    $columns = array(
        0 => 'news.id',
        1 => 'news.visibility',
        2 => 'news_langs.title',
        3 => 'news_langs.content',
        4 => 'news_langs.slug',
        5 => 'news_langs.link',
        6 => 'news_langs.lang',
        7 => 'news.created_at'
    );
    $limit = $r->length;
    $start = $r->start;
    $order = $columns[$r->order[0]->column];
    $dir   = $r->order[0]->dir == 'asc' ? 'DESC' : 'ASC';

    $paginate = $start == 0 ? 1 : ($start/$limit) + 1;
    $news = News::select('visibility', 'title', 'content', 'slug', 'link', 'lang', 'news.created_at')
                        ->orderBy($order, $dir)
                        ->where('lang', 'sr')
                        ->join('news_langs', 'news.id', 'news_langs.news_id')
                        ->paginate($limit, ['*'], 'page', $paginate);

    $totalData      = $news->total();
    $totalFiltered  = $totalData;

    $br = ($news->currentPage() - 1) * $news->perPage() + 1;

    $data = array();
    if(!empty($news))
        foreach ($news as $item)
        {
            $nestedData['id']         = $br++;
            $nestedData['title']      = $item->title;
            $nestedData['content']    = $item->trim_content;
            $nestedData['slug']       = $item->slug;
            $nestedData['link']       = $item->link;
            $nestedData['lang']       = $item->lang;
            $nestedData['visibility'] = $item->visibility;
            $nestedData['created_at'] = $item->created_at ? date('d M, Y', strtotime($item->created_at)) : 'NULL';

            $data[] = $nestedData;
        }


    $json_data = array(
        "draw"            => intval($_POST['draw']),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $data
    );
    echo json_encode($json_data);
}