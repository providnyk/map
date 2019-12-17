let filters				= {}
	,s_locale			= '{!! $app->getLocale() !!}'
	;

moment.locale(s_locale);

$('#page-length').on('change', function(){
    dt.page.len($(this).val()).draw(false);
});

$('#btn-delete').on('click', function(){
    swal({
        title: '{!! trans('app/common.messages.confirm_delete_title') !!}',
        text: '{!! trans('app/common.messages.confirm_delete_description') !!}',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: '{!! trans('app/common.messages.confirm_delete_confirm_button_text') !!}',
        confirmButtonClass: 'btn btn-primary',
        cancelButtonText: '{!! trans('app/common.messages.confirm_delete_cancel_button_text') !!}',
        cancelButtonClass: 'btn btn-light',
    }).then((confirm) => {
        if(confirm.value){
            deleteEntries();
        }
    });
});


$('#btn-add').on('click', (e) => {
    window.location.href = s_route_add;
});

function deleteEntries(){
    let rows = dt.rows('.selected').indexes(),
        ids = Array.prototype.map.call(dt.rows(rows).data(), el => el.id);

    $.ajax({
        type: 'post',
        url: s_route_del,
        data: {
            'ids': ids
        },
        success: function (data, status, xhr){

            if(xhr.status === 200){
                notify('{!! trans('app/common.messages.delete_entries_success') !!}', 'success', 2000);
                dt.draw(false);
            }else{
                notify('{!! trans('app/common.messages.delete_entries_error') !!}', 'danger', 2000);
            }

            applyFilters(false);
        },
        error: function (data){}
    })
}