<!DOCTYPE html>
<html>
<head>
    <title>Tu Oasis de Tranquilidad - ARTIEM</title>
</head>
<body style="font-family: 'Segoe UI', Arial, sans-serif; color: #2d3748; background-color: #f7fafc; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <h2 style="color: #008080; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px;">¡Tu reserva está confirmada!</h2>
        <p>Hola, nos complace confirmarte que tu estancia ha sido registrada en nuestro sistema con éxito.</p>

        <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #edf2f7;"><strong>Hotel:</strong></td>
                <td style="padding: 10px; border-bottom: 1px solid #edf2f7;">{{ $datosReserva['nombre'] }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #edf2f7;"><strong>Habitación:</strong></td>
                <td style="padding: 10px; border-bottom: 1px solid #edf2f7;">{{ $datosReserva['tipo_habitacion'] }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #edf2f7;"><strong>Duración:</strong></td>
                <td style="padding: 10px; border-bottom: 1px solid #edf2f7;">{{ $datosReserva['noches'] }} noches</td>
            </tr>

            @if(!empty($datosReserva['extras']))
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #edf2f7; vertical-align: top;"><strong>Experiencias Wellness:</strong></td>
                <td style="padding: 10px; border-bottom: 1px solid #edf2f7;">
                    <ul style="margin: 0; padding-left: 20px; color: #4a5568;">
                        @foreach($datosReserva['extras'] as $extra)
                            <li>{{ $extra }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            @endif

            <tr>
                <td style="padding: 10px; padding-top: 20px; font-size: 1.2rem;"><strong>Monto Total:</strong></td>
                <td style="padding: 10px; padding-top: 20px; font-size: 1.2rem; color: #008080;"><strong>{{ $datosReserva['precio_total'] }}€</strong></td>
            </tr>
        </table>

        <div style="margin-top: 30px; text-align: center; font-size: 0.9rem; color: #718096;">
            <p>Te esperamos para disfrutar de una auténtica experiencia FreshPeople.</p>
            <p><strong>ARTIEM Hotels</strong> - Tu bienestar es nuestra prioridad.</p>
        </div>
    </div>
</body>
</html>
