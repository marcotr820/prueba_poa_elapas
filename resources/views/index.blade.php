@extends('layouts.plantillabase')
@section('contenido')

@endsection

@section('js')
    <script>
        toastr["success"]("My name is Inigo Montoya. You killed my father. Prepare to die!");
        toastr["error"]("Are you the six fingered man?");
        toastr["warning"]("Inconceivable!");
    </script>
@endsection