

<?php echo  "<script>

    function my_modal() {
  var vote_id = {$result['id']};
swal({
    title: 'Add Note',
    input: 'textarea',
    showCancelButton: true,
    confirmButtonColor: '#1FAB45',
    confirmButtonText: 'Save',
    cancelButtonText: 'Cancel',
    buttonsStyling: true
}).then(function () {       
    $.ajax({
        type: 'POST',
        url: 'vote.process.php',
        data: { 'id': vote_id,
        cache: false,
        success: function(response) {
            swal(
            'Sccess!',
            'Your note has been saved!',
            'success'
            )
        },
        failure: function (response) {
            swal(
            'Internal Error',
            'Oops, your note was not saved.', // had a missing comma
            'error'
            )
        }
    });
}, 
function (dismiss) {
  if (dismiss === 'cancel') {
    swal(
      'Cancelled',
        'Canceled Note',
      'error'
    )
  }
}) }</script>";  ?>