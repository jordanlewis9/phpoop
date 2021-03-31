$(document).ready(function() {
  var applyButton = $("#set_user_image");
  var modalSidebar = $("#modal_sidebar");
  var userId;
  var imageName;
  var photoId;
  var lastSelection;
  // setting an onclick handler on each modal picture
  $(".modal_thumbnails").click(function() {
    if (lastSelection){
      lastSelection.css('border', 'none');
    }
    modalSidebar.html('');
    lastSelection = $(this);
    $(this).css('border', '1px solid black');
    applyButton.prop('disabled', false);
    userId = $('#user-photo').data('id');
    imageName = $(this).prop('src').split('images/')[1];
    photoId = $(this).data('id');
    $.ajax({
      url: "includes/ajax_code.php",
      data: {
        photo_id: photoId
      },
      type: "GET",
      success: function(data) {
        if (!data.error) {
          parsedData = JSON.parse(data)
          $('#modal_sidebar').html(`<img src='images/${parsedData.filename}' width='100'>
          <h3>Title</h3>
          <p>${parsedData.title}</p>
          <h3>File Name</h3>
          <p>${parsedData.filename}</p>`);
        }
      }
    })
  })

  applyButton.click(function() {
    $.ajax({
      url: "includes/ajax_code.php",
      data: {
        image_name: imageName,
        user_id: userId
      },
      type: "POST",
      success: function(data) {
        if (!data.error) {
          console.log(data);
          $("#user_img").prop('src', data);
        }
      }
    })
  })




  var editor = document.querySelector('#editor');
if (editor) {
  ClassicEditor.create(editor).catch(err => console.error(err));
}
})

