@extends('layouts.app')

@section('content')
<b-container>
    <b-row align-h="center">
        <b-col cols="8">
            <b-card header="Iniciar Sesion" header-tag="header">
                <b-card-text>
                    <b-form method="POST" action="{{ route('login') }}">
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
                        label="Email" 
                        label-for="email">
                        
                            <b-col cols="8">
                                <b-form-input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required autocomplete="email" 
                                autofocus
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
                                autocomplete="current-password">
                            </b-col cols="8">
                        </b-form-group>
                
                    
                        <b-row align-h="center">
                        <b-form-group> 
                            <b-form-checkbox 
                            name="remember" 
                            {{ old('remember') ? 'checked="true"' : '' }}>
                            Recordar sesion
                            </b-form-checkbox>
                        </b-form-group> 
                        </b-row>
                
                        <b-row align-h="center">
                        <b-button variant="primary" type="submit">
                            Ingresar
                        </b-button>
                        <b-button href="{{ route('password.request') }}" variant="link">
                            ¿Olvidaste tu contraseña?
                        </b-button>
                        </b-row>

                    </b-form>
                </b-card-text>
            </b-card>
        </b-col>
    </b-row>
</b-container>
@endsection
