graph TD
    %% Estilos
    classDef actor fill:#fff,stroke:#000,stroke-width:2px;
    classDef systemBoundary fill:#f0f8ff,stroke:#000;
    classDef useCase fill:#ffe0bd,stroke:#000;
    classDef include useCase fill:#c3e6cb;
    classDef extend useCase fill:#f8d7da;
    classDef report useCase fill:#d1ecf1;

    %% Actores
    A1[Empleado]:::actor
    A2[Cliente / Socio]:::actor

    %% Subsistemas
    subgraph S1 [Gestión de Usuarios]
        UC1(Afiliar Socio):::useCase
    end
    S1:::systemBoundary

    subgraph S2 [Gestión de Medios (Películas, Video Casetes, DVD)]
        UC2(Registrar/Actualizar Película):::useCase
        UC3(Registrar Copia de Película):::useCase
        UC4(Registrar/Asignar Actor):::useCase
        UC5(Registrar Video Casete)
    end
    S2:::systemBoundary

    subgraph S3 [Gestión de Alquiler y Devolución]
        UC6(Alquilar Copia):::useCase
        UC7(Registrar Devolución de Copia):::useCase
        UC8(Consultar Disponibilidad de Copia):::include
        UC9(Calcular Multa por Retraso):::extend
        UC10(Consultar Uso de Copia):::useCase
    end
    S3:::systemBoundary

    subgraph S4 [Consulta de Reporte]
        UC11(Generar Reporte de Alquileres y Multas):::report
        UC12(Generar Reporte de Comportamiento de Socios):::report
        UC13(Analizar Preferencias de Clientes):::report
        UC14(Consultar Histórico de Alquileres de Socio):::report
    end
    S4:::systemBoundary

    %% Relaciones de Actores
    A1 --> UC1
    A1 --> UC2
    A1 --> UC3
    A1 --> UC4
    A1 --> UC5
    A1 --> UC6
    A1 --> UC7
    A1 --> UC10
    A1 --> UC11
    A1 --> UC12
    A1 --> UC13
    A1 --> UC14

    A2 --> UC6
    A2 --> UC7
    A2 --> UC14
    
    %% Relaciones de Dependencia
    UC2 .> UC3 : <<includes>>
    UC2 .> UC4 : <<includes>>
    UC6 .> UC8 : <<includes>>
    UC7 .> UC9 : <<extends>>
    UC14 --> UC12 : Necesario para reporte
    
    %% Etiquetas de Inclusión/Extensión
    linkStyle 8 stroke-dasharray: 5 5
    linkStyle 9 stroke-dasharray: 5 5
    linkStyle 10 stroke-dasharray: 5 5
    linkStyle 11 stroke-dasharray: 5 5
