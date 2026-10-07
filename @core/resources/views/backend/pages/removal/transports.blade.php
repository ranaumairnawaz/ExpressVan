@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button{
            padding: 0 !important;
        }
        div.dataTables_wrapper div.dataTables_length select {
            width: 60px;
            display: inline-block;
        }
        .image-wrap img{
            width: 5rem;
        }
    </style>
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
@endsection
@section('site-title')
    {{__('Transports')}}
@endsection
@section('content')
<div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-error-msg/>
                <x-flash-msg/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Transports')}}</h4>
                        <a href="#" data-toggle="modal" data-target="#addFloor" class="btn btn-primary " >Add New</a>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default" id="all_blog_table">
                                <thead>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Image')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Overtime Price')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($transports as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->name}}</td>
                                        <td class="image-wrap" >
                                            {!! render_image_markup_by_attachment_id($data->image) !!}
                                        </td>
                                        <td><span>{{amount_with_currency_symbol($data->price)}}</span></td>
                                        <td><span>{{amount_with_currency_symbol($data->overtime_price)}}</span></td>
                                        <td>
                                            <x-delete-popover :url="route('admin.removal.transports.delete',$data->id)"/>
                                            <a href="#"
                                               data-toggle="modal"
                                               data-target="#price_plan_item_edit_modal"
                                               class="btn btn-xs btn-primary btn-xs mb-3 mr-1 price_plan_edit_btn"
                                               data-id="{{$data->id}}"
                                               data-action="{{route('admin.removal.transports.update')}}"
                                               data-name="{{$data->name}}"
                                               data-price="{{$data->price}}"
                                               data-overtime_price="{{$data->overtime_price}}"
                                               data-seats="{{$data->seats}}"
                                               data-inside_height="{{$data->inside_height}}"
                                               data-inside_width="{{$data->inside_width}}"
                                               data-inside_length="{{$data->inside_length}}"
                                               data-outside_height="{{$data->outside_height}}"
                                               data-outside_width="{{$data->outside_width}}"
                                               data-outside_length="{{$data->outside_length}}"
                                               data-volume="{{$data->volume}}"
                                               data-specification_description ="{{$data->specification_description}}"
                                               data-payload="{{$data->payload}}"
                                               data-price="{{$data->price}}"
                                               data-overtime_price="{{$data->overtime_price}}"
                                            >
                                                <i class="ti-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addFloor" tabindex="-1" role="dialog" aria-labelledby="addTransportModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addTransportModalLabel">Add New Transport</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin.removal.transports.add') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row" >
                    <div class="col-lg-6" >
                        <div class="form-group">
                            <label for="name">Transport Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Transport Name" required>
                        </div>
                    </div>
                    <div class="col-lg-6" >
                        <div class="form-group">
                            <label for="inside_length">Inside Length (in meters)</label>
                            <input type="text" class="form-control" id="inside_length" name="inside_length" placeholder="Enter Inside Length">
                          </div>
                    </div>
                    <div class="col-lg-6" >
                        <div class="form-group">
                            <label for="inside_height">Inside Height (in meters)</label>
                            <input type="text" class="form-control" id="inside_height" name="inside_height" placeholder="Enter Inside Height">
                          </div>
                    </div>
                    <div class="col-lg-6" >
                        <div class="form-group">
                            <label for="inside_width">Inside Width (in meters)</label>
                            <input type="text" class="form-control" id="inside_width" name="inside_width" placeholder="Enter Inside Width">
                          </div>
                    </div>
                    <div class="col-lg-6" >
                        <div class="form-group">
                            <label for="outside_length">Outside Length (in meters)</label>
                            <input type="text" class="form-control" id="outside_length" name="outside_length" placeholder="Enter Outside Length">
                          </div>
                    </div>
                    <div class="col-lg-6" >
                        <div class="form-group">
                            <label for="outside_height">Outside Height (in meters)</label>
                            <input type="text" class="form-control" id="outside_height" name="outside_height" placeholder="Enter Outside Height">
                          </div>
                    </div>
                    
                    
                    <div class="col-lg-6" >
                        <div class="form-group">
                            <label for="outside_width">Outside Width (in meters)</label>
                            <input type="text" class="form-control" id="outside_width" name="outside_width" placeholder="Enter Outside Width">
                          </div>
                    </div>
                    <div class="col-lg-6" >
                        <div class="form-group">
                            <label for="volume">Volume (in m³)</label>
                            <input type="text" class="form-control" id="volume" name="volume" placeholder="Enter Volume">
                          </div>
                    </div>
                    <div class="col-lg-6" >
                        <div class="form-group">
                            <label for="payload">Payload Capacity (in kg)</label>
                            <input type="number" class="form-control" id="payload" name="payload" placeholder="Enter Payload Capacity">
                          </div>
                    </div>
                    <div class="col-lg-6" >
                        <div class="form-group">
                            <label for="seats">Number of Seats</label>
                            <input type="number" class="form-control" id="seats" name="seats" placeholder="Enter Seat Capacity">
                          </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="overtime_price">Overtime Price</label>
                        <input type="number" class="form-control" id="overtime_price" name="overtime_price">
                      </div>
                    </div>
                    <div class="col-lg-6" >
                        @php
                            $helpers  = getAllHelpers();
                          @endphp
                          <div class="form-group">
                            <label for="price_plan">{{__('Helpers')}}</label>
                            <select name="helpers[]" multiple class="form-control nice-select wide">
                              @foreach($helpers as $helper)
                                <option value="{{ $helper->id }}">{{ $helper->name }}</option>
                              @endforeach
                            </select>
                          </div>
                    </div>
                    <div class="col-lg-12" >
                        <div class="form-group">
                            <label for="specification_description">Specification Description</label>
                            <input type="text" class="form-control" id="specification_description" name="specification_description">
                        </div>
                    </div>
                    <div class="col-lg-6" >
                        <div class="form-group">
                            <label for="image">{{__('Image')}}</label>
                            <div class="media-upload-btn-wrapper">
                              <div class="img-wrap"></div>
                              <input type="hidden" name="image">
                              <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                {{__('Upload Image')}}
                              </button>
                            </div>
                            <small>{{__('Recommended image size 1920x1280')}}</small>
                        </div>
                    </div>
                    
                    <div class="col-lg-6" >
                        <div class="form-group">
                            <label for="image">{{__('Specification Images')}}</label>
                            <div class="media-upload-btn-wrapper">
                              <div class="img-wrap"></div>
                              <input type="hidden" name="specification_images" multiple>
                              <button type="button" class="btn btn-info media_upload_form_btn" data-mulitple="true" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                {{__('Upload Images')}}
                              </button>
                            </div>
                            <small>{{__('Recommended image size 1920x1280')}}</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Add Transport</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="price_plan_item_edit_modal" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{__('Edit Transport')}}</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
          </div>
          <form action="#" id="price_plan_edit_modal_form" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              @csrf
              <input type="hidden" name="id" id="transport_id" value="">
              <div class="row">
                <!-- Transport Name -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="edit_name">Transport Name</label>
                    <input type="text" class="form-control" id="edit_name" name="name" required>
                  </div>
                </div>
    
                <!-- Inside Length -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="edit_inside_length">Inside Length (in meters)</label>
                    <input type="text" class="form-control" id="edit_inside_length" name="inside_length">
                  </div>
                </div>
    
                <!-- Inside Height -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="edit_inside_height">Inside Height (in meters)</label>
                    <input type="text" class="form-control" id="edit_inside_height" name="inside_height">
                  </div>
                </div>
    
                <!-- Inside Width -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="edit_inside_width">Inside Width (in meters)</label>
                    <input type="text" class="form-control" id="edit_inside_width" name="inside_width">
                  </div>
                </div>
    
                <!-- Outside Length -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="edit_outside_length">Outside Length (in meters)</label>
                    <input type="text" class="form-control" id="edit_outside_length" name="outside_length">
                  </div>
                </div>
    
                <!-- Outside Height -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="edit_outside_height">Outside Height (in meters)</label>
                    <input type="text" class="form-control" id="edit_outside_height" name="outside_height">
                  </div>
                </div>
    
                <!-- Outside Width -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="edit_outside_width">Outside Width (in meters)</label>
                    <input type="text" class="form-control" id="edit_outside_width" name="outside_width">
                  </div>
                </div>
    
                <!-- Volume -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="edit_volume">Volume (in m³)</label>
                    <input type="text" class="form-control" id="edit_volume" name="volume">
                  </div>
                </div>
    
                <!-- Payload -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="edit_payload">Payload Capacity (in kg)</label>
                    <input type="number" class="form-control" id="edit_payload" name="payload">
                  </div>
                </div>
    
                <!-- Number of Seats -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="edit_seats">Number of Seats</label>
                    <input type="number" class="form-control" id="edit_seats" name="seats">
                  </div>
                </div>
                
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="edit_volume">Price</label>
                    <input type="text" class="form-control" id="edit_price" name="price">
                  </div>
                </div>
    
                <!-- Payload -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="edit_payload">Overtime Price</label>
                    <input type="number" class="form-control" id="edit_overtime_price" name="overtime_price">
                  </div>
                </div>
    
                <!-- Helpers -->
                <div class="col-lg-6">
                  @php
                    $helpers = getAllHelpers();
                  @endphp
                  <div class="form-group">
                    <label for="edit_helpers">{{__('Helpers')}}</label>
                    <select name="helpers[]" multiple class="form-control nice-select wide" id="edit_helpers">
                      @foreach($helpers as $helper)
                        <option value="{{ $helper->id }}">{{ $helper->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                
                <div class="col-lg-12" >
                    <div class="form-group">
                        <label for="edit_specification_description">Specification Description</label>
                        <input type="text" class="form-control" id="edit_specification_description" name="specification_description">
                    </div>
                </div>
    
                <!-- Image Upload -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="edit_image">{{__('Image')}}</label>
                    <div class="media-upload-btn-wrapper">
                      <div class="img-wrap"></div>
                      <input type="hidden" name="image" id="edit_image">
                      <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                        {{__('Upload Image')}}
                      </button>
                    </div>
                    <small>{{__('Recommended image size 1920x1280')}}</small>
                  </div>
                </div>
    
                <!-- Specification Images -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="edit_specification_images">{{__('Specification Images')}}</label>
                    <div class="media-upload-btn-wrapper">
                      <div class="img-wrap"></div>
                      <input type="hidden" name="specification_images" id="edit_specification_images" multiple>
                      <button type="button" class="btn btn-info media_upload_form_btn" data-mulitple="true" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                        {{__('Upload Images')}}
                      </button>
                    </div>
                    <small>{{__('Recommended image size 1920x1280')}}</small>
                  </div>
                </div>
                
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
              <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
@include('backend.partials.media-upload.media-upload-markup')
@endsection

@section('script')

    <script>
        $(document).ready(function () {
            $(document).on('click', '.price_plan_edit_btn', function () {
              var modal = $('#price_plan_item_edit_modal');
              var id = $(this).data('id');
              var action = $(this).data('action');
              var name = $(this).data('name');
              var insideLength = $(this).data('inside_length');
              var insideHeight = $(this).data('inside_height');
              var insideWidth = $(this).data('inside_width');
              var outsideLength = $(this).data('outside_length');
              var outsideHeight = $(this).data('outside_height');
              var outsideWidth = $(this).data('outside_width');
              var price = $(this).data('price');
              var overtime_price = $(this).data('overtime_price');
              var volume = $(this).data('volume');
              var specification_description = $(this).data('specification_description');
              var payload = $(this).data('payload');
              var seats = $(this).data('seats');
              var helpers = $(this).data('helpers');
              var image = $(this).data('image');
              var specificationImages = $(this).data('specification_images');
            
              // Populate Fields
              modal.find('#transport_id').val(id);
              modal.find('form').attr('action', action);
              modal.find('#edit_name').val(name);
              modal.find('#edit_inside_length').val(insideLength);
              modal.find('#edit_inside_height').val(insideHeight);
              modal.find('#edit_inside_width').val(insideWidth);
              modal.find('#edit_outside_length').val(outsideLength);
              modal.find('#edit_outside_height').val(outsideHeight);
              modal.find('#edit_outside_width').val(outsideWidth);
              modal.find('#edit_price').val(price);
              modal.find('#edit_overtime_price').val(overtime_price);
              modal.find('#edit_volume').val(volume);
              modal.find('#edit_payload').val(payload);
              modal.find('#edit_specification_description').val(specification_description);
              modal.find('#edit_seats').val(seats);
              modal.find('#edit_helpers').val(helpers).niceSelect('update');
              modal.find('#edit_image').val(image);
              modal.find('#edit_specification_images').val(specificationImages);
            });
        });
    </script>

    <!-- Start datatable js -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.table-wrap > table').DataTable( {
                "order": [[ 0, "desc" ]],
                "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,
                } ]
            } );
        } );
    </script>
    
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <x-backend.auto-slug-js :url="route('admin.work.slug.check')" :type="'new'"/>
    <script>
        $(document).ready(function () {

            $('.summernote').summernote({
                height: 250,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        let finalContenat =  iFrameFilterInSummernote(contents);
                        
                        $(this).prev('input').val(finalContenat);
                        console.log($(this).prev('input').val())
                    }
                }
            });
            
            if($('.summernote').length > 1){
                $('.summernote').each(function(index, value){
                    $(this).summernote('code', $(this).data('content'));
                });
            }

            if($('.nice-select').length > 0){
                $('.nice-select').niceSelect();
            }


            $(document).on('change','#language',function (e) {
                e.preventDefault();
                var selectedLang = $(this).val();
                $.ajax({
                    url : "{{route('admin.work.category.by.slug')}}",
                    type: "POST",
                    data: {
                        _token : "{{csrf_token()}}",
                        lang: selectedLang
                    },
                    success:function (data) {
                        $('#category').html('');
                        $.each(data,function (index,value) {
                            $('#category').append('<option value="'+value.id+'">'+value.name+'</option>');
                            $('.nice-select').niceSelect('update');
                        });
                    }
                });
            });
        });
    </script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection