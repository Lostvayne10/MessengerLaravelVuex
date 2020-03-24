@extends('layouts.app')

@section('content')
<b-container >
    <b-row align-h="center">
        <b-col cols="8">
            <b-card header="Registro" header-tag="header">

                <b-card-text>
                    <b-form method="POST" action="{{ route('register') }}">
                        @csrf
                        @if($errors->any())
                        <b-alert show variant="danger">
                            <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </b-alert>
                      
                        @else
                        <b-alert show>Por favor ingresa tus datos</b-alert>
                        @endif
                        
                        <b-form-group  
                        label-align-sm="right" 
                        label-cols-sm="4" 
                        label="Nombre" 
                        label-for="name">
                        
                            <b-col cols="8">
                                <b-form-input 
                                id="name" 
                                type="text" 
                                name="name" 
                                value="{{ old('name') }}" 
                                autocomplete="name" 
                                required 
                                autofocus
                               >
                            </b-col>
                          
                        </b-form-group>

                        <b-form-group  
                        label-align-sm="right" 
                        label-cols-sm="4" 
                        label="Email" 
                        label-for="email">
                        
                            <b-col cols="8">
                                <b-form-input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required autocomplete="email" 
                                placeholder="example@email.com">
                            </b-col>
                            
                        </b-form-group>

                        <b-form-group 
                        label-align-sm="right" 
                        label-cols-sm="4" 
                        label="Contraseña" 
                        label-for="password">

                            <b-col cols="8">
                                <b-form-input 
                                id="password" 
                                type="password" 
                                name="password" 
                                required 
                               >
                            </b-col cols="8">
                            
                        </b-form-group>

                        <b-form-group 
                        label-align-sm="right" 
                        label-cols-sm="4" 
                        label="Confirmar Contraseña" 
                        label-for="password_confirm">

                            <b-col cols="8">
                                <b-form-input 
                                id="password-confirm" 
                                type="password" 
                                name="password_confirmation" 
                                required 
                                >
                            </b-col cols="8">
                        </b-form-group>

                        
                        <b-row align-h="center">
                        <b-button variant="primary" type="submit">
                            Registrar
                        </b-button>
                        <b-button href="{{ route('login') }}" variant="link">
                            ¿Ya te haz registrado?
                        </b-button>
                        </b-row>
                    </b-form>
                </b-crd-text>
            </b-card>
        </b-col>
    </b-row>
</b-container>
@endsection
