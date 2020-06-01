// Dialog para confirmação da exclusão de dado (genérico)
$(".excluir-dado").click(function(){
    
    event.preventDefault()

    form = this.closest('form')
    
    swal.fire({
        title: 'Tem certeza que deseja excluir?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não'
      }).then((result) => {
        if (result.value) {
          form.submit(); 
        }
      })
});

//Artistas

// Habilita campos para edição do artista (artistas/index)
$(".editar-artista").click(function(){
  
  const artistaId = $(this).attr('data-artista')

  toggleInput(artistaId)
  
})

// Atualizar cadastro artista (artistas/index)
$(".atualiza-artista").click(function(){
  
  // Inicia variáveis
  let formData = new FormData()
  const elemento = $(this).closest('div').find('.valor-artista') 
  const artistaId = $(this).attr('data-artista')
  const token = $(this).closest('div').find('[name="_token"]').val()
  const nome = $(this).closest('div').find('[name="nome"]').val()
  const identificadorExterno = $(this).closest('div').find('[name="identificador_externo"]').val()

  // Acrescenta valores para atualização
  formData.append('_token', token)
  formData.append("nome", nome)
  
  // Acrescenta valores apenas se não forem nulos
  if(identificadorExterno != "") {
    formData.append("identificador_externo", identificadorExterno)
  }
    
  // Define a URL de atualização
  const url = "/artistas/atualizar/" + artistaId;
  
  // Formata a requisição e atualiza
  fetch(url, {
    body: formData,
    method: 'POST' 
  }).then(() => {
    
    // Atualiza a exibição do item 
    toggleInput(artistaId);
    $(document.getElementById('nome-artista-' + artistaId)).text(nome)
    
  });

})

// Função para ocultar/desocultar as inputs de edição de artista (artistas/index)
function toggleInput(artistaId) {
  const input = $(document.getElementById('inputs-artista-' + artistaId))
  const span = $(document.getElementById('nome-artista-' + artistaId))

  if(span.is(":hidden")){
    span.attr("hidden", false);
    input.attr("hidden", true);
  } else {
    span.attr("hidden", true);
    input.removeAttr("hidden");
  } 
}

// (albuns)
// Atualizar cadastro artista (artistas/index)
$(".pesquisar-artista").click(function(){
  
  // Tira comportamento padrão do botão
  event.preventDefault()

  // Pega o dado digitado pelo usuário, referente ao nome do artista
  const nomeArtista = $('[name="artista_nome"]').val()
  
  // Pega os elementos da tela que serão preenchidos para visualização
  const imagemArtista = $('#artista-imagem')
  const tituloArtista = $('#artista_titulo')
  const idArtista = $('[name="identificador_externo"]')
  const artista = $('#nome')

  // Requisição
  $.ajax({
    type: "GET",
    dataType: "JSON",
    url: "/albuns/buscar_artista",
    data: {
      artista_nome: nomeArtista 
    },
    success: function(data) {
      
      $('#artista-area').removeClass('d-none');

      tituloArtista.text(data['resposta'][0].nome)
      imagemArtista.attr("src", data['resposta'][0].url_imagem)
      idArtista.val(data['resposta'][0].identificador_externo)
      artista.val(data['resposta'][0].nome)

    }
  })
})