@extends('dashboard.layouts.app')
@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.posts')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('site.posts')</li>
        </ol>
    </section>

    <section class="content">
        
        <div class="box box-primary">
            <div class="box-body">
                <a href="{{ route('dashboard.posts.create') }}" class="btn btn-primary">{{ __('site.add') }} {{ __('site.post') }} <i class="fa fa-plus"></i></a>
                <br /><br />
                @include('dashboard.includes.errors')
                <table class="table table-striped" id="table_id">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('site.image') }}</th>
                            <th>{{ __('site.title') }}</th>
                            <th>{{__('site.category')}}</th>
                            <th>{{ __('site.user') }}</th>
                            <th>{{ __('site.status') }}</th>
                            <th>{{ __('site.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>

            </div><!-- end of box body -->


        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->
 {{-- delete --}}
 <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
 aria-hidden="true">
 <div class="modal-dialog">
     <form action="{{ Route('dashboard.posts.delete') }}" method="POST">
         <div class="modal-content">

             <div class="modal-body">
                 @csrf

                 <div class="form-group">
                     <p>{{ __('site.confirm_delete') }}</p>
                     @csrf
                     <input type="hidden" name="id" id="id">
                 </div>



             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-info" data-dismiss="modal">{{ __('site.close') }}</button>
                 <button type="submit" class="btn btn-danger">{{ __('site.delete') }} </button>
             </div>
         </div>
     </form>
     <!-- /.modal-content -->
 </div>
 <!-- /.modal-dialog -->
</div>
{{-- delete --}}

@endsection
@push('javascripts')
    <script type="text/javascript">
        $(function() {
            var table = $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard.posts.all') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'main_img',
                        name: 'main_img'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false

                    }
                ]
            });

        });



        $('#table_id tbody').on('click', '#deleteBtn', function(argument) {
            var id = $(this).attr("data-id");
            console.log(id);
            $('#deletemodal #id').val(id);
        });
    </script>
@endpush