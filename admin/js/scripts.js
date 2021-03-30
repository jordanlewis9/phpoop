$(document).ready(function() {
  $(".modal_thumbnails").click(function() {
    $("#set_user_image").prop('disabled', false);
  })




  var editor = document.querySelector('#editor');
if (editor) {
  ClassicEditor.create(editor).catch(err => console.error(err));
}
})

