{
    sortable: false,
    data: function(row){
        return `<a href="{!! route('admin.'.$s_category.'.form', [':id']) !!}" class="btn btn-sm btn-primary  tooltip-helper" data-toggle="tooltip" data-placement="top" title="{!! trans('user/crud.button.edit.label') !!} {!! trans('user/' . $s_category . '.names.btn_edit') !!}" data-trigger="hover"><i class="icon-pencil"></i></a>`.replace(':id', row.id);
    }
}
