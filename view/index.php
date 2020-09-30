<?php
__include('header', ['title' => 'Home']);
?>
    <div class="container mt-3">
        <h3 class="mt-5 mb-5">Index page: </h3>
        <a class="btn btn-success" target="_blank" href="<?= route('singleNews', [$news->id, $news->slug]) ?>"><?= $news->title ?></a>

        <form action="<?= route('uploadFIle') ?>" method="post" enctype="multipart/form-data">
            <input type="file" name="file">
            <br>
            <button>Upload</button>
        </form>
    </div>
<?php __include('footer');