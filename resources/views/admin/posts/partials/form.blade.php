{{ Form::hidden('user_id', auth()->user()->id) }}

<div class="form-group">
    {{ Form::label('category_id', 'Categoria' )}}
    {{ Form::select('category_id', $categories, null, ['class' => 'form-control', 'id' => 'name'])}}
</div>

<div class="form-group">
    {{ Form::label('name', 'Nombre de la etiqueta') }}
    {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name'])}}
</div>

<div class="form-group">
    {{ Form::label('slug', 'URL Amigable') }}
    {{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug'])}}
</div>

<div class="form-group">
    {{ Form::label('file', 'Imagen') }}
    {{ Form::file('file') }}
</div>

<div class="form-group">
    {{ Form::label('status', 'Estado') }}
    <label>
        {{ Form::radio('status', 'PUBLISHED') }} Publicado
    </label>
    <label>
        {{ Form::radio('status', 'DRAFT') }} Borrador
    </label>
</div>

<div class="form-group">
    {{ Form::label('tags', 'Etiquetas') }}
    @foreach ($tags as $tag)
        {{ Form::checkbox('tags[]', $tag->id) }} {{ $tag->name }}
    @endforeach
</div>

<div class="form-group">
    {{ Form::label('excerpt', 'Extracto') }}
    {{ Form::textarea('excerpt', null, ['class' => 'form-control', 'rows' => '2'])}}
</div>

<div class="form-group">
    {{ Form::label('body', 'Descripcion') }}
    {{ Form::textarea('body', null, ['class' => 'form-control', 'name' => 'body', 'id' => 'body'])}}
</div>

<div class="form-group">
    {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary'])}}
</div>

@section('scripts')

<script src="{{ asset('vendor/strinToSlug/jquery.stringToSlug.min') }}"></script>
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>



<script>
    //funcion para convertir el nombre a slug automaticamente
    $(document).ready(function(){
        CKEDITOR.replace( 'body' );


        $("#name").keyup(function(){
            var cadena = $(this).val();
            string_to_slug(cadena);
        });
    });

    function string_to_slug (str) {
            str = str.replace(/^\s+|\s+$/g, '');
            str = str.toLowerCase(); 
            
            //quita acentos, cambia la ñ por n, etc
            var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
            var to   = "aaaaeeeeiiiioooouuuunc------";
            
            for (var i=0, l=from.length ; i<l ; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') // quita caracteres invalidos
                    .replace(/\s+/g, '-') // reemplaza los espacios por -
                    .replace(/-+/g, '-'); // quita las plecas

            return $("#slug").val(str);
        
    }   





</script>
@endsection