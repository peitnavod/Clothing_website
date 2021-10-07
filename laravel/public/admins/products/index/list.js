function actionDelete(event){
    event.preventDefault();
    let ulrRequest = $(this).data('url');
    let that = $(this); // nut xoa
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
                'type': 'get',
                'url': ulrRequest,
                success: function (data){
                   if(data.code == 200)
                   {
                        that.parent().parent().remove() // xoa ca hang tr la xoa san pham
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
