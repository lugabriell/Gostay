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
  $sqlmycourse = "SELECT * FROM cursoaluno WHERE idaluno = '$idaluno'";
  $sqlfreecourse = "SELECT * FROM curso WHERE tipo = 'gratis'";
  $resultmycourse = mysqli_query($conexao, $sqlmycourse);
  $resultfreecourse = mysqli_query($conexao, $sqlfreecourse);
  $resultfreecourse2 = mysqli_query($conexao, $sqlfreecourse);
  $dadosfreecourse = mysqli_fetch_assoc($resultfreecourse2);
  $idcategoria = $dadosfreecourse['idcategoria'];
  $sqlcategoria = "SELECT nome FROM categoria WHERE id ='$idcategoria'";
  $resultcategoria = mysqli_query($conexao, $sqlcategoria);
  $dadoscategoria = mysqli_fetch_assoc($resultcategoria);
  $resultfreecourse3 = mysqli_query($conexao, $sqlfreecourse);
  $sqlnovidades = "SELECT * FROM curso WHERE tipo ='gratis' ORDER BY datacadastro DESC";
  $resultnovidades = mysqli_query($conexao, $sqlnovidades);
 

?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>GoStay</title>
      <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Lora:ital,wght@0,400;1,400&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="stylehomepage.css">
  <style>
    .hero {
      position: relative; width: 100%;
      height: clamp(520px, 80vh, 780px);
      overflow: hidden; margin-top: var(--nav-h);
    }

    .hero-bg {
      position: absolute; inset: 0;
      background:
        linear-gradient(160deg,
          rgba(10,22,40,.85) 0%,
          rgba(30,77,155,.6) 40%,
          rgba(56,189,248,.25) 100%),
        url('<?php  echo("creates/".$dadosfreecourse['posterft']); ?>') center/cover no-repeat;
      transform: scale(1.04);
      animation: hero-zoom 18s ease-in-out infinite alternate;
    }
  </style>
