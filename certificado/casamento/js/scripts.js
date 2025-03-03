document.addEventListener("DOMContentLoaded", function() {
    const data = new Date();
    document.getElementById("data").textContent = data.toLocaleDateString();

    // Corrigido: Adicionado método completo 'toLocaleString()' para exibir data e hora.
    document.getElementById("data2").textContent = data.toLocaleString();
});
