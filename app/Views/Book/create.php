<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Tambah Data Buku</h2>
            <?php if (session()->has('errors')) : ?>
                <!-- <ul class="alert alert-danger">
                    <?php
                    // echo (session('errors')['judul']);
                    // foreach (session('errors') as $error) : ?>
                </ul> -->
            <?php endif ?>

            <form action="/books/save" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="judul" class="form-control <?= (session()->has('errors')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= old('judul'); ?>">
                        <div class="invalid-feedback">
                            <?= (session()->has('errors')) ? (session('errors')['judul']) : ''; ?>
                        </div>

                        <!-- <input type="text" class="form-control" id="judul" name="judul" autofocus> -->
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">

                        <input type="penulis" class="form-control <?= (session()->has('errors')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" autofocus value="<?= old('penulis'); ?>">
                        <div class="invalid-feedback">
                            <?= (session()->has('errors')) ? (session('errors')['penulis']) : ''; ?>
                        </div>
                        <!-- <input type="text" class="form-control" id="penulis" name="penulis"> -->
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">

                        <input type="penerbit" class="form-control <?= (session()->has('errors')) ? 'is-invalid' : ''; ?>" id="penerbit" name="penerbit" autofocus value="<?= old('penerbit'); ?>">
                        <div class="invalid-feedback">
                            <?= (session()->has('errors')) ? (session('errors')['penerbit']) : ''; ?>
                        </div>
                        <!-- <input type="text" class="form-control" id="penerbit" name="penerbit"> -->
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>

                    <div class="input-group mb-3">
                        <input type="file" class="form-control <?= (session()->has('errors')) ? 'is-invalid' : ''; ?>" id="sampul" name="sampul" onchange="previewImg()">
                        <div class="invalid-feedback">
                            <?= (session()->has('errors')) ? (session('errors')['sampul']) : ''; ?>
                        </div>
                        <label class="input-group-text" for="Sampul">Upload</label>
                    </div>


                    <!-- <div class="col-sm-10">
                        <input type="text" class="form-control" id="sampul" name="sampul">
                    </div> -->
                </div>

                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>




        </div>
    </div>
</div>

<?= $this->endSection(); ?>