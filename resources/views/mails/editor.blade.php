@extends('layouts.app')

@section('content')

  <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
  <script>tinymce.init(
      { selector:'textarea' ,
      plugins: 'print preview fullpage searchreplace autolink directionality  visualblocks visualchars fullscreen image link media  template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount  imagetools textpattern help ',
  toolbar: 'formatselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | link image media pageembed | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment',
  image_advtab: true,
  importcss_append: true,
  height: 400,
  template_cdate_format: '[CDATE: %m/%d/%Y : %H:%M:%S]',
  template_mdate_format: '[MDATE: %m/%d/%Y : %H:%M:%S]',
  image_caption: true,
  spellchecker_dialog: true,
  spellchecker_whitelist: ['Ephox', 'Moxiecode'],
  tinycomments_mode: 'embedded',
//   mentions_fetch: mentionsFetchFunction,
  content_style: '.mce-annotation { background: #fff0b7; } .tc-active-annotation {background: #ffe168; color: black; }'

      }
      );</script>

<div class="container">
    <div class="row justify-content-center">
       <form class="form" method="POST" action={{route("guardarMail")}}>
        @csrf
           <div class="form-group">
             <label for="asunto">Asunto</label>
             <input type="text" class="form-control" name="asunto" id="" aria-describedby="helpId" placeholder="" required>
             {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
           </div>
           <div class="form-group">
             <label for="asunto">Contenido</label>
            <textarea name="mensaje">

            </textarea>

           </div>
           <div class="row">
               <div class="col-md-6">

                   <div class="form-group">
                     <label for="para">Enviar a:</label>
                     <input type="text" class="form-control" name="para" id="" aria-describedby="emailHelpId" placeholder="" required>
                     {{-- <small id="emailHelpId" class="form-text text-muted">Help text</small> --}}
                   </div>
               </div>
               <div class="col-md-2">
                <div class="form-group">
             <label for="">Todos los </label>
             <select class="form-control" name="day_of_week" id="">
               <option value="1">Lunes</option>
               <option value="2">Martes</option>
               <option value="3">Miercoles</option>
               <option value="4">Jueves</option>
               <option value="5">Viernes</option>
               <option value="6">Sabado</option>
              <option value="7"> Domingo</option>
             </select>
           </div>
               </div>
           <div class="col-md-2">
<div class="form-group">
             <label for="">a las </label>
             <select class="form-control" name="hour" id="">
               @for ($i = 0; $i <= 23; $i++)
                   <option value="{{$i}}">{{$i}}:00</option>
               @endfor
             </select>
           </div>
           </div>
           <div class="col-md-2">

               <button type="submit" class="btn btn-primary">Guardar</button>
           </div>
        </div>


       </form>
    </div>
</div>
@endsection
