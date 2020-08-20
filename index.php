<?php
require_once './config/config.php';
__include('header', ['title' => 'Home']);
$datas = (object) [
        'Year' => (object) ['type' => 'radio', 'name' => 'year', 'data' => ['2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020']],
        'Age' => (object) ['type' => 'radio', 'name' => 'age', 'data' => ['17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28']],
        'Skills' => (object) ['type' => 'checkbox', 'name' => 'skills', 'data' => ['HTML', 'CSS', 'PHP', 'LARAVEL', 'JavaScript', '.NET', 'Angular', 'React', 'Symfony']],
        'Must have' => (object) ['type' => 'checkbox', 'name' => 'mustHave', 'data' => ['Money', 'Car', 'Smart phone', 'Tablet', 'Computer', 'Job', 'Girlfriend', 'House']],
        'Favorite name' => (object) ['type' => 'checkbox', 'name' => 'favoriteName', 'data' => ['Bojan', 'Dejan', 'Nenad', 'Nikola', 'Maja', 'Mirko', 'Nikolina', 'Dajana']]
]
?>
    <div class="container mt-3 d-flex flex-wrap">
        <form action="" id="test" method="post">
            <div class="form-group">
                <?= csrf_field(); ?>
                <label>Name</label>
                <input class="form-control" type="text" name="name" value="Bojan">
                <label>Surname</label>
                <input class="form-control" type="text" name="surname" value="Djurdjevic Baki">
                <label>Comment</label>
                <textarea class="form-control" name="comment" cols="30" rows="10"><?= Lipsum::html() ?></textarea>
            </div>
            <div class="row">
                <?php foreach ($datas as $key => $value) { ?>
                    <div class="form-group mr-5">
                        <h4><?= $key ?></h4><br>
                        <?php foreach ($value->data as $br => $item) { ?>
                            <div class="form-check">
                                <input class="form-check-input" type="<?= $value->type ?>" name="<?= $value->name ?>" id="<?= $item ?>" value="<?= $item ?>" <?= $br == 0 ? 'checked' : '' ?>>
                                <label class="form-check-label" for="<?= $item ?>"><?= $item ?></label>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
            <button class="btn btn-primary">Save</button>
        </form>
    </div>
<?php
__include('footer');
