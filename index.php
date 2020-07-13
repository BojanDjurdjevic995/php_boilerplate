<?php
require_once './config/config.php';
use App\Models\NewsLang;
$news = NewsLang::where('lang', 'en')->get();
__include('header', ['title' => 'Home']);
?>
    <div class="container mt-3">
    <?php foreach ($news as $n) { ?>
        <div class="card mt-2 p-2">
            <h3><?= $n->title ?></h3>
            <p><?= $n->content ?></p>
        </div>
    <?php } ?>
    </div>
<?php
__include('footer');
