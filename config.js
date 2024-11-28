//Função para buscar moeda
function selecionar_buscarMoeda(event) {
  event.preventDefault();

  var idMoeda = document.getElementById("selecionar_idMoeda").value.trim();
  var nomeMoeda = document.getElementById("selecionar_nomeMoeda").value.trim();

  if (!idMoeda && !nomeMoeda) {
    alert("Por favor, insira pelo menos um filtro (ID ou Nome da moeda).");
    return;
  }

  let url = `php/moeda_selecionar.php?`;
  if (idMoeda) {
    url += `id=${encodeURIComponent(idMoeda)}&`;
  }
  if (nomeMoeda) {
    url += `nome=${encodeURIComponent(nomeMoeda)}`;
  }

  fetch(url)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Erro ao buscar os dados da moeda.");
      }
      return response.json();
    })
    .then((data) => {
      var resultados = document.getElementById("selecionar_moedaResultados");

      if (data.mensagem) {
        resultados.innerHTML = `<p class="text-danger">${data.mensagem}</p>`;
      } else {
        let tabela = `
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Símbolo</th>
                    <th>Preço Atual</th>
                    <th>Capital de Mercado</th>
                    <th>Mudança Preço</th>
                    <th>Rank</th>
                    <th>Imagem</th>
                  </tr>
                </thead>
                <tbody>
            `;
        data.forEach((moeda) => {
          tabela += `
                <tr>
                  <td>${moeda.id_moeda}</td>
                  <td>${moeda.nome}</td>
                  <td>${moeda.simbolo}</td>
                  <td>${moeda.preco_atual}</td>
                  <td>${moeda.capital_mercado}</td>
                  <td>${moeda.percentual_mudanca_preco}%</td>
                  <td>${moeda.rank_capital_mercado}</td>
                  <td><img src="${moeda.url_imagem}" alt="${moeda.nome}" style="max-width: 50px;"></td>
                </tr>
              `;
        });
        tabela += `
                </tbody>
              </table>
            `;
        resultados.innerHTML = tabela;
      }
    })
    .catch((error) => {
      alert("Ocorreu um erro: " + error.message);
    });
}

// Função para inserir moeda
document
  .getElementById("btnSalvarMoeda")
  .addEventListener("click", function () {
    var inserir_nome = document.getElementById("inserir_nome").value;
    var inserir_simbolo = document.getElementById("inserir_simbolo").value;
    var inserir_urlImagem = document.getElementById("inserir_url_imagem").value;
    var inserir_precoAtual = document.getElementById(
      "inserir_preco_atual"
    ).value;
    var inserir_capitalMercado = document.getElementById(
      "inserir_capital_mercado"
    ).value;
    var inserir_percentualMudancaPreco = document.getElementById(
      "inserir_percentual_mudanca_preco"
    ).value;
    var inserir_rankCapitalMercado = document.getElementById(
      "inserir_rank_capital_mercado"
    ).value;

    if (
      !inserir_nome ||
      !inserir_simbolo ||
      !inserir_urlImagem ||
      !inserir_precoAtual ||
      !inserir_capitalMercado ||
      !inserir_percentualMudancaPreco ||
      !inserir_rankCapitalMercado
    ) {
      alert("Por favor, preencha todos os campos antes de salvar.");
      return;
    }

    var params = new URLSearchParams({
      inserir_nome: inserir_nome,
      inserir_simbolo: inserir_simbolo,
      inserir_url_imagem: inserir_urlImagem,
      inserir_preco_atual: inserir_precoAtual,
      inserir_capital_mercado: inserir_capitalMercado,
      inserir_percentual_mudanca_preco: inserir_percentualMudancaPreco,
      inserir_rank_capital_mercado: inserir_rankCapitalMercado,
    });

    fetch(`php/moeda_inserir.php?${params.toString()}`)
      .then((response) => response.text())
      .then((data) => {
        alert(data);

        if (data.includes("inserida com sucesso")) {
          document.getElementById("formInserirMoeda").reset();
          var modal = bootstrap.Modal.getInstance(
            document.getElementById("modalInserirMoeda")
          );
          modal.hide();
        }
      })
      .catch((error) => {
        console.error("Erro ao inserir moeda:", error);
        alert("Ocorreu um erro ao tentar salvar a moeda.");
      });
  });

