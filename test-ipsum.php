<?php
require_once './config/config.php';
use App\Controllers\LoremIpsum;
__include('header', ['title' => 'Test ipsum']);
?>
    <div class="container">
        <?= LoremIpsum::ul()->headers()->link()->code()->html()->generate() ?>
    </div>
<?php __include('footer');
