<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="m-3">Daftar Data Obat</h1>

            <p>
                <a class="btn btn-success" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Tambah Obat
                </a>
            </p>
            <div class="collapse mb-3" id="collapseExample">
                <div class="card card-body">
                    <form action="/obat/save" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Obat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= old('nama'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control <?= ($validation->hasError('stok')) ? 'is-invalid' : ''; ?>" id="stok" name="stok" value="<?= (old('stok')) ? old('stok') : 0; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('stok'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stok" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('foto'); ?>
                                    </div>
                                    <label class="custom-file-label" for="foto">Pilih gambar..</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>

            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th scope="col">Nomor</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Stok Obat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($obat as $ob) : ?>
                        <tr class="text-center">
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $ob['foto']; ?>" alt="<?= $ob['foto']; ?>" class="gambar"></td>
                            <td><?= $ob['nama']; ?></td>
                            <td><?= $ob['stok']; ?></td>
                            <td>
                                <a href="/obat/<?= $ob['slug']; ?>" class="btn btn-primary">Ubah Data Obat</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>