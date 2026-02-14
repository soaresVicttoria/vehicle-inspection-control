# 🚗 Sistema de Controle de Revisões de Veículos

Sistema web completo para gerenciar proprietários, veículos e suas revisões periódicas, com relatórios analíticos e visualizações gráficas.

Desenvolvido como teste técnico para vaga de **Desenvolvedor Web Júnior**.

---

## 🎯 Objetivo

Criar um software de controle de revisões de veículos que permita:

- Cadastrar proprietários e seus veículos
- Registrar revisões realizadas
- Gerar relatórios analíticos com gráficos
- Interface responsiva e intuitiva

---

## 🛠️ Tecnologias Utilizadas

| Categoria          | Tecnologia   | Versão |
| ------------------ | ------------ | ------ |
| **Backend**        | PHP          | 8.4    |
|                    | Laravel      | 12     |
|                    | PostgreSQL   | 18     |
| **Frontend**       | Vue.js       | 3.3    |
|                    | Bootstrap    | 5.3    |
|                    | Chart.js     | 4.4    |
|                    | Axios        | 1.x    |
| **Infraestrutura** | Docker       | Latest |
|                    | Laravel Sail | Latest |

---

## 📊 Estrutura do Banco de Dados

### Schema: `gabriel`

```sql
gabriel/
├── proprietarios
│   ├── id (PK)
│   ├── nome_completo
│   ├── sexo (M/F)
│   ├── data_nascimento
│   └── timestamps
├── veiculos
│   ├── id (PK)
│   ├── proprietario_id (FK → proprietarios.id)
│   ├── marca
│   ├── modelo
│   ├── placa (UNIQUE)
│   └── timestamps
└── revisoes
    ├── id (PK)
    ├── veiculo_id (FK → veiculos.id)
    ├── data_revisao
    ├── duracao_minutos
    └── timestamps
```

**Relacionamentos:**

- 1 Proprietário → N Veículos (CASCADE)
- 1 Veículo → N Revisões (CASCADE)

---

## 🚀 Instalação e Configuração

### Pré-requisitos

- Docker Desktop instalado e rodando
- WSL2 configurado (Windows) ou Docker nativo (Linux/Mac)
- Composer (ou use via Docker)
- Mínimo 4GB RAM disponível

### Passo a Passo

**1. Clone ou extraia o projeto:**

```bash
cd /seu/diretorio
```

**2. Configure o ambiente:**

```bash
cp .env.example .env
```

**3. Suba os containers Docker:**

```bash
./vendor/bin/sail up -d
```

**4. Execute as migrations e seeders:**

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

**5. Acesse a aplicação:**

```
http://localhost:80
```

---

## 📡 API REST - Documentação de Endpoints

### Base URL

```
http://localhost:80/api
```

### Autenticação

Não requerida (projeto de demonstração)

### Endpoints

#### **Proprietários**

| Método | Endpoint              | Descrição                    |
| ------ | --------------------- | ---------------------------- |
| GET    | `/proprietarios`      | Lista todos os proprietários |
| POST   | `/proprietarios`      | Cria novo proprietário       |
| GET    | `/proprietarios/{id}` | Detalhes de um proprietário  |
| PUT    | `/proprietarios/{id}` | Atualiza proprietário        |
| DELETE | `/proprietarios/{id}` | Remove proprietário          |

**Exemplo de payload (POST/PUT):**

```json
{
    "nome_completo": "João da Silva",
    "sexo": "M",
    "data_nascimento": "1990-05-15"
}
```

#### **Veículos**

| Método | Endpoint         | Descrição               |
| ------ | ---------------- | ----------------------- |
| GET    | `/veiculos`      | Lista todos os veículos |
| POST   | `/veiculos`      | Cria novo veículo       |
| GET    | `/veiculos/{id}` | Detalhes de um veículo  |
| PUT    | `/veiculos/{id}` | Atualiza veículo        |
| DELETE | `/veiculos/{id}` | Remove veículo          |

**Exemplo de payload (POST/PUT):**

```json
{
    "proprietario_id": 1,
    "marca": "Toyota",
    "modelo": "Corolla",
    "placa": "ABC1234"
}
```

#### **Revisões**

