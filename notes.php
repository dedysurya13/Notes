<?php

$action = $_REQUEST['action'] ?? '';

if (!file_exists('notes.json')) {
  file_put_contents('notes.json', json_encode([]));
}

$notes = json_decode(file_get_contents('notes.json'), true);

if ($action === 'get') {
  echo json_encode($notes);
} elseif ($action === 'getOne') {
  $id = $_REQUEST['id'];
  $note = array_filter($notes, fn($note) => $note['id'] === $id);
  echo json_encode(array_values($note)[0]);
} elseif ($action === 'save') {
  $id = $_POST['id'] ?: date('YmdHis');
  $title = $_POST['title'];
  $text = $_POST['text'];

  $noteIndex = array_search($id, array_column($notes, 'id'));
  $noteData = [
    'id' => $id,
    'title' => $title,
    'text' => $text
  ];

  if ($noteIndex !== false) {
    $notes[$noteIndex] = $noteData;
  } else {
    $notes[] = $noteData;
  }

  file_put_contents('notes.json', json_encode($notes));
  echo 'success';
} elseif ($action === 'delete') {
  $id = $_POST['id'];
  $notes = array_filter($notes, fn($note) => $note['id'] !== $id);
  file_put_contents('notes.json', json_encode(array_values($notes)));
  echo 'success';
}
