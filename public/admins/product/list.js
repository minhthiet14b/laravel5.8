function actionDelete(event){
    event.preventDefault(); // cat load lai trang web trong the a
    let urlRequest = $(this).data('url');
    let that =  $(this);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            type: 'GET',
            url: urlRequest,
            success: function(data){
                if(data.code == 200){
                    that.parent().parent().remove();
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                }
            },
            error: function(){

            }
          });
        }
      })
}

$(function(){
    $(document).on('click','.action_delete', actionDelete);
});
