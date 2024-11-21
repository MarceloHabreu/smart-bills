// Receber seletor do campo valor
let inputValue = document.getElementById("value");

// Aguardar o usuário digitar o valor no campo
inputValue.addEventListener("input", function () {
    // obtendo o valor atual
    let valueValor = this.value.replace(/[^\d]/g, "");

    // adicionar os separadores de milhares
    let formattedValue =
        valueValor.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, ".") +
        "," +
        valueValor.slice(-2);

    // atualizar o campo com o valor formatado
    this.value = formattedValue;
});