| Método | Endpoint         | Descrição               |
| ------ | ---------------- | ----------------------- |
| GET    | `/revisoes`      | Lista todas as revisões |
| POST   | `/revisoes`      | Cria nova revisão       |
| GET    | `/revisoes/{id}` | Detalhes de uma revisão |
| PUT    | `/revisoes/{id}` | Atualiza revisão        |
| DELETE | `/revisoes/{id}` | Remove revisão          |

**Exemplo de payload (POST/PUT):**

```json
{
    "veiculo_id": 1,
    "data_revisao": "2024-02-14",
    "duracao_minutos": 120
}
```

#### **Relatórios**

**Veículos:**

- `GET /relatorios/veiculos/todos` - Todos os veículos
- `GET /relatorios/veiculos/por-proprietario` - Agrupados por proprietário
- `GET /relatorios/veiculos/por-sexo` - Distribuição por sexo do proprietário
- `GET /relatorios/veiculos/marcas-quantidade` - Ranking de marcas
- `GET /relatorios/veiculos/marcas-por-sexo` - Marcas separadas por sexo

**Pessoas:**

- `GET /relatorios/pessoas/todas` - Todos os proprietários com idade
- `GET /relatorios/pessoas/por-sexo` - Estatísticas por sexo e idade média

**Revisões:**

- `GET /relatorios/revisoes/por-periodo` - Revisões em período específico
- `GET /relatorios/revisoes/marcas-mais-revisoes` - Ranking de marcas
- `GET /relatorios/revisoes/proprietarios-mais-revisoes` - Ranking de proprietários
- `GET /relatorios/revisoes/tempo-medio` - Média de dias entre revisões
- `GET /relatorios/revisoes/proximas` - Previsão de próximas revisões

**Exemplo de resposta:**

```json
{
    "success": true,
    "message": null,
    "data": [
        {
            "sexo": "M",
            "total_veiculos": 6
        },
        {
            "sexo": "F",
            "total_veiculos": 4
        }
    ]
}
```

---

## 📁 Estrutura do Projeto

```
vehicle-inspection-control/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── Api/
│   │           ├── ProprietarioController.php
│   │           ├── VeiculoController.php
│   │           ├── RevisaoController.php
│   │           └── RelatorioController.php
│   ├── Models/
│   │   ├── Proprietario.php
│   │   ├── Veiculo.php
│   │   └── Revisao.php
│   └── Traits/
│       └── ApiResponse.php
├── database/
│   ├── migrations/
│   │   ├── 2026_02_13_create_proprietarios_table.php
│   │   ├── 2026_02_13_create_veiculos_table.php
│   │   └── 2026_02_13_create_revisoes_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── ProprietarioSeeder.php
│       ├── VeiculoSeeder.php
│       └── RevisaoSeeder.php
├── resources/
│   └── views/
│       └── app.blade.php (Frontend Vue.js SPA)
├── routes/
│   ├── api.php (Rotas da API REST)
│   └── web.php (Rota do frontend)
├── relatorios_sql.sql (Queries SQL documentadas)
├── docker-compose.yml
├── .env.example
└── README.md
```

---

## 🎨 Funcionalidades do Frontend

### Dashboard

- Visão geral com cards de estatísticas
- Contadores em tempo real (proprietários, veículos, revisões)
- Design moderno com gradiente

### CRUD Completo

- ✅ **Proprietários**: Criar, listar, editar, deletar
- ✅ **Veículos**: Criar, listar, editar, deletar (com seleção de proprietário)
- ✅ **Revisões**: Criar, listar, editar, deletar (com seleção de veículo)

### Relatórios Analíticos

- ✅ 12 relatórios diferentes com queries SQL otimizadas
- ✅ Visualizações gráficas interativas (Chart.js)
- ✅ Gráficos de barras e pizza
- ✅ Análises de tendências e previsões

### Interface

- Design responsivo (mobile, tablet, desktop)
- Animações suaves e transições
- Feedback visual para todas as ações
- Validações em tempo real
- Ícones intuitivos (Bootstrap Icons)

---

## 🧪 Dados de Demonstração

O projeto inclui seeders que populam automaticamente o banco com dados de exemplo:

- **6 proprietários** (3 homens, 3 mulheres) com idades variadas
- **10 veículos** de marcas diversas (Toyota, Honda, Chevrolet, etc.)
- **26 revisões** distribuídas entre 2023-2024

