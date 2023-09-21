@extends('dashboard.layouts.app')
@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.users')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('site.users')</li>
        </ol>
    </section>

    <section class="content">
        
        <div class="box box-primary">
            <div class="box-body">
                <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary">{{ __('site.add') }} {{ __('site.user') }} <i class="fa fa-plus"></i></a>
                <br /><br />
                @include('dashboard.includes.errors')
                <table class="table table-striped" id="table_id">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Frist Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
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
     <form action="{{ Route('dashboard.users.delete') }}" method="POST">
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
                ajax: "{{ route('dashboard.users.all') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'email',
                        name: 'email'
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