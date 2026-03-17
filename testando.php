<?php
include_once('connection.php');
session_start();


$sqlcategoria = 'SELECT * From categoria';
$resultcategoria = mysqli_query($conexao, $sqlcategoria);


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoStay - Lista de Cursos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="dash.css">
    <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Fraunces:wght@600;700&display=swap" rel="stylesheet">

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
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='38' height='38' viewBox='0 0 38 38'%3E%3Crect width='38' height='38' fill='%23fbbf24'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' font-size='16' fill='%231e3a8a' font-weight='600'%3EAD%3C/text%3E%3C/svg%3E" alt="Admin" class="user-avatar">
                <span class="user-name"><?php echo($_SESSION['nameadm']); ?></span>
                <svg class="dropdown-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </button>
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="#" class="dropdown-item">
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
                    <a href="dashadm.php" class="nav-link">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        <span class="nav-text">Dashboard Principal</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="testando.php" class="nav-link active">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                        </svg>
                        <span class="nav-text">Categorias</span>
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
                    <a href="profadm.php" class="nav-link">
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
            <h2 class="page-title">Lista de Categorias</h2>
            <p class="page-subtitle">Visualize e gerencie todas as Categorias cadastradas na plataforma</p>
        </div>

        <!-- Courses Table -->
        <div class="table-container">
            <div class="table-header">
                <h3 class="table-title">Todos as Categorias</h3>
                <div class="table-controls">
                    <div class="search-box">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                        <input type="text" placeholder="Buscar categorias...">
                    </div>
                    <form action="admre.php" method="post">
                      <button class="btn btn-primary" name="categoria" id="categoria" value="categoria">
                          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                              <line x1="12" y1="5" x2="12" y2="19"></line>
                              <line x1="5" y1="12" x2="19" y2="12"></line>
                          </svg>
                          Nova Categoria
                      </button>
                    </form>
                </div>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th>Categoria</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <ul class="course-list">
                                <?php
                                $numrows = mysqli_num_rows($resultcategoria);
                                 while ($row = mysqli_fetch_assoc($resultcategoria)): ?>
                                    <li class="course-item">
                                        <span class="course-name-cell">
                                            <?= htmlspecialchars($row['nome']) ?>
                                        </span>

                                        <div class="course-name-cell">
                                            <a class="course-icon"href="editarcategoria.php?id=<?= $row['id'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                            </svg></a>
                                            <a class="course-icon" href="delete/deletecategoria.php?id=<? $row['id'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                              <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                            </svg></a>
                                        </div>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </td>
                    </tr>
                </tbody>

            </table>

            <!-- Pagination -->
            <div class="pagination">
                <div class="pagination-info">
                    Mostrando <?php echo($numrows); ?> 
                </div>

            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>GoStay © 2026 - Sistema de Gestão Educacional - v2.1.4</p>
        <p>Developted By Lucas</p>
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

        // Filter buttons
        const filterButtons = document.querySelectorAll('.filter-btn');
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
            });
        });
    </script>
</body>
</html>