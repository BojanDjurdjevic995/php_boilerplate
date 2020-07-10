<?php
require_once './config/config.php';

__include('header', ['title' => 'Home']);
?>
<div class="container">
    <table id="bakiTable" class="table table-dark mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Content</th>
                <th>Slug</th>
                <th>Link</th>
                <th>Lang</th>
                <th>Visibility</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<?php
__include('footer');