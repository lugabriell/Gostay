<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self'");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: DENY");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    header("Permissions-Policy: geolocation=(), camera=(), microphone=()");
  session_start();
  include_once("connection.php");
  $idaluno = $_SESSION['id'];
  if(!isset($_SESSION['email'])|| !isset($_SESSION['nome'])){
    header("Location:login.php");
  }
  $idcurso = $_GET['trackid'];

  $sqlcurso = "SELECT * FROM curso WHERE id = '$idcurso'";
  $resultcurso = mysqli_query($conexao,$sqlcurso);
  $dadoscurso = mysqli_fetch_assoc($resultcurso);
  $tipo = $dadoscurso['tipo'];
  $sqlalunocurso = "SELECT * FROM cursoaluno WHERE idcurso = '$idcurso'";
  $resultcursoaluno = mysqli_query($conexao, $sqlalunocurso);
  $numrowsaluno = mysqli_num_rows($resultcursoaluno);


  if($tipo == "gratis" || $numrowsaluno > 0){
    $sqlnovidades = "SELECT * FROM curso WHERE tipo ='gratis' ORDER BY datacadastro DESC";
    $resultnovidades = mysqli_query($conexao, $sqlnovidades);

    $sqlinfo = "SELECT * FROM curso WHERE id = '$idcurso'";
    $resultinfo = mysqli_query($conexao, $sqlinfo);
    $dadosinfo = mysqli_fetch_assoc($resultinfo);


    $idcategoria = $dadosinfo['idcategoria'];
    $sqlcategoria = "SELECT * FROM categoria WHERE id = '$idcategoria'";
    $resultcategoria = mysqli_query($conexao, $sqlcategoria);
    $dadoscategoria = mysqli_fetch_assoc($resultcategoria);


    $idprofessor= $dadosinfo['idprofessor'];
    $sqlprofessor= "SELECT * FROM professor WHERE id = '$idprofessor'";
    $resultprofessor= mysqli_query($conexao, $sqlprofessor);
    $dadosprofessor= mysqli_fetch_assoc($resultprofessor);


    $sqlaula = "
    SELECT aula.*
    FROM alunoaula
    JOIN aula ON aula.id = alunoaula.idaula
    WHERE alunoaula.idaluno = '$idaluno'
    AND alunoaula.statusal = 'ativo'
    ORDER BY aula.ordem ASC
    ";

    $resultaula = mysqli_query($conexao, $sqlaula);
    $numrows = mysqli_num_rows($resultaula);
    $resultaula2 = mysqli_query($conexao, $sqlaula);
    $dadosaula2 = mysqli_fetch_assoc($resultaula2);

    

  }
  else{
    header("Location: homepage.php");
  }

  




?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>GoStay</title>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Lora:ital,wght@0,400;1,400&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="styleinfos.css">
    <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">
  <style>
        .banner-bg {
      position: absolute; inset: 0;
      background: url('<?php echo("creates/". $dadosinfo['posterft']); ?>') center/cover no-repeat;
      transform: scale(1.04);
      animation: banner-zoom 20s ease-in-out infinite alternate;
    }
  </style>
