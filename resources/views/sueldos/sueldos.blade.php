@extends('layouts.app')

@section('content')

<script>
$(document).ready(function(){


})
</script>

<div class="container">

    <div class="row">
        <div class="col-md-6">
        <form method="post" action="" class="form">
            @csrf
            <div class="row">


            <div class="col-md-6">
                 <div class="form-group">
            <label for="cargo">Cargo</label>
           <select name="cargo" id="cargo" class="form-control form-control-sm" required>
               <option value="">--</option>
            <option value="AY.ALUM">Ayudante Alumno</option>
            <option value="AUX.1RA">Auxiliar 1°</option>
            <option value="JTP">JTP</option>
            <option value="P.ADJ">P. Adjunto</option>
            <option value="P.TIT">P. Titular</option>
            <option value="BEDEL">Bedel</option>
        </select>
        </div>
            </div>

            <div class="col-md-6">
                  <div class="form-group">
            <label for="dedicacion">Dedicacion</label>
           <select name="dedicacion" id="dedicacion" class="form-control form-control-sm" required>
                <option value="">--</option>
                <option value="SIMP"> Simple</option>
                <option value="SEMI"> Semi</option>
                <option value="EXCL"> Exclusivo</option>
                <option value="25 HS"> 25 Hs</option>
           </select>
        </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="antiguedad">Antigüedad</label>
                    <input required class="form-control form-control-sm" type="number"  min=0 step=1 name="antiguedad">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="adicional">Adicional Por Título</label>
                    <select id="adicional" class="form-control form-control-sm" name="adicional">
                        <option>--</option>
                        <option value="esp">Especialista</option>
                        <option value="master">Maestria</option>
                        <option value="doctor">Doctor</option>
                    </select>
                </div>
            </div>


            </div>
            <div class="row">
                <div class="col-md-4">Periodo Designación</div>
                <div class="col-md-4"><div class="form-group">

                    <input  required class="form-control form-control-sm" type="date"  name="desde">
                </div></div>
                <div class="col-md-4">
                                    <div class="form-group">

                    <input required class="form-control form-control-sm" type="date" value="2019-12-31" name="hasta">
                </div>
                </div>


            </div>
            <div class="row ">
                <div class="col-md-12 text-right">
                    <input class="btn btn-success" type="submit" id="btn_calcular" value="Aceptar">
                </div>

            </div>



    </form>
        </div>
        {{--  --}}
        <div class="col-md-6">
          @isset($resultado)
                @include('sueldos.resultados',['resultado'=>$resultado])
          @endisset

        </div>
    </div>
</div>

@endsection
