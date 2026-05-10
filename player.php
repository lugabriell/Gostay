<?php
require_once __DIR__ . "/connection.php";
session_start();
$trackid = $_GET['trackid'];
$sqlselect = "SELECT * FROM aula WHERE id = '$trackid' ORDER BY ordem DESC";
$resultselect = mysqli_query($conexao, $sqlselect);
$dadosselect = mysqli_fetch_assoc($resultselect);
$sqlselect2 = "SELECT * FROM alunoaula WHERE idaula = '$trackid'";
$resultselect2 = mysqli_query($conexao, $sqlselect2);
$dadosselect2 = mysqli_fetch_assoc($resultselect2);
$caminho = $dadosselect['caminhovideo'];
$idcurso = $dadosselect['idcurso'];
$ordem = $dadosselect['ordem'];
if($dadosselect2['ultimoacesso'] !== 'nao'){
  $ultimaposicao = $dadosselect2['ultimoacesso'];
}
else{
  $ultimaposicao = false;
}


$sqlcurso = "SELECT * FROM curso WHERE id = '$idcurso'";
$resultcurso = mysqli_query($conexao, $sqlcurso);
$dadoscurso = mysqli_fetch_assoc($resultcurso);


$sqlselect2 = "SELECT * FROM aula WHERE idcurso = '$idcurso' ORDER BY ordem ASC";
$resultselect2 = mysqli_query($conexao, $sqlselect2);
while($dadosprox= mysqli_fetch_assoc($resultselect2)){
    if($ordem >= $dadosprox['ordem']){

        continue;
    }
    else{
        $idprox = $dadosprox['id'];
        break;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>GoStay</title>
    <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
  <style>
    
    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

    :root {
      --blue-400: #2563eb;
      --blue-300: #3b82f6;
      --accent:   #38bdf8;
      --white:    #ffffff;
      --ctrl-h:   72px;
      --transition: .22s cubic-bezier(.4,0,.2,1);
    }

    html, body {
      width: 100%; height: 100%;
      background: #050a12;
      font-family: 'Outfit', sans-serif;
      overflow: hidden;
      user-select: none;
    }


    #player {
      position: relative;
      width: 100vw;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #000;
      cursor: none;
    }

    #video {
      width: 100%;
      height: 100%;
      object-fit: contain;
      display: block;
      /* Bloqueia todos os controles nativos do Chrome/Safari */
      pointer-events: none;
    }

    /* Suprime a UI nativa do Chrome no elemento <video> */
    #video::-webkit-media-controls              { display: none !important; }
    #video::-webkit-media-controls-enclosure    { display: none !important; }
    #video::-webkit-media-controls-panel        { display: none !important; }
    #video::-webkit-media-controls-play-button  { display: none !important; }
    #video::-webkit-media-controls-timeline     { display: none !important; }
    #video::-webkit-media-controls-volume-slider{ display: none !important; }
    #video::-webkit-media-controls-overlay-play-button { display: none !important; }


    .cursor {
      position: fixed;
      width: 10px; height: 10px;
      background: white;
      border-radius: 50%;
      pointer-events: none;
      z-index: 9999;
      transform: translate(-50%, -50%);
      transition: opacity .3s, transform .15s;
      mix-blend-mode: difference;
    }
    #player.controls-hidden .cursor { opacity: 0; }

    .overlay-top,
    .overlay-bottom {
      position: absolute;
      left: 0; right: 0;
      pointer-events: none;
      z-index: 5;
      transition: opacity var(--transition);
    }
    .overlay-top {
      top: 0; height: 180px;
      background: linear-gradient(to bottom, rgba(0,0,0,.75) 0%, transparent 100%);
    }
    .overlay-bottom {
      bottom: 0; height: 220px;
      background: linear-gradient(to top, rgba(0,0,0,.88) 0%, rgba(0,0,0,.4) 60%, transparent 100%);
    }
    #player.controls-hidden .overlay-top,
    #player.controls-hidden .overlay-bottom {
      opacity: 0;
    }

    .controls-area {
      position: absolute;
      left: 0; right: 0; bottom: 0;
      z-index: 10;
      padding: 0 clamp(16px, 3vw, 36px) clamp(16px, 2.5vh, 28px);
      transform: translateY(0);
      opacity: 1;
      transition: opacity .35s ease, transform .35s ease;
    }
    #player.controls-hidden .controls-area {
      opacity: 0;
      transform: translateY(12px);
      pointer-events: none;
    }

    .top-bar {
      position: absolute;
      top: 0; left: 0; right: 0;
      z-index: 10;
      padding: clamp(14px, 2.5vh, 28px) clamp(16px, 3vw, 36px);
      display: flex;
      align-items: center;
      gap: 14px;
      transform: translateY(0);
      opacity: 1;
      transition: opacity .35s ease, transform .35s ease;
    }
    #player.controls-hidden .top-bar {
      opacity: 0;
      transform: translateY(-12px);
      pointer-events: none;
    }

    .back-btn {
      display: flex; align-items: center; gap: 8px;
      color: rgba(255,255,255,.85);
      font-size: .82rem; font-weight: 600;
      background: rgba(255,255,255,.10);
      border: 1px solid rgba(255,255,255,.15);
      border-radius: 99px;
      padding: 7px 16px 7px 10px;
      cursor: pointer;
      backdrop-filter: blur(10px);
      transition: var(--transition);
      text-decoration: none;
      white-space: nowrap;
    }
    .back-btn:hover {
      background: rgba(255,255,255,.18);
      color: white;
    }
    .back-btn svg { flex-shrink: 0; }

    .top-titles {
      display: flex; flex-direction: column; gap: 2px;
      overflow: hidden;
    }
    .top-course-name {
      font-size: .7rem; font-weight: 600;
      letter-spacing: .08em; text-transform: uppercase;
      color: var(--accent);
      white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .top-lesson-name {
      font-size: clamp(.85rem, 1.5vw, 1rem);
      font-weight: 700; color: white;
      white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }

 
    .center-feedback {
      position: absolute;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%) scale(0);
      z-index: 20;
      width: 80px; height: 80px;
      border-radius: 50%;
      background: rgba(37,99,235,.4);
      display: grid; place-items: center;
      color: white;
      pointer-events: none;
      opacity: 0;
      transition: none;
    }
    .center-feedback.pop {
      animation: pop-feedback .5s cubic-bezier(.4,0,.2,1) forwards;
    }
    @keyframes pop-feedback {
      0%   { transform: translate(-50%,-50%) scale(0);   opacity: 1; }
      40%  { transform: translate(-50%,-50%) scale(1.1); opacity: 1; }
      100% { transform: translate(-50%,-50%) scale(1.5); opacity: 0; }
    }


    .skip-feedback {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      z-index: 20;
      display: flex; flex-direction: column; align-items: center; gap: 4px;
      color: white; font-size: .78rem; font-weight: 700;
      pointer-events: none;
      opacity: 0;
    }
    .skip-feedback.left  { left: 14%; }
    .skip-feedback.right { right: 14%; }
    .skip-feedback svg { filter: drop-shadow(0 2px 6px rgba(0,0,0,.6)); }
    .skip-feedback.show { animation: skip-anim .6s ease forwards; }
    @keyframes skip-anim {
      0%   { opacity: 0; transform: translateY(-50%) scale(.8); }
      20%  { opacity: 1; transform: translateY(-50%) scale(1); }
      80%  { opacity: 1; transform: translateY(-50%) scale(1); }
      100% { opacity: 0; transform: translateY(-50%) scale(.9); }
    }

    
    .progress-wrapper {
      position: relative;
      height: 18px;
      display: flex;
      align-items: center;
      cursor: pointer;
      margin-bottom: 10px;
    }

    .progress-track {
      position: relative;
      width: 100%;
      height: 4px;
      background: rgba(255,255,255,.2);
      border-radius: 99px;
      transition: height .2s ease;
    }
    .progress-wrapper:hover .progress-track { height: 6px; }

    .progress-buffer {
      position: absolute; left: 0; top: 0; height: 100%;
      background: rgba(255,255,255,.3);
      border-radius: 99px;
      pointer-events: none;
      width: 0%;
    }

    .progress-fill {
      position: absolute; left: 0; top: 0; height: 100%;
      background: linear-gradient(to right, var(--blue-400), var(--accent));
      border-radius: 99px;
      pointer-events: none;
      width: 0%;
      transition: width .08s linear;
    }

    .progress-thumb {
      position: absolute;
      top: 50%; transform: translate(-50%, -50%) scale(0);
      width: 14px; height: 14px;
      background: white;
      border-radius: 50%;
      box-shadow: 0 2px 8px rgba(0,0,0,.5);
      pointer-events: none;
      transition: transform .15s ease;
      left: 0%;
    }
    .progress-wrapper:hover .progress-thumb,
    .progress-wrapper.dragging .progress-thumb {
      transform: translate(-50%, -50%) scale(1);
    }


    .progress-tooltip {
      position: absolute;
      bottom: calc(100% + 10px);
      transform: translateX(-50%);
      background: rgba(10,22,40,.9);
      color: white;
      font-size: .72rem; font-weight: 600;
      padding: 4px 8px;
      border-radius: 6px;
      pointer-events: none;
      opacity: 0;
      white-space: nowrap;
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255,255,255,.1);
      transition: opacity .15s;
    }
    .progress-wrapper:hover .progress-tooltip { opacity: 1; }

  
    .controls-row {
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .ctrl-group {
      display: flex; align-items: center; gap: 2px;
    }
    .ctrl-group.right { margin-left: auto; }


    .ctrl-btn {
      width: 40px; height: 40px;
      border-radius: 50%;
      border: none; background: transparent;
      color: rgba(255,255,255,.85);
      display: grid; place-items: center;
      cursor: pointer;
      transition: var(--transition);
      position: relative;
      flex-shrink: 0;
    }
    .ctrl-btn:hover {
      background: rgba(255,255,255,.12);
      color: white;
      transform: scale(1.08);
    }
    .ctrl-btn:active { transform: scale(.95); }


    .ctrl-btn[data-tip]::after {
      content: attr(data-tip);
      position: absolute;
      bottom: calc(100% + 8px);
      left: 50%; transform: translateX(-50%);
      background: rgba(10,22,40,.92);
      color: white;
      font-size: .68rem; font-weight: 600;
      padding: 4px 8px; border-radius: 5px;
      white-space: nowrap;
      pointer-events: none;
      opacity: 0;
      transition: opacity .15s;
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255,255,255,.08);
    }
    .ctrl-btn[data-tip]:hover::after { opacity: 1; }

    .ctrl-btn.play-btn {
      width: 46px; height: 46px;
      background: rgba(37,99,235,.25);
      border: 1px solid rgba(37,99,235,.4);
    }
    .ctrl-btn.play-btn:hover {
      background: var(--blue-400);
      border-color: var(--blue-400);
    }

    .volume-group {
      display: flex; align-items: center; gap: 4px;
    }
    .volume-slider-wrap {
      width: 0;
      overflow: hidden;
      transition: width .25s ease;
      display: flex; align-items: center;
    }
    .volume-group:hover .volume-slider-wrap,
    .volume-group:focus-within .volume-slider-wrap {
      width: 80px;
    }

    .volume-slider {
      -webkit-appearance: none;
      appearance: none;
      width: 76px;
      height: 4px;
      background: rgba(255,255,255,.25);
      border-radius: 99px;
      outline: none;
      cursor: pointer;
      transition: var(--transition);
    }
    .volume-slider::-webkit-slider-thumb {
      -webkit-appearance: none;
      width: 12px; height: 12px;
      border-radius: 50%;
      background: white;
      box-shadow: 0 1px 4px rgba(0,0,0,.4);
      cursor: pointer;
      transition: transform .15s;
    }
    .volume-slider:hover::-webkit-slider-thumb { transform: scale(1.2); }
    .volume-slider::-moz-range-thumb {
      width: 12px; height: 12px;
      border-radius: 50%;
      background: white;
      border: none;
      cursor: pointer;
    }

   
    .time-display {
      font-size: .78rem; font-weight: 600;
      color: rgba(255,255,255,.8);
      white-space: nowrap;
      padding: 0 8px;
      letter-spacing: .03em;
    }
    .time-display span { color: rgba(255,255,255,.4); margin: 0 2px; }

   
    .quality-wrap { position: relative; }

    .quality-btn {
      font-family: 'Outfit', sans-serif;
      font-size: .72rem; font-weight: 700;
      letter-spacing: .04em;
      color: rgba(255,255,255,.8);
      background: rgba(255,255,255,.10);
      border: 1px solid rgba(255,255,255,.15);
      border-radius: 6px;
      padding: 5px 10px;
      cursor: pointer;
      transition: var(--transition);
      white-space: nowrap;
    }
    .quality-btn:hover {
      background: rgba(255,255,255,.18);
      color: white;
    }

    .quality-menu {
      position: absolute;
      bottom: calc(100% + 10px);
      right: 0;
      background: rgba(10,22,40,.95);
      border: 1px solid rgba(255,255,255,.1);
      border-radius: 10px;
      overflow: hidden;
      backdrop-filter: blur(16px);
      min-width: 110px;
      transform: translateY(6px) scale(.96);
      opacity: 0;
      pointer-events: none;
      transition: opacity .2s, transform .2s;
    }
    .quality-wrap.open .quality-menu {
      opacity: 1; transform: translateY(0) scale(1); pointer-events: auto;
    }

    .quality-item {
      padding: 10px 16px;
      font-size: .8rem; font-weight: 600;
      color: rgba(255,255,255,.7);
      cursor: pointer;
      transition: var(--transition);
      display: flex; align-items: center; justify-content: space-between; gap: 8px;
    }
    .quality-item:hover { background: rgba(255,255,255,.08); color: white; }
    .quality-item.active { color: var(--accent); }
    .quality-item.active::after {
      content: '';
      width: 6px; height: 6px;
      border-radius: 50%;
      background: var(--accent);
    }


    .settings-wrap { position: relative; }
    .settings-menu {
      position: absolute;
      bottom: calc(100% + 10px);
      right: 0;
      background: rgba(10,22,40,.95);
      border: 1px solid rgba(255,255,255,.1);
      border-radius: 10px;
      overflow: hidden;
      backdrop-filter: blur(16px);
      min-width: 180px;
      transform: translateY(6px) scale(.96);
      opacity: 0;
      pointer-events: none;
      transition: opacity .2s, transform .2s;
    }
    .settings-wrap.open .settings-menu {
      opacity: 1; transform: translateY(0) scale(1); pointer-events: auto;
    }
    .settings-title {
      padding: 10px 16px 6px;
      font-size: .62rem; font-weight: 800;
      letter-spacing: .1em; text-transform: uppercase;
      color: rgba(255,255,255,.3);
      border-bottom: 1px solid rgba(255,255,255,.07);
    }
    .settings-item {
      padding: 10px 16px;
      font-size: .8rem; font-weight: 500;
      color: rgba(255,255,255,.7);
      cursor: pointer; display: flex; align-items: center;
      justify-content: space-between; gap: 12px;
      transition: var(--transition);
    }
    .settings-item:hover { background: rgba(255,255,255,.08); color: white; }
    .settings-item-value {
      color: var(--accent); font-weight: 600; font-size: .75rem;
    }


    .ctrl-btn.captions-on { color: var(--accent); }

    .next-card {
      position: absolute;
      bottom: 110px; right: clamp(16px, 3vw, 36px);
      z-index: 20;
      width: clamp(240px, 28vw, 320px);
      background: rgba(10,18,34,.92);
      border: 1px solid rgba(56,189,248,.25);
      border-radius: 14px;
      overflow: hidden;
      backdrop-filter: blur(16px);
      box-shadow: 0 16px 48px rgba(0,0,0,.6);
      transform: translateX(20px) scale(.97);
      opacity: 0;
      pointer-events: none;
      transition: opacity .4s ease, transform .4s ease;
    }
    .next-card.visible {
      opacity: 1; transform: translateX(0) scale(1); pointer-events: auto;
    }

    .next-card-thumb {
      width: 100%; aspect-ratio: 16/9;
      object-fit: cover; display: block;
      opacity: .7;
    }

    .next-card-body { padding: 14px 16px; }

    .next-card-label {
      font-size: .62rem; font-weight: 800;
      letter-spacing: .1em; text-transform: uppercase;
      color: var(--accent); margin-bottom: 5px;
      display: flex; align-items: center; gap: 6px;
    }

    .next-card-title {
      font-size: .9rem; font-weight: 700; color: white;
      margin-bottom: 4px; line-height: 1.3;
    }

    .next-card-sub {
      font-size: .72rem; color: rgba(255,255,255,.4);
      margin-bottom: 14px;
    }

    .next-card-actions {
      display: flex; gap: 8px;
    }

    .next-play-btn {
      flex: 1; padding: 9px;
      background: var(--blue-400); color: white;
      border: none; border-radius: 8px;
      font-family: 'Outfit', sans-serif;
      font-size: .8rem; font-weight: 700;
      cursor: pointer; transition: var(--transition);
      display: flex; align-items: center; justify-content: center; gap: 6px;
    }
    .next-play-btn:hover { background: var(--blue-300); }

    .next-dismiss-btn {
      padding: 9px 14px;
      background: rgba(255,255,255,.1);
      border: 1px solid rgba(255,255,255,.15);
      color: rgba(255,255,255,.7);
      border-radius: 8px;
      font-family: 'Outfit', sans-serif;
      font-size: .8rem; font-weight: 600;
      cursor: pointer; transition: var(--transition);
    }
    .next-dismiss-btn:hover { background: rgba(255,255,255,.18); }

    
    .countdown-ring {
      position: absolute;
      top: 10px; right: 10px;
      width: 36px; height: 36px;
    }
    .countdown-ring circle {
      fill: none;
      stroke-width: 3;
      transform-origin: center;
      transform: rotate(-90deg);
    }
    .countdown-ring .track  { stroke: rgba(255,255,255,.15); }
    .countdown-ring .fill   { stroke: var(--accent); stroke-linecap: round; }
    .countdown-num {
      position: absolute; inset: 0;
      display: grid; place-items: center;
      font-size: .75rem; font-weight: 800; color: white;
    }

    .spinner {
      position: absolute; top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      z-index: 15;
      width: 48px; height: 48px;
      border: 3px solid rgba(255,255,255,.1);
      border-top-color: var(--blue-400);
      border-radius: 50%;
      animation: spin 1s linear infinite;
      opacity: 0;
      transition: opacity .3s;
      pointer-events: none;
    }
    .spinner.visible { opacity: 1; }
    @keyframes spin { to { transform: translate(-50%,-50%) rotate(360deg); } }

 
    .tap-zone {
      position: absolute;
      top: 0; bottom: 0; width: 30%;
      z-index: 8;
      cursor: pointer;
    }
    .tap-zone.left  { left: 0; }
    .tap-zone.right { right: 0; }

    /* Zona central para toggle play */
    .tap-zone-center {
      position: absolute;
      top: 0; bottom: 0;
      left: 30%; right: 30%;
      z-index: 8;
      cursor: pointer;
    }

    .big-pause-icon {
      position: absolute;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      z-index: 6;
      width: 72px; height: 72px;
      border-radius: 50%;
      background: rgba(37,99,235,.3);
      border: 2px solid rgba(37,99,235,.5);
      display: grid; place-items: center;
      color: white;
      backdrop-filter: blur(8px);
      pointer-events: none;
      opacity: 0;
      transition: opacity .25s;
    }
    #player.is-paused .big-pause-icon { opacity: 1; }


    @media (max-width: 600px) {
      .ctrl-btn { width: 36px; height: 36px; }
      .ctrl-btn.play-btn { width: 40px; height: 40px; }
      .time-display { font-size: .7rem; padding: 0 4px; }
      .quality-btn { font-size: .65rem; padding: 4px 8px; }
      .ctrl-btn[data-tip]::after { display: none; }
      .back-btn span { display: none; }
      .top-lesson-name { font-size: .85rem; }
    }
  </style>
