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

// Cuidar da exclusão da conta
function deleteConfirm(event, accountId) {
    event.preventDefault();

    Swal.fire({
        title: "Tem certeza?",
        text: "Você não poderá reverter isso!",
        icon: "warning",
        showCancelButton: true,
        cancelButtonColor: "#0d6efd",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#dc3545",
        confirmButtonText: "Sim, excluir!",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formDelete" + accountId).submit();
        }
    });
}
