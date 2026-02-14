<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Controle de Revisões</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        
        .main-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .nav-pills .nav-link {
            color: #667eea;
            font-weight: 500;
            border-radius: 10px;
            transition: all 0.3s;
        }
        
        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .nav-pills .nav-link:hover:not(.active) {
            background: #f0f0f0;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
        
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .badge {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 200px;
        }
        
        .chart-container {
            position: relative;
            height: 400px;
            margin-top: 20px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 20px;
        }
        
        .stat-card h2 {
            font-size: 3rem;
            font-weight: bold;
            margin: 0;
        }
        
        .stat-card p {
            margin: 0;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="container">
            <!-- Header -->
            <div class="main-container">
                <div class="text-center mb-4">
                    <h1 class="display-4 fw-bold">
                        <i class="bi bi-car-front-fill"></i>
                        Sistema de Controle de Revisões
                    </h1>
                    <p class="lead text-muted">Gerencie proprietários, veículos e revisões</p>
                </div>
                
                <!-- Navigation Tabs -->
                <ul class="nav nav-pills nav-fill mb-4" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" @click="currentView = 'dashboard'" :class="{active: currentView === 'dashboard'}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" @click="currentView = 'proprietarios'" :class="{active: currentView === 'proprietarios'}">
                            <i class="bi bi-people-fill"></i> Proprietários
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" @click="currentView = 'veiculos'" :class="{active: currentView === 'veiculos'}">
                            <i class="bi bi-car-front"></i> Veículos
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" @click="currentView = 'revisoes'" :class="{active: currentView === 'revisoes'}">
                            <i class="bi bi-wrench-adjustable"></i> Revisões
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" @click="currentView = 'relatorios'" :class="{active: currentView === 'relatorios'}">
                            <i class="bi bi-graph-up"></i> Relatórios
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Content Area -->
            <div class="main-container">
                <!-- DASHBOARD VIEW -->
                <div v-if="currentView === 'dashboard'">
                    <h2 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard</h2>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stat-card">
                                <h2>@{{ stats.proprietarios }}</h2>
                                <p><i class="bi bi-people-fill"></i> Proprietários</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <h2>@{{ stats.veiculos }}</h2>
                                <p><i class="bi bi-car-front"></i> Veículos</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <h2>@{{ stats.revisoes }}</h2>
                                <p><i class="bi bi-wrench-adjustable"></i> Revisões</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info mt-4">
                        <i class="bi bi-info-circle-fill"></i>
                        <strong>Bem-vindo ao sistema!</strong> Use o menu acima para navegar entre as seções.
                    </div>
                </div>

                <!-- PROPRIETÁRIOS VIEW -->
                <div v-if="currentView === 'proprietarios'">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2><i class="bi bi-people-fill"></i> Proprietários</h2>
                        <button class="btn btn-primary" @click="showProprietarioForm = true">
                            <i class="bi bi-plus-circle"></i> Novo Proprietário
                        </button>
                    </div>

                    <!-- Form Modal -->
                    <div v-if="showProprietarioForm" class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">@{{ proprietarioForm.id ? 'Editar' : 'Cadastrar' }} Proprietário</h5>
                            <form @submit.prevent="salvarProprietario">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nome Completo *</label>
                                        <input type="text" class="form-control" v-model="proprietarioForm.nome_completo" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Sexo *</label>
                                        <select class="form-select" v-model="proprietarioForm.sexo" required>
                                            <option value="">Selecione</option>
                                            <option value="M">Masculino</option>
                                            <option value="F">Feminino</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Data de Nascimento *</label>
                                        <input type="date" class="form-control" v-model="proprietarioForm.data_nascimento" required>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle"></i> Salvar
                                    </button>
                                    <button type="button" class="btn btn-secondary" @click="cancelarProprietarioForm">
                                        <i class="bi bi-x-circle"></i> Cancelar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Lista -->
                    <div v-if="loading" class="loading">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Carregando...</span>
                        </div>
                    </div>

                    <div v-else class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Sexo</th>
                                    <th>Data Nascimento</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="prop in proprietarios" :key="prop.id">
                                    <td>@{{ prop.id }}</td>
                                    <td>@{{ prop.nome_completo }}</td>
                                    <td>
                                        <span class="badge" :class="prop.sexo === 'M' ? 'bg-primary' : 'bg-danger'">
                                            @{{ prop.sexo === 'M' ? 'Masculino' : 'Feminino' }}
                                        </span>
                                    </td>
                                    <td>@{{ formatarData(prop.data_nascimento) }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning me-1" @click="editarProprietario(prop)">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" @click="deletarProprietario(prop.id)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- VEÍCULOS VIEW -->
                <div v-if="currentView === 'veiculos'">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2><i class="bi bi-car-front"></i> Veículos</h2>
                        <button class="btn btn-primary" @click="showVeiculoForm = true; carregarProprietarios()">
                            <i class="bi bi-plus-circle"></i> Novo Veículo
                        </button>
                    </div>

                    <!-- Form Modal -->
                    <div v-if="showVeiculoForm" class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">@{{ veiculoForm.id ? 'Editar' : 'Cadastrar' }} Veículo</h5>
                            <form @submit.prevent="salvarVeiculo">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Proprietário *</label>
                                        <select class="form-select" v-model="veiculoForm.proprietario_id" required>
                                            <option value="">Selecione</option>
                                            <option v-for="prop in proprietarios" :key="prop.id" :value="prop.id">
                                                @{{ prop.nome_completo }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Marca *</label>
                                        <input type="text" class="form-control" v-model="veiculoForm.marca" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Modelo *</label>
                                        <input type="text" class="form-control" v-model="veiculoForm.modelo" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Placa *</label>
                                        <input type="text" class="form-control" v-model="veiculoForm.placa" required maxlength="8" placeholder="ABC1234">
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle"></i> Salvar
                                    </button>
                                    <button type="button" class="btn btn-secondary" @click="cancelarVeiculoForm">
                                        <i class="bi bi-x-circle"></i> Cancelar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Lista -->
                    <div v-if="loading" class="loading">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>

                    <div v-else class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Placa</th>
                                    <th>Proprietário</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="veiculo in veiculos" :key="veiculo.id">
                                    <td>@{{ veiculo.id }}</td>
                                    <td>@{{ veiculo.marca }}</td>
                                    <td>@{{ veiculo.modelo }}</td>
                                    <td><span class="badge bg-secondary">@{{ veiculo.placa }}</span></td>
                                    <td>@{{ veiculo.proprietario ? veiculo.proprietario.nome_completo : 'N/A' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning me-1" @click="editarVeiculo(veiculo)">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" @click="deletarVeiculo(veiculo.id)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- REVISÕES VIEW -->
                <div v-if="currentView === 'revisoes'">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2><i class="bi bi-wrench-adjustable"></i> Revisões</h2>
                        <button class="btn btn-primary" @click="showRevisaoForm = true; carregarVeiculos()">
                            <i class="bi bi-plus-circle"></i> Nova Revisão
                        </button>
                    </div>

                    <!-- Form Modal -->
                    <div v-if="showRevisaoForm" class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">@{{ revisaoForm.id ? 'Editar' : 'Registrar' }} Revisão</h5>
                            <form @submit.prevent="salvarRevisao">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Veículo *</label>
                                        <select class="form-select" v-model="revisaoForm.veiculo_id" required>
                                            <option value="">Selecione</option>
                                            <option v-for="veiculo in veiculos" :key="veiculo.id" :value="veiculo.id">
                                                @{{ veiculo.marca }} @{{ veiculo.modelo }} - @{{ veiculo.placa }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Data da Revisão *</label>
                                        <input type="date" class="form-control" v-model="revisaoForm.data_revisao" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Duração (minutos) *</label>
                                        <input type="number" class="form-control" v-model="revisaoForm.duracao_minutos" required min="1">
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle"></i> Salvar
                                    </button>
                                    <button type="button" class="btn btn-secondary" @click="cancelarRevisaoForm">
                                        <i class="bi bi-x-circle"></i> Cancelar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Lista -->
                    <div v-if="loading" class="loading">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>

                    <div v-else class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Data</th>
                                    <th>Veículo</th>
                                    <th>Placa</th>
                                    <th>Duração</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="revisao in revisoes" :key="revisao.id">
                                    <td>@{{ revisao.id }}</td>
                                    <td>@{{ formatarData(revisao.data_revisao) }}</td>
                                    <td>@{{ revisao.veiculo ? revisao.veiculo.marca + ' ' + revisao.veiculo.modelo : 'N/A' }}</td>
                                    <td><span class="badge bg-secondary">@{{ revisao.veiculo ? revisao.veiculo.placa : 'N/A' }}</span></td>
                                    <td>@{{ revisao.duracao_minutos }} min</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning me-1" @click="editarRevisao(revisao)">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" @click="deletarRevisao(revisao.id)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- RELATÓRIOS VIEW -->
                <div v-if="currentView === 'relatorios'">
                    <h2 class="mb-4"><i class="bi bi-graph-up"></i> Relatórios</h2>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-car-front"></i> Veículos por Sexo</h5>
                                    <button class="btn btn-sm btn-primary" @click="carregarRelatorio('veiculosPorSexo')">
                                        Ver Relatório
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-graph-up"></i> Marcas por Quantidade</h5>
                                    <button class="btn btn-sm btn-primary" @click="carregarRelatorio('marcasPorQuantidade')">
                                        Ver Relatório
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-people"></i> Pessoas por Sexo</h5>
                                    <button class="btn btn-sm btn-primary" @click="carregarRelatorio('pessoasPorSexo')">
                                        Ver Relatório
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Área do gráfico -->
                    <div v-if="relatorioAtual" class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">@{{ relatorioTitulo }}</h5>
                            <div class="chart-container">
                                <canvas id="relatorioChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vue 3 CDN -->
    <script src="https://unpkg.com/vue@3.3.4/dist/vue.global.js"></script>
    
    <!-- Axios CDN -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    currentView: 'dashboard',
                    loading: false,
                    
                    stats: {
                        proprietarios: 0,
                        veiculos: 0,
                        revisoes: 0
                    },
                    
                    proprietarios: [],
                    showProprietarioForm: false,
                    proprietarioForm: {
                        id: null,
                        nome_completo: '',
                        sexo: '',
                        data_nascimento: ''
                    },
                    
                    veiculos: [],
                    showVeiculoForm: false,
                    veiculoForm: {
                        id: null,
                        proprietario_id: '',
                        marca: '',
                        modelo: '',
                        placa: ''
                    },
                    
                    revisoes: [],
                    showRevisaoForm: false,
                    revisaoForm: {
                        id: null,
                        veiculo_id: '',
                        data_revisao: '',
                        duracao_minutos: ''
                    },
                    
                    relatorioAtual: null,
                    relatorioTitulo: '',
                    chartInstance: null
                }
            },
            
            mounted() {
                this.carregarDashboard();
            },
            
            watch: {
                currentView(newView) {
                    if (newView === 'proprietarios') {
                        this.carregarProprietarios();
                    } else if (newView === 'veiculos') {
                        this.carregarVeiculos();
                    } else if (newView === 'revisoes') {
                        this.carregarRevisoes();
                    } else if (newView === 'dashboard') {
                        this.carregarDashboard();
                    }
                }
            },
            
            methods: {
                async carregarDashboard() {
                    try {
                        const [propRes, veicRes, revRes] = await Promise.all([
                            axios.get('/api/proprietarios'),
                            axios.get('/api/veiculos'),
                            axios.get('/api/revisoes')
                        ]);
                        
                        this.stats.proprietarios = propRes.data.data.length;
                        this.stats.veiculos = veicRes.data.data.length;
                        this.stats.revisoes = revRes.data.data.length;
                    } catch (error) {
                        console.error('Erro ao carregar dashboard:', error);
                    }
                },
                
                async carregarProprietarios() {
                    this.loading = true;
                    try {
                        const response = await axios.get('/api/proprietarios');
                        this.proprietarios = response.data.data;
                    } catch (error) {
                        alert('Erro ao carregar proprietários');
                        console.error(error);
                    } finally {
                        this.loading = false;
                    }
                },
                
                async salvarProprietario() {
                    try {
                        if (this.proprietarioForm.id) {
                            await axios.put(`/api/proprietarios/${this.proprietarioForm.id}`, this.proprietarioForm);
                            alert('Proprietário atualizado com sucesso!');
                        } else {
                            await axios.post('/api/proprietarios', this.proprietarioForm);
                            alert('Proprietário criado com sucesso!');
                        }
                        this.cancelarProprietarioForm();
                        this.carregarProprietarios();
                        this.carregarDashboard();
                    } catch (error) {
                        alert('Erro ao salvar proprietário');
                        console.error(error);
                    }
                },

                
                async deletarProprietario(id) {
                    if (confirm('Deseja realmente deletar este proprietário?')) {
                        try {
                            await axios.delete(`/api/proprietarios/${id}`);
                            alert('Proprietário deletado com sucesso!');
                            this.carregarProprietarios();
                        } catch (error) {
                            alert('Erro ao deletar proprietário');
                            console.error(error);
                        }
                    }
                },
                
                editarProprietario(proprietario) {
                    this.proprietarioForm = {
                        id: proprietario.id,
                        nome_completo: proprietario.nome_completo,
                        sexo: proprietario.sexo,
                        data_nascimento: proprietario.data_nascimento
                    };
                    this.showProprietarioForm = true;
                },

                cancelarProprietarioForm() {
                    this.showProprietarioForm = false;
                    this.proprietarioForm = {
                        id: null,
                        nome_completo: '',
                        sexo: '',
                        data_nascimento: ''
                    };
                },
                
                async carregarVeiculos() {
                    this.loading = true;
                    try {
                        const response = await axios.get('/api/veiculos');
                        this.veiculos = response.data.data;
                    } catch (error) {
                        alert('Erro ao carregar veículos');
                        console.error(error);
                    } finally {
                        this.loading = false;
                    }
                },
                
                async salvarVeiculo() {
                    try {
                        if (this.veiculoForm.id) {
                            await axios.put(`/api/veiculos/${this.veiculoForm.id}`, this.veiculoForm);
                            alert('Veículo atualizado com sucesso!');
                        } else {
                            await axios.post('/api/veiculos', this.veiculoForm);
                            alert('Veículo criado com sucesso!');
                        }
                        this.cancelarVeiculoForm();
                        this.carregarVeiculos();
                        this.carregarDashboard();
                    } catch (error) {
                        alert('Erro ao salvar veículo');
                        console.error(error);
                    }
                },
                
                async deletarVeiculo(id) {
                    if (confirm('Deseja realmente deletar este veículo?')) {
                        try {
                            await axios.delete(`/api/veiculos/${id}`);
                            alert('Veículo deletado com sucesso!');
                            this.carregarVeiculos();
                        } catch (error) {
                            alert('Erro ao deletar veículo');
                            console.error(error);
                        }
                    }
                },
                
                editarVeiculo(veiculo) {
                    this.veiculoForm = {
                        id: veiculo.id,
                        proprietario_id: veiculo.proprietario_id,
                        marca: veiculo.marca,
                        modelo: veiculo.modelo,
                        placa: veiculo.placa
                    };
                    this.showVeiculoForm = true;
                    this.carregarProprietarios();
                },

                cancelarVeiculoForm() {
                    this.showVeiculoForm = false;
                    this.veiculoForm = {
                        id: null,
                        proprietario_id: '',
                        marca: '',
                        modelo: '',
                        placa: ''
                    };
                },
                
                async carregarRevisoes() {
                    this.loading = true;
                    try {
                        const response = await axios.get('/api/revisoes');
                        this.revisoes = response.data.data;
                    } catch (error) {
                        alert('Erro ao carregar revisões');
                        console.error(error);
                    } finally {
                        this.loading = false;
                    }
                },
                
                async salvarRevisao() {
                    try {
                        if (this.revisaoForm.id) {
                            await axios.put(`/api/revisoes/${this.revisaoForm.id}`, this.revisaoForm);
                            alert('Revisão atualizada com sucesso!');
                        } else {
                            await axios.post('/api/revisoes', this.revisaoForm);
                            alert('Revisão criada com sucesso!');
                        }
                        this.cancelarRevisaoForm();
                        this.carregarRevisoes();
                        this.carregarDashboard();
                    } catch (error) {
                        alert('Erro ao salvar revisão');
                        console.error(error);
                    }
                },
                
                async deletarRevisao(id) {
                    if (confirm('Deseja realmente deletar esta revisão?')) {
                        try {
                            await axios.delete(`/api/revisoes/${id}`);
                            alert('Revisão deletada com sucesso!');
                            this.carregarRevisoes();
                        } catch (error) {
                            alert('Erro ao deletar revisão');
                            console.error(error);
                        }
                    }
                },
                
                editarRevisao(revisao) {
                    this.revisaoForm = {
                        id: revisao.id,
                        veiculo_id: revisao.veiculo_id,
                        data_revisao: revisao.data_revisao,
                        duracao_minutos: revisao.duracao_minutos
                    };
                    this.showRevisaoForm = true;
                    this.carregarVeiculos();
                },

                cancelarRevisaoForm() {
                    this.showRevisaoForm = false;
                    this.revisaoForm = {
                        id: null,
                        veiculo_id: '',
                        data_revisao: '',
                        duracao_minutos: ''
                    };
                },
                
                async carregarRelatorio(tipo) {
                    try {
                        let endpoint = '';
                        let titulo = '';
                        
                        if (tipo === 'veiculosPorSexo') {
                            endpoint = '/api/relatorios/veiculos/por-sexo';
                            titulo = 'Veículos por Sexo';
                        } else if (tipo === 'marcasPorQuantidade') {
                            endpoint = '/api/relatorios/veiculos/marcas-quantidade';
                            titulo = 'Marcas por Quantidade de Veículos';
                        } else if (tipo === 'pessoasPorSexo') {
                            endpoint = '/api/relatorios/pessoas/por-sexo';
                            titulo = 'Pessoas por Sexo';
                        }
                        
                        const response = await axios.get(endpoint);
                        this.relatorioAtual = response.data.data;
                        this.relatorioTitulo = titulo;
                        
                        this.$nextTick(() => {
                            this.renderizarGrafico(tipo);
                        });
                    } catch (error) {
                        alert('Erro ao carregar relatório');
                        console.error(error);
                    }
                },
                
                renderizarGrafico(tipo) {
                    const ctx = document.getElementById('relatorioChart');
                    
                    if (this.chartInstance) {
                        this.chartInstance.destroy();
                    }
                    
                    let labels = [];
                    let data = [];
                    let backgroundColor = [];
                    
                    if (tipo === 'veiculosPorSexo') {
                        labels = this.relatorioAtual.map(item => item.categoria);
                        data = this.relatorioAtual.map(item => item.total_veiculos);
                        backgroundColor = ['#667eea', '#764ba2'];
                    } else if (tipo === 'marcasPorQuantidade') {
                        labels = this.relatorioAtual.map(item => item.marca);
                        data = this.relatorioAtual.map(item => item.total_veiculos);
                        backgroundColor = this.relatorioAtual.map((_, i) => 
                            `hsl(${(i * 360) / this.relatorioAtual.length}, 70%, 60%)`
                        );
                    } else if (tipo === 'pessoasPorSexo') {
                        labels = this.relatorioAtual.map(item => item.categoria);
                        data = this.relatorioAtual.map(item => item.total_pessoas);
                        backgroundColor = ['#667eea', '#764ba2'];
                    }
                    
                    this.chartInstance = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Quantidade',
                                data: data,
                                backgroundColor: backgroundColor,
                                borderWidth: 0,
                                borderRadius: 10
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                },
                
                formatarData(data) {
                    if (!data) return '';
                    const partes = data.split('-');
                    return `${partes[2]}/${partes[1]}/${partes[0]}`;
                }
            }
        }).mount('#app');
    </script>
</body>
</html>