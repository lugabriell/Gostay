<?php
require_once __DIR__ . "/connection.php";
session_start();
if(!isset($_SESSION['emailadm']) && !isset($_SESSION['nameadm'])){
    header('Location: nonvalidated.php');
}
else{
    $email = $_SESSION['emailadm'];
    $nome = $_SESSION['nameadm'];
    $sql = "SELECT autenticado FROM adms WHERE email = '$email' AND nome = '$nome' ";
    $result = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_assoc($result);
    $sqlcategoria = 'SELECT * from categoria';
    $resultcategoria =mysqli_query($conexao, $sqlcategoria);

    $qtdcategoria = mysqli_num_rows($resultcategoria);
    if(empty($dados)){
        header('Location: nonvalidated.php');
    }
    else{
        if($dados['autenticado'] == 'nao'){
            header('Location: nonvalidated.php');
        }
    }



}
$idinfo = $_GET['id'];
$sqlcursos2 = "SELECT * from curso WHERE idprofessor = '$idinfo'";
$resultcurso2 =mysqli_query($conexao, $sqlcursos2);
$qtdcurso = mysqli_num_rows($resultcurso2);
$sql2 = "SELECT nome FROM adms WHERE email = '$email' AND nome = '$nome' ";
$result2 = mysqli_query($conexao, $sql2);
$dados2 = mysqli_fetch_assoc($result2);
$nomeCompleto = $dados2['nome'];

$sqlalunoaula = "SELECT * FROM aula WHERE idprofessor = '$idinfo'";
$resultalunoaula = mysqli_query($conexao, $sqlalunoaula);
$resultalunoaula2 = mysqli_query($conexao, $sqlalunoaula);
$sqlcursoaluno = "SELECT * FROM curso WHERE idprofessor = '$idinfo'";




$partesNome = explode(' ', trim($nomeCompleto));
$nomePrincipal = $partesNome[0] . ' ' . ($partesNome[1] ?? '');

$letras = strtoupper(
    substr($partesNome[0], 0, 1) .
    (isset($partesNome[1]) ? substr($partesNome[1], 0, 1) : '')
);

$sqlinfo = "SELECT * FROM professor WHERE id = '$idinfo'";
$resultinfo = mysqli_query($conexao, $sqlinfo);
$dadosinfo = mysqli_fetch_assoc($resultinfo);



?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoStay - Dashboard de Cursos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Fraunces:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <button class="menu-toggle" id="menuToggle">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
            <div class="logo">G</div>
            <h1 class="brand-name">GoStay</h1>
        </div>
        <div class="user-profile">
            <button class="user-button" id="userButton">
                <div class="user-avatar"><?php echo($letras); ?></div>

                <span class="user-name"><?php echo($nomePrincipal); ?></span>
                <svg class="dropdown-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </button>
            <div class="dropdown-menu" id="dropdownMenu">
            
                <a href="sairadm.php" class="dropdown-item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Sair
                </a>
            </div>
        </div>
    </header>

    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <button class="sidebar-toggle" id="sidebarToggle">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>
        <nav>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="testando.php" class="nav-link">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        <span class="nav-text">Categorias</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="dashadm.php" class="nav-link ">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                        </svg>
                        <span class="nav-text">Dashboard Principal</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="alunosadm.php" class="nav-link">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span class="nav-text">Alunos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="profadm.php" class="nav-link active">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                        </svg>
                        <span class="nav-text">Professores</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="videosadm.php" class="nav-link">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="15" height="10" rx="2" ry="2"></rect>
                        <polygon points="17 10 22 7 22 17 17 14"></polygon>
                    </svg>
                        <span class="nav-text">Videos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="aulasadm.php" class="nav-link">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="15" height="10" rx="2" ry="2"></rect>
                        <polygon points="17 10 22 7 22 17 17 14"></polygon>
                    </svg>
                        <span class="nav-text">Aulas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M12 1v6m0 6v6m5.196-15.196l-4.242 4.242m0 5.656l-4.242 4.242M23 12h-6m-6 0H1m18.196-5.196l-4.242 4.242m0 5.656l4.242 4.242"></path>
                        </svg>
                        <span class="nav-text">Configurações</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Page Header -->
        <div class="page-header">
    <h2 class="page-title">Perfil</h2>
    <p class="page-subtitle">Informações pessoais do usuário</p>
</div>

<!-- Card Perfil -->
<div class="kpi-grid">
    <div class="kpi-card" style="width: 100%;">
        <div class="kpi-header" style="align-items: center; gap: 20px;">

  
            <div>
                <img src="creates/<?php echo($dadosinfo['ftperfil']); ?>" 
                     alt="Avatar" 
                     style="width:200px; height:200px; border-radius:50%; object-fit:cover;">
            </div>


            <div>
                <div class="kpi-value">
                    <?php echo($dadosinfo['nome']); ?>
                </div>

                <div class="kpi-label" style="margin-top:8px;">
                    <strong>Formação:</strong> <?php echo($dadosinfo['formacao']); ?>
                </div>

                <div class="kpi-label" style="margin-top:4px;">
                    <strong>Email:</strong> <?php echo($dadosinfo['email']); ?>
                </div>
                <div class="kpi-label" style="margin-top:4px;">
                    <strong>Data Cadastro:</strong> <?php echo($dadosinfo['datacadastro']); ?>
                </div>
                <div class="kpi-label" style="margin-top:4px;">
                    <strong>Autenticado:</strong> <?php echo($dadosinfo['autenticado']); ?>
                </div>
                
            </div>

            <!-- Ícone lateral opcional -->
            <div class="kpi-icon primary">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" 
                     stroke="currentColor" stroke-width="2" 
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>

        </div>
    </div>
