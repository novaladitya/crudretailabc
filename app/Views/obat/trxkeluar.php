<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="m-3">Daftar Data Obat Keluar</h1>

            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th scope="col">Nomor</th>
                        <th scope="col">ID Transaksi Keluar</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Banyak Unit</th>
                        <th scope="col">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($obat as $ob) : ?>
                        <tr class="text-center">
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $ob['id']; ?></td>
                            <td><?= $ob['nama']; ?></td>
                            <td><?= $ob['unit']; ?></td>
                            <td><?= $ob['created_at']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>