</head>
<body>

  <input type="checkbox" id="mobile-nav-toggle" style="display:none"/>


  <nav class="navbar">
    <a href="homepage.php" class="nav-logo">
      Go<span style="color:var(--accent)">Stay</span>
      <span class="logo-dot"></span>
    </a>
    <ul class="nav-links">
      <li><a href="homepage.php">Início</a></li>
      <li><a href="homepage.php#cursos">Cursos</a></li>
      <li><a href="homepage.php#cursos">Meus Cursos</a></li>
    </ul>
    <div class="nav-right">

    </div>
  </nav> 


  <div class="mobile-nav">
    <label for="mobile-nav-toggle" class="mobile-nav-close-label"></label>
    <div class="mobile-nav-panel">
      <a href="homepage.php">Início</a>
      <a href="homepage.php#cursos">Cursos</a>
      <a href="homepage.php#cursos">Meus Cursos</a>
    </div>
  </div>

  <!-- BANNER -->
  <section class="banner">
    <div class="banner-bg"></div>
    <div class="banner-overlay"></div>
    <div class="banner-overlay-bottom"></div>
    <div class="banner-content">
      <div class="banner-breadcrumb">
        <a href="homepage.php">Início</a>
        <span>›</span>
        <a href="homepage.php#cursos">Cursos</a>
        <span>›</span>
        <span style="color:rgba(255,255,255,.7)"><?php echo($dadosinfo['nome']); ?></span>
      </div>
      <div class="banner-category"><?php echo($dadoscategoria['nome']); ?></div>
      <h1 class="banner-title"><?php echo($dadosinfo['nome']); ?></h1>
      <div class="banner-meta">
        <span class="banner-tag">
          <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
          <?php echo($dadosinfo['cargahoraria']); ?>H
        </span>-
        <span class="banner-tag"> 
        <?php echo($dadosinfo['descricao']); ?>
        </span>
      </div>
      <?php if($numrows < 1){ ?>
      <div class="banner-actions">
        <a href="creates/autocreate.php?trackid=<?php echo($dadosinfo['id']); ?>" class="btn btn-ghost">
          <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
          Adicionar aos meus Cursos
        </a >
        <?php }else{ ?>
        <div class="banner-actions">
          <a href="player.php?trackid=<?php echo($idaula); ?>" class="btn btn-primary">
          <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
          Assistir a aula 
        </a >
        <a href="media.php?trackid=<?php echo($idaula); ?>" class="btn btn-ghost">
          <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
          Baixar Conteúdo
        </a >
        <?php } ?>
      </div>
    </div>
  </section>

  <!-- MAIN -->
  <main class="main">

    <!-- INFO SECTION -->
    <div class="info-section">

      <!-- LEFT -->
      <div class="info-main">

        <!-- Description card -->
        <div class="info-desc-card">
          <div class="section-label">Sobre o curso</div>
          <h2 class="info-title"><?php echo($dadosinfo['nome']); ?></h2>
          <div class="info-description">
            <p>
              <?php echo($dadosinfo['descricao']); ?>    
          </p>
          </div>
        </div>

        <!-- Lessons section -->
        <div class="lessons-section">
          <div class="lessons-header">
            <div class="section-label" style="margin-bottom:0">Aulas do curso</div>
            <span class="lessons-count"><?php $numrowsaula = mysqli_num_rows($resultaula); echo($numrowsaula); ?> aulas · <?php echo($dadosinfo['cargahoraria']); ?>h </span>
          </div>
          <?php 
          $i = 1;
          while($dadosaula = mysqli_fetch_assoc($resultaula)): ?>
          <!-- Lessons list -->
          <a class="lesson-item" href="player.php?trackid=<?php echo($dadosaula['id']); ?>">
            <div class="lesson-number"><?php echo($i); ?></div>
            <div class="lesson-info">
              <div class="lesson-name"><?php echo($dadosaula['nome']); ?></div>
              <div class="lesson-subtitle"><?php echo($dadosaula['descricao']); ?></div>
            </div>
            <div class="lesson-duration">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
              <?php echo($dadosaula['duracao']); ?>M
            </div>
            <a href="player.php?trackid=<?php echo($dadosaula['id']); ?>" class="lesson-play-btn" aria-label="Assistir">
              <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            </a>
          </a>
          <div class="lesson-divider"></div>
          <?php 
          $i++;
          endwhile; ?>
          
        </div>

      </div><!-- /info-main -->

      <!-- SIDEBAR -->
      <aside class="info-sidebar">
        <div class="stats-card">
          

          <div class="stat-row">
            <div class="stat-icon">
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
            <div class="stat-info">
              <div class="stat-label">Professor</div>
              <div class="stat-value"><?php echo($dadosprofessor['nome']); ?></div>
            </div>
          </div>

          <div class="stat-row">
            <div class="stat-icon">
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            </div>
            <div class="stat-info">
              <div class="stat-label">Carga horária</div>
              <div class="stat-value"><?php echo($dadosinfo['cargahoraria']); ?>H</div>
            </div>
          </div>

          <div class="stat-row">
            <div class="stat-icon">
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 10l4.553-2.069A1 1 0 0121 8.82V15.18a1 1 0 01-1.447.89L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/></svg>
            </div>
            <div class="stat-info">
              <div class="stat-label">Quantidade de aulas</div>
              <div class="stat-value"><?php  echo($numrowsaula); ?></div>
            </div>
          </div>

          <div class="stat-row">
            <div class="stat-icon">
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2 20h20M6 20V10M10 20V4M14 20v-8M18 20v-6"/></svg>
            </div>
            <div class="stat-info">
              <div class="stat-label">Nível</div>
              <div class="stat-value"><?php echo($dadosinfo['nivel']); ?></div>
            </div>
          </div>

          <div class="stat-row">
            <div class="stat-icon">
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <div class="stat-info">
              <div class="stat-label">Certificado</div>
              <div class="stat-value">Incluso na conclusão</div>
            </div>
          </div>

          <div class="stat-row">
            <div class="stat-icon">
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10z"/></svg>
            </div>
            <div class="stat-info">
              <div class="stat-label">Idioma</div>
              <div class="stat-value">Português (BR)</div>
            </div>
          </div>
        </div>
      </aside>

    </div><!-- /info-section -->

    <!-- RELATED SECTION -->
    <section class="related-section">
      <div class="related-header">
        <h2 class="related-title">Você também pode gostar</h2>
      </div>
      <div class="related-carousel-wrapper" id="rel-carousel">
        <button class="rel-btn prev" onclick="scrollRel(-1)">
          <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <div class="related-track-outer" id="rel-track-outer">
          <div class="related-track">
            <?php while($dadosnovidades = mysqli_fetch_assoc($resultnovidades)): 
                      $idcategoria2 = $dadosnovidades['idcategoria'];
                      $sqlcategoria2 = "SELECT nome FROM categoria WHERE id ='$idcategoria2'";
                      $resultcategoria2 = mysqli_query($conexao, $sqlcategoria2);
                      $dadoscategoria2 = mysqli_fetch_assoc($resultcategoria2);
                      $idnovidade =$dadosnovidades['id']
            ?>

            <a class="rel-card" href="infos.php?trackid=<?php echo $idnovidade; ?>">
              <img class="rel-card-img" src="<?php echo("creates/". $dadosnovidades['posterft']); ?>" alt="Curso"/>
              <div class="rel-card-body">
                <div class="rel-card-category"><?php echo($dadosnovidades['nome']); ?></div>
                <div class="rel-card-title"><?php echo($dadosnovidades['descricao']); ?></div>
                <div class="rel-card-meta">>
                  <span><?php echo($dadosnovidades['cargahoraria']); ?>H</span>
                  <span class="rel-card-dot"></span>
                </div>
              </div>
            </a>
            <?php endwhile; ?>

          </div>
        </div>
        <button class="rel-btn next" onclick="scrollRel(1)">
          <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
        </button>
      </div>
    </section>

  </main>


  <footer>
    <div class="footer-inner">
      <div class="footer-logo">Go<span>Stay</span>.</div>
      <ul class="footer-links">
        <li><a href="#">Sobre</a></li>
        <li><a href="#">Termos</a></li>
        <li><a href="#">Privacidade</a></li>
        <li><a href="#">Contato</a></li>
      </ul>
      <p class="footer-copy">© 2026 GoStay. Todos os direitos reservados.</p>
      <p class="footer-copy">developted by Lucas</p>
    </div>
  </footer>

  <script>
    /* Related carousel */
    function scrollRel(dir) {
      const outer = document.getElementById('rel-track-outer');
      outer.scrollBy({ left: dir * outer.clientWidth * 0.75, behavior: 'smooth' });
    }

    /* Drag-to-scroll */
    const outer = document.getElementById('rel-track-outer');
    let isDown = false, startX, scrollLeft;
    outer.addEventListener('mousedown', e => { isDown = true; startX = e.pageX - outer.offsetLeft; scrollLeft = outer.scrollLeft; });
    outer.addEventListener('mouseleave', () => { isDown = false; });
    outer.addEventListener('mouseup', () => { isDown = false; });
    outer.addEventListener('mousemove', e => { if (!isDown) return; e.preventDefault(); outer.scrollLeft = scrollLeft - (e.pageX - outer.offsetLeft - startX); });
  </script>

</body>
</html>