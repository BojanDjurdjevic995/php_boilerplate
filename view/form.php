<?php
__include('header', ['title' => 'Baki']);
?>
    <div class="container">
        <div class="card" style="width: 19rem;">
            <form action="<?= route('form') ?>" method="POST">
                <input class="form-control" type="text" name="name" value="<?= $name ?>">
                <input class="form-control" type="text" name="surname" value="<?= $surname ?>">
                <button class="btn btn-secondary">Save</button>
            </form>
        </div>
        <a class="btn btn-secondary" href="<?= route('news.edit', 1) ?>">Novost</a>
    </div>
<?php __include('footer');