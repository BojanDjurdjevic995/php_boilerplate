<?php
$page = explode('/', $_SERVER['SCRIPT_NAME']);
$page = explode('.', end($page))[0]; ?>
<script src="<?= asset('js/all-scripts.min.js') ?>"></script>
<script src="<?= asset('js/main.js') ?>"></script>
</body>
</html>