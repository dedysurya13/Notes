$(document).ready(function() {
  $('#noteContent').summernote({
    height: 250
  });

  function loadNotes() {
    $.get('notes.php', { action: 'get' }, function(data) {
      let notes = JSON.parse(data);
      renderNotes(notes);
    });
  }

  function renderNotes(notes) {
    let noteList = '';
    notes.reverse();
    $.each(notes, function(index, note) {
      // Ambil 100 karakter pertama dari teks catatan
      let noteText = note.text.substring(0, 100);
      noteList += `<a href="#" class="list-group-item list-group-item-action note-item" data-id="${note.id}">
        <div>
          <h5 class="mb-1">${note.title}</h5>
          <small class="text-muted">${noteText}${note.text.length > 100 ? '...' : ''}</small>
        </div>
        <div class="text-right">
          <button class="btn btn-sm btn-danger deleteNoteBtn">Hapus</button>
        </div>
      </a>`;
    });
    $('#noteList').html(noteList);
  }

  loadNotes();

  $('#addNoteBtn').click(function() {
    $('#noteId').val('');
    $('#noteTitle').val('');
    $('#noteContent').summernote('code', '');
    $('#noteModal').modal('show');
  });

  $('#noteList').on('click', '.note-item h5', function() {
    let noteId = $(this).closest('.note-item').data('id');
    $.get('notes.php', { action: 'getOne', id: noteId }, function(data) {
      let note = JSON.parse(data);
      $('#noteId').val(note.id);
      $('#noteTitle').val(note.title);
      $('#noteContent').summernote('code', note.text);
      $('#noteModal').modal('show');
    });
  });

  $('#saveNoteBtn').click(function() {
    let id = $('#noteId').val();
    let title = $('#noteTitle').val();
    let text = $('#noteContent').val();

    $.post('notes.php', {
      action: 'save',
      id: id,
      title: title,
      text: text
    }, function() {
      $('#noteModal').modal('hide');
      loadNotes();
    });
  });

  // Delete note
  $('#noteList').on('click', '.deleteNoteBtn', function() {
    if (confirm('Hapus catatan?')) {
      let noteId = $(this).closest('.note-item').data('id');
      $.post('notes.php', { action: 'delete', id: noteId }, function() {
        loadNotes();
      });
    }
  });

  // Search notes
  $('#searchInput').on('input', function() {
    let searchTerm = $(this).val().toLowerCase();
    $.get('notes.php', { action: 'get' }, function(data) {
      let notes = JSON.parse(data);
      let filteredNotes = notes.filter(note => note.title.toLowerCase().includes(searchTerm));
      renderNotes(filteredNotes);
    });
  });
});