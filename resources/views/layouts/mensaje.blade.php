@if ($message = session('success'))
<div class="alert alert-success alert-block alert-dismissible">
    <button id="btn_mensaje" type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>

    <script language="javascript">
        setTimeout(function() {
            $("#btn_mensaje").click();
        },2000);
    </script>
</div>
@endif

@if ($message = session('error'))
<div class="alert alert-danger alert-block">
    <button id="btn_mensaje" type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>

    <script language="javascript">
        setTimeout(function() {
            $("#btn_mensaje").click();
        },2000);
    </script>
</div>
@endif

@if ($message = session('warning'))
<div class="alert alert-warning alert-block">
    <button id="btn_mensaje" type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>

    <script language="javascript">
        setTimeout(function() {
            $("#btn_mensaje").click();
        },2000);
    </script>
</div>
@endif

@if ($message = session('info'))
<div class="alert alert-info alert-block">
    <button id="btn_mensaje" type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>

    <script language="javascript">
        setTimeout(function() {
            $("#btn_mensaje").click();
        },2000);
    </script>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    Error en los datos de entrada
</div>
@endif
