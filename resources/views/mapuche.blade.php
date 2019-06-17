@extends('layouts.app')

@section('content')
<script>

docentes = null;

// ordenar
function compare(a, b) {
  // Use toUpperCase() to ignore character casing
  const genreA = toDate(a.fec_baja)
  const genreB = toDate(b.fec_baja)

  let comparison = 0;
  if (genreA < genreB) {
    comparison = 1;
  } else if (genreA >= genreB) {
    comparison = -1;
  }
  return comparison * -1;
}
function toDate(cadena)
{
    var parts = cadena.split('-');
    var fecha = new Date(parts[0], parts[1] - 1, parts[2]);
    return fecha;
}



function mostrar(resultados)
{


    tabla = $("#resultados");
    tabla.html("");//limpio
        row = '<tr>'
    resultados.forEach(element => {

            row += '<td>'+element.codc_categ+'</td>'
            row += '<td>'+element.codc_nivel+'</td>'
            row += '<td>'+element.desc_appat+'</td>'
            row += '<td>'+element.desc_nombr+'</td>'
            row += '<td>'+element.estado+'</td>'
            row += '<td>'+element.fec_alta+'</td>'
            row += '<td>'+element.fec_baja+'</td>'
            row += '<td>'+element.codc_titul+'</td>'
            row += '<td>'+element.desc_titul+'</td>'

            // row += '<td>'+element.fec_desde+'</td>'
            // row += '<td>'+element.fec_hasta+'</td>'
            // row += '<td>'+element.fecha_finalorig+'</td>'
            // row += '<td>'+element.nro_cargo+'</td>'
            row += '<td>'+element.nro_docum+'</td>'
            row += '<td>'+element.nro_legaj+'</td>'
            // row += '<td>'+element.nrovarlicencia+'</td>'
            row += '<td>'+element.observacion+'</td>'
            // row += '<td>'+element.tipo_docum+'</th>'
        row += '</tr>'
    });
    tabla.append(row)

}
$(document).ready(function(){
    $.get('{{route("getMapuche")}}',{},function(data){


        docentes = data.filter(docente => docente.codc_agrup == "DOCE")
        docentes.sort(compare)

    })

$("#buscar").click(function(e){

    e.preventDefault();
    needle = $("#filtro").val().toUpperCase();
    filtro = docentes.filter(docente => docente.desc_appat.includes(needle))
    console.log(filtro)
    mostrar(filtro);
})



$("#buscar_fecha").click(function(e){
    e.preventDefault();

    needle = $("#fecha").val();
    desde = $("#desde").val();



    filtro = docentes.filter(docente => ( (toDate(needle) >= toDate(docente.fec_baja))  && (toDate(desde) <= (toDate(docente.fec_baja)))))
    mostrar(filtro);
})

$("#meses_3").click(function(){
    console.log("Filtro 3 meses")
    hoy = new Date();
    hasta = new Date();
    hasta = hasta.setMonth(hasta.getMonth()+3);
    filtro = docentes.filter(docente => ( (hasta >= toDate(docente.fec_baja))  && (hoy <= (toDate(docente.fec_baja)))))
    mostrar(filtro);
})

$("#meses_6").click(function(){
    console.log("Filtro 6 meses")
    hoy = new Date();
    hasta = new Date();
    hasta = hasta.setMonth(hasta.getMonth()+6);
    filtro = docentes.filter(docente => ( (hasta >= toDate(docente.fec_baja))  && (hoy <= (toDate(docente.fec_baja)))))
    mostrar(filtro);
})

$("#meses_anio").click(function(){
    console.log("Filtro este año")
    hoy = new Date();
    hasta = toDate("2019-12-31");

    filtro = docentes.filter(docente => ( (hasta >= toDate(docente.fec_baja))  && (hoy <= (toDate(docente.fec_baja)))))
    mostrar(filtro);
})

})

</script>
<div class="container">
<div class="card text-center">
  <div class="card-body">
    <form class="form">
     <div class="form-group">
         <div class="row">

             <div class="col-md-4">
                 <label for="">Buscar por Nombre / Dni / Legajo</label>
                 <input type="text" name="" id="filtro" class="form-control" placeholder="" aria-describedby="helpId">
                 <button type="submit" id="buscar" class="btn btn-primary">Buscar</button>
                </div>
                <div class="col-md-4">
                    <label for="">Fecha de Baja desde el</label>
                    <input type="date" name="" id="desde" class="form-control" placeholder="" aria-describedby="helpId">
                    <label for="">hasta el</label>
                    <input type="date" name="" id="fecha" class="form-control" placeholder="" aria-describedby="helpId">
                    <button type="submit" id="buscar_fecha" class="btn btn-primary">Buscar</button>
                </div>
                <div class="col-md-4">
                    Busquedas Rápidas
                    <a name="" id="meses_3" class="btn btn-primary  btn-block" href="#" role="button">Con baja en los proximos 3 meses</a>
                    <a name="" id="meses_6" class="btn btn-primary  btn-block" href="#" role="button">Con baja en los proximos 6 meses</a>
                    <a name="" id="meses_anio" class="btn btn-primary  btn-block" href="#" role="button">Con baja este año</a>
                </div>
        </div>

        </div>
    </form>


  </div>
</div>
<table class="table table-responsive table-sm" style=" white-space: nowrap; height:50vh">
    <thead>
        <tr>

            <th>codc_categ</th>
            <th>codc_nivel</th>
            <th>desc_appat</th>
            <th>desc_nombr</th>
            <th>estado</th>
            <th>fec_alta</th>
            <th>fec_baja</th>
            <th>codc_titul</th>
            <th>desc_titul</th>

            {{-- <th>fec_desde</th> --}}
            {{-- <th>fec_hasta</th> --}}
            {{-- <th>fecha_finalorig</th> --}}
            {{-- <th>nro_cargo</th> --}}
            <th>nro_docum</th>
            <th>nro_legaj</th>
            {{-- <th>nrovarlicencia</th> --}}
            <th>observacion</th>
            {{-- <th>tipo_docum</th> --}}

        </tr>
    </thead>
    <tbody id="resultados">

    </tbody>
</table>

</div>
@endsection
