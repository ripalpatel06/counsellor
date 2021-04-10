@section('modal')
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @include('partials.modal.content')
            </div>
        </div>
    </div>
@stop

@yield('modal')

<script>
    $('#modal').on('hidden.bs.modal', function (e) {
        $(this).removeData('bs.modal');
        $(this).find('.modal-content').html('{!! str_replace(array("\r\n", "\r", "\n"), "", View::make('partials.modal.content')) !!}');
    });
</script>