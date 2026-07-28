<?php
require_once __DIR__ . "/connection.php";
require_once __DIR__ . "/functions/headers.php";
require_once __DIR__ . "/functions/sessions.php";
$_SESSION['tokenn1'] = bin2hex(random_bytes(32));
$sql = "SELECT posterft, nome, cargahoraria FROM curso ORDER BY id DESC";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$posteraula = [];
$nome = [];
$cargahoraria = [];
$i = 0;
while(($row = $result->fetch_assoc()) && $i<9){
  $posteraula[$i] = $row['posterft'];
  $nome[$i] = $row['nome'];
  $cargahoraria[$i] = $row['cargahoraria'];
  $i++;
}



?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GoStay Educação – Educação Que Transforma Carreiras</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
   <?php require_once __DIR__ . '/functions/analytics.php'; ?>
  <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">
  <link href="https://fonts.googleapis.com/css2?family=Josefin Sans:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet" />
  <style>
    :root {
      --navy-deep:   #050d1a;
      --navy-mid:    #071428;
      --navy-card:   #0b1c35;
      --navy-border: #122040;
      --blue-accent: #1a5cff;
      --blue-glow:   rgba(26, 92, 255, 0.18);
      --gold:        #f5c400;
      --gold-dark:   #c99a00;
      --white:       #ffffff;
      --white-80:    rgba(255,255,255,0.8);
      --white-40:    rgba(255,255,255,0.4);
      --white-10:    rgba(255,255,255,0.07);
      --text-body:   #afc0d8;
      --radius-card: 16px;
      --transition:  0.3s cubic-bezier(.4,0,.2,1);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--navy-deep);
      color: var(--white);
      overflow-x: hidden;
      line-height: 1.6;
    }

    img { display: block; width: 100%; object-fit: cover; }

    a { text-decoration: none; color: inherit; }

    .container {
      width: min(1200px, 92vw);
      margin: 0 auto;
    }

    .section-label {
      font-family: 'Josefin Sans', sans-serif;
      font-size: 0.7rem;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: var(--blue-accent);
      margin-bottom: 12px;
    }

    .section-title {
      font-family: 'Josefin Sans', sans-serif;
      font-weight: 800;
      font-size: clamp(1.8rem, 4vw, 3rem);
      line-height: 1.15;
    }

    .section-subtitle {
      color: var(--text-body);
      font-size: 1rem;
      max-width: 520px;
      margin-top: 12px;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 13px 30px;
      border-radius: 999px;
      font-family: 'DM Sans', sans-serif;
      font-weight: 500;
      font-size: 0.95rem;
      cursor: pointer;
      transition: var(--transition);
      border: none;
    }

    .btn-gold {
      background: var(--gold);
      color: var(--navy-deep);
    }
    .btn-gold:hover {
      background: var(--gold-dark);
      transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(245,196,0,0.35);
    }

    .btn-outline {
      background: transparent;
      color: var(--white);
      border: 1.5px solid var(--white-40);
    }
    .btn-outline:hover {
      border-color: var(--white-80);
      background: var(--white-10);
    }

    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 0;
      opacity: 0.6;
    }

    header {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 100;
      padding: 14px 0;
      background: rgba(5, 13, 26, 0.75);
      backdrop-filter: blur(16px);
      border-bottom: 1px solid var(--navy-border);
    }

    .nav-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .nav-logo {
      font-family: 'Josefin Sans', sans-serif;
      font-weight: 800;
      font-size: 1.45rem;
      letter-spacing: -0.02em;
    }

    .nav-logo span.go { color: var(--blue-accent); }
    .nav-logo span.stay { color: var(--white); }

    nav ul {
      display: flex;
      list-style: none;
      gap: 32px;
    }

    nav ul li a {
      font-size: 0.9rem;
      color: var(--white-80);
      transition: color var(--transition);
    }
    nav ul li a:hover { color: var(--white); }

    .nav-actions { display: flex; gap: 10px; }

    .hamburger {
      display: none;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
      padding: 4px;
    }
    .hamburger span {
      display: block;
      width: 24px; height: 2px;
      background: var(--white);
      border-radius: 2px;
      transition: var(--transition);
    }

    .hero {
      position: relative;
      min-height: 100vh;
      display: flex;
      align-items: center;
      padding-top: 80px;
      overflow: hidden;
      background-image: url('assets/fundoCorrigido.png');
      background-size: cover;
      background-position: center;
    }

    /* Bottom fade */
    .hero-fade {
      position: absolute;
      bottom: 0; left: 0; right: 0;
      height: 160px;
      background: linear-gradient(to bottom, transparent, var(--navy-deep));
      z-index: 2;
    }

    .hero-content {
      position: relative;
      z-index: 3;
    }

    .hero-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--white-10);
      border: 1px solid var(--navy-border);
      border-radius: 999px;
      padding: 6px 16px;
      font-size: 0.78rem;
      color: var(--text-body);
      margin-bottom: 24px;
    }

    .hero-eyebrow .dot {
      width: 6px; height: 6px;
      border-radius: 50%;
      background: var(--gold);
    }

    .hero-heading {
      font-family: 'Josefin Sans', sans-serif;
      font-weight: 800;
      font-size: /*clamp(2.6rem, 6vw, 4.8rem)*/ 5rem;
      line-height: 1.08;
      letter-spacing: -0.03em;
      margin-bottom: 20px;
    }

    .hero-heading em {
      font-style: normal;
      color: var(--gold);
    }

    .hero-desc {
      color: var(--text-body);
      font-size: 1.05rem;
      max-width: 480px;
      margin-bottom: 36px;
    }

    .hero-actions { display: flex; gap: 12px; flex-wrap: wrap; }


    .section-planos {
      padding: 100px 0;
      background: linear-gradient(180deg, var(--navy-deep) 0%, var(--navy-mid) 100%);
      position: relative;
      z-index: 1;
    }

    .planos-header {
      text-align: center;
      margin-bottom: 60px;
    }

    .planos-grid {
      display: grid;
      grid-template-columns: 1fr 1.18fr 1fr;
      gap: 20px;
      align-items: center;
    }

    .plan-card {
      background: var(--navy-card);
      border: 1.5px solid var(--navy-border);
      border-radius: var(--radius-card);
      padding: 36px 28px;
      display: flex;
      flex-direction: column;
      gap: 18px;
      transition: var(--transition);
      cursor: pointer;
      position: relative;
      overflow: hidden;
    }

    .plan-card::before {
      content: '';
      position: absolute;
      inset: 0;
      background: radial-gradient(ellipse at 50% 0%, var(--blue-glow), transparent 70%);
      opacity: 0;
      transition: opacity var(--transition);
    }

    .plan-card:hover::before,
    .plan-card.featured::before { opacity: 1; }

    .plan-card:hover {
      border-color: var(--blue-accent);
      transform: translateY(-6px) scale(1.02);
      box-shadow: 0 24px 60px rgba(26,92,255,0.2);
    }

    .plan-card.featured {
      border-color: var(--gold);
      transform: scale(1.04);
      box-shadow: 0 0 0 1px var(--gold), 0 24px 60px rgba(245,196,0,0.15);
    }

    .plan-card.featured::before {
      background: radial-gradient(ellipse at 50% 0%, rgba(245,196,0,0.12), transparent 70%);
    }

    .plan-card.featured:hover {
      transform: scale(1.04) translateY(-4px);
    }

    .plan-badge {
      display: inline-flex;
      align-self: flex-start;
      padding: 4px 12px;
      border-radius: 999px;
      font-size: 0.72rem;
      font-weight: 600;
      letter-spacing: 0.05em;
      text-transform: uppercase;
    }

    .badge-basic  { background: var(--white-10); color: var(--text-body); border: 1px solid var(--navy-border); }
    .badge-max    { background: rgba(245,196,0,0.15); color: var(--gold); border: 1px solid rgba(245,196,0,0.3); }
    .badge-pro    { background: rgba(26,92,255,0.15); color: #7aabff; border: 1px solid rgba(26,92,255,0.3); }

    .plan-name {
      font-family: 'Josefin Sans', sans-serif;
      font-weight: 700;
      font-size: 1.4rem;
    }

    .plan-desc {
      color: var(--text-body);
      font-size: 0.9rem;
      line-height: 1.5;
    }

    .plan-features {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .plan-features li {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 0.875rem;
      color: var(--white-80);
    }

    .plan-features li::before {
      content: '';
      width: 16px; height: 16px; flex-shrink: 0;
      border-radius: 50%;
      background: var(--white-10);
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 16 16' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M3.5 8l3 3 6-6' stroke='%23afc0d8' stroke-width='1.5' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: center;
    }

    .plan-features.gold li::before { background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 16 16' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M3.5 8l3 3 6-6' stroke='%23f5c400' stroke-width='1.5' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E"); }

    .plan-cta {
      margin-top: auto;
    }

    .plan-cta .btn {
      width: 100%;
      justify-content: center;
    }

    .gostay-note {
      text-align: center;
      margin-top: 32px;
      font-size: 0.9rem;
      color: var(--text-body);
    }

    .gostay-note strong {
      color: var(--white);
    }

    .gostay-note .go { color: var(--blue-accent); font-weight: 700; }

    .section-carrossel {
      padding: 80px 0;
      overflow: hidden;
      background: var(--navy-mid);
      position: relative;
      z-index: 1;
    }

    .carrossel-track-wrapper {
      position: relative;
      overflow: hidden;
    }

    .carrossel-track-wrapper::before,
    .carrossel-track-wrapper::after {
      content: '';
      position: absolute;
      top: 0; bottom: 0;
      width: 120px;
      z-index: 2;
      pointer-events: none;
    }

    .carrossel-track-wrapper::before {
      left: 0;
      background: linear-gradient(to right, var(--navy-mid), transparent);
    }

    .carrossel-track-wrapper::after {
      right: 0;
      background: linear-gradient(to left, var(--navy-mid), transparent);
    }

    .carrossel-track {
      display: flex;
      gap: 20px;
      animation: scroll-left 28s linear infinite;
      width: max-content;
    }

    .carrossel-track:hover { animation-play-state: paused; }

    @keyframes scroll-left {
      0%   { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }

    .carrossel-slide {
      width: 280px;
      height: 180px;
      border-radius: 12px;
      background: var(--navy-card);
      border: 1px solid var(--navy-border);
      flex-shrink: 0;
      overflow: hidden;
      position: relative;
      transition: var(--transition);
    }

    .carrossel-slide:hover {
      border-color: var(--blue-accent);
      transform: scale(1.03);
    }

    /* Colored placeholder slides */
    .carrossel-slide:nth-child(odd)  { background: linear-gradient(135deg, #0d1f30, #1a2a3a); }
    .carrossel-slide:nth-child(even) { background: linear-gradient(135deg, #0b1828, #162030); }

    .slide-inner {
      width: 100%; height: 100%;
      display: flex;
      align-items: flex-end;
      padding: 16px;
      background: linear-gradient(to top, rgba(5,13,26,0.8) 0%, transparent 60%);
    }

    .slide-tag {
      background: var(--white-10);
      border: 1px solid var(--navy-border);
      border-radius: 999px;
      padding: 4px 12px;
      font-size: 0.72rem;
      color: var(--white-80);
    }

    .section-cursos {
      padding: 100px 0;
      background: linear-gradient(180deg, var(--navy-mid) 0%, var(--navy-deep) 100%);
      position: relative;
      z-index: 1;
    }

    .cursos-header {
      margin-bottom: 48px;
    }

    .cursos-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-template-rows: auto auto;
      gap: 16px;
    }

    /* Featured top row: spans all 3 cols */
    .curso-card-hero {
      grid-column: 1 / -1;
    }

    .curso-card {
      background: var(--navy-card);
      border: 1px solid var(--navy-border);
      border-radius: var(--radius-card);
      overflow: hidden;
      transition: var(--transition);
      cursor: pointer;
    }

    .curso-card:hover {
      border-color: var(--blue-accent);
      transform: translateY(-4px);
      box-shadow: 0 16px 40px rgba(26,92,255,0.15);
    }

    .curso-thumb {
      background: linear-gradient(135deg, #0d1f30, #1a2a3a);
      position: relative;
      overflow: hidden;
    }

    .curso-thumb-hero { height: 220px; }
    .curso-thumb-sm   { height: 150px; }

    .curso-thumb-placeholder {
      width: 100%; height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--white-10);
    }

    .curso-thumb-placeholder svg { width: 48px; height: 48px; opacity: 0.3; }

    .curso-body {
      padding: 20px;
    }

    .curso-tag {
      font-size: 0.72rem;
      color: var(--blue-accent);
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      margin-bottom: 8px;
    }

    .curso-name {
      font-family: 'Josefin Sans', sans-serif;
      font-weight: 700;
      font-size: 1rem;
      line-height: 1.3;
      margin-bottom: 6px;
    }

    .curso-meta {
      font-size: 0.8rem;
      color: var(--text-body);
    }

    .section-porque {
      padding: 100px 0;
      background: var(--navy-deep);
      position: relative;
      z-index: 1;
    }

    .porque-header {
      text-align: center;
      margin-bottom: 64px;
    }

    .porque-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      margin-bottom: 20px;
    }

    .porque-row2 {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
    }

    .porque-card {
      background: var(--navy-card);
      border: 1px solid var(--navy-border);
      border-radius: var(--radius-card);
      padding: 32px 28px;
      transition: var(--transition);
      position: relative;
      overflow: hidden;
    }

    .porque-card::after {
      content: '';
      position: absolute;
      bottom: 0; left: 0; right: 0;
      height: 3px;
      background: linear-gradient(to right, var(--blue-accent), var(--gold));
      opacity: 0;
      transition: opacity var(--transition);
    }

    .porque-card:hover { border-color: var(--navy-border); transform: translateY(-4px); }
    .porque-card:hover::after { opacity: 1; }

    .porque-icon {
      width: 48px; height: 48px;
      border-radius: 12px;
      background: var(--white-10);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      font-size: 1.3rem;
    }

    .porque-card-title {
      font-family: 'Josefin Sans', sans-serif;
      font-weight: 700;
      font-size: 1rem;
      margin-bottom: 10px;
    }

    .porque-card-desc {
      font-size: 0.875rem;
      color: var(--text-body);
      line-height: 1.6;
    }

    /* Image placeholders in porque section */
    .porque-img-card {
      background: linear-gradient(135deg, #0d1f30, #1a2a3a);
      height: 220px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--white-10);
      border-radius: 8px;
      overflow: hidden;
      height: 140px;   
    }
    
    .porque-img-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .porque-img-card svg { width: 48px; height: 48px; opacity: 0.25; }

    .section-cta {
      padding: 100px 0;
      background: linear-gradient(180deg, var(--navy-deep) 0%, var(--navy-mid) 100%);
      text-align: center;
      position: relative;
      z-index: 1;
      overflow: hidden;
    }

    .cta-glow {
      position: absolute;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      width: 600px; height: 300px;
      background: radial-gradient(ellipse, rgba(26,92,255,0.12) 0%, transparent 70%);
      pointer-events: none;
    }

    .section-cta .section-title { margin-bottom: 32px; position: relative; z-index: 1; }
    .section-cta .btn { position: relative; z-index: 1; }

    .divider-line {
      width: min(540px, 90%);
      height: 1px;
      background: var(--navy-border);
      margin: 60px auto 0;
    }

    .section-faq {
      padding: 100px 0;
      background: var(--navy-mid);
      position: relative;
      z-index: 1;
    }

    .faq-layout {
      display: grid;
      grid-template-columns: 1fr 1.6fr;
      gap: 80px;
      align-items: start;
    }

    .faq-left .section-title { margin-bottom: 16px; }

    .faq-logo {
      font-family: 'Josefin Sans', sans-serif;
      font-weight: 800;
      font-size: 2.8rem;
      letter-spacing: -0.03em;
      margin-top: 36px;
    }

    .faq-logo .go   { color: var(--blue-accent); }
    .faq-logo .stay { color: var(--white); }

    .faq-list { display: flex; flex-direction: column; gap: 0; }

    .faq-item {
      border-bottom: 1px solid var(--navy-border);
    }

    .faq-question {
      width: 100%;
      background: none;
      border: none;
      color: var(--white);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.95rem;
      font-weight: 500;
      text-align: left;
      padding: 22px 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      cursor: pointer;
      gap: 16px;
      transition: color var(--transition);
    }

    .faq-question:hover { color: var(--gold); }

    .faq-icon {
      width: 28px; height: 28px; flex-shrink: 0;
      border-radius: 50%;
      border: 1.5px solid var(--navy-border);
      display: flex; align-items: center; justify-content: center;
      transition: var(--transition);
    }

    .faq-icon svg {
      width: 12px; height: 12px;
      transition: transform var(--transition);
    }

    .faq-item.open .faq-icon {
      background: var(--gold);
      border-color: var(--gold);
    }

    .faq-item.open .faq-icon svg {
      transform: rotate(180deg);
    }

    .faq-answer {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s ease, padding 0.3s ease;
    }

    .faq-answer-inner {
      padding-bottom: 20px;
      font-size: 0.9rem;
      color: var(--text-body);
      line-height: 1.7;
    }

    .faq-item.open .faq-answer {
      max-height: 300px;
    }

    footer {
      background: var(--navy-deep);
      border-top: 1px solid var(--navy-border);
      padding: 64px 0 32px;
      position: relative;
      z-index: 1;
    }

    .footer-top {
      display: grid;
      grid-template-columns: 1.4fr 1fr 1fr 1fr;
      gap: 48px;
      padding-bottom: 48px;
      border-bottom: 1px solid var(--navy-border);
    }

    .footer-brand .logo {
      font-family: 'Josefin Sans', sans-serif;
      font-weight: 800;
      font-size: 1.6rem;
      margin-bottom: 14px;
    }

    .footer-brand .logo .go   { color: var(--blue-accent); }
    .footer-brand .logo .stay { color: var(--white); }

    .footer-brand p {
      font-size: 0.875rem;
      color: var(--text-body);
      line-height: 1.6;
      max-width: 220px;
      margin-bottom: 24px;
    }

    .social-links {
      display: flex;
      gap: 10px;
    }

    .social-link {
      width: 36px; height: 36px;
      border-radius: 8px;
      background: var(--white-10);
      border: 1px solid var(--navy-border);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.8rem;
      color: var(--white-80);
      transition: var(--transition);
    }

    .social-link:hover {
      background: var(--blue-accent);
      border-color: var(--blue-accent);
      color: var(--white);
    }

    .footer-col h4 {
      font-family: 'Josefin Sans', sans-serif;
      font-weight: 600;
      font-size: 0.85rem;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      color: var(--gold);
      margin-bottom: 20px;
    }

    .footer-col ul {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .footer-col ul li a {
      font-size: 0.875rem;
      color: var(--text-body);
      transition: color var(--transition);
    }

    .footer-col ul li a:hover { color: var(--white); }

    .footer-bottom {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding-top: 28px;
      font-size: 0.8rem;
      color: var(--white-40);
    }

    .reveal {
      opacity: 0;
      transform: translateY(28px);
      transition: opacity 0.65s ease, transform 0.65s ease;
    }

    .reveal.visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* =============================
       RESPONSIVE
    ============================= */
    @media (max-width: 900px) {
      nav ul, .nav-actions { display: none; }
      nav ul.open { display: flex; flex-direction: column; position: fixed; inset: 64px 0 0 0; background: rgba(5,13,26,0.97); padding: 32px; gap: 24px; z-index: 99; }
      .hamburger { display: flex; }

      .planos-grid { grid-template-columns: 1fr; }
      .plan-card.featured { transform: none; }
      .plan-card.featured:hover { transform: translateY(-4px); }

      .cursos-grid {
        grid-template-columns: 1fr;
      }
      .curso-card-hero { grid-column: 1; }

      .porque-grid, .porque-row2 { grid-template-columns: 1fr 1fr; }

      .faq-layout {
        grid-template-columns: 1fr;
        gap: 40px;
      }

      .footer-top {
        grid-template-columns: 1fr 1fr;
        gap: 32px;
      }

      .hero-brand { display: none; }
    }

    @media (max-width: 600px) {
      .porque-grid, .porque-row2 { grid-template-columns: 1fr; }
      .footer-top { grid-template-columns: 1fr; }
      .footer-bottom { flex-direction: column; gap: 8px; text-align: center; }
      .hero-actions { flex-direction: column; align-items: flex-start; }
    }
  </style>
</head>
<body>

  <header>
    <div class="container nav-inner">
      <div class="nav-logo">
        <span class="go">Go</span><span class="stay">Stay</span>
      </div>
      <nav>
        <ul id="nav-menu">
          <li><a href="#cursos">Cursos</a></li>
          <li><a href="#metodologia">Metodologia</a></li>
          <li><a href="#certificados">Certificados</a></li>
        </ul>
      </nav>
      <div class="nav-actions">
        <a href="login.php" class="btn btn-outline" style="padding:10px 22px;font-size:.85rem;">Entrar</a>
        <a href="formAluno.php" class="btn btn-gold" style="padding:10px 22px;font-size:.85rem;">Registro</a>
      </div>
      <div class="hamburger" id="hamburger" aria-label="Menu" role="button" tabindex="0">
        <span></span><span></span><span></span>
      </div>
    </div>
  </header>

  <section class="hero" aria-label="Hero">
    <!-- Mosaic background tiles -->
    <div class="hero-overlay" aria-hidden="true"></div>
    <div class="hero-fade"    aria-hidden="true"></div>

    <div class="container hero-content">
      
      <h1 class="hero-heading"> 
        Educação<br>
        <em>Que Transforma<br>Carreiras</em>
      </h1>
      <p class="hero-desc">
        Cursos práticos com metodologia dedicada, tecnologia de ponta e suporte ao seu aprendizado em cada etapa.
      </p>
      <div class="hero-actions">
        <a href="#planos" class="btn btn-gold">Conhecer</a>
        <a href="#cursos" class="btn btn-outline">Ver Cursos</a>
      </div>
    </div>

  </section>


  <section class="section-planos" id="planos" aria-labelledby="planos-title">
    <div class="container">
      <div class="planos-header reveal">
        <p class="section-label">Modelos de Cobrança</p>
        <h2 class="section-title" id="planos-title">Nossos modelos de cobrança</h2>
        <p class="section-subtitle" style="margin:12px auto 0;">Escolha o plano ideal para o seu ritmo de aprendizado e objetivos profissionais.</p>
      </div>

      <div class="planos-grid">
        <!-- Básico -->
        <div class="plan-card reveal">
          <span class="plan-badge badge-basic">Básico</span>
          <div class="plan-name">GoStay Starter</div>
          <p class="plan-desc">Ideal para quem está começando e quer explorar conteúdos essenciais com flexibilidade.</p>
          <ul class="plan-features">
            <li>Acesso a cursos selecionados</li>
            <li>Certificado digital</li>
            <li>Suporte por email</li>
            <li>Atualizações mensais</li>
          </ul>
          <div class="plan-cta">
            <a href="login.php" class="btn btn-outline" style="border-color:var(--navy-border);">Conhecer</a>
          </div>
        </div>

        <div class="plan-card featured reveal" style="transition-delay:.1s">
          <span class="plan-badge badge-max">⭐ Mais Popular</span>
          <div class="plan-name" style="color:var(--gold);">GoStay Max</div>
          <p class="plan-desc">Grandes aulas, experiências imperdíveis e os melhores professores em um único plano.</p>
          <ul class="plan-features gold">
            <li>Acesso completo ao catálogo</li>
            <li>Certificados reconhecidos</li>
            <li>Mentoria ao vivo mensal</li>
            <li>Suporte prioritário 24/7</li>
            <li>Downloads para estudo offline</li>
          </ul>
          <div class="plan-cta">
            <a href="login.php" class="btn btn-gold">Conhecer</a>
          </div>
        </div>

        <div class="plan-card reveal" style="transition-delay:.2s">
          <span class="plan-badge badge-pro">Pro</span>
          <div class="plan-name">GoStay Pro</div>
          <p class="plan-desc">Para profissionais que querem o máximo em crescimento acelerado e networking de alto nível.</p>
          <ul class="plan-features">
            <li>Tudo do Max</li>
            <li>Trilhas personalizadas com IA</li>
            <li>Acesso antecipado a lançamentos</li>
            <li>Comunidade exclusiva Pro</li>
          </ul>
          <div class="plan-cta">
            <a href="login.php" class="btn btn-outline" style="border-color:var(--navy-border);">Conhecer</a>
          </div>
        </div>
      </div>

      <p class="gostay-note reveal" style="margin-top:40px;">
        No <span class="go">Go</span><strong>stay Max</strong> você encontra grandes aulas, experiências imperdíveis e os melhores professores.
      </p>
    </div>
  </section>


  <section class="section-carrossel" aria-label="Carrossel de categorias">
    <div class="container" style="margin-bottom:32px;">
      <p class="section-label reveal">Explore</p>
      <h2 class="section-title reveal">Categorias em destaque</h2>
    </div>

    <div class="carrossel-track-wrapper">
        <!-- (AS IMAGENS DOS CURSOS E OS LINKS DELES VEM AQUI BETINHA DA SILVA)-->
      
      <div class="carrossel-track" aria-live="polite">
        <!-- slides originais -->
       <div class="carrossel-slide"><img src="<?php echo ("creates/" .$posteraula[0]) ?? 'placeholder.png'; ?>" alt="imagem do curso" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;"><div class="slide-inner"><span class="slide-tag"><?php echo $nome[0] ?? 'Curso Sem Nome'; ?></span></div></div>
      <div class="carrossel-slide"><img src="<?php echo ("creates/" .$posteraula[1]) ?? 'placeholder.png'; ?>" alt="imagem do curso" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;"><div class="slide-inner"><span class="slide-tag"><?php echo $nome[1] ?? 'Curso Sem Nome'; ?></span></div></div>
      <div class="carrossel-slide"><img src="<?php echo ("creates/" .$posteraula[2]) ?? 'placeholder.png'; ?>" alt="imagem do curso" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;"><div class="slide-inner"><span class="slide-tag"><?php echo $nome[2] ?? 'Curso Sem Nome'; ?></span></div></div>
      <div class="carrossel-slide"><img src="<?php echo ("creates/" .$posteraula[3]) ?? 'placeholder.png'; ?>" alt="imagem do curso" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;"><div class="slide-inner"><span class="slide-tag"><?php echo $nome[3] ?? 'Curso Sem Nome'; ?></span></div></div>
      <div class="carrossel-slide"><img src="<?php echo ("creates/" .$posteraula[4]) ?? 'placeholder.png'; ?>" alt="imagem do curso" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;"><div class="slide-inner"><span class="slide-tag"><?php echo $nome[4] ?? 'Curso Sem Nome'; ?></span></div></div>
      <div class="carrossel-slide"><img src="<?php echo ("creates/" .$posteraula[5]) ?? 'placeholder.png'; ?>" alt="imagem do curso" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;"><div class="slide-inner"><span class="slide-tag"><?php echo $nome[5] ?? 'Curso Sem Nome'; ?></span></div></div>
      <div class="carrossel-slide"><img src="<?php echo ("creates/" .$posteraula[6]) ?? 'placeholder.png'; ?>" alt="imagem do curso" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;"><div class="slide-inner"><span class="slide-tag"><?php echo $nome[6] ?? 'Curso Sem Nome'; ?></span></div></div>
      <div class="carrossel-slide"><img src="<?php echo ("creates/" .$posteraula[7]) ?? 'placeholder.png'; ?>" alt="imagem do curso" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;"><div class="slide-inner"><span class="slide-tag"><?php echo $nome[7] ?? 'Curso Sem Nome'; ?></span></div></div>

      <div class="carrossel-slide"><img src="<?php echo ("creates/".$posteraula[0]) ?? 'placeholder.png'; ?>" alt="imagem do curso" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;"><div class="slide-inner"><span class="slide-tag"><?php echo $nome[0] ?? 'Curso Sem Nome'; ?></span></div></div>
      <div class="carrossel-slide"><img src="<?php echo ("creates/".$posteraula[1]) ?? 'placeholder.png'; ?>" alt="imagem do curso" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;"><div class="slide-inner"><span class="slide-tag"><?php echo $nome[1] ?? 'Curso Sem Nome'; ?></span></div></div>
      <div class="carrossel-slide"><img src="<?php echo ("creates/" .$posteraula[2]) ?? 'placeholder.png'; ?>" alt="imagem do curso" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;"><div class="slide-inner"><span class="slide-tag"><?php echo $nome[2] ?? 'Curso Sem Nome'; ?></span></div></div>
      <div class="carrossel-slide"><img src="<?php echo ("creates/" .$posteraula[3]) ?? 'placeholder.png'; ?>" alt="imagem do curso" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;"><div class="slide-inner"><span class="slide-tag"><?php echo $nome[3] ?? 'Curso Sem Nome'; ?></span></div></div>
      <div class="carrossel-slide"><img src="<?php echo ("creates/" .$posteraula[4]) ?? 'placeholder.png'; ?>" alt="imagem do curso" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;"><div class="slide-inner"><span class="slide-tag"><?php echo $nome[4] ?? 'Curso Sem Nome'; ?></span></div></div>
      <div class="carrossel-slide"><img src="<?php echo ("creates/" .$posteraula[5]) ?? 'placeholder.png'; ?>" alt="imagem do curso" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;"><div class="slide-inner"><span class="slide-tag"><?php echo $nome[5] ?? 'Curso Sem Nome'; ?></span></div></div>
      <div class="carrossel-slide"><img src="<?php echo ("creates/" .$posteraula[6]) ?? 'placeholder.png'; ?>" alt="imagem do curso" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;"><div class="slide-inner"><span class="slide-tag"><?php echo $nome[6] ?? 'Curso Sem Nome'; ?></span></div></div>
      <div class="carrossel-slide"><img src="<?php echo ("creates/" .$posteraula[7]) ?? 'placeholder.png'; ?>" alt="imagem do curso" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;"><div class="slide-inner"><span class="slide-tag"><?php echo $nome[7] ?? 'Curso Sem Nome'; ?></span></div></div>
      </div>
    </div>
  </section>

  <section class="section-cursos" id="cursos" aria-labelledby="cursos-title">
    <div class="container">
      <div class="cursos-header reveal">
        <p class="section-label">Lançamentos</p>
        <h2 class="section-title" id="cursos-title">Novos Cursos:</h2>
      </div>

      <div class="cursos-grid">
        <div class="curso-card curso-card-hero reveal">
          <div class="curso-thumb curso-thumb-hero">
            <img src="<?php echo("creates/" . $posteraula[0]);  ?>" alt="Foto do Curso">
          </div>
          <div class="curso-body">
            <div class="curso-tag">Destaque</div>
            <div class="curso-name"><?php echo $nome[0] ?? 'Curso'; ?></div>
            <div class="curso-meta"><?php echo $cargahoraria[0] ?? '0'; ?>h · Certificado incluso · Instructor certificado</div>
          </div>
        </div>

        <!-- 3 smaller cards -->
        <div class="curso-card reveal" style="transition-delay:.05s">
          <div class="curso-thumb curso-thumb-sm">
            <img src="<?php echo("creates/" . $posteraula[1]);  ?>" alt="curso">
          </div>
          <div class="curso-body">
            <div class="curso-tag">Novo</div>
            <div class="curso-name"><?php echo $nome[1] ?? 'Curso';  ?></div>
            <div class="curso-meta"><?php echo $cargahoraria[1] ?? '0'; ?>h · GoStay Max</div>
          </div>
        </div>

        <div class="curso-card reveal" style="transition-delay:.1s">
          <div class="curso-thumb curso-thumb-sm">
            <img src="<?php echo("creates/" . $posteraula[2]);  ?>" alt="curso">
          </div>
          <div class="curso-body">
            <div class="curso-tag">Novo</div>
            <div class="curso-name"><?php echo $nome[2] ?? 'Curso';  ?></div>
            <div class="curso-meta"><?php echo $cargahoraria[2] ?? '0'; ?>h · Certificado incluso</div>
          </div>
        </div>

        <div class="curso-card reveal" style="transition-delay:.15s">
          <div class="curso-thumb curso-thumb-sm">
            <img src="<?php echo("creates/" . $posteraula[3]);  ?>" alt="curso">
          </div>
          <div class="curso-body">
            <div class="curso-tag">Novo</div>
            <div class="curso-name"><?php echo $nome[3] ?? 'Curso'; ?></div>
            <div class="curso-meta"><?php echo $cargahoraria[3] ?? '0' ; ?>h  · GoStay Starter</div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="section-porque" id="metodologia" aria-labelledby="porque-title">
    <div class="container">
      <div class="porque-header reveal">
        <p class="section-label">Diferenciais</p>
        <h2 class="section-title" id="porque-title">
          Por que escolher o <span style="color:var(--blue-accent);">Go</span>stay ?
        </h2>
        <p class="section-subtitle">Tecnologia, metodologia e suporte dedicado ao seu aprendizado.</p>
      </div>

      <div class="porque-grid">
        <div class="porque-card reveal">
            
          <div class="porque-icon">🎓</div>
          <div class="porque-card-title">Certificação Reconhecida</div>
          <p class="porque-card-desc">Certificados digitais com validação no mercado, aceitos por empresas e instituições parceiras.</p>
          <div class="porque-img-card" style="margin-top:16px;border-radius:8px;height:140px;">
              <img src="creates/<?php echo $posteraula[0] ?? 'placeholder.png' ?>" alt="Curso">  
          </div>
        </div>
        <div class="porque-card reveal" style="transition-delay:.1s">
          <div class="porque-icon">🚀</div>
          <div class="porque-card-title">Metodologia Acelerada</div>
          <p class="porque-card-desc">Aprendizado focado em prática real, com projetos aplicáveis desde a primeira aula.</p>
          <div class="porque-img-card" style="margin-top:16px;border-radius:8px;height:140px;">
              <img src="creates/<?php echo $posteraula[1] ?? 'placeholder.png' ?>" alt="Curso">  
          </div>
        </div>
        <div class="porque-card reveal" style="transition-delay:.2s">
          <div class="porque-icon">💬</div>
          <div class="porque-card-title">Suporte Dedicado</div>
          <p class="porque-card-desc">Equipe especializada pronta para apoiar você em cada etapa do seu desenvolvimento.</p>
          <div class="porque-img-card" style="margin-top:16px;border-radius:8px;height:140px;">
            <img src="creates/<?php echo $posteraula[2] ?? 'placeholder.png' ?>" alt="Curso">  
          </div>
        </div>
      </div>

      <div class="porque-row2" style="margin-top:20px;">
        <div class="porque-card reveal">
          <div class="porque-icon">📱</div>
          <div class="porque-card-title">Acesso Mobile</div>
          <p class="porque-card-desc">Estude de qualquer lugar, a qualquer hora, no dispositivo que preferir.</p>
          <div class="porque-img-card" style="margin-top:16px;border-radius:8px;height:140px;">
              <img src="creates/<?php echo $posteraula[3] ?? 'placeholder.png' ?>" alt="Curso">  
          </div>
        </div>
        <div class="porque-card reveal" style="transition-delay:.1s">
          <div class="porque-icon">⭐</div>
          <div class="porque-card-title">Melhores Professores</div>
          <p class="porque-card-desc">Instrutores selecionados com anos de experiência prática no mercado.</p>
          <div class="porque-img-card" style="margin-top:16px;border-radius:8px;height:140px;">
            <img src="creates/<?php echo $posteraula[4] ?? 'placeholder.png' ?>" alt="Curso">  
          </div>
        </div>
        <div class="porque-card reveal" style="transition-delay:.2s">
          <div class="porque-icon">🏆</div>
          <div class="porque-card-title">Comunidade Exclusiva</div>
          <p class="porque-card-desc">Conecte-se com profissionais da área e expanda seu network de forma estratégica.</p>
          <div class="porque-img-card" style="margin-top:16px;border-radius:8px;height:140px;">
            <img src="creates/<?php echo $posteraula[5] ?? 'placeholder.png' ?>" alt="Curso">  
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section-cta" aria-label="Call to action">
    <!-- COLOCA OS LINKS AQ Q VAI PRAS PÁGINAS AQUI-->
    <div class="cta-glow" aria-hidden="true"></div>
    <div class="container">
      <p class="section-label reveal">Próximo passo</p>
      <h2 class="section-title reveal">Pronto Para Transformar<br>Sua Carreira?</h2>
      <a href="login.php" class="btn btn-gold reveal" style="margin-top:32px;">Conhecer</a>
      <div class="divider-line"></div>
    </div>
  </section>

  <section class="section-faq" id="faq" aria-labelledby="faq-title">
    <div class="container">
      <div class="faq-layout">
        <div class="faq-left reveal">
          <p class="section-label">Dúvidas</p>
          <h2 class="section-title" id="faq-title">Perguntas<br>Frequentes</h2>
          <div class="faq-logo" aria-label="GoStay">
            <span class="go">Go</span><span class="stay">Stay</span>
          </div>
        </div>

        <div class="faq-list reveal" style="transition-delay:.1s">
          <div class="faq-item">
            <button class="faq-question" aria-expanded="false">
              Como eu faço para assinar ?
              <span class="faq-icon">
                <svg viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
            </button>
            <div class="faq-answer">
              <div class="faq-answer-inner">
                Para assinar, basta escolher o plano ideal para você na seção de modelos de cobrança, clicar em "Conhecer" e preencher seus dados. O acesso é liberado imediatamente após a confirmação do pagamento.
              </div>
            </div>
          </div>

          <div class="faq-item">
            <button class="faq-question" aria-expanded="false">
              Posso cancelar minha assinatura a qualquer momento ?
              <span class="faq-icon">
                <svg viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
            </button>
            <div class="faq-answer">
              <div class="faq-answer-inner">
                Sim! Você pode cancelar sua assinatura a qualquer momento diretamente pelo painel de controle da sua conta, sem taxas adicionais ou burocracia.
              </div>
            </div>
          </div>

          <div class="faq-item">
            <button class="faq-question" aria-expanded="false">
              Os certificados são reconhecidos pelo mercado ?
              <span class="faq-icon">
                <svg viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
            </button>
            <div class="faq-answer">
              <div class="faq-answer-inner">
                Todos os certificados GoStay possuem validação digital e são reconhecidos por empresas e instituições parceiras. Eles podem ser compartilhados diretamente no LinkedIn e portfólios profissionais.
              </div>
            </div>
          </div>

          <div class="faq-item">
            <button class="faq-question" aria-expanded="false">
              Tenho acesso ao conteúdo offline ?
              <span class="faq-icon">
                <svg viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
            </button>
            <div class="faq-answer">
              <div class="faq-answer-inner">
                No plano GoStay Max e Pro, você pode baixar aulas para assistir offline no aplicativo móvel. No plano Starter, o acesso é exclusivamente online.
              </div>
            </div>
          </div>

          <div class="faq-item">
            <button class="faq-question" aria-expanded="false">
              Como funciona o suporte ao aluno ?
              <span class="faq-icon">
                <svg viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
            </button>
            <div class="faq-answer">
              <div class="faq-answer-inner">
                Oferecemos suporte por email para todos os planos. No Max, o suporte é prioritário com resposta em até 4h. No Pro, você conta com atendimento 24/7 e mentoria mensal ao vivo.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <footer>
    <div class="container">
      <div class="footer-top">
        <div class="footer-brand">
          <div class="logo"><span class="go">Go</span><span class="stay">stay</span></div>
          <p>Tecnologia, metodologia e suporte dedicado ao seu aprendizado e transformação profissional.</p>
          <div class="social-links">
            <a href="#" class="social-link" aria-label="Twitter/X">𝕏</a>
            <a href="#" class="social-link" aria-label="Instagram">IG</a>
            <a href="#" class="social-link" aria-label="YouTube">▶️</a>
          </div>
        </div>

        <div class="footer-col">
          <h4>Use cases</h4>
          <ul>
            <li><a href="#">UI design</a></li>
            <li><a href="#">UX design</a></li>
            <li><a href="#">Wireframing</a></li>
            <li><a href="#">Diagramming</a></li>
            <li><a href="#">Brainstorming</a></li>
            <li><a href="#">Online whiteboard</a></li>
            <li><a href="#">Team collaboration</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Explore</h4>
          <ul>
            <li><a href="#">Design</a></li>
            <li><a href="#">Prototyping</a></li>
            <li><a href="#">Development features</a></li>
            <li><a href="#">Design systems</a></li>
            <li><a href="#">Collaboration features</a></li>
            <li><a href="#">Design process</a></li>
            <li><a href="#">FigJam</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Resources</h4>
          <ul>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Best practices</a></li>
            <li><a href="#">Colors</a></li>
            <li><a href="#">Color wheel</a></li>
            <li><a href="#">Support</a></li>
            <li><a href="#">Developers</a></li>
            <li><a href="#">Resource library</a></li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <span>© <span class="go" style="color:var(--blue-accent)">Go</span>stay 2026. Todos os direitos reservados.</span>
        <span>Política de Privacidade · Termos de Uso</span>
      </div>
    </div>
  </footer>

  <script>
    /* --- Mobile nav toggle --- */
    const hamburger = document.getElementById('hamburger');
    const navMenu   = document.getElementById('nav-menu');

    hamburger.addEventListener('click', () => {
      navMenu.classList.toggle('open');
    });

    /* --- FAQ accordion --- */
    document.querySelectorAll('.faq-question').forEach(btn => {
      btn.addEventListener('click', () => {
        const item   = btn.closest('.faq-item');
        const isOpen = item.classList.contains('open');

        // Close all
        document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));

        // Toggle current
        if (!isOpen) {
          item.classList.add('open');
          btn.setAttribute('aria-expanded', 'true');
        } else {
          btn.setAttribute('aria-expanded', 'false');
        }
      });
    });

    /* --- Scroll reveal --- */
    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });

    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
  </script>
</body>
</html>