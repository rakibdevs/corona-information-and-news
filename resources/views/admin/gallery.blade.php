@extends('admin.layouts.main')

@section('content')
@push('css')
 	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
 	<style type="text/css">
 		.fileinput-remove,
        .fileinput-upload{
            display: none;
        }
 	</style>

@endpush
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ik ik-x"></i>
                </button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ik ik-x"></i>
                </button>

            </div>
            @endif
        </div>
        <div class="col-sm-12">
        	<div class="form-group">
        		{!! csrf_field() !!}
                <div class="file-loading">
                    <input id="file-1" type="file" name="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="1">
                </div>
                <div class="space-10"></div>
                <div class="form-group center">
                	<button id="upload" class="btn btn-success">Upload All</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
    <script type="text/javascript">
        $("#file-1").fileinput({
            theme: 'fa',
            uploadUrl: "/admin/gallery/store",
            uploadExtraData: function() {
                return {
                    _token: $("input[name='_token']").val(),
                };
            },
            allowedFileExtensions: ['jpg', 'png', 'gif'],
            overwriteInitial: false,
            maxFileSize:2000,
            maxFilesNum: 10,
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            }
        });
        $(document).ready(function()
        {
        	$(document).on('click','#upload', function(){
        		$('.kv-file-upload').each( function(){
        			if($(this).is(":visible")){
        				$(this).trigger('click');
        			}
        		});
        		
        	});
        });
    </script>
@endpush
@endsection