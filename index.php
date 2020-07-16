<?php
require_once './config/config.php';
use App\Models\NewsLang;

$news = NewsLang::where('lang', 'en')->get();


__include('header', ['title' => 'Home']);
?>
    <div class="container mt-3 d-flex flex-wrap">
    <?php foreach ($news as $n) { ?>
        <div class="card mt-2 p-2" style="flex-basis: 20%">
            <h3><?= $n->title ?></h3>
            <p><?= $n->trim_content ?></p>
        </div>
    <?php } ?>
    </div>
<?php
__include('footer');
