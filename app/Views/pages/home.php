<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="m-3">Ini Home.</h1>

            <table class="tabelprofil">
                <tbody>
                    <tr>
                        <th>
                            <img src="/img/gilang.jpg" class="gambarprofil" alt="gilang">
                        </th>
                        <th>
                            <img src="/img/noval.jpg" class="gambarprofil" alt="noval">
                        </th>
                        <th>
                            <img src="/img/yuan.jpg" class="gambarprofil" alt="yuan">
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <h3>GILANG RAHMAN AFFANDI</h3>
                            <h5>1817051075</h5>
                            <h6>Kelas B</h6>
                        </td>
                        <td>
                            <h3>NOVAL ADITYA MARLON</h3>
                            <h5>1817051019</h5>
                            <h6>Kelas B</h6>
                        </td>
                        <td>
                            <h3>YULIVIA ANNISA PUTRI</h3>
                            <h5>1857051008</h5>
                            <h6>Kelas B</h6>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>