<?php
require '../conn/koneksi.php';
?>

<?php if (isset($_GET["NIP"])) {  ?>



    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_nilaiKerja">Nilai Kerja Pegawai</h4>
            </div>
            <div class="modal-body">

                <form id="form_validation" action="proses-ubah.php" name="modal_popup" method="POST">

                    <!-- Striped Rows -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">

                            <div class="body table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                        <!-- untuk ambil nip dari staf yang di pilih -->
                                        <input type="hidden" name="nip" value="<?= $_GET["NIP"] ?>">
                                        <tr>
                                            <td style="font-weight: bold; width: 50%">Orientasi Pelayanan</td>
                                            <td><input style="border-left: none;border-right: none;border-top: none;width: 100%;text-align: center;font-weight: bold;" type="text" name="orientasi_pelayanan" value="" required></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold; width: 50%">Integritas</td>
                                            <td><input style="border-left: none;border-right: none;border-top: none;width: 100%;text-align: center;font-weight: bold;" type="text" name="integritas" value="" required></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold; width: 50%">Komitmen</td>
                                            <td><input style="border-left: none;border-right: none;border-top: none;width: 100%;text-align: center;font-weight: bold;" type="text" name="komitmen" value="" required></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold; width: 50%">Disiplin</td>
                                            <td><input style="border-left: none;border-right: none;border-top: none;width: 100%;text-align: center;font-weight: bold;" type="text" name="disiplin" value="" required></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold; width: 50%">Kerja sama</td>
                                            <td><input style="border-left: none;border-right: none;border-top: none;width: 100%;text-align: center;font-weight: bold;" type="text" name="kerjasama" value="" required></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold; width: 50%">Kepemimpinan</td>
                                            <td><input style="border-left: none;border-right: none;border-top: none;width: 100%;text-align: center;font-weight: bold;" type="text" name="kepemimpinan" value="0" readonly></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Striped Rows -->

                    <button class="btn btn-primary waves-effect" name="ubah_nilai_kerja">SUBMIT</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>

<?php } ?>
