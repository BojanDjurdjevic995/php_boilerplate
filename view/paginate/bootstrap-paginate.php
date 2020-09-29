<?php
if ($paginator->hasPages())
{ ?>
    <ul class="pagination" role="navigation">
        <?php if ($paginator->onFirstPage()) { ?>
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        <?php } else { ?>
            <li class="page-item">
                <a class="page-link" href="<?= $paginator->previousPageUrl() ?>" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        <?php }  ?>

        <?php foreach ($elemets as $element) {
            if (is_string($element)) { ?>
                <li class="page-item disabled" aria-disabled="true"><span class="page-link"><?= $element ?></span></li>
            <?php }

            if (is_array($element))
                foreach ($element as $page => $url)
                    if ($page == $paginator->currentPage()) { ?>
                        <li class="page-item active" aria-current="page"><span class="page-link"><?= $page ?></span></li>
                    <?php } else { ?>
                        <li class="page-item"><a class="page-link" href="<?= $url ?>"><?= $page ?></a></li>
                    <?php } ?>

        <?php }
        if ($paginator->hasMorePages()) {
        ?>
            <li class="page-item">
                <a class="page-link" href="<?= $paginator->nextPageUrl() ?>" rel="next">&rsaquo;</a>
            </li>
        <?php } else { ?>
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        <?php } ?>
    </ul>
<?php }
