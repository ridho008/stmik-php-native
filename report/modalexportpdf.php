<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('report/exportpdftgl.php'); ?>" method="post" target="_blank">
          <table>
            <tr>
              <div class="form-group">
                <label for="tgla">Dari Tanggal</label>
                <input type="date" name="tgla" id="tgla" required>
              </div>
            </tr>
            <tr>
              <div class="form-group">
                <label for="tglb">Sampai Tanggal</label>
                <input type="date" name="tglb" id="tglb" required>
              </div>
            </tr>
            <tr>
              <button type="submit" name="cetak_mhs" class="btn btn-primary">Cetak</button>
            </tr>
          </table>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary">Reset</button>
        <a href="<?= base_url('report/exportpdf.php'); ?>" class="btn btn-primary" target="_blank">Export Semua Data</a>
      </div>
    </div>
  </div>
</div>