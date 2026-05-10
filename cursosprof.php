<?php
    require_once("connection.php");
    session_start();
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self'");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: DENY");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    header("Permissions-Policy: geolocation=(), camera=(), microphone=()");


    $idprof = $_SESSION['idprof'];
    $stmt = $conexao->prepare("SELECT * FROM curso WHERE idprofessor = ?");
    $stmt2 = $conexao->prepare("SELECT * FROM curso WHERE idprofessor = ?");
    $stmt->bind_param("i", $idprof);
    $stmt2->bind_param("i", $idprof);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $qtdcurso= $result->num_rows;

    $stmt2->execute();
    $result2= $stmt2-> get_result();
    $qtdalunos = [];
    $idaluno = [];
    $statusa = [];
    $nomecurso = [];
    $idcursoss = [];
    $statuscurso = [];
    $datascurso = [];
    for($i = 0; $i< $qtdcurso; $i++){
        
        $row=$result2->fetch_assoc();   
        $idcursoss[] = $row['id'];
        $statuscurso[] = $row['statuscurso'];
        $datascurso[] = $row['datacadastro'];
        $nomecurso[] = $row['nome'];
        $stmt3 =$conexao->prepare("SELECT * FROM cursoaluno WHERE idcurso = ?");
        $stmt3->bind_param("i", $idcursoss[$i]);
        $stmt3->execute();
        $result3 = $stmt3->get_result();
        $qtdalunos[] = $result3->num_rows;
    }
    $totalalunos = array_sum($qtdalunos);
    




    $nomeCompleto = $_SESSION['nameprof'];
    $partesNome = explode(' ', trim($nomeCompleto));
    $nomePrincipal = $partesNome[0] . ' ' . ($partesNome[1] ?? '');

    $letras = strtoupper(
        substr($partesNome[0], 0, 1) .
        (isset($partesNome[1]) ? substr($partesNome[1], 0, 1) : '')
    );


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
            
                <a href="" class="dropdown-item">
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

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <aside class="sidebar" id="sidebar">
        <button class="sidebar-toggle" id="sidebarToggle">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>
        <nav>
            <ul class="nav-menu">
    
                <li class="nav-item">
                    <a href="homeprof.php" class="nav-link">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                        </svg>
                        <span class="nav-text">Dashboard Principal</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="cursosprof.php" class="nav-link active">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span class="nav-text">Cursos</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="aulasprof.php" class="nav-link">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="15" height="10" rx="2" ry="2"></rect>
                        <polygon points="17 10 22 7 22 17 17 14"></polygon>
                    </svg>
                        <span class="nav-text">Aulas</span>
                    </a>
                </li>
                
            </ul>
        </nav>
    </aside>

    <main class="main-content">
     
        <div class="page-header">
            <h2 class="page-title">Dashboard Cursos</h2>
            <p class="page-subtitle">Gerencie todos os seus cursos da plataforma</p>
        </div>

        <div class="kpi-grid">
            <div class="kpi-card">
                <div class="kpi-header">
                    <div>
                        <div class="kpi-value"><?php echo($qtdcurso); ?></div>
                        <div class="kpi-label">Total de Cursos</div>
                        <span class="kpi-trend positive">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg>
                        </span>
                    </div>
                    <div class="kpi-icon primary">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="kpi-card">
                <div class="kpi-header">
                    <div>
                        <div class="kpi-value"><?php echo($totalalunos); ?></div>
                        <div class="kpi-label">N째 de alunos</div>
                        <span class="kpi-trend positive">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg>
                            
                        </span>
                    </div>
                    <div class="kpi-icon success">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

  
        <div class="table-container">
            <div class="table-header">
                <h3 class="table-title">Os seus Cursos</h3>
                <div class="search-box">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text" placeholder="Buscar...">
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nome do curso</th>
                        <th>Status</th>
                        <th>Data Cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        
                       $qtdcursos = count($nomecurso);
                        for($l = 0;$l < $qtdcursos; $l++):

                                if($statuscurso[$l] === 'ativo'){
                                    $badgeclass = 'badge-active';
                                }
                                else{
                                    $badgeclass = 'badge-pending';
                                }
                        ?>
                        <tr>
                            
                            
                            <td><strong><?php echo($nomecurso[$l]);?></strong></td>
                            <td><span class="badge <?php echo($badgeclass); ?>"><?php echo($statuscurso[$l]);?></span></td>
                            <td><strong><?php echo($datascurso[$l]); ?></strong></td>
                        </tr>
                    <?php 
                    endfor; ?>
                    
                </tbody>
            </table>
        </div>
    </main>

    <footer class="footer">
        <p>GoStay @ 2026 - Sistema de Gest찾o Educacional - v2.1.4</p>
    </footer>

    <script>

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

        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });

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