</head>
<body>

  <div class="cursor" id="cursor"></div>

  
  <div id="player" class="is-paused">

    <!-- O atributo controls NÃO deve estar presente aqui -->
    <video id="video" preload="metadata">
      <source src="<?php echo("creates/". $caminho); ?>" type="video/mp4"/>
      <track kind="subtitles" srclang="pt" label="Português" id="captions-track"/>
    </video>


    <div class="big-pause-icon">
      <svg width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
    </div>

    <div class="spinner" id="spinner"></div>

    <div class="overlay-top"></div>
    <div class="overlay-bottom"></div>


    <div class="skip-feedback left" id="skip-left">
      <svg width="32" height="32" fill="none" stroke="white" stroke-width="2.2" viewBox="0 0 24 24"><path d="M11 17l-5-5 5-5"/><path d="M18 17l-5-5 5-5"/></svg>
      10s
    </div>
    <div class="skip-feedback right" id="skip-right">
      <svg width="32" height="32" fill="none" stroke="white" stroke-width="2.2" viewBox="0 0 24 24"><path d="M13 17l5-5-5-5"/><path d="M6 17l5-5-5-5"/></svg>
      10s
    </div>

    <div class="center-feedback" id="center-feedback">
      <svg id="center-icon" width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
    </div>


    <!-- Zona esquerda: retroceder 10s -->
    <div class="tap-zone left"  id="tap-left"></div>
    <!-- Zona central: play/pause -->
    <div class="tap-zone-center" id="tap-center"></div>
    <!-- Zona direita: avançar 10s -->
    <div class="tap-zone right" id="tap-right"></div>


    <div class="top-bar">
      <a href="infos.php?trackid=<?php echo($dadoscurso['id']);  ?>" class="back-btn">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        <span>Voltar ao curso</span>
      </a>
      <div class="top-titles">
        <div class="top-course-name"><?php  echo($dadoscurso['nome']);?></div>
        <div class="top-lesson-name">Aula <?php echo($dadosselect['ordem']) ?> — <?php echo($dadosselect['nome']); ?></div>
      </div>
    </div>

    <?php if(isset($dadosprox)){ ?>
    <div class="next-card" id="next-card">
      <svg class="countdown-ring" viewBox="0 0 36 36" id="countdown-ring">
        <circle class="track" cx="18" cy="18" r="15.9"/>
        <circle class="fill"  cx="18" cy="18" r="15.9" id="countdown-arc"
          stroke-dasharray="100 100"
          stroke-dashoffset="0"/>
      </svg>
      <div class="countdown-num" id="countdown-num">10</div>

      <img class="next-card-thumb" src="<?php echo($dadosprox['posteraula']); ?>" alt="Próxima aula"/>
      <div class="next-card-body">
        <div class="next-card-label">
          <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
          Próxima aula
        </div>
        <div class="next-card-title"><?php echo($dadosprox['nome']); ?></div>
        <div class="next-card-sub">Módulo <?php echo($dadosprox['ordem']); ?> · <?php echo($dadosprox['duracao']); ?>min</div>
        <div class="next-card-actions">
          <a href="player.php?trackid=<?php echo($dadosprox['id']); ?>" class="next-play-btn" id="next-play-btn">
            <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            Assistir agora
          </a>
          <a href="homepage.php" class="next-dismiss-btn" id="next-dismiss-btn">Ignorar</a>
        </div>
      </div>
    </div>
    <?php } ?>
  
    <div class="controls-area">

   
      <div class="progress-wrapper" id="progress-wrapper">
        <div class="progress-track">
          <div class="progress-buffer" id="progress-buffer"></div>
          <div class="progress-fill"   id="progress-fill"></div>
          <div class="progress-thumb"  id="progress-thumb"></div>
        </div>
        <div class="progress-tooltip" id="progress-tooltip">0:00</div>
      </div>

   
      <div class="controls-row">

     
        <div class="ctrl-group">


          <button class="ctrl-btn play-btn" id="play-btn" data-tip="Play (Espaço)">
            <svg id="play-icon" width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
          </button>

   
          <button class="ctrl-btn" id="rewind-btn" data-tip="−10s (←)">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12.5 3C8.4 3 5 6.4 5 10.5v.5H3l3 3 3-3H7v-.5C7 7.5 9.5 5 12.5 5S18 7.5 18 10.5 15.5 16 12.5 16c-1.4 0-2.7-.5-3.7-1.4L7.4 16c1.3 1.2 3 1.9 5.1 2 4.1.1 7.5-3.2 7.5-7.2C20 6.7 16.6 3 12.5 3z"/>
              <text x="9.5" y="13.5" font-size="5.5" font-family="Outfit,sans-serif" font-weight="800" fill="white">10</text>
            </svg>
          </button>

   
          <button class="ctrl-btn" id="forward-btn" data-tip="+10s (→)">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
              <path d="M11.5 3C15.6 3 19 6.4 19 10.5v.5h2l-3 3-3-3h2v-.5C17 7.5 14.5 5 11.5 5S6 7.5 6 10.5 8.5 16 11.5 16c1.4 0 2.7-.5 3.7-1.4l1.4 1.4c-1.3 1.2-3 1.9-5.1 2-4.1.1-7.5-3.2-7.5-7.2C4 6.7 7.4 3 11.5 3z"/>
              <text x="8.5" y="13.5" font-size="5.5" font-family="Outfit,sans-serif" font-weight="800" fill="white">10</text>
            </svg>
          </button>

 
          <div class="volume-group">
            <button class="ctrl-btn" id="mute-btn" data-tip="Mudo (M)">
              <svg id="vol-icon" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                <path id="vol-path" d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.8-1-3.3-2.5-4.1v8.2c1.5-.8 2.5-2.3 2.5-4.1zM14 3.2v2.1c2.9.9 5 3.6 5 6.7s-2.1 5.8-5 6.7v2.1c4-.9 7-4.5 7-8.8s-3-7.9-7-8.8z"/>
              </svg>
            </button>
            <div class="volume-slider-wrap">
              <input type="range" class="volume-slider" id="volume-slider" min="0" max="1" step="0.01" value="1"/>
            </div>
          </div>

          <div class="time-display" id="time-display">
            <span id="current-time">0:00</span><span>/</span><span id="duration">0:00</span>
          </div>
        </div>

        <div class="ctrl-group right">

          <div class="quality-wrap" id="quality-wrap">
            <button class="quality-btn" id="quality-btn" data-tip="Qualidade">1080p</button>
            <div class="quality-menu" id="quality-menu">
              <div class="quality-item" data-q="Auto">Automático</div>
              <div class="quality-item active" data-q="1080p">1080p</div>
              <div class="quality-item" data-q="720p">720p</div>
              <div class="quality-item" data-q="480p">480p</div>
              <div class="quality-item" data-q="360p">360p</div>
            </div>
          </div>

          <button class="ctrl-btn" id="captions-btn" data-tip="Legendas (C)">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <rect x="2" y="5" width="20" height="14" rx="2"/>
              <path d="M7 12h5M7 15h3M13 12h4M14 15h3"/>
            </svg>
          </button>

          <div class="settings-wrap" id="settings-wrap">
            <button class="ctrl-btn" id="settings-btn" data-tip="Configurações (S)">
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="3"/>
                <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/>
              </svg>
            </button>
            <div class="settings-menu" id="settings-menu">
              <div class="settings-title">Configurações</div>
              <div class="settings-item" id="speed-item">
                Velocidade
                <span class="settings-item-value" id="speed-val">1×</span>
              </div>
              <div class="settings-item" id="autoplay-item">
                Próxima aula
                <span class="settings-item-value" id="autoplay-val">Ativado</span>
              </div>
            </div>
          </div>

          <button class="ctrl-btn" id="fs-btn" data-tip="Tela cheia (F)">
            <svg id="fs-icon" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M8 3H5a2 2 0 00-2 2v3M21 8V5a2 2 0 00-2-2h-3M16 21h3a2 2 0 002-2v-3M3 16v3a2 2 0 002 2h3"/>
            </svg>
          </button>

        </div>
      </div>

    </div>

  </div>


  <script>

    const player        = document.getElementById('player');
    const video         = document.getElementById('video');
    const cursor        = document.getElementById('cursor');
    const spinner       = document.getElementById('spinner');
    const playBtn       = document.getElementById('play-btn');
    const playIcon      = document.getElementById('play-icon');
    const rewindBtn     = document.getElementById('rewind-btn');
    const forwardBtn    = document.getElementById('forward-btn');
    const muteBtn       = document.getElementById('mute-btn');
    const volSlider     = document.getElementById('volume-slider');
    const volIcon       = document.getElementById('vol-icon');
    const volPath       = document.getElementById('vol-path');
    const currentTimeEl = document.getElementById('current-time');
    const durationEl    = document.getElementById('duration');
    const progressWrap  = document.getElementById('progress-wrapper');
    const progressFill  = document.getElementById('progress-fill');
    const progressBuf   = document.getElementById('progress-buffer');
    const progressThumb = document.getElementById('progress-thumb');
    const progressTip   = document.getElementById('progress-tooltip');
    const fsBtn         = document.getElementById('fs-btn');
    const fsIcon        = document.getElementById('fs-icon');
    const captionsBtn   = document.getElementById('captions-btn');
    const qualityWrap   = document.getElementById('quality-wrap');
    const qualityBtn    = document.getElementById('quality-btn');
    const qualityMenu   = document.getElementById('quality-menu');
    const settingsWrap  = document.getElementById('settings-wrap');
    const settingsBtn   = document.getElementById('settings-btn');
    const settingsMenu  = document.getElementById('settings-menu');
    const speedItem     = document.getElementById('speed-item');
    const speedVal      = document.getElementById('speed-val');
    const autoplayItem  = document.getElementById('autoplay-item');
    const autoplayVal   = document.getElementById('autoplay-val');
    const nextCard      = document.getElementById('next-card');
    const countdownNum  = document.getElementById('countdown-num');
    const countdownArc  = document.getElementById('countdown-arc');
    const nextPlayBtn   = document.getElementById('next-play-btn');
    const nextDismissBtn= document.getElementById('next-dismiss-btn');
    const centerFeedback= document.getElementById('center-feedback');
    const centerIcon    = document.getElementById('center-icon');
    const skipLeft      = document.getElementById('skip-left');
    const skipRight     = document.getElementById('skip-right');
    const tapLeft       = document.getElementById('tap-left');
    const tapRight      = document.getElementById('tap-right');
    const tapCenter     = document.getElementById('tap-center');

   
    let controlsTimer     = null;
    let isDragging        = false;
    let captionsOn        = false;
    let autoplayOn        = true;
    let countdownTimer    = null;
    let countdownSecs     = 10;
    let nextCardDismissed = false;
    const speeds = [0.5, 0.75, 1, 1.25, 1.5, 2];
    let speedIdx = 2; // default 1×

    // Garante que o vídeo nunca mostre controles nativos
    video.removeAttribute('controls');


    function fmtTime(s) {
      if (isNaN(s)) return '0:00';
      const h = Math.floor(s / 3600);
      const m = Math.floor((s % 3600) / 60);
      const sec = Math.floor(s % 60);
      if (h > 0) return `${h}:${String(m).padStart(2,'0')}:${String(sec).padStart(2,'0')}`;
      return `${m}:${String(sec).padStart(2,'0')}`;
    }

    document.addEventListener('mousemove', e => {
      cursor.style.left = e.clientX + 'px';
      cursor.style.top  = e.clientY + 'px';
    });

    function showControls() {
      player.classList.remove('controls-hidden');
      clearTimeout(controlsTimer);
      if (!video.paused) {
        controlsTimer = setTimeout(hideControls, 3000);
      }
    }

    function hideControls() {
      if (!isDragging && !qualityWrap.classList.contains('open') && !settingsWrap.classList.contains('open')) {
        player.classList.add('controls-hidden');
      }
    }

    player.addEventListener('mousemove', showControls);
    player.addEventListener('mouseleave', () => {
      if (!video.paused) hideControls();
    });


    const PLAY_SVG  = `<path d="M8 5v14l11-7z"/>`;
    const PAUSE_SVG = `<path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>`;

    function togglePlay() {
      if (video.paused) {
        video.play();
      } else {
        video.pause();
      }
    }

    video.addEventListener('play', () => {
      playIcon.innerHTML = PAUSE_SVG;
      player.classList.remove('is-paused');
      showControls();
      pulseCenter('pause');
    });

    video.addEventListener('pause', () => {
      playIcon.innerHTML = PLAY_SVG;
      player.classList.add('is-paused');
      showControls();
      pulseCenter('play');
    });

    // Botão play da barra de controles
    playBtn.addEventListener('click', e => {
      e.stopPropagation();
      togglePlay();
    });

    // Zona central da tela: play/pause
    tapCenter.addEventListener('click', e => {
      e.stopPropagation();
      togglePlay();
    });

    // Zona esquerda: retroceder 10s
    tapLeft.addEventListener('click', e => {
      e.stopPropagation();
      skipTime(-10);
    });

    // Zona direita: avançar 10s
    tapRight.addEventListener('click', e => {
      e.stopPropagation();
      skipTime(+10);
    });


    function pulseCenter(type) {
      centerIcon.innerHTML = type === 'play'
        ? `<path d="M8 5v14l11-7z"/>`
        : `<path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>`;
      centerFeedback.classList.remove('pop');
      void centerFeedback.offsetWidth; // reflow
      centerFeedback.classList.add('pop');
    }


    function skipTime(delta) {
      video.currentTime = Math.max(0, Math.min(video.duration || 0, video.currentTime + delta));
      const el = delta < 0 ? skipLeft : skipRight;
      el.classList.remove('show');
      void el.offsetWidth;
      el.classList.add('show');
    }

    rewindBtn.addEventListener('click',  e => { e.stopPropagation(); skipTime(-10); });
    forwardBtn.addEventListener('click', e => { e.stopPropagation(); skipTime(+10); });


    const VOL_HIGH = `<path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.8-1-3.3-2.5-4.1v8.2c1.5-.8 2.5-2.3 2.5-4.1zM14 3.2v2.1c2.9.9 5 3.6 5 6.7s-2.1 5.8-5 6.7v2.1c4-.9 7-4.5 7-8.8s-3-7.9-7-8.8z"/>`;
    const VOL_LOW  = `<path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.8-1-3.3-2.5-4.1v2.4c.9.6 1.5 1.6 1.5 2.8s-.6 2.2-1.5 2.8v2.4c1.5-.8 2.5-2.3 2.5-4.1z"/>`;
    const VOL_MUTE = `<path d="M16.5 12c0-1.8-1-3.3-2.5-4.1v2.4L16.5 12zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z"/>`;

    function updateVolIcon(vol, muted) {
      if (muted || vol === 0) volPath.setAttribute('d', VOL_MUTE.match(/d="([^"]+)"/)[1]);
      else if (vol < 0.5)    volPath.setAttribute('d', VOL_LOW.match(/d="([^"]+)"/)[1]);
      else                   volPath.setAttribute('d', VOL_HIGH.match(/d="([^"]+)"/)[1]);
    }

    muteBtn.addEventListener('click', e => {
      e.stopPropagation();
      video.muted = !video.muted;
      updateVolIcon(video.volume, video.muted);
    });

    volSlider.addEventListener('input', () => {
      video.volume = parseFloat(volSlider.value);
      video.muted = video.volume === 0;
      updateVolIcon(video.volume, video.muted);
      
      const pct = video.volume * 100;
      volSlider.style.background = `linear-gradient(to right, #38bdf8 ${pct}%, rgba(255,255,255,.25) ${pct}%)`;
    });


    volSlider.style.background = 'linear-gradient(to right, #38bdf8 100%, rgba(255,255,255,.25) 100%)';

    video.addEventListener('timeupdate', () => {
      if (isDragging) return;
      const pct = video.duration ? (video.currentTime / video.duration) * 100 : 0;
      progressFill.style.width  = pct + '%';
      progressThumb.style.left  = pct + '%';
      currentTimeEl.textContent = fmtTime(video.currentTime);
      checkNextCard();
    });

    video.addEventListener('progress', () => {
      if (video.buffered.length > 0) {
        const buffered = (video.buffered.end(video.buffered.length - 1) / video.duration) * 100;
        progressBuf.style.width = buffered + '%';
      }
    });

    video.addEventListener('loadedmetadata', () => {
      durationEl.textContent = fmtTime(video.duration);
    });

  
    progressWrap.addEventListener('mousemove', e => {
      const rect = progressWrap.querySelector('.progress-track').getBoundingClientRect();
      const pct  = Math.max(0, Math.min(1, (e.clientX - rect.left) / rect.width));
      const t    = pct * (video.duration || 0);
      progressTip.textContent = fmtTime(t);
      progressTip.style.left  = (pct * 100) + '%';
    });

    function seekTo(e) {
      const rect = progressWrap.querySelector('.progress-track').getBoundingClientRect();
      const pct  = Math.max(0, Math.min(1, (e.clientX - rect.left) / rect.width));
      video.currentTime = pct * (video.duration || 0);
      progressFill.style.width = (pct * 100) + '%';
      progressThumb.style.left = (pct * 100) + '%';
    }

    progressWrap.addEventListener('mousedown', e => {
      e.stopPropagation();
      isDragging = true;
      progressWrap.classList.add('dragging');
      seekTo(e);
    });

    document.addEventListener('mousemove', e => {
      if (!isDragging) return;
      seekTo(e);
    });

    document.addEventListener('mouseup', () => {
      if (isDragging) {
        isDragging = false;
        progressWrap.classList.remove('dragging');
      }
    });

    progressWrap.addEventListener('touchstart', e => {
      e.stopPropagation();
      isDragging = true;
      seekTo(e.touches[0]);
    }, { passive: true });
    document.addEventListener('touchmove', e => {
      if (!isDragging) return;
      seekTo(e.touches[0]);
    }, { passive: true });
    document.addEventListener('touchend', () => { isDragging = false; });


    video.addEventListener('waiting', () => spinner.classList.add('visible'));
    video.addEventListener('playing', () => spinner.classList.remove('visible'));
    video.addEventListener('canplay', () => spinner.classList.remove('visible'));


    const FS_EXPAND   = `<path d="M8 3H5a2 2 0 00-2 2v3M21 8V5a2 2 0 00-2-2h-3M16 21h3a2 2 0 002-2v-3M3 16v3a2 2 0 002 2h3"/>`;
    const FS_CONTRACT = `<path d="M8 3v3a2 2 0 01-2 2H3M21 8h-3a2 2 0 01-2-2V3M3 16h3a2 2 0 012 2v3M16 21v-3a2 2 0 012-2h3"/>`;

    function isFullscreen() {
      return !!(document.fullscreenElement || document.webkitFullscreenElement);
    }

    fsBtn.addEventListener('click', e => {
      e.stopPropagation();
      if (!isFullscreen()) {
        (player.requestFullscreen || player.webkitRequestFullscreen).call(player);
      } else {
        (document.exitFullscreen || document.webkitExitFullscreen).call(document);
      }
    });

    document.addEventListener('fullscreenchange', updateFsIcon);
    document.addEventListener('webkitfullscreenchange', updateFsIcon);

    function updateFsIcon() {
      fsIcon.innerHTML = isFullscreen() ? FS_CONTRACT : FS_EXPAND;
      fsBtn.setAttribute('data-tip', isFullscreen() ? 'Sair (F)' : 'Tela cheia (F)');
    }

    qualityBtn.addEventListener('click', e => {
      e.stopPropagation();
      qualityWrap.classList.toggle('open');
      settingsWrap.classList.remove('open');
    });

    qualityMenu.querySelectorAll('.quality-item').forEach(item => {
      item.addEventListener('click', e => {
        e.stopPropagation();
        qualityMenu.querySelectorAll('.quality-item').forEach(i => i.classList.remove('active'));
        item.classList.add('active');
        qualityBtn.textContent = item.dataset.q;
        qualityWrap.classList.remove('open');
      });
    });

    captionsBtn.addEventListener('click', e => {
      e.stopPropagation();
      captionsOn = !captionsOn;
      captionsBtn.classList.toggle('captions-on', captionsOn);
      captionsBtn.setAttribute('data-tip', captionsOn ? 'Legendas: ON (C)' : 'Legendas: OFF (C)');
    });

    settingsBtn.addEventListener('click', e => {
      e.stopPropagation();
      settingsWrap.classList.toggle('open');
      qualityWrap.classList.remove('open');
    });

    speedItem.addEventListener('click', e => {
      e.stopPropagation();
      speedIdx = (speedIdx + 1) % speeds.length;
      video.playbackRate = speeds[speedIdx];
      speedVal.textContent = speeds[speedIdx] + '×';
    });

    autoplayItem.addEventListener('click', e => {
      e.stopPropagation();
      autoplayOn = !autoplayOn;
      autoplayVal.textContent = autoplayOn ? 'Ativado' : 'Desativado';
    });

    document.addEventListener('click', () => {
      qualityWrap.classList.remove('open');
      settingsWrap.classList.remove('open');
    });

    const NEXT_TRIGGER = 15;

    function checkNextCard() {
      if (!nextCard || !video.duration || nextCardDismissed || !autoplayOn) return;
      const remaining = video.duration - video.currentTime;
      if (remaining <= NEXT_TRIGGER && remaining > 0) {
        showNextCard(remaining);
      } else {
        hideNextCard();
      }
    }

    function showNextCard(remaining) {
      if (!nextCard) return;
      if (!nextCard.classList.contains('visible')) {
        nextCard.classList.add('visible');
      }
      const pct = (remaining / NEXT_TRIGGER) * 100;
      if (countdownArc) countdownArc.style.strokeDasharray = `${pct} 100`;
      if (countdownNum) countdownNum.textContent = Math.ceil(remaining);
    }

    function hideNextCard() {
      if (!nextCard) return;
      nextCard.classList.remove('visible');
      clearInterval(countdownTimer);
    }

    if (nextDismissBtn) {
      nextDismissBtn.addEventListener('click', e => {
        e.stopPropagation();
        nextCardDismissed = true;
        hideNextCard();
      });
    }

    const nextVideo = "player.php?trackid=<?php echo isset($dadosprox['id']) ? $dadosprox['id'] : ''; ?>";

    if (nextPlayBtn) {
      nextPlayBtn.addEventListener('click', e => {
        e.stopPropagation();
        if (nextVideo) window.location.href = nextVideo;
      });
    }

    video.addEventListener('ended', () => {
      if (autoplayOn && !nextCardDismissed && nextVideo) {
        window.location.href = nextVideo;
      }
    });


    document.addEventListener('keydown', e => {
      const tag = document.activeElement.tagName;
      if (tag === 'INPUT' || tag === 'TEXTAREA') return;

      switch (e.key) {
        case ' ':
        case 'k':
          e.preventDefault();
          togglePlay();
          break;
        case 'ArrowLeft':
          e.preventDefault();
          skipTime(-10);
          break;
        case 'ArrowRight':
          e.preventDefault();
          skipTime(+10);
          break;
        case 'ArrowUp':
          e.preventDefault();
          video.volume = Math.min(1, video.volume + 0.1);
          volSlider.value = video.volume;
          volSlider.dispatchEvent(new Event('input'));
          break;
        case 'ArrowDown':
          e.preventDefault();
          video.volume = Math.max(0, video.volume - 0.1);
          volSlider.value = video.volume;
          volSlider.dispatchEvent(new Event('input'));
          break;
        case 'f':
        case 'F':
          fsBtn.click();
          break;
        case 'm':
        case 'M':
          muteBtn.click();
          break;
        case 'c':
        case 'C':
          captionsBtn.click();
          break;
        case 's':
        case 'S':
          settingsBtn.click();
          break;
      }
      showControls();
    });


    showControls();

    video.muted = false;
    player.addEventListener('contextmenu', e => e.preventDefault());
    video.addEventListener('dragstart', e => e.preventDefault());
    document.addEventListener('keydown', e => {
      if ((e.ctrlKey || e.metaKey) && ['s','S','u','U'].includes(e.key)) {
        e.preventDefault();
      }
    });
    function salvarProgresso() {
      const dados = new FormData();
        dados.append('tempo_atual', video.currentTime);
        dados.append('tempo_total', video.duration || 0);
        dados.append('trackid', <?php echo $trackid?>);
        const ok = navigator.sendBeacon('functions/savetime.php', dados);
        console.log('sendBeacon enviou:', ok);
      }

      window.addEventListener('beforeunload', salvarProgresso);
      window.addEventListener('pagehide', salvarProgresso);
      
        const ultimaposicao = <?php echo json_encode($ultimaposicao); ?>;

        if(ultimaposicao) {
          if(video.readyState >= 1) {
            // metadados já carregaram, seta direto
            video.currentTime = parseFloat(ultimaposicao);
          } else {
            // ainda não carregou, espera o evento
            video.addEventListener('loadedmetadata', () => {
              video.currentTime = parseFloat(ultimaposicao);
            });
          }
        }
  </script>
</body>
</html>