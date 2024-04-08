

"use strict";
var KTDatatableRemoteAjaxDemo = {
    init: function(url,columnsArray,  table_id,search_input_id) {

        localStorage.removeItem(table_id+'-1-meta');
        
        let t;
        t = $("#"+table_id).KTDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: url,
                        map: function(t) {
                            var a = t;
                            return void 0 !== t.data && (a = t.data), a
                        },
                         params: {
						  _token: $('meta[name="token"]').attr('content')		
						}
                    }
                },
               
                pageSize: 10,
                serverPaging: !0,
                serverFiltering: !0,
                serverSorting: !0
            },
            layout: {
                // scroll: !1,
                footer: !1
            },
            sortable: !0,
            pagination: !0,
            search: {
                input: $("#"+search_input_id),
                key: "generalSearch"
            },
            columns: columnsArray
        });

        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
        return t;
    }
};

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(document).on('click','.delete_btn', function(event){

	event.preventDefault();
	var url             =   $(this).attr('href');
    var thisTRobject    =   $(this).closest('tr');
    var thisobj         =   $(this);
    
    Swal.fire({
        title: "Are you sure?",
        text: "You won\"t be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!"
    }).then(function(result) {
        
        console.log(thisTRobject);
        console.log(thisobj);

        if(thisobj.attr('data-delete') == 'soft'){
            thisTRobject.remove();
        }
        if (result.value) {
            if(url !== ''){
                window.location.href = url;
            }
        }
	});
});
