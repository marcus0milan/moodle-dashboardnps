# Dashboard NPS para o Feedback do Moodle

Um plugin local do Moodle que gera relatórios de NPS a partir das respostas coletadas pela atividade nativa **Feedback** (`mod_feedback`).

## Requisitos

- Moodle 4.4.x ou 4.5.x;
- Versão do PHP compatível;
- Atividade nativa Feedback habilitada.

## Instalação

1. Coloque o plugin no seguinte diretório:

   ```text
   local/feedbackdashboard
   ```

2. Se instalar por meio de um arquivo ZIP, certifique-se de que o arquivo contenha a pasta `feedbackdashboard/` na raiz.
3. Acesse **Administração do site → Notificações** e conclua a instalação.

## Acesso

O dashboard pode ser acessado de duas formas:

**Dentro da atividade Feedback**

Usuários com a permissão necessária podem acessar o dashboard pelo botão **Abrir Dashboard NPS**, localizado na área de ações do cabeçalho da atividade.

O botão está disponível em todas as páginas da atividade Feedback, incluindo Feedback, Configurações, Modelos, Análise e Respostas.

**Dashboard geral do site**

Administradores e gerentes podem acessar o dashboard central por meio do caminho:

```text
Administração do site → Relatórios → Dashboard NPS
```

Ele apresenta uma visão geral de todas as atividades Feedback, incluindo quantidade de respostas, pontuações NPS, promotores, passivos, detratores e links para relatórios detalhados.

## Permissões

O plugin define duas permissões:

- `local/feedbackdashboard:view`: permite acessar os relatórios de atividades Feedback individuais;
- `local/feedbackdashboard:viewall`: permite acessar o dashboard geral do site.

Por padrão, ambas as permissões são concedidas ao arquétipo de função **Gerente**. Administradores possuem acesso completo.

Para permitir que professores com permissão de edição visualizem os relatórios, conceda a capacidade apropriada nas configurações de permissões da função.

## Cálculo do NPS

O plugin identifica automaticamente a primeira questão de escolha única que contém a escala completa de **0 a 10**.

As respostas são classificadas da seguinte forma:

- **9–10:** Promotores
- **7–8:** Passivos
- **0–6:** Detratores

A pontuação NPS é calculada com base na porcentagem de promotores menos a porcentagem de detratores.

## Privacidade

O plugin não cria tabelas adicionais no banco de dados nem armazena dados pessoais.

Ele consulta as respostas já armazenadas no Feedback do Moodle e apresenta os resultados apenas aos usuários que
