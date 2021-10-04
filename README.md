# Descrição
---

Este é um site que foi proposto como teste para uma vaga, o objetivo é criar um sistema de escolas em php ultilizando o framework Laravel no backend e o bootstrap no frontend.

#### Banco de dados (mysql)
Nome
- controle_de_alunos

Tabelas
- cad_alunos (nome,email,telefone,data_nascimento,genero)
- cad_escolas (nome,endereco)
- cad_turmas (ano,nivel,serie,turno)

# Api

<p>A api segue o padrão de status de código http, esses códigos podem ser visualizados em https://developer.mozilla.org/en-US/docs/Web/HTTP/Status </p>

Abaixo está explicando as funções da api

## Alunos
---

### GET

`/api/alunos`
Trás informações sobre todos os alunos

`/api/alunos/{id}`
Trás informações sobre um aluno especifico baseado no id

`/api/alunos/nome/{nome}`
Trás informações sobre alunos baseado no nome

### POST

`/api/alunos/`
Adiciona um aluno ao banco de dados

Paramêtros
- nome (Nome do aluno) *
- email (Email do aluno) *
- data_nascimento (Data de nascimento do aluno)
- telefone (Telefone do aluno)
- genero (Gênero do aluno)


### PUT

`/api/alunos/{id}`
Altera um aluno do banco de dados

Parâmetros
- nome (Nome do aluno) *
- email (Email do aluno) *
- data_nascimento (Data de nascimento do aluno)
- telefone (Telefone do aluno)
- genero (Gênero do aluno)

### Delete

`/api/alunos/{id}`
Deleta um aluno baseado no id

## Escolas
---

### GET

`/api/escolas`
Trás informações sobre todas as escolas

`/api/escolas/{id}`
Trás informações sobre uma escola especifica baseada no id

`/api/escolas/nome/{nome}`
Trás informações sobre as escolas baseado no nome

### POST

`/api/escolas/`

Adiciona uma escola ao banco de dados

Paramêtros
- nome (Nome da escola) *
- endereco (Endereço da escola) *

### PUT

`/api/escolas/{id}`

Altera uma escola do banco de dados

Parâmetros
- nome (Nome da escola) *
- endereco (Endereço da escola) *


### Delete

`/api/escolas/{id}`

Deleta uma escola baseado no id

## Turmas
---

### GET

`/api/turmas`
Trás informações sobre todas as turmas

`/api/turmas/{id}`
Trás informações sobre uma turma especifica baseada no id


### POST

`/api/turmas/`

Adiciona uma turma ao banco de dados

Paramêtros
- ano (data da turma) *
- nivel (fundamental,medio) *
- serie (1-9) *
- turno (manha,tarde,noite) *

### PUT

`/api/turmas/{id}`

Altera uma turma do banco de dados

Paramêtros
- ano (data da turma) *
- nivel (fundamental,medio) *
- serie (1-9) *
- turno (manha,tarde,noite) *

### Delete

`/api/turmas/{id}`

Deleta uma turma baseado no id

# Site
---

### View

As views estão realizando consultas assíncronas na api para popular os dados nas tabelas do site usando a lib Jquery


### A fazer 

Index
<p>Por motivo de tempo, não foi possível criar uma index com gráficos e estatisticas sobre turmas, alunos e escolas, mas a ideia principal era usar a bilioteca de chartjs.org para popular gráficos dos dados do banco de dados</p>
 
Relações do banco
<p>Por motivo de tempo, não foi possível realizar a consulta ja com os dados de outras tabelas, pois os outros view não estavam totalmente feitos ainda.</p>

Algumas views ainda não estão maduras