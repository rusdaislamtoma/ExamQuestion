<message>
    @if($errors->any())
    {!! Toastr::message() !!}
    <script type="text/javascript">
        @foreach($errors->all() as $error)
        toastr.error('{{ $error }}','Error',{
            closeButton:true,
            progressBar:true,
            positionClass: "toast-top-full-width",
        });
        @endforeach
    </script>
    @endif
</message>