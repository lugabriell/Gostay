<?php
session_start();

if (!isset($_SESSION['autorizado']) || $_SESSION['autorizado'] !== 'sim') {
    header("Location: demo.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --azul: #4169E1;
            --azul-escuro: #2a4bc7;
            --azul-fundo: #0d1b4b;
            --mostarda: #E8B400;
            --mostarda-hover: #d4a500;
            --texto: #f0f4ff;
            --texto-secundario: #8fa3d4;
        }

        body {
            background: var(--azul-fundo);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .container {
            width: 100%;
            max-width: 860px;
        }

        .label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--mostarda);
            margin-bottom: 10px;
        }

        .title {
            font-size: 22px;
            font-weight: 600;
            color: var(--texto);
            margin-bottom: 24px;
        }

        /* Wrapper do player */
        .player-wrap {
            position: relative;
            background: #000;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 0 1.5px rgba(65,105,225,0.25), 0 24px 60px rgba(0,0,0,0.6);
        }

        video {
            width: 100%;
            display: block;
            border-radius: 12px;
            /* Impede download via arrastar */
            pointer-events: none;
        }

        /* Overlay invisível para bloquear clique direito visualmente */
        .overlay {
            position: absolute;
            inset: 0;
            z-index: 2;
            border-radius: 12px;
        }

        /* Controles customizados */
        .controls {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 3;
            padding: 32px 20px 16px;
            background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, transparent 100%);
            border-radius: 0 0 12px 12px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            opacity: 0;
            transition: opacity 0.25s ease;
        }

        .player-wrap:hover .controls {
            opacity: 1;
        }

        /* Barra de progresso */
        .progress-wrap {
            width: 100%;
            height: 4px;
            background: rgba(255,255,255,0.2);
            border-radius: 99px;
            cursor: pointer;
            position: relative;
        }

        .progress-fill {
            height: 100%;
            background: var(--mostarda);
            border-radius: 99px;
            width: 0%;
            transition: width 0.1s linear;
            pointer-events: none;
        }

        .progress-wrap:hover .progress-fill {
            background: var(--mostarda-hover);
        }

        /* Linha de controles */
        .controls-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .controls-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-ctrl {
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--texto);
            opacity: 0.9;
            transition: opacity 0.15s, transform 0.15s;
        }

        .btn-ctrl:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        .btn-play {
            width: 36px;
            height: 36px;
            background: var(--mostarda);
            border-radius: 50%;
            color: #000;
            opacity: 1;
        }

        .btn-play:hover {
            background: var(--mostarda-hover);
            transform: scale(1.08);
        }

        .time {
            font-size: 12px;
            color: var(--texto-secundario);
            font-variant-numeric: tabular-nums;
        }

        /* Volume */
        .volume-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .volume-slider {
            -webkit-appearance: none;
            width: 70px;
            height: 3px;
            border-radius: 99px;
            background: rgba(255,255,255,0.2);
            outline: none;
            cursor: pointer;
        }

        .volume-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--mostarda);
            cursor: pointer;
        }

        /* Badge de acesso */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 500;
            color: var(--mostarda);
            background: rgba(232,180,0,0.1);
            border: 1px solid rgba(232,180,0,0.2);
            border-radius: 99px;
            padding: 4px 10px;
            margin-top: 16px;
        }

        .badge svg {
            flex-shrink: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <p class="label">Reprodutor</p>
    <h1 class="title">teste.mp4</h1>

    <div class="player-wrap" id="playerWrap">
        <video id="video" preload="metadata">
            <source src="video.php" type="video/mp4">
            Seu navegador não suporta reprodução de vídeo.
        </video>

        <!-- Overlay bloqueia clique direito e arrastar -->
        <div class="overlay" id="overlay"></div>

        <!-- Controles -->
        <div class="controls" id="controls">
            <div class="progress-wrap" id="progressWrap">
                <div class="progress-fill" id="progressFill"></div>
            </div>

            <div class="controls-row">
                <div class="controls-left">
                    <button class="btn-ctrl btn-play" id="btnPlay" title="Play / Pause">
                        <svg id="iconPlay" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                            <polygon points="5,3 19,12 5,21"/>
                        </svg>
                        <svg id="iconPause" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" style="display:none">
                            <rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/>
                        </svg>
                    </button>

                    <div class="volume-wrap">
                        <button class="btn-ctrl" id="btnMute" title="Mudo">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="11,5 6,9 2,9 2,15 6,15 11,19"/>
                                <path id="volumeLine" d="M15.54 8.46a5 5 0 0 1 0 7.07M19.07 4.93a10 10 0 0 1 0 14.14"/>
                            </svg>
                        </button>
                        <input type="range" class="volume-slider" id="volumeSlider" min="0" max="1" step="0.05" value="1">
                    </div>

                    <span class="time" id="timeDisplay">0:00 / 0:00</span>
                </div>

                <button class="btn-ctrl" id="btnFullscreen" title="Tela cheia">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15,3 21,3 21,9"/><polyline points="9,21 3,21 3,15"/>
                        <line x1="21" y1="3" x2="14" y2="10"/><line x1="3" y1="21" x2="10" y2="14"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="badge">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
        </svg>
        Acesso autenticado · download desativado
    </div>
</div>

<script>
    const video        = document.getElementById('video');
    const btnPlay      = document.getElementById('btnPlay');
    const iconPlay     = document.getElementById('iconPlay');
    const iconPause    = document.getElementById('iconPause');
    const progressFill = document.getElementById('progressFill');
    const progressWrap = document.getElementById('progressWrap');
    const timeDisplay  = document.getElementById('timeDisplay');
    const volumeSlider = document.getElementById('volumeSlider');
    const btnMute      = document.getElementById('btnMute');
    const btnFullscreen= document.getElementById('btnFullscreen');
    const overlay      = document.getElementById('overlay');

    // Bloqueia clique direito em toda a página
    document.addEventListener('contextmenu', e => e.preventDefault());

    // Bloqueia atalhos de teclado para salvar
    document.addEventListener('keydown', e => {
        if ((e.ctrlKey || e.metaKey) && ['s','u'].includes(e.key.toLowerCase())) {
            e.preventDefault();
        }
    });

    // Overlay captura clique pra dar play/pause sem expor o vídeo
    overlay.addEventListener('click', togglePlay);

    // Play / Pause
    btnPlay.addEventListener('click', togglePlay);

    function togglePlay() {
        if (video.paused) {
            video.play();
            iconPlay.style.display  = 'none';
            iconPause.style.display = 'block';
        } else {
            video.pause();
            iconPlay.style.display  = 'block';
            iconPause.style.display = 'none';
        }
    }

    // Progresso
    video.addEventListener('timeupdate', () => {
        if (!video.duration) return;
        const pct = (video.currentTime / video.duration) * 100;
        progressFill.style.width = pct + '%';
        timeDisplay.textContent  = formatTime(video.currentTime) + ' / ' + formatTime(video.duration);
    });

    progressWrap.addEventListener('click', e => {
        const rect = progressWrap.getBoundingClientRect();
        const pct  = (e.clientX - rect.left) / rect.width;
        video.currentTime = pct * video.duration;
    });

    // Volume
    volumeSlider.addEventListener('input', () => {
        video.volume = volumeSlider.value;
        video.muted  = video.volume === 0;
    });

    btnMute.addEventListener('click', () => {
        video.muted     = !video.muted;
        volumeSlider.value = video.muted ? 0 : video.volume || 1;
    });

    // Fullscreen
    btnFullscreen.addEventListener('click', () => {
        const wrap = document.getElementById('playerWrap');
        if (!document.fullscreenElement) {
            wrap.requestFullscreen();
        } else {
            document.exitFullscreen();
        }
    });

    // Formata segundos em m:ss
    function formatTime(s) {
        const m = Math.floor(s / 60);
        const sec = Math.floor(s % 60).toString().padStart(2, '0');
        return m + ':' + sec;
    }

    // Ao terminar, volta ao ícone de play
    video.addEventListener('ended', () => {
        iconPlay.style.display  = 'block';
        iconPause.style.display = 'none';
    });
</script>

</body>
</html>