<?php
__include('header', ['title' => 'Home']);
?>
    <div class="container mt-3">
        <h3 class="mt-5 mb-5">Index page</h3>

        <a class="btn btn-success" target="_blank" href="<?= route('singleNews', ['one-news-slug-simple', 43]) ?>">News</a>
    </div>
<?php __include('footer');