function actionDelete(event){
    event.preventDefault();
    let deleteRequest = $(this).data('url');
    let that = $(this);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value){
           $.ajax({
              'type' : 'get',
              'url' : deleteRequest,
               success: function (data){
                  if(data==200)
                  {
                      that.parent().parent().remove() // xoa ca hang tr la xoa slider
                  }
               },
               error: function (){

               }
           });
        }
    })
}
$(function (){
    $(document).on('click','.action_delete',actionDelete);

});
