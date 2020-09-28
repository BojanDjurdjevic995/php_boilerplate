<?php
__include('header', ['title' => $news->title]);
?>
<div class="container mt-5 d-flex justify-content-between">
    <div class="card" style="flex-basis: 70%">
        <h3 class="card-header"><?= $news->title ?></h3>
        <div class="card-text p-3"><?= $news->content ?></div>
    </div>
    <div class="card" style="flex-basis: 30%">
        <ul class="list-group">
            <?php foreach ($otherNews as $item) { ?>
                <li class="list-group-item">
                    <a href="<?= route('singleNews', [$item->id, $item->slug]) ?>"><?= $item->title ?></a>
                </li>
            <?php } ?>
        </ul>
        <div class="card"><?= $otherNews->links('bootstrap-paginate') ?></div>
    </div>
</div>
