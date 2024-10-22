<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notes</title>
  <link rel="shortcut icon" href="dist/img/favicon.ico" type="image/x-icon">
  <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="plugins/summernote/summernote-bs4.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3>Notes</h3>
  <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari catatan...">
  <div id="noteList" class="mt-4"></div>
  <button class="btn btn-primary rounded-circle" id="addNoteBtn" style="position: fixed; width:70px; height:70px; bottom: 20px; right: 20px;">+</button>
</div>

<div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="noteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="noteModalLabel">Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="noteId">
        <div class="form-group">
          <label for="noteTitle">Judul</label>
          <input type="text" class="form-control" id="noteTitle">
        </div>
        <div class="form-group">
          <label for="noteContent">Catatan</label>
          <textarea id="noteContent" class="form-control"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="saveNoteBtn">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<script src="dist/js/index.js"></script>
</body>
</html>