//Função para listar moeda
function moedaListar() {
  var listar_url = "php/moeda_listar.php";

  fetch(listar_url)
    .then((listar_response) => {
      if (!listar_response.ok) {
        throw new Error("Erro ao carregar os dados");
      }
      return listar_response.json();
    })
    .then((listar_data) => {
      var listar_tabela = document.getElementById("moedaTabela");
      listar_tabela.innerHTML = "";

      listar_data.forEach((listar_moeda) => {
        var listar_row = document.createElement("tr");

        listar_row.innerHTML = `
                      <td>${listar_moeda.id_moeda}</td>
                      <td>${listar_moeda.simbolo}</td>
                      <td>${listar_moeda.nome}</td>
                      <td><img src="${listar_moeda.url_imagem}" alt="${listar_moeda.nome}" style="width: 50px; height: 50px;"></td>
                      <td>${listar_moeda.preco_atual}</td>
                      <td>${listar_moeda.capital_mercado}</td>
                      <td>${listar_moeda.percentual_mudanca_preco}%</td>
                      <td>${listar_moeda.rank_capital_mercado}</td>
                  `;

        listar_tabela.appendChild(listar_row);
      });
    })
    .catch((listar_error) => {
      console.error("Erro:", listar_error);
      var listar_tabela = document.getElementById("moedaTabela");
      listar_tabela.innerHTML =
        '<tr><td colspan="8">Erro ao carregar os dados.</td></tr>';
    });
}

// Função para alterar moeda
function moedaAlterar() {
  var busca_id_moeda = document.getElementById("id_moeda").value;
  var altera_nome_moeda = document.getElementById("nome").value;
  var altera_simbolo = document.getElementById("simbolo").value;
  var altera_preco_atual = document.getElementById("preco_atual").value;
  var altera_capital_mercado = document.getElementById("capital_mercado").value;
  var altera_percentual_mudanca_preco = document.getElementById(
    "percentual_mudanca_preco"
  ).value;
  var rank_capital_mercado = document.getElementById(
    "rank_capital_mercado"
  ).value;
  var url_imagem = document.getElementById("url_imagem").value;

  if (!busca_id_moeda) {
    alert("ID da moeda é obrigatório para realizar a alteração!");
    return;
  }

  var url = `php/moeda_alterar.php?id_moeda=${encodeURIComponent(
    busca_id_moeda
  )}&nome=${encodeURIComponent(altera_nome_moeda)}&simbolo=${encodeURIComponent(
    altera_simbolo
  )}&preco_atual=${encodeURIComponent(
    altera_preco_atual
  )}&capital_mercado=${encodeURIComponent(
    altera_capital_mercado
  )}&percentual_mudanca_preco=${encodeURIComponent(
    altera_percentual_mudanca_preco
  )}&rank_capital_mercado=${encodeURIComponent(
    rank_capital_mercado
  )}&url_imagem=${encodeURIComponent(url_imagem)}`;

  fetch(url)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Erro na requisição");
      }
      return response.text();
    })
    .then((data) => {
      alert(data);

      var modal = bootstrap.Modal.getInstance(
        document.getElementById("modalAlterarMoeda")
      );
      modal.hide();

      location.reload();
    })
    .catch((error) => {
      console.error("Erro ao atualizar a moeda:", error);
      alert("Erro ao atualizar a moeda. Verifique os dados e tente novamente.");
    });
}

// Função para excluir moeda
async function moedaExcluir() {
  var excluir_id_moeda = document
    .getElementById("excluir_id_moeda")
    .value.trim();
  var excluir_nome = document.getElementById("excluir_nome").value.trim();

  if (!excluir_id_moeda || !excluir_nome) {
    alert("Por favor, preencha todos os campos.");
    return;
  }
  try {
    var response = await fetch(
      `php/moeda_excluir.php?id_moeda=${excluir_id_moeda}`,
      {
        method: "GET",
      }
    );

    if (!response.ok) {
      throw new Error(`Erro: ${response.status}`);
    }

    var excluir_resultado = await response.text();
    alert(excluir_resultado);

    var excluir_modalExcluirMoeda = document.getElementById(
      "excluir_modalExcluirMoeda"
    );
    var excluir_bootstrapModal = bootstrap.Modal.getInstance(
      excluir_modalExcluirMoeda
    );
    excluir_bootstrapModal.hide();
  } catch (error) {
    console.error("Erro ao excluir a moeda:", error);
    alert("Erro ao excluir a moeda. Tente novamente mais tarde.");
  }
}

//Função para registrar Logs
function registrarLogBanco(dataHora, numeroRegistros) {
  fetch("php/registrar_logs.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      dataHora: dataHora,
      numeroRegistros: numeroRegistros,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "sucesso") {
        alert(data.mensagem);
      } else {
        console.error(data.mensagem);
      }
    })
    .catch((error) => {
      console.error("Erro ao registrar o log:", error);
    });
}
function moedaListar() {
  buscarMoedasFamosas();
  const dataHora = new Date().toISOString();
  const numeroRegistros = dadosMoedas.length;

  registrarLogBanco(dataHora, numeroRegistros);
}

// Listar Logs
function buscarLogsNoBanco() {
  fetch("php/listar_logs.php")
    .then((response) => response.json())
    .then((logsDoBanco) => {
      logs = logsDoBanco.map((log) => ({
        data: log.datahora,
        sistema: "Sistema CoinGecko",
        acao: "Consulta ao banco",
        detalhes: `Número de registros: ${log.numeroregistros}`,
      }));
      exibirLogs();
    })
    .catch((error) => {
      console.error("Erro ao buscar logs do banco:", error);
      alert("Erro ao buscar logs. Tente novamente.");
    });
}
