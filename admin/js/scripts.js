var editor = document.querySelector('#editor');
if (editor) {
  ClassicEditor.create(editor).catch(err => console.error(err));
}