<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="m-3">Ini Laporan.</h1>

            <table class="table table-striped w-auto table-bordered m-auto">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th scope="col">Jumlah Transaksi Masuk</th>
                        <th scope="col">Jumlah Transaksi Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <th>
                            <h5><?= $datamasuk['sum']; ?></h5>
                        </th>
                        <th>
                            <h5><?= $datakeluar['sum']; ?></h5>
                        </th>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>