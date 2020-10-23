<?php
__include('header', ['title' => 'Home']);
?>
    <div class="container mt-3">
        <h3 class="mt-5 mb-5 card-header">Index page: </h3>

        <div class="d-flex justify-content-center">
            <div class="card p-2" style="width: 20rem;">
                <form action="<?= route('uploadFIle') ?>" method="post" enctype="multipart/form-data">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="banners" id="validatedCustomFile">
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                    </div>
                    <button class="btn btn-warning mt-2">Upload</button>
                </form>
            </div>
        </div>
    </div>
<?php __include('footer');