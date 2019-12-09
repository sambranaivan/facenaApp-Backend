@php setlocale(LC_MONETARY, 'es_AR'); @endphp
<h4>COSTO DESIGNACIÓN / CONTRATACIÓN  (PERSONAL DOCENTE)					</h4>
<div class="row">
    <div class="col-md-4"><strong>CARGO:</strong></div>
<div class="col-md-4">{{$resultado->cargo}}</div>
</div>
<div class="row">
    <div class="col-md-4"><strong>DEDICACIÓN:</strong></div>
<div class="col-md-4">{{$resultado->dedicacion}}</div>
</div>
<div class="row">
    <div class="col-md-4"><strong>ANTIGÜEDAD AÑOS:</strong></div>
<div class="col-md-4">{{$resultado->antiguedad_anios}}</div>
</div>

<p></p>
<div class="row">
    <div class="col-md-5"><strong>SUELDO BÁSICO	</strong></div>
    <div class="col-md-4">{{number_format($resultado->sueldo_basico,2,',','.')}}</div>
</div>
<div class="row">
    <div class="col-md-5"><strong>ANTIGÜEDAD	</strong></div>
    <div class="col-md-4">{{number_format($resultado->antiguedad,2,',','.')}}</div>
</div>
<div class="row">
    <div class="col-md-5"><strong>ADICIONAL TÍTULO	</strong></div>
    <div class="col-md-4">{{number_format($resultado->adicional_titulo,2,',','.')}}</div>
</div>
<div class="row">
    <div class="col-md-5"><strong>Garantia 01/18	</strong></div>
    <div class="col-md-4">{{number_format($resultado->garantia,2,',','.')}}</div>
</div>


<div class="row">
    <div class="col-md-5"><strong>ADIC. NRNB 01/09	</strong></div>
    <div class="col-md-4">{{number_format($resultado->adicional_no_remunerativo,2,',','.')}}</div>
</div>
<div class="row">
    <div class="col-md-5"><strong>ADIC.JERARQUIZACION NRNB	</strong></div>
    <div class="col-md-3">{{number_format($resultado->adicional_jeraquico,2,',','.')}}</div>
</div>
<div class="row">
    <div class="col-md-5"><strong>SUB TOTAL	</strong></div>
    <div class="col-md-4">{{number_format($resultado->total_bruto,2,',','.')}}</div>
</div>
<p></p>

<div class="row">
    <div class="col-md-5"><strong>PERIODO DE DESIGNACIÓN</strong></div>
    <div class="col-md-3">{{$resultado->desde->format('d-m-Y')}}</div>
    <div class="col-md-1">al </div>
    <div class="col-md-3">{{$resultado->hasta->format('d-m-Y')}}</div>
    <div class="col-md-4 offset-md-5"><strong> Días 1er. Semestre</strong></div>
    <div class="col-md-3">{{$resultado->primer_bimestre}}</div>
    <div class="col-md-4 offset-md-5"><strong> Días 2do. Semestre</strong></div>
    <div class="col-md-3">{{$resultado->segundo_bimestre}}</div>
     <div class="col-md-4 offset-md-5"><strong> TOTAL DÍAS</strong></div>
    <div class="col-md-3">{{$resultado->dias}}</div>
</div>

<div class="row">
    <div class="col-md-5">
    <strong>ASIGNACIONES</strong>
</div>
<div class="col-md-4">{{number_format($resultado->totales->asignaciones,2,',','.')}}</div></div>
<div class="row">
    <div class="col-md-5">
    <strong>ADICIONALES</strong>
</div>
<div class="col-md-4">{{number_format($resultado->totales->adicionales,2,',','.')}}</div></div>
<div class="row">
    <div class="col-md-5">
    <strong>ADICIONALES NRNB</strong>
</div>
<div class="col-md-4">{{number_format($resultado->totales->adicionales_nrnb,2,',','.')}}</div></div>
<div class="row">
    <div class="col-md-5">
    <strong>S.A.C. 1er.Sem.</strong>
</div>
<div class="col-md-4">{{number_format($resultado->totales->primer_sac,2,',','.')}}</div></div>
<div class="row">
    <div class="col-md-5">
    <strong>S.A.C. 2do.Sem.</strong>
</div>
<div class="col-md-4">{{number_format($resultado->totales->segundo_sac,2,',','.')}}</div></div>
<div class="row">
    <div class="col-md-5">
    <strong>SUB TOTAL</strong>
</div>
<div class="col-md-4">{{number_format($resultado->totales->sub_total,2,',','.')}}</div></div>

<h5><strong>APORTES PATRONALES</strong></h5>
<div class="row">
        <div class="col-md-5"><strong>C.Patr.    10,17%		</strong></div>
        <div class="col-md-4">{{number_format($resultado->patronales->cuota_patronal,2,',','.')}}</div>
</div>
<div class="row">
        <div class="col-md-5"><strong>O.Soc.           6%		</strong></div>
        <div class="col-md-4">{{number_format($resultado->patronales->obra_social,2,',','.')}}</div>
</div>
<div class="row">
        <div class="col-md-5"><strong>L.19032      1,5%	</strong></div>
        <div class="col-md-4">{{number_format($resultado->patronales->ley,2,',','.')}}</div>
</div>
<div class="row">
        <div class="col-md-5"><strong>A.R.T.       0,33%	</strong></div>
        <div class="col-md-4">{{number_format($resultado->patronales->art,2,',','.')}}</div>
</div>
<div class="row">
        <div class="col-md-5"><strong>TOTAL:</strong></div>
        <div class="col-md-4">{{number_format($resultado->patronales->total,2,',','.')}}</div>
</div>
<p></p>
<div class="row">
        <div class="col-md-8"><strong>
TOTAL COSTO PERIODO SOLICITADO	:</strong></div>
        <div class="col-md-4">{{number_format($resultado->total_perido,2,',','.')}}</div>
</div>
<div class="row">
        <div class="col-md-8"><strong>
TOTAL COSTO MENSUAL	:</strong></div>
        <div class="col-md-4">{{number_format($resultado->total_costo_mensual,2,',','.')}}</div>
</div>



