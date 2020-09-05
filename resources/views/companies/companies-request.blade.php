@extends('layouts.manage-app')

@section('content')


	<div class="kt-datatable mt-4" id="productsTable"></div>

@endsection

@section('scripts')

<script>

// Class definition

var KTDatatableRemoteAjaxDemo = function() {
    // Private functions
    
    // basic demo
    var demo = function() {

       

        var datatable = $('.kt-datatable').KTDatatable({
            // datasource definition
            /*data: function (d) {
                d.searchText = $('#generalSearch').val()
                
            },*/

           

            data: {
              
                type: 'remote',
                source: {
                    read: {
                        url: "{{url('companies/getcompanybystatus')}}/"+ 'approved',
                        // sample custom headers
                        headers: {'x-my-custokt-header': 'some value', 'x-test-header': 'the value', 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        map: function(raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    },
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },

            // layout definition
            layout: {
                scroll: false,
                footer: false,
            },
            mobile: {
            layout: 'compact'
            },

            // column sorting
            sortable: true,

            pagination: true,

           /* search: {
                input: $('#generalSearch'),
                caseInsensitive: false
            },
            */
            // columns definition
            columns: [
                {
                    field: 'id',
                    title: '#',
                    sortable: 'asc',
                    width: 30,
                    type: 'number',
                    selector: false,
                    textAlign: 'center',
                }, 
                {
                    field: 'id',
                    title: "@lang('base.company_register_date')",
                    sortable: 'asc',
                  
                    type: 'number',
                    selector: false,
                    textAlign: 'center',
                    template: function(data) {
                        var cStart = new Date(data.couponStart);
                        var cFinish = new Date(data.couponFinish);

                        var dateStart = cStart.getDate()  + "-" + (cStart.getMonth()+1) + "-" + cStart.getFullYear();
                        var dateFinish = cFinish.getDate()  + "-" + (cFinish.getMonth()+1) + "-" + cFinish.getFullYear();

                        return dateStart + ' - ' + dateFinish;
                    }
                }, 




                 {
                    field: 'companyname',
                    title: "@lang('base.label_company_name')",
                    /*template: function(row) {
                        return row.Country + ' ' + row.ShipCountry;
                    },*/
                },{
                    field: "userfirstname",
                    title: "@lang('base.company_representative')",
                    type: 'text',
                    //format: 'MM/DD/YYYY',
                    /*template: function(data) {
                        var cStart = new Date(data.couponStart);
                        var cFinish = new Date(data.couponFinish);

                        var dateStart = cStart.getDate()  + "-" + (cStart.getMonth()+1) + "-" + cStart.getFullYear();
                        var dateFinish = cFinish.getDate()  + "-" + (cFinish.getMonth()+1) + "-" + cFinish.getFullYear();

                        return dateStart + ' - ' + dateFinish;
                    }*/
                    template: function(data) {
                    	return data.userfirstname + ' ' + data.userlastname;
                    }
                },{
                    field: "userfirstname",
                    title: "@lang('base.header_status')",
                    type: 'text',
                    //format: 'MM/DD/YYYY',
                    
                },
                /*{
                    field: "status_id",
                    title: "@lang('base.header_status')",
                    // callback function support for column rendering
                    template: function(row) {
                       var status = {
                            1: {'title': "@lang('base.label_status_active')", 'class': 'kt-badge--brand'},
                            2: {'title': "@lang('base.label_status_inactive')", 'class': ' kt-badge--danger'},
                            3: {'title': "@lang('base.label_status_temporary_inactive')", 'class': ' kt-badge--primary'},
                            4: {'title': 'Success', 'class': ' kt-badge--success'},
                            5: {'title': 'Info', 'class': ' kt-badge--info'},
                            6: {'title': 'Danger', 'class': ' kt-badge--danger'},
                            7: {'title': 'Warning', 'class': ' kt-badge--warning'},
                        };
                        

                        return '<span class="kt-badge ' + status[row.status_id].class + ' kt-badge--inline kt-badge--pill">' + row.statusName + '</span>';
                    
                    },
                },*/
                 
                {
                    field: 'Actions',
                    title: "@lang('base.header_actions')",
                    sortable: false,
                    width: 110,
                    overflow: 'visible',
                    autoHide: false,
                    template: function(data) {
                        var tmpl = '<div class="dropdown dropdown-inline" data-toggle-="kt-tooltip" title="Quick actions" data-placement="left">' +
                            '<a href="#" class="btn btn-outline-dark btn-xs btn-table-options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                                '<i class="flaticon-plus"></i>@lang('base.show_options')'+
                            '</a>'+
                            '<div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">'+
                                '<ul class="kt-nav">'+
                                    '<li class="kt-nav__item">'+
                                        '<a href="#" class="kt-nav__link couponDetails" data-base-url="{{url('')}}" data-url="/coupons/getSpecific/" data-target="modal-coupon-details" data-action="2" data-id="'+data.id+'">'+
                                            '<i class="kt-nav__link-icon flaticon-edit-1"></i>'+
                                            '<span class="kt-nav__link-text">@lang('base.see_details')</span>'+
                                        '</a>'+
                                    '</li>';
                                        
                                    
                                
                                tmpl += '</ul>'+
                            '</div>'+
                        '</div>';

                        return tmpl;
                    },
                }],

        });

    

    /*datatable.on('m-datatable--on-layout-updated', function () {
        $('.editItem').click(function () {
            console.log(this);
        });
    });*/

    $('#couponStatusId').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'couponStatusId');
    });
    $('#generalSearch').on('keyup', function() {
        console.log("sdfsdfadf")
      datatable.search($(this).val().toLowerCase(), 'generalSearch', $('#couponStatusId').val(), 'couponStatusId' );
    });

    $('#kt_form_type').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'Type');
    });

    $('#kt_form_status,#kt_form_type').selectpicker();

    };

    return {
        // public functions
        init: function() {
            demo();
            
        },
    };
}();

jQuery(document).ready(function() {
    KTDatatableRemoteAjaxDemo.init();



$('#productDetails').summernote({
    placeholder: 'Ingrese las características del producto aquí',
    tabsize: 2,
    height: 120,
    toolbar: [
     
      ['font', ['bold', 'underline', 'clear']],
     
      
      ['table', ['table']],
      
      ['view', ['codeview']]
    ]
  });

});
                        
</script>


@endsection