**Para popular o banco:**

```bash
./vendor/bin/sail artisan db:seed
```

**Para resetar e popular novamente:**

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

---

## 🔒 Segurança e Boas Práticas

### Backend

- ✅ Validações em todos os endpoints
- ✅ Form Requests do Laravel
- ✅ Proteção contra SQL Injection (Eloquent ORM + Prepared Statements)
- ✅ Foreign Keys com CASCADE para integridade referencial
- ✅ Sanitização de inputs
- ✅ Respostas padronizadas via Trait

### Frontend

- ✅ Validações client-side
- ✅ Máscaras de entrada (data, placa)
- ✅ Confirmações para ações destrutivas
- ✅ Tratamento de erros com feedback ao usuário
- ✅ CORS configurado

### Código

- ✅ PSR-12 (PHP Standards Recommendations)
- ✅ Código limpo e organizado
- ✅ Reutilização de componentes
- ✅ Separação de responsabilidades (MVC)

---

## 📊 Queries SQL dos Relatórios

Todas as queries SQL estão documentadas no arquivo:

```
relatorios_sql.sql
```

Exemplos de queries complexas implementadas:

- Window Functions (LAG, PARTITION BY)
- CTEs (Common Table Expressions)
- Agregações complexas
- Cálculos de datas e médias
- Subconsultas otimizadas

---

## 🐛 Troubleshooting

### Container não sobe

```bash
./vendor/bin/sail down
docker system prune -a
./vendor/bin/sail up -d
```

### Erro de permissão

```bash
sudo chown -R $USER:$USER .
chmod -R 755 storage bootstrap/cache
```

### Porta já em uso

Edite `.env` e mude `APP_PORT` para outra porta (ex: 8080)

### Cache travado

```bash
./vendor/bin/sail artisan config:clear
./vendor/bin/sail artisan cache:clear
./vendor/bin/sail artisan view:clear
```

---

## 🚀 Comandos Úteis

```bash
# Subir containers
./vendor/bin/sail up -d

# Parar containers
./vendor/bin/sail down

# Ver logs
./vendor/bin/sail logs

# Acessar banco de dados
./vendor/bin/sail psql -U sail

# Rodar migrations
./vendor/bin/sail artisan migrate

# Listar rotas
./vendor/bin/sail artisan route:list

# Limpar cache
./vendor/bin/sail artisan optimize:clear
```

---

## 📈 Melhorias Futuras

- [ ] Autenticação e autorização (Laravel Sanctum)
- [ ] Filtros avançados nos relatórios
- [ ] Exportação de relatórios (PDF, Excel)
- [ ] Notificações de revisões próximas
- [ ] Upload de fotos dos veículos
- [ ] Histórico de alterações (audit log)
- [ ] Testes automatizados (PHPUnit, Pest)
- [ ] CI/CD (GitHub Actions)

---

## 📝 Notas de Desenvolvimento

**Tempo de desenvolvimento:** 3 dias (conforme especificação do teste)

**Destaques técnicos:**

- Query SQL complexa para cálculo de próximas revisões usando CTEs e Window Functions
- API REST completa seguindo padrões RESTful
- Frontend SPA moderno com Vue.js 3
- Design responsivo e intuitivo
- 12 relatórios diferentes com visualizações gráficas

**Desafios superados:**

- Configuração do ambiente Docker com PostgreSQL
- Implementação de queries SQL complexas
- Integração Vue.js via CDN com Laravel Blade
- Cálculo de médias temporais entre revisões

---

## 👨‍💻 Desenvolvedor

**Nome:** Gabriel  
**Projeto:** Sistema de Controle de Revisões de Veículos  
**Contexto:** Teste Técnico - Desenvolvedor Web Júnior  
**Data:** Fevereiro 2026

---

## 📄 Licença

Este projeto foi desenvolvido exclusivamente para fins de avaliação técnica.

---

## 📞 Suporte

Em caso de dúvidas durante a avaliação:

1. Verifique a seção de Troubleshooting
2. Consulte o arquivo `relatorios_sql.sql` para queries SQL
3. Execute `./vendor/bin/sail artisan route:list` para ver todos os endpoints

---

**Obrigado pela oportunidade de demonstrar minhas habilidades! 🚀**
