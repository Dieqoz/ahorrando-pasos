<?php

// Verificamos si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recibimos los datos del formulario
    $electricidad = floatval($_POST["electricity"]);
    $gas = floatval($_POST["gas"]);
    $kilometrajeAutomovil = floatval($_POST["car-mileage"]);
    $eficienciaCombustibleAutomovil = floatval($_POST["car-fuel-efficiency"]);
    $transportePublico = floatval($_POST["public-transport"]);
    $vuelosAvion = floatval($_POST["flights"]);
    $consumoAlimentos = floatval($_POST["food-consumption"]);
    $reciclaje = floatval($_POST["recycling"]) / 100; // Convertimos el porcentaje a decimal

    // Factor de conversión de CO2 para electricidad y gas (en kg CO2eq/kWh o kg CO2eq/m³)
    $factorEmisionElectricidad = 0.5; // Ejemplo ficticio, usar datos reales para obtener resultados precisos
    $factorEmisionGas = 2.0; // Ejemplo ficticio, usar datos reales para obtener resultados precisos

    // Factor de conversión de CO2 para el transporte (en kg CO2eq/km)
    $factorEmisionAutomovil = 0.2; // Ejemplo ficticio, usar datos reales para obtener resultados precisos
    $factorEmisionTransportePublico = 0.1; // Ejemplo ficticio, usar datos reales para obtener resultados precisos
    $factorEmisionVuelosAvion = 0.3; // Ejemplo ficticio, usar datos reales para obtener resultados precisos

    // Factor de conversión de CO2 para la producción de alimentos (en kg CO2eq/kg)
    $factorEmisionAlimentos = 2.5; // Ejemplo ficticio, usar datos reales para obtener resultados precisos

    // Cálculos de la huella de carbono
    $huellaCarbonoElectricidad = $electricidad * $factorEmisionElectricidad;
    $huellaCarbonoGas = $gas * $factorEmisionGas;
    $huellaCarbonoAutomovil = ($kilometrajeAutomovil / $eficienciaCombustibleAutomovil) * $factorEmisionAutomovil;
    $huellaCarbonoTransportePublico = $transportePublico * $factorEmisionTransportePublico;
    $huellaCarbonoVuelosAvion = $vuelosAvion * $factorEmisionVuelosAvion;
    $huellaCarbonoAlimentos = $consumoAlimentos * $factorEmisionAlimentos;

    // Cálculo de la huella de carbono total
    $huellaCarbonoTotal = $huellaCarbonoElectricidad + $huellaCarbonoGas + $huellaCarbonoAutomovil;
    $huellaCarbonoTotal += $huellaCarbonoTransportePublico + $huellaCarbonoVuelosAvion + $huellaCarbonoAlimentos;

    // Ajuste por el porcentaje de materiales reciclados (reducción del 10%)
    $huellaCarbonoTotal *= (1 - $reciclaje);

    // Devolvemos el resultado como una respuesta JSON
    echo json_encode(["huellaCarbono" => round($huellaCarbonoTotal, 2)]);
} else {
    // Si no se han enviado datos por el formulario, devolvemos un error
    http_response_code(400);
    echo json_encode(["error" => "No se han enviado los datos del formulario correctamente"]);
}