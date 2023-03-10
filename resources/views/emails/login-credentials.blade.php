@component('mail::message')
# Credenciales para {{ config('app.name') }}

Tus credenciales para acceder son.

{{-- @component('mail::table')
    | Usuario | Contraseña |
    |---------|------------|
    |{{ $user->email }}|{{ $password }}|

@endcomponent --}}
@component('mail::table')
    <table>
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Contraseña</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center">{{ $user->email }}</td>
                <td style="text-align: center">{{ $password }}</td>
            </tr>
        </tbody>
    </table>
@endcomponent

@component('mail::button', ['url' => url('login')])
Iniciar Sesión
@endcomponent

@endcomponent
