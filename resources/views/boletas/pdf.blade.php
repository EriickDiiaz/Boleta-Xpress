<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boleta Escolar</title>
    <style>
        body {
            font-family: Calibri, sans-serif;
            margin: 0;
            padding: 20px;
            position: relative;
            height: 100vh;
        }
        .header {
            width: 100%;
            display: table;
            table-layout: fixed;
            margin-bottom: 10px;
        }
        .header-cell {
            display: table-cell;
            vertical-align: middle;
        }
        .logo {
            width: 250px;
            height: auto;
        }
        .school-info {
            text-align: center;
            font-size: 11pt;
        }
        .school-name {
            font-size: 12pt;
            font-weight: bold;
        }
        .content-center {
            text-align: center;
            width: 80%;
            margin: 140px auto;
                    
        }
        .boletin-title {
            font-size: 24pt;
            font-weight: bold;
            color: #0056b3;
            margin-bottom: 5px;
            text-transform: uppercase;
        
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        .project-title {
            font-size: 20pt;
            color: #28a745;
            margin-bottom: 5px;
            font-style: italic;
        }
        .info-container {
            font-size:11pt;
            width: 100%;
            margin: 40px 0;
        }
        .info-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        .info-section {
            flex: 1;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            margin: 10px;
        }
        .info-title {
            font-weight: bold;
            color: #0056b3;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid #0056b3;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        .info-boletin{
            text-align: center;
            margin-bottom: 20px;
        }
        .info-calificacion{
            font-size:11pt;
        }
        .signature-table {
            width: 100%;
            margin-top: 30px;
            font-size: 11pt;
        }
        .signature-cell {
            width: 33.33%;
            text-align: center;
            padding: 10px;
        }
        .signature-line {
            width: 80%;
            margin: 0 auto;
            border-bottom: 1px solid #000;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            font-size: 8pt;
            text-align: center;
            padding: 10px;
            background-color: #f8f9fa;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
<!-- PÁGINA 1 -->
    <!-- Membrete -->
    <div class="header">
        <div class="header-cell" style="width: 20%; text-align: left;">
            <img src="{{ public_path('img/logo-ministerio.png') }}" alt="Logo Ministerio" class="logo">
        </div>
        <div class="header-cell" style="width: 60%;">
            <div class="school-info">
                <p style="margin: 5px 0;">República Bolivariana de Venezuela</p>
                <p style="margin: 5px 0;">Ministerio del Poder Popular para la Educación</p>
                <p style="margin: 5px 0;">Territorial N° {{ $escuela->territorial}}</p>
                <p class="school-name" style="margin: 5px 0;">{{ $escuela->nombre ?? 'Nombre de la Escuela' }}</p>
                <p style="margin: 5px 0;">{{ $escuela->ciudad ?? 'Ciudad' }}</p>
                <p style="margin: 5px 0;">Código DEA: {{ $escuela->dea ?? 'No especificado' }}</p>
            </div>
        </div>
        <div class="header-cell" style="width: 20%; text-align: right;">
            <img src="data:image/png;base64,{{ $logoEscuelaBase64 }}" alt="Logo Escuela" class="logo">
        </div>
    </div>
    <!-- Contenido -->
    <div class="content-center">
        <h1 class="boletin-title">Boletín Informativo</h1>
        <h2 class="project-title">{{ $boleta->proyecto }}</h2>
        <h4 style="margin: 5px 0;">Año escolar: {{ $boleta->anoEscolar->nombre }}</h4>
        <h4 style="margin: 5px 0;">{{ $boleta->momento }}</h4>
    </div>

    <div class="info-container">        
        <div class="info-row">
            <!-- Datos del Estudiante -->
            <div class="info-section">
                <div class="info-title">Datos del Estudiante</div>
                <div class="info-grid">
                    <div class="info-item"><strong>Nombres y Apellidos:</strong> {{ $boleta->estudiante->nombres }} {{ $boleta->estudiante->apellidos }}</div>
                    <div class="info-item"><strong>Cédula:</strong> {{ $boleta->estudiante->cedula }}</div>
                    <div class="info-item"><strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($boleta->estudiante->fecha_nacimiento)->format('d/m/Y') }}</div>
                    <div class="info-item"><strong>Lugar de Nacimiento:</strong> {{ $boleta->estudiante->lugar_nacimiento }}</div>
                    <div class="info-item"><strong>Género:</strong> {{ $boleta->estudiante->genero }}</div>
                    <div class="info-item"><strong>Grado:</strong> {{ $boleta->grado->nombre }}</div>
                    <div class="info-item"><strong>Sección:</strong> {{ $boleta->seccion->nombre }}</div>
                </div>
            </div>
            <!-- Datos del Representante -->
            <div class="info-section">
                <div class="info-title">Datos del Representante</div>
                <div class="info-grid">
                    <div class="info-item"><strong>Nombres y Apellidos:</strong> {{ $boleta->estudiante->nombre_representante }}</div>
                    <div class="info-item"><strong>Cédula:</strong> {{ $boleta->estudiante->cedula_representante }}</div>
                </div>
            </div>
            <!-- Datos del Docente y Director -->
            <div class="info-section">
                <div class="info-grid">
                    <div class="info-item"><strong>Docente:</strong> Por asignar</div>
                    <div class="info-item"><strong>Director:</strong> {{ $boleta->escuela->director }}</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="footer">
        <p style="margin: 2px 0;">
            <strong>{{ $escuela->nombre }}</strong> | 
            {{ $escuela->direccion }} | 
            {{ $escuela->telefono ?? '' }} | 
            {{ $escuela->correo }} | 
            {{ $escuela->ciudad }}
        </p>
    </div>

