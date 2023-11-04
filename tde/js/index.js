function salvar() {
    var form = document.getElementById('opcoes');
    var dados = new FormData(form);

    fetch("php/post.php", {
        method: "POST",
        body: dados
    });
}
