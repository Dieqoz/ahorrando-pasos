document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('carbon-footprint-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      mostrarResultado();
    });
  });
  
  function calcularHuellaCarbono() {
    // Variables para el consumo de energía
    const electricidad = parseFloat(document.getElementById('electricity').value);
    const gas = parseFloat(document.getElementById('gas').value);
  
    // Variables para el transporte
    const kilometrajeAutomovil = parseFloat(document.getElementById('car-mileage').value);
    const eficienciaCombustible = parseFloat(document.getElementById('car-fuel-efficiency').value);
    const transportePublico = parseFloat(document.getElementById('public-transport').value);
    const vuelosAvion = parseFloat(document.getElementById('flights').value);
  
    // Variables para el estilo de vida y alimentación
    const consumoAlimentos = parseFloat(document.getElementById('food-consumption').value);
    const reciclaje = parseFloat(document.getElementById('recycling').value) / 100; // Convertir el porcentaje a decimal
  
    // Variables para el consumo de agua
    const consumoAgua = parseFloat(document.getElementById('water-consumption').value);
  
    // Variables para el manejo de residuos
    const residuosGenerados = parseFloat(document.getElementById('waste-generated').value);
    const residuosReciclados = parseFloat(document.getElementById('waste-recycled').value) / 100; // Convertir el porcentaje a decimal
  
    // Factores de conversión de CO2 para diferentes aspectos (en kg CO2eq por unidad de medida)
    const factorEmisionElectricidad = 0.5; // Ejemplo ficticio, usar datos reales para obtener resultados precisos
    const factorEmisionGas = 2.0; // Ejemplo ficticio, usar datos reales para obtener resultados precisos
    const factorEmisionAutomovil = 0.2; // Ejemplo ficticio, usar datos reales para obtener resultados precisos
    const factorEmisionTransportePublico = 0.1; // Ejemplo ficticio, usar datos reales para obtener resultados precisos
    const factorEmisionVuelosAvion = 0.3; // Ejemplo ficticio, usar datos reales para obtener resultados precisos
    const factorEmisionAlimentos = 2.5; // Ejemplo ficticio, usar datos reales para obtener resultados precisos
    const factorEmisionAgua = 0.1; // Ejemplo ficticio, usar datos reales para obtener resultados precisos
    const factorEmisionResiduos = 0.05; // Ejemplo ficticio, usar datos reales para obtener resultados precisos
  
    // Cálculos de la huella de carbono
    const huellaCarbonoElectricidad = electricidad * factorEmisionElectricidad;
    const huellaCarbonoGas = gas * factorEmisionGas;
    const huellaCarbonoAutomovil = (kilometrajeAutomovil / eficienciaCombustible) * factorEmisionAutomovil;
    const huellaCarbonoTransportePublico = transportePublico * factorEmisionTransportePublico;
    const huellaCarbonoVuelosAvion = vuelosAvion * factorEmisionVuelosAvion;
    const huellaCarbonoAlimentos = consumoAlimentos * factorEmisionAlimentos;
    const huellaCarbonoAgua = consumoAgua * factorEmisionAgua;
    const huellaCarbonoResiduos = residuosGenerados * factorEmisionResiduos * (1 - residuosReciclados);
  
    // Cálculo de la huella de carbono total
    let huellaCarbonoTotal = huellaCarbonoElectricidad + huellaCarbonoGas + huellaCarbonoAutomovil;
    huellaCarbonoTotal += huellaCarbonoTransportePublico + huellaCarbonoVuelosAvion + huellaCarbonoAlimentos;
    huellaCarbonoTotal += huellaCarbonoAgua + huellaCarbonoResiduos;
  
    return huellaCarbonoTotal;
  }
  
  function mostrarResultado() {
    const huellaCarbono = calcularHuellaCarbono();
    const resultadoElemento = document.getElementById('result');
    resultadoElemento.textContent = `La huella de carbono total es: ${huellaCarbono.toFixed(2)} kg CO2eq`;
  }
  