<!-- PÁGINA 2 -->
    <!-- Membrete -->
    <div class="header">
        <div class="header-cell" style="width: 20%; text-align: left;">
            <img src="{{ public_path('img/logo-ministerio.png') }}" alt="Logo Ministerio" class="logo">
        </div>
        <div class="header-cell" style="width: 60%;">
            <div class="school-info">
                <p style="margin: 5px 0;">República Bolivariana de Venezuela</p>
                <p style="margin: 5px 0;">Ministerio del Poder Popular para la Educación</p>
                <p style="margin: 5px 0;">Territorial N° {{ $escuela->territorial}}</p>
                <p class="school-name" style="margin: 5px 0;">{{ $escuela->nombre ?? 'Nombre de la Escuela' }}</p>
                <p style="margin: 5px 0;">{{ $escuela->ciudad ?? 'Ciudad' }}</p>
                <p style="margin: 5px 0;">Código DEA: {{ $escuela->dea ?? 'No especificado' }}</p>
            </div>
        </div>
        <div class="header-cell" style="width: 20%; text-align: right;">
            <img src="data:image/png;base64,{{ $logoEscuelaBase64 }}" alt="Logo Escuela" class="logo">
        </div>
    </div>

    <!-- Contenido -->
    <!-- Titulo de la Boleta -->
    <div class="info-boletin">
        <h3 class="boletin-title" style="margin: 5px 0;">
            @if($boleta->tipo_boleta == 'descriptiva')
                Informe Descriptivo {{ $boleta->momento }}
            @else
                Informe Calificativo {{ $boleta->momento }}
            @endif
        </h3>
        <p style="margin: 5px 0;">Desde: {{ $boleta->anoEscolar->fecha_inicio }} / Hasta {{ $boleta->anoEscolar->fecha_fin }}</p>
        <p style="margin: 5px 0;"><strong>{{ $boleta->estudiante->nombres}} {{ $boleta->estudiante->apellidos }}</strong> - {{ $boleta->grado->nombre }}, Sección {{ $boleta->seccion->nombre }}.</p>
        <p style="margin: 5px 0;">Proyecto de Aprendizaje: <strong>{{ $boleta->proyecto }}</strong></p>
        <p class="project-title" style="margin: 5px 0;">Información de la Actuación Integral del Estudiante.</p>        
    </div>
    <!-- Calificaciones Asignaturas -->
    <div class="info-section">
        <div class="info-title">Calificaciones</div>
        
        @if($boleta->tipo_boleta == 'descriptiva')
            <!-- Formato para boletas descriptivas -->
            <div class="info-grid">            
                @foreach ($boleta->calificacionesAsignaturas as $calificacion)
                    <div class="info-calificacion">
                        <p style="margin: 5px 0;"><strong>{{ $calificacion->asignatura->nombre }}:</strong> {{ $calificacion->descripcion }}</p>
                    </div>
                @endforeach          
            </div>
        @else
            <!-- Formato para boletas calificativas -->
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Asignatura</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Calificación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($boleta->calificacionesAsignaturas as $calificacion)
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px;">{{ $calificacion->asignatura->nombre }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                @if(isset($calificacion->calificacion_literal))
                                    <strong>{{ $calificacion->calificacion_literal }}</strong>
                                @elseif(isset($calificacion->calificacion_numerica))
                                    <strong>{{ $calificacion->calificacion_numerica }}</strong>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Calificación General (solo para 3er momento) -->
    @if($boleta->momento === '3er Momento')
    <div class="info-section">
        <div class="info-title">Calificación General</div>
        <div style="text-align: center; font-size: 18pt; margin: 15px 0;">
            @if($boleta->tipo_boleta == 'calificativa' && isset($boleta->calificacion_general_numerica))
                <strong>{{ $boleta->calificacion_general_numerica }}</strong>
            @else
                <strong>{{ $boleta->calificacion_general }}</strong>
            @endif
        </div>
    </div>
    @endif

    <!-- Recomendaciones -->
    <div class="info-section">
        <div class="info-title">Recomendaciones</div>
        <div class="info-grid">  
            <div class="info-calificacion">
                <p style="margin: 5px 0;">{{$boleta->observaciones}}</p>
            </div>
        </div>
    </div>
    
    <!-- Firmas -->
    <table class="signature-table">
        <tr>
            <td class="signature-cell">
                <div class="signature-line">&nbsp;</div>
                <p>Docente</p>
            </td>
            <td class="signature-cell">
                <div class="signature-line">&nbsp;</div>
                <p>Representante</p>
            </td>
            <td class="signature-cell">
                <div class="signature-line">&nbsp;</div>
                <p>Director</p>
            </td>
        </tr>
    </table>
</body>
</html>