</div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <form action="admre6.php" method="post">
            
                <button type="submit" name="curso" value="<?php echo($idinfo); ?>" class="btn btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Novo Curso
                </button>
                <button type="submit" name="aula" value="<?php echo($idinfo); ?>" class="btn btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#4169E1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Nova Aula   
                </button>
        
                <button type="submit" name="professor" value="<?php echo($idinfo); ?>" class="btn btn-secondary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    Gerenciar Professor
                </button>
            </form>
        </div>



            <div class="content-card">
                <div class="content-card-header">
                    <h3 class="content-card-title">Aulas deste Professor</h3>
                    <a href="aulasadm.php" class="view-all-link">Ver todos →</a>
                </div>

                <?php 
                while($dadosalunoaula = mysqli_fetch_assoc($resultalunoaula2)):
                    $idaula = $dadosalunoaula['id'];
                    $sqlaula = "SELECT * from aula WHERE id = '$idaula'";
                    $resultaula = mysqli_query($conexao, $sqlaula);
                    while(($dadosaula = mysqli_fetch_assoc($resultaula)) ):
                ?>
                
                    <div class="course-list-item">
                        <div class="course-icon">📚</div>
                        <div class="course-info">
                            <div class="course-name">
                                <?php echo $dadosaula['nome']; ?>
   
                            
                            </div>
                            <div class="course-meta">
                                <?php echo $dadosaula['duracao']; ?>
                                
                            </div>
                            <td> 
                                <a href='editaraula.php?id=<?= $dadosaula['id'] ?>' class="action-btn" title="Editar">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </a>
                                <a href='delete/deleteaula.php?id=<?= $dadosaula['id'] ?>' class="action-btn" title="Excluir">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                </a>
                            </td>

                        </div>
                        </div>


                    
            
            <?php 
                endwhile;
            endwhile;
            ?>
            </div>
            </div>
        </div>
<br>
        <!-- Courses Table -->
        <div class="table-container">
            <div class="table-header">
                <h3 class="table-title">Cursos deste Professor</h3>
                <div class="search-box">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text" placeholder="Buscar cursos...">
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nome do Curso</th>
                        <th>Categoria</th>
                        <th>Status</th>
                        <th>Alunos</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $resultcursoaluno = mysqli_query($conexao, $sqlcursoaluno);
                    while($dadoscursoaluno = mysqli_fetch_assoc($resultcursoaluno)):
                        $idcurso = $dadoscursoaluno['id'];
                        $sqlcursos = "SELECT * from curso WHERE id = '$idcurso'";
                        $resultcurso =mysqli_query($conexao, $sqlcursos);
    
                        while($dadoscursos = mysqli_fetch_assoc($resultcurso)):
                            
                            $idcategoria2 = $dadoscursos['idcategoria'];
                            $sqlcategoriaid = "SELECT * from categoria where id = '$idcategoria2'";
                            $resultcategoria2 = mysqli_query($conexao, $sqlcategoriaid);
                            $dadoscategoria2 = mysqli_fetch_assoc($resultcategoria2);
                             if($dadoscursoaluno['statuscurso'] === 'ativo'){
                                $badgeclass = 'badge-active';
                             }
                             else{
                                $badgeclass = 'badge-pending';
                             }
                    ?>
                    <tr>
                        
                        <!-- //$dadoscursos = mysqli_fetch_assoc($resultcurso); -->
                        <td><strong><?php echo($dadoscursos['nome']);?></strong></td>
                        <td><?php echo($dadoscategoria2['nome']);  ?></td>
                        <td><span class="badge <?php echo($badgeclass); ?>"><?php echo($dadoscursoaluno['statuscurso']);?></span></td>
                        <td><?php echo($dadoscursos['qtdal']);?></td>
                        <td>
                            <div class="table-actions">
                                <a href='curso.php?id=<?= $dadoscursos['id'] ?>' class="action-btn" title="Editar">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </a>
                                <a href='delete/deletecurso.php?id=<?= $dadoscursos['id'] ?>' class="action-btn" title="Excluir">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                   <?php 
                    endwhile;
                        endwhile ?>
                    
                </tbody>
            </table>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>GoStay © 2026 - Sistema de Gestão Educacional - v2.1.4</p>
    </footer>

    <script>
        // User dropdown toggle
        const userButton = document.getElementById('userButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        userButton.addEventListener('click', (e) => {
            e.stopPropagation();
            userButton.classList.toggle('active');
            dropdownMenu.classList.toggle('active');
        });

        document.addEventListener('click', () => {
            userButton.classList.remove('active');
            dropdownMenu.classList.remove('active');
        });

        // Sidebar toggle (desktop)
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });

        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('mobile-open');
            sidebarOverlay.classList.toggle('active');
        });

        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.remove('mobile-open');
            sidebarOverlay.classList.remove('active');
        });

        // Close mobile menu when clicking a nav item
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('mobile-open');
                    sidebarOverlay.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>