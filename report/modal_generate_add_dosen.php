<!-- Modal -->
<div class="modal fade" id="generate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Generate Dosen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="tambah_multi_dosen.php" method="post">
          <div class="form-group">
            <label for="count_add">Banyak Record Yang Akan Ditambahkan</label>
            <input type="text" class="form-control" name="count_add" id="count_add" pattern="[0-9]+" required>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" name="generate" class="btn btn-primary">Generate</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>