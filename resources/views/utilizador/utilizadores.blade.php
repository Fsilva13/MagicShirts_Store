@extends('layouts.app')


@section('content')
@include('layouts.messages')


@if(isset($user))
{!! Form::model($user, ['method' => 'post', 'route' => ['utilizador.update', $user->id ], 'class' =>'form-horizontal',
'enctype' => "multipart/form-data"]) !!}
{{method_field('PUT')}}
@else
{!! Form::model( ['method' => 'post', 'route' => ['utilizador.store' ], 'class' =>'form-horizontal', 'enctype' =>
"multipart/form-data"]) !!}
@endif
@CSRF

<fieldset>

    <div class="row justify-content-center">
        <div class="form-group col-7 ">
            <h2>Dados Contas Utilizadores</h2>
            <img name="foto_url" class="product-imagem"
                data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                alt="Thumbnail [100%x225]" @if(isset($user))
                src="{{$user->foto_url ? asset('storage/fotos/' . $user->foto_url) : 'https://digimedia.web.ua.pt/wp-content/uploads/2017/05/default-user-image.png' }}"
                data-holder-rendered="true">
            @else
            src="{{'https://digimedia.web.ua.pt/wp-content/uploads/2017/05/default-user-image.png'}}"
            data-holder-rendered="true">
            @endif
        </div>
        <div class="form-group justify-content-md-center col-7">
            <label style="display:block" class="control-label" for="filebutton">Alterar Foto</label>
            <input id="filebutton" name="foto_url" class="file-input" type="file">

        </div>

        <!-- Text input-->
        <div class="form-group col-7 ">
            <label class="control-label" for="name">Nome</label>
            <input id="name" name="name" type="text" placeholder="" class="form-control input-md"
                value="{{ old('name') ?? isset($user) ? $user->name : '' ?? '' }}">
            @error('name')
            <div class="error">
                {{$message}}
            </div>
            @enderror

        </div>

        <!-- Text input-->
        <div class="form-group col-7">
            <label class=" control-label" for="email">Email</label>
            <input id="email" name="email" type="text" placeholder="" class="form-control input-md"
                value="{{old('email') ?? isset($user) ? $user->email : '' ?? ''}}">
            @error('email')
            <div class="error">
                {{$message}}
            </div>
            @enderror

        </div>

        <!-- Select Basic -->
        <div class="form-group col-7">
            <label class="control-label" for="tipo">Tipo de Utilizador</label>
            <select id="tipo" name="tipo" class="form-control">
                <option value="" selected disabled hidden>--Tipo Utilizador--</option>
                @foreach(["A" => "Admin", "F" => "Funcionario"] AS $tipo => $userLabel)
                <option value="{{$tipo}}"
                    {{ old("tipo") ?? (isset($user) ? $user->tipo == $tipo : '') ? "selected" : "" }}>
                    {{ $userLabel }}
                </option>
                @endforeach
            </select>
            @error('tipo')
            <div class="error">
                {{$message}}
            </div>
            @enderror

        </div>

        <!-- Button (Double) -->
        <div class="form-group col-7">
            <label class=" control-label" for="submit"></label>
            <button id="submit" name="submit" class="btn btn-secondary">Guardar</button>
            <a href="{{ isset($user) ? route('utilizador.list') : route('estampas.list') }}"
                class="btn btn-danger">Sair</a>
        </div>
    </div>
</fieldset>
</form>

@endsection