<!DOCTYPE html>
<html>
<head>
    <title>Tu Oasis de Tranquilidad</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">
    <h2 style="color: #008080;">¡Gracias por confiar en ARTIEM Hotels!</h2>
    <p>Hola, nos complace confirmarte que tu reserva se ha procesado con éxito.</p>

    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong>Hotel:</strong></td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $datosReserva['hotel_nombre'] }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong>Habitación:</strong></td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $datosReserva['tipo_habitacion'] }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong>Noches:</strong></td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $datosReserva['noches'] }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong>Precio Total:</strong></td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong>{{ $datosReserva['precio_total'] }}€</strong></td>
        </tr>
    </table>

    <p style="margin-top: 20px;">¡Te esperamos para disfrutar de tu oasis de tranquilidad!</p>
</body>
</html>