</head>
<body>

  <input type="checkbox" id="mobile-nav-toggle" style="display:none"/>

  <nav class="navbar">
    <a href="#" class="nav-logo">
      Go<span style="color:var(--accent)">Stay</span>
      <span class="logo-dot"></span>
    </a>

    <ul class="nav-links">

      <li><a href="#destaques">Destaques</a></li>
      <li><a href="#gratuitos">Gratuitos</a></li>
      <li><a href="#cursos">Meus Cursos</a></li>
    </ul>

    <div class="nav-right">

      
  </nav>

  <!-- Mobile Nav (CSS-only toggle) -->
  <div class="mobile-nav">
    <label for="mobile-nav-toggle" class="mobile-nav-close-label"></label>
    <div class="mobile-nav-panel">
      <a href="#destaques">Destaques</a>
      <a href="#gratuitos">Gratuitos</a>
      <a href="#cursos">Meus Cursos</a>
    </div>
  </div>

  <section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-gradient"></div>
    <div class="hero-gradient-bottom"></div>
    <div class="hero-content">
      <div class="hero-badge">Em destaque agora</div>
      <h1 class="hero-title"><span><?php echo($dadosfreecourse['nome']); ?></span></h1>
      <div class="hero-meta">
   
        <span class="hero-genre"><?php echo($dadoscategoria['nome']); ?></span>
        <span class="hero-sep">·</span>
        <span class="hero-duration"><?php echo($dadosfreecourse['cargahoraria']); ?>H</span>
      </div>
      <p class="hero-desc">
        <?php echo($dadosfreecourse['descricao']); ?>
      </p>
      <div class="hero-actions">
        <a href="infos.php?trackid=<?php echo($dadosfreecourse['id']); ?>" class="btn btn-primary">
          <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
          Assistir
        </a>
        <a href="infos.php?trackid=<?php echo($dadosfreecourse['id']); ?>" class="btn btn-ghost">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
          Mais Informações
        </a>
      </div>
    </div>
  </section>

  <main class="main">

    <!-- DESTAQUES -->
    <section id="destaques" class="section-destaques">
      <div class="section-header">
        <h2 class="section-title">Destaques</h2>
    
      </div>
      <div class="carousel-wrapper" id="carousel-hot">
        <button class="carousel-btn prev" onclick="scrollCarousel('carousel-hot', -1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <div class="carousel-track-outer">
          <div class="carousel-track">
          <?php 
            while($dadosfreecourse2 = mysqli_fetch_assoc($resultfreecourse)):
          ?>
            <!-- Card 1 -->
            <a class="card-link" href="infos.php?trackid=<?php echo($dadosfreecourse2['id']); ?>">
            <div class="card">
              <div class="card-poster">
                <!-- <span class="card-badge hot">Hot</span> -->
                <img src="<?php echo("creates/". $dadosfreecourse2['ftcurso']); ?>"   loading="lazy"/>
                <div class="card-title-overlay"><span><?php echo($dadosfreecourse2['nome']); ?></span></div> 
              </div>
                </div>
              </div>
            </div>
            </a>
            <?php endwhile; ?>
           

          </div>
        </div>
        <button class="carousel-btn next" onclick="scrollCarousel('carousel-hot', 1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
        </button>
      </div>
    </section>

    <!-- GRATUITOS -->
    <section id="gratuitos" class="section">
      <div class="section-header">
        <h2 class="section-title">Gratuitos</h2>
       
      </div>
      <div class="carousel-wrapper" id="carousel-rec">
        <button class="carousel-btn prev" onclick="scrollCarousel('carousel-rec', -1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <div class="carousel-track-outer">
          <div class="carousel-track">
          <?php 
            while($dadosfreecourse3 = mysqli_fetch_assoc($resultfreecourse3)):
          ?>
            <!-- Card 1 -->
            <a class="card-link" href="infos.php?trackid=<?php echo($dadosfreecourse3['id']); ?>">
            <div class="card">
              <div class="card-poster">
                <!-- <span class="card-badge hot">Hot</span> -->
                <img src="<?php echo("creates/". $dadosfreecourse3['ftcurso']); ?>"  loading="lazy"/>
                <div class="card-title-overlay"><span><?php echo($dadosfreecourse3['nome']); ?></span></div> 
              </div>
                </div>
              </div>
            </div>
            </a>
            <?php endwhile; ?>


          </div>
        </div>
        <button class="carousel-btn next" onclick="scrollCarousel('carousel-rec', 1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
        </button>
      </div>
    </section>

    <!-- NOVIDADES (wide cards) -->
    <section id="novidades" class="section">
      <div class="section-header">
        <h2 class="section-title">Novidades</h2>
        
      </div>
      <div class="carousel-wrapper" id="carousel-new">
        <button class="carousel-btn prev" onclick="scrollCarousel('carousel-new', -1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <div class="carousel-track-outer">
          <div class="carousel-track">
            <?php while($dadosnovidades = mysqli_fetch_assoc($resultnovidades)): 
                      $idcategoria2 = $dadosnovidades['idcategoria'];
                      $sqlcategoria2 = "SELECT nome FROM categoria WHERE id ='$idcategoria2'";
                      $resultcategoria2 = mysqli_query($conexao, $sqlcategoria2);
                      $dadoscategoria2 = mysqli_fetch_assoc($resultcategoria2);
            ?>
              
            <!-- Wide Card 1 -->
            <a class="card-link" href="infos.php?trackid=<?php echo($dadosnovidades['id']); ?>">
            <div class="card-wide">
              <div style="position:relative;overflow:hidden;border-radius:14px 14px 0 0">
                <span class="card-badge new" style="position:absolute;top:8px;left:8px;z-index:2">Novo</span>
                <img class="card-wide-img" src="<?php echo("creates/". $dadosnovidades['posterft']) ?>"  loading="lazy"/>
                <div class="card-wide-title-overlay"><span><?php echo($dadosnovidades['nome']); ?></span></div>
              </div>
              <div class="card-wide-body">
                <div class="card-wide-meta"><?php echo($dadosnovidades['cargahoraria']) ?>H - <?php echo($dadoscategoria2['nome']); ?></div>
              </div>
            </div>
            </a>
            <?php endwhile; ?>

          </div>
        </div>
        <button class="carousel-btn next" onclick="scrollCarousel('carousel-new', 1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
        </button>
      </div>
    </section>

    <!-- MEUS CURSOS -->
    <section id="cursos" class="section">
      <div class="section-header">
        <h2 class="section-title"> Meus Cursos</h2>
      
      </div>
      <div class="carousel-wrapper" id="carousel-pop">
        <button class="carousel-btn prev" onclick="scrollCarousel('carousel-pop', -1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <div class="carousel-track-outer">
          <div class="carousel-track">
          <?php 
            $numrows = mysqli_num_rows($resultmycourse);
            if($numrows == 0){
              echo('<div ><span>Você não tem nenhum curso</span></div>');
            }
            while($dadosmycourse = mysqli_fetch_assoc($resultmycourse)):
              $idcurso = $dadosmycourse['idcurso'];
              $sqlmycourse2 = "SELECT * FROM curso WHERE id = '$idcurso'";
              $resultmycourse2 = mysqli_query($conexao, $sqlmycourse2);

              while($dadosmycourse2 = mysqli_fetch_assoc($resultmycourse2)):

          ?>
            <!-- Card 1 -->
            <a class="card-link" href="infos.php?trackid=<?php echo($dadosmycourse2['id']); ?>">
            <div class="card">
              <div class="card-poster">

                <img src="<?php echo("creates/".$dadosmycourse2['ftcurso']); ?>"  loading="lazy"/>
                <div class="card-title-overlay"><span><?php echo($dadosmycourse2['nome']); ?></span></div>
              </div>
            </div>
            </a>
          <?php 
            endwhile;  
          endwhile; 
          ?>
          </div>
        </div>
        <button class="carousel-btn next" onclick="scrollCarousel('carousel-pop', 1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
        </button>
      </div>
    </section>

  </main>

  <!-- =============================================
       FOOTER
  ============================================= -->
  <footer>
    <div class="footer-top">
      <div class="footer-brand">
        <span class="logo">Go Stay<span style="color:var(--accent)">.</span></span>
        <p>Seu universo de entretenimento e aprendizado. Conteúdo de qualidade, disponível a qualquer hora, em qualquer lugar.</p>
        <div class="footer-social">
          <button class="social-btn" title="Twitter">
            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
          </button>
          <button class="social-btn" title="Instagram">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zM17.5 6.5h.01"/></svg>
          </button>
          <button class="social-btn" title="YouTube">
            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58zM9.75 15.02V8.98L15.5 12l-5.75 3.02z"/></svg>
          </button>
        </div>
      </div>
      <div class="footer-col">
        <h4>Empresa</h4>
        <ul>
          <li><a href="#">Sobre nós</a></li>
          <li><a href="#">Carreiras</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Imprensa</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Suporte</h4>
        <ul>
          <li><a href="#">Central de ajuda</a></li>
          <li><a href="#">Contato</a></li>
          <li><a href="#">Status</a></li>
          <li><a href="#">Comunidade</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Legal</h4>
        <ul>
          <li><a href="#">Termos de uso</a></li>
          <li><a href="#">Privacidade</a></li>
          <li><a href="#">Cookies</a></li>
          <li><a href="#">Acessibilidade</a></li>
        </ul>
      </div>
    </div>
    <hr class="footer-divider"/>
    <div class="footer-bottom">
      <span class="footer-copy">© 2026 Go Stay. Todos os direitos reservados.</span>
      <div class="footer-badge">
        <span>developted by Lucas</span>
      </div>
    </div>
  </footer>

  <script>
    /* Carousel arrow scroll */
    function scrollCarousel(wrapperId, dir) {
      const wrapper = document.getElementById(wrapperId);
      const outer = wrapper.querySelector('.carousel-track-outer');
      outer.scrollBy({ left: dir * outer.clientWidth * 0.75, behavior: 'smooth' });
    }

    /* Drag-to-scroll */
    document.querySelectorAll('.carousel-track-outer').forEach(el => {
      let isDown = false, startX, scrollLeft;
      el.addEventListener('mousedown', e => {
        isDown = true;
        startX = e.pageX - el.offsetLeft;
        scrollLeft = el.scrollLeft;
      });
      el.addEventListener('mouseleave', () => { isDown = false; });
      el.addEventListener('mouseup',    () => { isDown = false; });
      el.addEventListener('mousemove', e => {
        if (!isDown) return;
        e.preventDefault();
        el.scrollLeft = scrollLeft - (e.pageX - el.offsetLeft - startX);
      });
    });
  </script>
</body>
</html>