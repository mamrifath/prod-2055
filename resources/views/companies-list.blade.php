<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company List</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
</head>
<body>
    <div class="container">
          <div class="row" style="margin-top: 45px">
              <div class="col-md-8">

                {{-- <input type="text" name="searchfor" id="" class="form-control"> --}}
                    <div class="card">
                        <div class="card-header">Companies</div>
                        <div class="card-body">
                            <table class="table table-hover table-condensed" id="companies-table">
                                <thead>
                                    <th><input type="checkbox" name="main_checkbox"><label></label></th>
                                    <th>#</th>
                                    <th>Trading name</th>
                                    <th>ABN</th>
                                    <th>Status</th>
                                    <th>Actions <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">Delete All</button></th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
              </div>
              <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add new Company</div>
                        <div class="card-body">
                            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                            <form action="{{ route('add.company') }}" method="post" id="add-company-form" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <label for="">Trading Name</label>
                                    <input type="text" class="form-control" name="trading_name" placeholder="Enter Trading name">
                                    <span class="text-danger error-text trading_name_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Company Name</label>
                                    <input type="text" class="form-control" name="company_name" placeholder="Enter Company Name">
                                    <span class="text-danger error-text company_name_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">ABN</label>
                                    <input type="text" class="form-control" name="abn" placeholder="Enter ABN"><small>ABN number lookup we need to have SOAP integration to verify the number. POST https://abr.business.gov.au/ABRXMLSearch/AbrXmlSearch.asmx HTTP/1.1</small>
                                    <span class="text-danger error-text abn_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea class="form-control" name="address" placeholder="Enter address"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email"><small>Format: example@example.com</small>
                                    <span class="text-danger error-text email_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="phone" class="form-control" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Enter Phone #"><small>Format: 123-456-7890</small>
                                    <span class="text-danger error-text phone_error"></span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-success">SAVE</button>
                                </div>
                            </form>
                        </div>
                    </div>
              </div>
          </div>

    </div>
    @include('edit-company-modal')
    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script>

         toastr.options.preventDuplicates = true;

         $.ajaxSetup({
             headers:{
                 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
             }
         });


         $(function(){

                //ADD NEW COUNTRY
                $('#add-company-form').on('submit', function(e){
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url:$(form).attr('action'),
                        method:$(form).attr('method'),
                        data:new FormData(form),
                        processData:false,
                        dataType:'json',
                        contentType:false,
                        beforeSend:function(){
                             $(form).find('span.error-text').text('');
                        },
                        success:function(data){
                             if(data.code == 0){
                                   $.each(data.error, function(prefix, val){
                                       $(form).find('span.'+prefix+'_error').text(val[0]);
                                   });
                             }else{
                                 $(form)[0].reset();
                                //  alert(data.msg);
                                $('#companies-table').DataTable().ajax.reload(null, false);
                                toastr.success(data.msg);
                             }
                        }
                    });
                });

                //GET ALL COMPANIES
               var table =  $('#companies-table').DataTable({
                     processing:true,
                     info:true,
                     ajax:"{{ route('get.companies.list') }}",
                     "pageLength":5,
                     "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
                     columns:[
                         {data:'checkbox', name:'checkbox', orderable:false, searchable:false},
                         {data:'DT_RowIndex', name:'DT_RowIndex'},
                         {data:'trading_name', name:'trading_name'},
                         {data:'abn', name:'abn'},
                         {data:'status', name:'status'},
                         {data:'actions', name:'actions', orderable:false, searchable:false},
                     ]
                }).on('draw', function(){
                    $('input[name="company_checkbox"]').each(function(){this.checked = false;});
                    $('input[name="main_checkbox"]').prop('checked', false);
                    $('button#deleteAllBtn').addClass('d-none');
                });

                $(document).on('click','#editCompanyBtn', function(){
                    var company_id = $(this).data('id');
                    $('.editCompany').find('form')[0].reset();
                    $('.editCompany').find('span.error-text').text('');
                    $.post('<?= route("get.company.details") ?>',{company_id:company_id}, function(data){
                        //  alert(data.details.country_name);
                        $('.editCompany').find('input[name="cid"]').val(data.details.id);
                        $('.editCompany').find('input[name="trading_name"]').val(data.details.trading_name);
                        $('.editCompany').find('input[name="company_name"]').val(data.details.company_name);
                        $('.editCompany').find('input[name="abn"]').val(data.details.abn);
                        $('.editCompany').find('input[name="address"]').val(data.details.address);
                        $('.editCompany').find('input[name="email"]').val(data.details.email);
                        $('.editCompany').find('input[name="phone"]').val(data.details.phone);
                        $('.editCompany').modal('show');
                    },'json');
                });


                //UPDATE COUNTRY DETAILS
                $('#update-company-form').on('submit', function(e){
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url:$(form).attr('action'),
                        method:$(form).attr('method'),
                        data:new FormData(form),
                        processData:false,
                        dataType:'json',
                        contentType:false,
                        beforeSend: function(){
                             $(form).find('span.error-text').text('');
                        },
                        success: function(data){
                              if(data.code == 0){
                                  $.each(data.error, function(prefix, val){
                                      $(form).find('span.'+prefix+'_error').text(val[0]);
                                  });
                              }else{
                                  $('#companies-table').DataTable().ajax.reload(null, false);
                                  $('.editCompany').modal('hide');
                                  $('.editCompany').find('form')[0].reset();
                                  toastr.success(data.msg);
                              }
                        }
                    });
                });

                //DELETE COMPANY RECORD
                $(document).on('click','#deleteCompanyBtn', function(){
                    var company_id = $(this).data('id');
                    var url = '<?= route("delete.company") ?>';

                    swal.fire({
                         title:'Are you sure?',
                         html:'You want to <b>delete</b> this company',
                         showCancelButton:true,
                         showCloseButton:true,
                         cancelButtonText:'Cancel',
                         confirmButtonText:'Yes, Delete',
                         cancelButtonColor:'#d33',
                         confirmButtonColor:'#556ee6',
                         width:300,
                         allowOutsideClick:false
                    }).then(function(result){
                          if(result.value){
                              $.post(url,{company_id:company_id}, function(data){
                                   if(data.code == 1){
                                       $('#companies-table').DataTable().ajax.reload(null, false);
                                       toastr.success(data.msg);
                                   }else{
                                       toastr.error(data.msg);
                                   }
                              },'json');
                          }
                    });

                });




           $(document).on('click','input[name="main_checkbox"]', function(){
                  if(this.checked){
                    $('input[name="company_checkbox"]').each(function(){
                        this.checked = true;
                    });
                  }else{
                     $('input[name="company_checkbox"]').each(function(){
                         this.checked = false;
                     });
                  }
                  toggledeleteAllBtn();
           });

           $(document).on('change','input[name="company_checkbox"]', function(){

               if( $('input[name="company_checkbox"]').length == $('input[name="company_checkbox"]:checked').length ){
                   $('input[name="main_checkbox"]').prop('checked', true);
               }else{
                   $('input[name="main_checkbox"]').prop('checked', false);
               }
               toggledeleteAllBtn();
           });


           function toggledeleteAllBtn(){
               if( $('input[name="company_checkbox"]:checked').length > 0 ){
                   $('button#deleteAllBtn').text('Delete ('+$('input[name="company_checkbox"]:checked').length+')').removeClass('d-none');
               }else{
                   $('button#deleteAllBtn').addClass('d-none');
               }
           }


           $(document).on('click','button#deleteAllBtn', function(){
               var checkedCompanies = [];
               $('input[name="company_checkbox"]:checked').each(function(){
                   checkedCompanies.push($(this).data('id'));
               });

               var url = '{{ route("delete.selected.companies") }}';
               if(checkedCompanies.length > 0){
                   swal.fire({
                       title:'Are you sure?',
                       html:'You want to delete <b>('+checkedCompanies.length+')</b> companies',
                       showCancelButton:true,
                       showCloseButton:true,
                       confirmButtonText:'Yes, Delete',
                       cancelButtonText:'Cancel',
                       confirmButtonColor:'#556ee6',
                       cancelButtonColor:'#d33',
                       width:300,
                       allowOutsideClick:false
                   }).then(function(result){
                       if(result.value){
                           $.post(url,{countries_ids:checkedCompanies},function(data){
                              if(data.code == 1){
                                  $('#companies-table').DataTable().ajax.reload(null, true);
                                  toastr.success(data.msg);
                              }
                           },'json');
                       }
                   })
               }
           });
        



         });

    </script>
</body>
</html>