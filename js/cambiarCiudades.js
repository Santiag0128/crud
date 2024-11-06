
// Función para actualizar las ciudades según el departamento seleccionado
function cambiarCiudades() {
    const departamentoSelect = document.getElementById("departamento");
    const ciudadSelect = document.getElementById("ciudad");
    const departamentoId = departamentoSelect.value;

    ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';

    // Filtrar y agregar las ciudades correspondientes al departamento
    ciudades.forEach(ciudad => {
        if (ciudad.departamento_id == departamentoId) {
            const option = document.createElement("option");
            option.value = ciudad.id;
            option.textContent = ciudad.nombre;
            ciudadSelect.appendChild(option);
        }
    
    });
}
document.addEventListener("DOMContentLoaded",()=>{
    document.getElementById("departamento").addEventListener("change",cambiarCiudades);
});