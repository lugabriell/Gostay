<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>OdontoElite — Instituto de Odontologia de Excelência</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
/* ══════════════════════════════════════
   BASE
══════════════════════════════════════ */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --royal:#1a3a8f;--royal-light:#2550c8;--royal-dim:#0d1f4e;
  --black:#050810;--surface:#0b0f1e;--surface-2:#0f1628;--surface-3:#111827;
  --white:#f5f7ff;--white-dim:rgba(245,247,255,.62);
  --accent:#4a7bff;--gold:#c8a84b;--wapp:#25d366;
  --font-d:'Cormorant Garamond',serif;--font-b:'DM Sans',sans-serif;
  --ease-o:cubic-bezier(.16,1,.3,1);--ease-io:cubic-bezier(.45,0,.55,1);
  --sp:clamp(5rem,9vw,8rem)
}
html{scroll-behavior:smooth;overflow-x:hidden}
body{background:var(--black);color:var(--white);font-family:var(--font-b);font-weight:300;line-height:1.6;overflow-x:hidden}

/* ══════════════════════════════════════
   SPLASH
══════════════════════════════════════ */
#splash{position:fixed;inset:0;z-index:9999;background:var(--black);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:1.4rem;transition:opacity .9s var(--ease-io),visibility .9s}
#splash.hide{opacity:0;visibility:hidden;pointer-events:none}
.spl-logo{display:flex;flex-direction:column;align-items:center;gap:.6rem;animation:sReveal .9s var(--ease-o) .3s both}
.spl-icon{width:72px;height:72px;border:1.5px solid rgba(74,123,255,.5);border-radius:50%;display:flex;align-items:center;justify-content:center;position:relative;box-shadow:0 0 40px rgba(37,80,200,.25)}
.spl-icon::before{content:'';position:absolute;inset:6px;border-radius:50%;background:radial-gradient(circle at 38% 38%,var(--royal-light),var(--royal-dim))}
.spl-icon svg{position:relative;z-index:1;width:32px;height:32px;fill:var(--white)}
.spl-name{font-family:var(--font-d);font-size:clamp(2rem,5vw,3.5rem);font-weight:600;letter-spacing:.09em;text-transform:uppercase}
.spl-tag{font-size:.7rem;letter-spacing:.3em;text-transform:uppercase;color:var(--accent);opacity:0;animation:fUp .7s var(--ease-o) 1.1s both}
.spl-line{width:0;height:1px;background:linear-gradient(90deg,transparent,var(--accent),transparent);animation:lGrow 1s var(--ease-o) .8s both}
.spl-bar{position:absolute;bottom:2.5rem;width:180px;height:1px;background:rgba(255,255,255,.07);overflow:hidden}
.spl-bar::after{content:'';position:absolute;inset:0;background:var(--accent);transform:scaleX(0);transform-origin:left;animation:pFill 2.6s var(--ease-io) .3s forwards}
@keyframes sReveal{from{opacity:0;transform:scale(.88) translateY(20px)}to{opacity:1;transform:none}}
@keyframes fUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:none}}
@keyframes lGrow{from{width:0}to{width:110px}}
@keyframes pFill{from{transform:scaleX(0)}to{transform:scaleX(1)}}

/* ══════════════════════════════════════
   NAVBAR
══════════════════════════════════════ */
#navbar{position:fixed;top:0;left:0;right:0;z-index:1000;padding:0 5%;height:70px;display:flex;align-items:center;justify-content:space-between;background:rgba(5,8,16,.9);backdrop-filter:blur(18px);-webkit-backdrop-filter:blur(18px);border-bottom:1px solid rgba(74,123,255,.1);opacity:0;transform:translateY(-100%);transition:opacity .6s var(--ease-o),transform .6s var(--ease-o)}
#navbar.visible{opacity:1;transform:translateY(0)}
.nlogo{display:flex;align-items:center;gap:.7rem;text-decoration:none}
.nlogo-dot{width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,var(--royal-light),var(--royal-dim));display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,.15)}
.nlogo-dot svg{width:16px;height:16px;fill:var(--white)}
.nlogo-name{font-family:var(--font-d);font-size:1.2rem;font-weight:600;letter-spacing:.06em;color:var(--white)}
.nlinks{display:flex;align-items:center;gap:2.2rem;list-style:none}
.nlinks a{color:var(--white-dim);text-decoration:none;font-size:.78rem;letter-spacing:.12em;text-transform:uppercase;transition:color .3s;position:relative}
.nlinks a::after{content:'';position:absolute;bottom:-3px;left:0;right:100%;height:1px;background:var(--accent);transition:right .3s var(--ease-o)}
.nlinks a:hover{color:var(--white)}
.nlinks a:hover::after{right:0}
.ncta{padding:.45rem 1.2rem!important;background:var(--wapp)!important;color:var(--white)!important;border-radius:3px;font-size:.72rem!important;display:inline-flex;align-items:center;gap:.4rem;transition:background .3s,transform .2s,box-shadow .3s!important;box-shadow:0 4px 18px rgba(37,211,102,.22)}
.ncta::after{display:none!important}
.ncta:hover{background:#1fb558!important;transform:translateY(-1px);box-shadow:0 8px 28px rgba(37,211,102,.32)!important}
.ncta svg{width:13px;height:13px;fill:currentColor}
.hamburger{display:none;flex-direction:column;gap:5px;background:none;border:none;cursor:pointer;padding:4px}
.hamburger span{display:block;width:24px;height:1.5px;background:var(--white);transition:transform .3s,opacity .3s}

/* ══════════════════════════════════════
   SECTION FLOW CONNECTORS
   Gradient bleeds eliminate hard edges
══════════════════════════════════════ */
section,footer{position:relative}
#hero::after{content:'';position:absolute;bottom:0;left:0;right:0;height:180px;background:linear-gradient(to bottom,transparent,var(--surface));pointer-events:none;z-index:1}
#cursos::after{content:'';position:absolute;bottom:0;left:0;right:0;height:160px;background:linear-gradient(to bottom,transparent,var(--black));pointer-events:none;z-index:2}
#diferenciais::after{content:'';position:absolute;bottom:0;left:0;right:0;height:160px;background:linear-gradient(to bottom,transparent,var(--surface));pointer-events:none;z-index:2}
#depoimentos::after{content:'';position:absolute;bottom:0;left:0;right:0;height:160px;background:linear-gradient(to bottom,transparent,var(--black));pointer-events:none;z-index:2}
#professores::after{content:'';position:absolute;bottom:0;left:0;right:0;height:160px;background:linear-gradient(to bottom,transparent,var(--royal-dim));pointer-events:none;z-index:2}

/* Shared orb */
.orb{position:absolute;border-radius:50%;pointer-events:none;filter:blur(80px);opacity:.11;z-index:0}

/* ══════════════════════════════════════
   HERO
══════════════════════════════════════ */
#hero{min-height:100vh;display:flex;align-items:center;justify-content:flex-start;padding:0 8% 0 10%;background:var(--black);overflow:hidden}
.hero-bg{position:absolute;inset:0;background:radial-gradient(ellipse 70% 80% at 80% 50%,rgba(26,58,143,.38) 0%,transparent 70%),radial-gradient(ellipse 35% 45% at 15% 75%,rgba(74,123,255,.07) 0%,transparent 60%)}
.hero-grid{position:absolute;inset:0;background-image:linear-gradient(rgba(74,123,255,.025) 1px,transparent 1px),linear-gradient(90deg,rgba(74,123,255,.025) 1px,transparent 1px);background-size:60px 60px;mask-image:radial-gradient(ellipse 80% 80% at 80% 50%,black 0%,transparent 70%)}
.hero-circle{position:absolute;right:5%;top:50%;transform:translateY(-50%);width:clamp(260px,38vw,520px);height:clamp(260px,38vw,520px);border-radius:50%;border:1px solid rgba(74,123,255,.12);background:radial-gradient(circle at 38% 33%,rgba(26,58,143,.55) 0%,rgba(5,8,16,.92) 70%);overflow:hidden;display:flex;align-items:center;justify-content:center}
.hero-circle::before{content:'';position:absolute;inset:-2px;border-radius:50%;background:conic-gradient(from 0deg,transparent 65%,rgba(74,123,255,.45) 90%,transparent 100%);animation:rBorder 10s linear infinite}
.hci{width:84%;height:84%;border-radius:50%;background:linear-gradient(135deg,rgba(26,58,143,.65),rgba(11,15,30,.97));display:flex;align-items:center;justify-content:center;position:relative;z-index:1}
.hci svg{width:56%;height:56%;fill:none;stroke:rgba(74,123,255,.5);stroke-width:1}
@keyframes rBorder{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}
.hero-content{position:relative;z-index:2;max-width:620px}
.hero-eyebrow{display:flex;align-items:center;gap:.8rem;font-size:.68rem;letter-spacing:.3em;text-transform:uppercase;color:var(--accent);margin-bottom:1.5rem;opacity:0;animation:fUp .7s var(--ease-o) 3.2s both}
.hero-eyebrow::before{content:'';display:inline-block;width:28px;height:1px;background:var(--accent)}
.hero-title{font-family:var(--font-d);font-size:clamp(2.8rem,5.5vw,5rem);font-weight:600;line-height:1.08;color:var(--white);margin-bottom:1.5rem;opacity:0;animation:fUp .8s var(--ease-o) 3.4s both}
.hero-title em{font-style:normal;color:transparent;-webkit-text-stroke:1px rgba(74,123,255,.75)}
.hero-sub{font-size:1rem;color:var(--white-dim);line-height:1.75;max-width:480px;margin-bottom:2.5rem;opacity:0;animation:fUp .8s var(--ease-o) 3.6s both}
.hero-actions{display:flex;align-items:center;gap:1.2rem;flex-wrap:wrap;opacity:0;animation:fUp .8s var(--ease-o) 3.8s both}
.hero-stats{position:absolute;bottom:3rem;left:10%;display:flex;gap:3rem;opacity:0;animation:fUp .8s var(--ease-o) 4s both}
.stat-num{font-family:var(--font-d);font-size:1.8rem;font-weight:600}
.stat-num span{color:var(--accent)}
.stat-lbl{font-size:.68rem;letter-spacing:.15em;text-transform:uppercase;color:var(--white-dim)}
.hero-scroll{position:absolute;bottom:3rem;right:5%;display:flex;flex-direction:column;align-items:center;gap:.5rem;opacity:0;animation:fUp .8s var(--ease-o) 4.2s both;cursor:pointer}
.hero-scroll span{font-size:.58rem;letter-spacing:.2em;text-transform:uppercase;color:var(--white-dim);writing-mode:vertical-rl}
.scroll-line{width:1px;height:48px;background:linear-gradient(to bottom,var(--accent),transparent);animation:sPulse 2s ease-in-out infinite}
@keyframes sPulse{0%,100%{opacity:.3;transform:scaleY(.7) translateY(-8px)}50%{opacity:1;transform:scaleY(1) translateY(0)}}

/* ══════════════════════════════════════
   BUTTONS
══════════════════════════════════════ */
.btn-wapp{display:inline-flex;align-items:center;gap:.6rem;padding:.88rem 2rem;background:var(--wapp);color:var(--white);text-decoration:none;font-size:.8rem;letter-spacing:.1em;text-transform:uppercase;font-weight:500;border-radius:3px;transition:background .3s,transform .2s,box-shadow .3s;box-shadow:0 8px 32px rgba(37,211,102,.28)}
.btn-wapp:hover{background:#1fb558;transform:translateY(-2px);box-shadow:0 14px 40px rgba(37,211,102,.4)}
.btn-wapp svg{width:18px;height:18px;fill:currentColor;flex-shrink:0}
.btn-ghost{display:inline-flex;align-items:center;gap:.6rem;padding:.88rem 1.5rem;color:var(--white-dim);text-decoration:none;font-size:.78rem;letter-spacing:.12em;text-transform:uppercase;font-weight:500;border-bottom:1px solid rgba(255,255,255,.2);transition:color .3s,border-color .3s}
.btn-ghost:hover{color:var(--white);border-color:var(--accent)}
.btn-ghost svg{width:12px;height:12px;fill:none;stroke:currentColor;stroke-width:1.5}

/* ══════════════════════════════════════
   SHARED SECTION
══════════════════════════════════════ */
section{padding:var(--sp) 8%}
.sec-lbl{display:flex;align-items:center;gap:.8rem;font-size:.68rem;letter-spacing:.3em;text-transform:uppercase;color:var(--accent);margin-bottom:1rem}
.sec-lbl::before{content:'';display:inline-block;width:22px;height:1px;background:var(--accent)}
.sec-title{font-family:var(--font-d);font-size:clamp(1.9rem,3.5vw,3rem);font-weight:600;line-height:1.14;color:var(--white);margin-bottom:.9rem}
.sec-sub{font-size:.94rem;color:var(--white-dim);line-height:1.8;max-width:520px}

/* ══════════════════════════════════════
   REVEAL
══════════════════════════════════════ */
.reveal{opacity:0;transform:translateY(34px);transition:opacity .8s var(--ease-o),transform .8s var(--ease-o)}
.reveal.visible{opacity:1;transform:none}
.d1{transition-delay:.1s}.d2{transition-delay:.2s}.d3{transition-delay:.32s}.d4{transition-delay:.44s}

/* ══════════════════════════════════════
   CURSOS
══════════════════════════════════════ */
#cursos{background:linear-gradient(to bottom,var(--surface) 0%,var(--surface) 82%,var(--black) 100%);padding-top:calc(var(--sp) + 2rem)}
.carousel-wrap{position:relative;overflow:hidden}
.carousel-track{display:flex;gap:1.5rem;transition:transform .65s var(--ease-o);will-change:transform}
.ccard{min-width:calc(33.333% - 1rem);background:var(--surface-3);border:1px solid rgba(74,123,255,.1);border-radius:10px;overflow:hidden;flex-shrink:0;transition:transform .3s var(--ease-o),border-color .3s,box-shadow .3s}
.ccard:hover{transform:translateY(-7px);border-color:rgba(74,123,255,.3);box-shadow:0 24px 60px rgba(26,58,143,.28)}
.ccard-img{height:200px;background:linear-gradient(135deg,var(--royal-dim),var(--surface-3));position:relative;overflow:hidden;display:flex;align-items:center;justify-content:center}
.ccard-img svg{width:72px;height:72px;fill:none;stroke:rgba(74,123,255,.35);stroke-width:1}
.ccard-img-ov{position:absolute;inset:0;background:linear-gradient(to bottom,transparent 40%,var(--surface-3))}
.ccard-badge{position:absolute;top:1rem;left:1rem;padding:.22rem .65rem;background:rgba(74,123,255,.15);border:1px solid rgba(74,123,255,.28);border-radius:2px;font-size:.62rem;letter-spacing:.15em;text-transform:uppercase;color:var(--accent)}
.ccard-body{padding:1.5rem}
.ccard-title{font-family:var(--font-d);font-size:1.3rem;font-weight:600;margin-bottom:.55rem;color:var(--white)}
.ccard-desc{font-size:.84rem;color:var(--white-dim);line-height:1.65;margin-bottom:1.2rem}
.ccard-meta{display:flex;gap:1rem;margin-bottom:1.2rem}
.ccard-meta-i{display:flex;align-items:center;gap:.32rem;font-size:.7rem;letter-spacing:.07em;text-transform:uppercase;color:var(--white-dim)}
.ccard-meta-i svg{width:12px;height:12px;fill:none;stroke:var(--accent);stroke-width:1.5}
.ccard-cta{display:inline-flex;align-items:center;gap:.45rem;padding:.55rem 1.1rem;background:var(--wapp);color:var(--white);border-radius:3px;text-decoration:none;font-size:.7rem;letter-spacing:.1em;text-transform:uppercase;font-weight:500;transition:background .3s,transform .2s,box-shadow .3s;box-shadow:0 4px 16px rgba(37,211,102,.2)}
.ccard-cta:hover{background:#1fb558;transform:translateY(-1px);box-shadow:0 8px 24px rgba(37,211,102,.32)}
.ccard-cta svg{width:14px;height:14px;fill:currentColor}
.car-nav{display:flex;align-items:center;justify-content:space-between;margin-top:2rem}
.dots{display:flex;gap:.5rem}
.dot{width:6px;height:6px;border-radius:50%;background:rgba(255,255,255,.18);cursor:pointer;transition:background .3s,width .3s}
.dot.active{background:var(--accent);width:20px;border-radius:3px}
.car-btns{display:flex;gap:.7rem}
.car-btn{width:44px;height:44px;border-radius:50%;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1);color:var(--white);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .3s,border-color .3s;font-size:1.05rem}
.car-btn:hover{background:var(--royal-light);border-color:var(--royal-light)}

/* ══════════════════════════════════════
   DIFERENCIAIS
══════════════════════════════════════ */
#diferenciais{background:linear-gradient(to bottom,var(--black) 0%,var(--surface) 25%,var(--black) 100%);padding-top:calc(var(--sp) + 1.5rem)}
.dif-inner{display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:center;position:relative;z-index:1}
.counters{display:flex;flex-direction:column;gap:2.2rem}
.ci{display:flex;align-items:center;gap:1.5rem}
.cc{position:relative;width:90px;height:90px;flex-shrink:0}
.cc svg{width:90px;height:90px;transform:rotate(-90deg)}
.cc svg .track{fill:none;stroke:rgba(74,123,255,.09);stroke-width:2}
.cc svg .fill{fill:none;stroke:var(--royal-light);stroke-width:2;stroke-linecap:round;stroke-dasharray:251.2;stroke-dashoffset:251.2;transition:stroke-dashoffset 2.2s var(--ease-o)}
.cc.counted .fill{stroke-dashoffset:0}
.cc-num{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-family:var(--font-d);font-size:1.45rem;font-weight:600}
.cc-num sup{font-size:.78rem;color:var(--accent)}
.ci-lbl{font-family:var(--font-d);font-size:1.1rem;font-weight:600;margin-bottom:.3rem}
.ci-desc{font-size:.82rem;color:var(--white-dim);line-height:1.6}
.dif-text .sec-sub{margin-bottom:2rem}
.feat-list{list-style:none;display:flex;flex-direction:column;gap:.95rem;margin-bottom:2rem}
.feat-list li{display:flex;align-items:flex-start;gap:.8rem;font-size:.9rem;color:var(--white-dim);line-height:1.55}
.feat-list li::before{content:'';flex-shrink:0;width:18px;height:18px;margin-top:2px;border-radius:50%;background:rgba(74,123,255,.12) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12'%3E%3Cpath d='M2.5 6l2.5 2.5 4.5-5' stroke='%234a7bff' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' fill='none'/%3E%3C/svg%3E") no-repeat center/10px;border:1px solid rgba(74,123,255,.25)}

/* ══════════════════════════════════════
   DEPOIMENTOS
══════════════════════════════════════ */
#depoimentos{background:linear-gradient(to bottom,var(--black) 0%,var(--surface) 12%,var(--surface) 85%,var(--black) 100%);padding-top:calc(var(--sp) + 1.5rem)}
.dep-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:3rem;flex-wrap:wrap;gap:1.5rem}
.test-wrap{overflow:hidden}
.test-track{display:flex;gap:1.5rem;transition:transform .65s var(--ease-o)}
.tcard{min-width:calc(50% - .75rem);background:var(--surface-3);border:1px solid rgba(74,123,255,.08);border-radius:12px;padding:2rem;flex-shrink:0;position:relative;transition:border-color .3s,transform .3s}
.tcard:hover{border-color:rgba(74,123,255,.2);transform:translateY(-4px)}
.quote{font-family:var(--font-d);font-size:5rem;line-height:.5;color:rgba(74,123,255,.12);position:absolute;top:1.6rem;right:1.8rem;user-select:none}
.stars{display:flex;gap:3px;margin-bottom:1rem}
.stars span{color:var(--gold);font-size:.75rem}
.ttext{font-size:.92rem;line-height:1.8;color:var(--white-dim);margin-bottom:1.6rem;font-style:italic}
.tauthor{display:flex;align-items:center;gap:.9rem}
.avatar{width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,var(--royal-light),var(--royal-dim));display:flex;align-items:center;justify-content:center;font-family:var(--font-d);font-size:1.1rem;font-weight:600;border:1.5px solid rgba(74,123,255,.3);flex-shrink:0}
.aname{font-size:.88rem;font-weight:500}
.arole{font-size:.7rem;letter-spacing:.1em;text-transform:uppercase;color:var(--accent)}

/* ══════════════════════════════════════
   PROFESSORES
══════════════════════════════════════ */
#professores{background:linear-gradient(to bottom,var(--black) 0%,var(--surface) 18%,var(--surface) 80%,var(--black) 100%);padding-top:calc(var(--sp) + 1rem)}
.prof-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;margin-top:3rem}
.pcard{background:var(--surface-3);border:1px solid rgba(74,123,255,.08);border-radius:10px;text-align:center;padding:2rem 1.2rem 1.5rem;transition:transform .3s,border-color .3s,box-shadow .3s}
.pcard:hover{transform:translateY(-5px);border-color:rgba(74,123,255,.25);box-shadow:0 20px 48px rgba(26,58,143,.22)}
.pavatar{width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,var(--royal-light),var(--royal-dim));margin:0 auto 1rem;display:flex;align-items:center;justify-content:center;font-family:var(--font-d);font-size:1.8rem;font-weight:600;border:2px solid rgba(74,123,255,.2);position:relative}
.pavatar::after{content:'';position:absolute;inset:-4px;border-radius:50%;border:1px solid rgba(74,123,255,.14)}
.pname{font-family:var(--font-d);font-size:1.05rem;font-weight:600;margin-bottom:.3rem}
.pspec{font-size:.7rem;letter-spacing:.1em;text-transform:uppercase;color:var(--accent);margin-bottom:.7rem}
.pbio{font-size:.8rem;color:var(--white-dim);line-height:1.6}

/* ══════════════════════════════════════
   CTA BAND
══════════════════════════════════════ */
#cta-band{background:linear-gradient(135deg,var(--royal-dim) 0%,var(--royal) 40%,var(--royal-light) 100%);padding:5rem 8%;text-align:center;position:relative;overflow:hidden}
#cta-band::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 60% at 80% 50%,rgba(255,255,255,.05) 0%,transparent 70%),radial-gradient(ellipse 40% 40% at 20% 50%,rgba(0,0,0,.2) 0%,transparent 70%);pointer-events:none}
.cta-title{font-family:var(--font-d);font-size:clamp(2rem,4vw,3.2rem);font-weight:600;color:var(--white);margin-bottom:.8rem;position:relative;z-index:1}
.cta-sub{font-size:1rem;color:rgba(255,255,255,.75);margin-bottom:2rem;position:relative;z-index:1}
.cta-actions{display:flex;align-items:center;justify-content:center;gap:1.2rem;flex-wrap:wrap;position:relative;z-index:1}

/* ══════════════════════════════════════
   FOOTER
══════════════════════════════════════ */
#footer{background:var(--surface-2);border-top:1px solid rgba(74,123,255,.08);padding:5rem 8% 2.5rem}
.footer-grid{display:grid;grid-template-columns:2fr 1fr 1fr 1.3fr;gap:4rem;margin-bottom:4rem}
.fbrand-desc{font-size:.84rem;color:var(--white-dim);line-height:1.7;margin-bottom:1.5rem;max-width:280px}
.fsocials{display:flex;gap:.7rem;margin-bottom:1.2rem}
.fsocial{width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;text-decoration:none;color:var(--white-dim);font-size:.7rem;font-weight:600;transition:background .3s,color .3s}
.fsocial:hover{background:var(--royal-light);color:var(--white)}
.fwapp{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem 1.2rem;background:var(--wapp);color:var(--white);border-radius:3px;text-decoration:none;font-size:.72rem;letter-spacing:.08em;text-transform:uppercase;font-weight:500;transition:background .3s,transform .2s;box-shadow:0 4px 18px rgba(37,211,102,.22)}
.fwapp:hover{background:#1fb558;transform:translateY(-1px)}
.fwapp svg{width:14px;height:14px;fill:currentColor}
.fcol-title{font-size:.68rem;letter-spacing:.2em;text-transform:uppercase;color:var(--accent);margin-bottom:1.2rem}
.flinks{list-style:none;display:flex;flex-direction:column;gap:.7rem}
.flinks a{color:var(--white-dim);text-decoration:none;font-size:.86rem;transition:color .3s,padding-left .3s;display:block}
.flinks a:hover{color:var(--white);padding-left:4px}
.fcontact-i{display:flex;align-items:flex-start;gap:.7rem;font-size:.84rem;color:var(--white-dim);margin-bottom:.8rem;line-height:1.5}
.fcontact-i svg{width:14px;height:14px;flex-shrink:0;margin-top:2px;fill:none;stroke:var(--accent);stroke-width:1.5}
.footer-bottom{border-top:1px solid rgba(255,255,255,.04);padding-top:2rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem}
.fcopy{font-size:.72rem;color:rgba(255,255,255,.22);letter-spacing:.05em}
.flegal{display:flex;gap:1.5rem}
.flegal a{font-size:.7rem;color:rgba(255,255,255,.22);text-decoration:none;transition:color .3s}
.flegal a:hover{color:var(--white-dim)}

/* ══════════════════════════════════════
   FLOATING WHATSAPP
══════════════════════════════════════ */
#wfloat{position:fixed;bottom:2rem;right:2rem;z-index:900;width:58px;height:58px;border-radius:50%;background:var(--wapp);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 32px rgba(37,211,102,.4),0 2px 8px rgba(0,0,0,.4);text-decoration:none;color:var(--white);opacity:0;pointer-events:none;transition:opacity .5s,transform .3s var(--ease-o),box-shadow .3s}
#wfloat.visible{opacity:1;pointer-events:all}
#wfloat:hover{transform:scale(1.1) translateY(-3px);box-shadow:0 14px 42px rgba(37,211,102,.5)}
#wfloat svg{width:26px;height:26px;fill:currentColor;position:relative;z-index:1}
#wfloat::before{content:'';position:absolute;inset:0;border-radius:50%;background:var(--wapp);opacity:.5;animation:wPulse 2.5s ease-out infinite}
@keyframes wPulse{0%{transform:scale(1);opacity:.5}80%{transform:scale(1.85);opacity:0}100%{transform:scale(1.85);opacity:0}}

/* WhatsApp SVG path reused — define as CSS mask approach */
.wa-svg{width:18px;height:18px;fill:currentColor;flex-shrink:0}

/* ══════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════ */
@media(max-width:1100px){
  .hero-circle{display:none}
  .dif-inner{grid-template-columns:1fr;gap:3rem}
  .prof-grid{grid-template-columns:repeat(2,1fr)}
  .footer-grid{grid-template-columns:1fr 1fr;gap:2.5rem}
  .ccard{min-width:calc(50% - .75rem)}
}
@media(max-width:768px){
  section{padding:4.5rem 5%}
  #hero{padding:0 5%}
  .hero-stats{left:5%;gap:2rem}
  .stat-num{font-size:1.4rem}
  .nlinks{display:none}
  .nlinks.open{display:flex;flex-direction:column;position:absolute;top:70px;left:0;right:0;background:rgba(5,8,16,.97);padding:1.5rem 5%;border-bottom:1px solid rgba(74,123,255,.1);gap:1.2rem}
  .hamburger{display:flex}
  .ccard{min-width:85%}
  .tcard{min-width:90%}
  .footer-grid{grid-template-columns:1fr;gap:2rem}
  #navbar{padding:0 5%}
  #cta-band{padding:4rem 5%}
  #wfloat{bottom:1.5rem;right:1.2rem;width:52px;height:52px}
}
@media(max-width:480px){
  .prof-grid{grid-template-columns:1fr}
  .hero-actions{flex-direction:column;align-items:flex-start}
  .cta-actions{flex-direction:column}
}
</style>
</head>
<body>

<!-- SPLASH -->
<div id="splash">
  <div class="spl-logo">
    <div class="spl-icon">
      <svg viewBox="0 0 32 32"><path d="M16 4C8 4 5 11 5 16c0 5 2 9 5 11l6 2 6-2c3-2 5-6 5-11 0-5-3-12-11-12z"/><path d="M12 14c0-2.2 1.8-4 4-4s4 1.8 4 4-1.8 4-4 4-4-1.8-4-4z"/></svg>
    </div>
    <div class="spl-name">OdontoElite</div>
    <div class="spl-line"></div>
    <div class="spl-tag">Instituto de Odontologia de Excelência</div>
  </div>
  <div class="spl-bar"></div>
</div>

<!-- NAVBAR -->
<nav id="navbar">
  <a href="#" class="nlogo">
    <div class="nlogo-dot"><svg viewBox="0 0 16 16"><path d="M8 2C4 2 2.5 5.5 2.5 8c0 2.5 1 4.5 2.5 5.5l3 1 3-1c1.5-1 2.5-3 2.5-5.5C13.5 5.5 12 2 8 2z"/></svg></div>
    <span class="nlogo-name">OdontoElite</span>
  </a>
  <ul class="nlinks" id="navLinks">
    <li><a href="#cursos">Cursos</a></li>
    <li><a href="#diferenciais">Diferenciais</a></li>
    <li><a href="#depoimentos">Depoimentos</a></li>
    <li><a href="#professores">Professores</a></li>
    <li>
      <a href="https://wa.me/5562984666917?text=Estou%20interessado%20na%20%C3%A1rea%20de%20odonto" target="_blank" rel="noopener" class="ncta">
        <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        Inscreva-se
      </a>
    </li>
  </ul>
  <button class="hamburger" id="hamburger" aria-label="Menu"><span></span><span></span><span></span></button>
</nav>

<!-- HERO -->
<section id="hero">
  <div class="hero-bg"></div>
  <div class="hero-grid"></div>
  <div class="hero-circle">
    <div class="hci">
      <svg viewBox="0 0 120 120">
        <path d="M60 15C40 15 28 30 28 45c0 15 7 25 7 40 0 10 5 20 13 20 6 0 9-7 12-15 3 8 6 15 12 15 8 0 13-10 13-20 0-15 7-25 7-40 0-15-12-30-32-30z" stroke-width="1.4"/>
        <circle cx="60" cy="47" r="11" stroke-width="1" stroke-dasharray="3 3"/>
        <line x1="54" y1="20" x2="40" y2="7" stroke-width=".7" stroke-opacity=".4"/>
        <line x1="66" y1="20" x2="80" y2="7" stroke-width=".7" stroke-opacity=".4"/>
        <circle cx="60" cy="60" r="36" stroke-width=".5" stroke-dasharray="2 4" stroke-opacity=".25"/>
        <circle cx="60" cy="60" r="50" stroke-width=".3" stroke-dasharray="1 5" stroke-opacity=".15"/>
      </svg>
    </div>
  </div>

  <div class="hero-content">
    <div class="hero-eyebrow">Instituto de Excelência</div>
    <h1 class="hero-title">Formando<br>os Melhores<br><em>Odontologistas</em></h1>
    <p class="hero-sub">Educação odontológica de alto nível, com tecnologia de ponta, corpo docente especializado e metodologia que transforma profissionais em referência no mercado.</p>
    <div class="hero-actions">
      <a href="https://wa.me/5562984666917?text=Estou%20interessado%20na%20%C3%A1rea%20de%20odonto" target="_blank" rel="noopener" class="btn-wapp">
        <svg class="wa-svg" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        Falar pelo WhatsApp
      </a>
      <a href="#cursos" class="btn-ghost">Ver Cursos <svg viewBox="0 0 12 12"><path d="M2 6h8M6 2l4 4-4 4"/></svg></a>
    </div>
  </div>

  <div class="hero-stats">
    <div><div class="stat-num">500<span>+</span></div><div class="stat-lbl">Alunos Formados</div></div>
    <div><div class="stat-num">18<span>+</span></div><div class="stat-lbl">Anos de Tradição</div></div>
    <div><div class="stat-num">98<span>%</span></div><div class="stat-lbl">Aprovação CRO</div></div>
  </div>

  <div class="hero-scroll" onclick="document.getElementById('cursos').scrollIntoView({behavior:'smooth'})">
    <span>Scroll</span><div class="scroll-line"></div>
  </div>
</section>

<!-- CURSOS -->
<section id="cursos">
  <div style="margin-bottom:3.5rem">
    <div class="sec-lbl reveal">Formação Especializada</div>
    <h2 class="sec-title reveal d1">Cursos &amp; Programas</h2>
    <p class="sec-sub reveal d2">Escolha sua especialização e dê o próximo passo em uma carreira odontológica de excelência.</p>
  </div>

  <div class="carousel-wrap reveal d1">
    <div class="carousel-track" id="cursosTrack">

      <div class="ccard">
        <div class="ccard-img">
          <svg viewBox="0 0 80 80"><rect x="15" y="20" width="50" height="40" rx="3" stroke-width="1.2"/><path d="M25 32h30M25 40h20M25 48h25" stroke-width="1" stroke-linecap="round"/><circle cx="55" cy="46" r="10" stroke-width="1.2" stroke-dasharray="3 2"/></svg>
          <div class="ccard-img-ov"></div><span class="ccard-badge">Presencial</span>
        </div>
        <div class="ccard-body">
          <div class="ccard-title">Ortodontia Avançada</div>
          <p class="ccard-desc">Técnicas modernas de alinhamento dental incluindo aparelhos invisíveis e sistemas de última geração.</p>
          <div class="ccard-meta">
            <div class="ccard-meta-i"><svg viewBox="0 0 14 14"><circle cx="7" cy="7" r="6"/><path d="M7 4v3.5l2.5 1.5" stroke-linecap="round"/></svg>18 meses</div>
            <div class="ccard-meta-i"><svg viewBox="0 0 14 14"><path d="M7 1l1.8 3.6L13 5.4l-3 2.9.7 4.1L7 10.4 3.3 12.4l.7-4.1L1 5.4l4.2-.8z"/></svg>4.9/5.0</div>
          </div>
          <a href="https://wa.me/5562984666917?text=Estou%20interessado%20na%20%C3%A1rea%20de%20odonto" target="_blank" rel="noopener" class="ccard-cta">
            <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Tenho interesse
          </a>
        </div>
      </div>

      <div class="ccard">
        <div class="ccard-img">
          <svg viewBox="0 0 80 80"><path d="M40 15C25 15 18 25 18 35c0 15 10 25 10 35 0 5 4 8 9 8 3 0 5-3 3-9-2 6 0 9 3 9 5 0 9-3 9-8 0-10 10-20 10-35C62 25 55 15 40 15z" stroke-width="1.2"/><circle cx="40" cy="36" r="7" stroke-width="1" stroke-dasharray="2 2"/></svg>
          <div class="ccard-img-ov"></div><span class="ccard-badge">Híbrido</span>
        </div>
        <div class="ccard-body">
          <div class="ccard-title">Implantodontia</div>
          <p class="ccard-desc">Do planejamento cirúrgico à carga imediata, domine as técnicas de implantes dentários osseointegrados.</p>
          <div class="ccard-meta">
            <div class="ccard-meta-i"><svg viewBox="0 0 14 14"><circle cx="7" cy="7" r="6"/><path d="M7 4v3.5l2.5 1.5" stroke-linecap="round"/></svg>24 meses</div>
            <div class="ccard-meta-i"><svg viewBox="0 0 14 14"><path d="M7 1l1.8 3.6L13 5.4l-3 2.9.7 4.1L7 10.4 3.3 12.4l.7-4.1L1 5.4l4.2-.8z"/></svg>4.8/5.0</div>
          </div>
          <a href="https://wa.me/5562984666917?text=Estou%20interessado%20na%20%C3%A1rea%20de%20odonto" target="_blank" rel="noopener" class="ccard-cta">
            <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Tenho interesse
          </a>
        </div>
      </div>

      <div class="ccard">
        <div class="ccard-img">
          <svg viewBox="0 0 80 80"><path d="M20 55Q30 25 40 20Q50 25 60 55" stroke-width="1.2" fill="none"/><path d="M24 48Q32 30 40 26Q48 30 56 48" stroke-width=".8" fill="none" stroke-dasharray="2 2"/><path d="M15 60h50" stroke-width="1" stroke-linecap="round"/><circle cx="40" cy="38" r="5" stroke-width="1"/></svg>
          <div class="ccard-img-ov"></div><span class="ccard-badge">Online</span>
        </div>
        <div class="ccard-body">
          <div class="ccard-title">Odontopediatria</div>
          <p class="ccard-desc">Atendimento especializado para crianças e adolescentes com foco em prevenção e comportamento clínico.</p>
          <div class="ccard-meta">
            <div class="ccard-meta-i"><svg viewBox="0 0 14 14"><circle cx="7" cy="7" r="6"/><path d="M7 4v3.5l2.5 1.5" stroke-linecap="round"/></svg>12 meses</div>
            <div class="ccard-meta-i"><svg viewBox="0 0 14 14"><path d="M7 1l1.8 3.6L13 5.4l-3 2.9.7 4.1L7 10.4 3.3 12.4l.7-4.1L1 5.4l4.2-.8z"/></svg>4.9/5.0</div>
          </div>
          <a href="https://wa.me/5562984666917?text=Estou%20interessado%20na%20%C3%A1rea%20de%20odonto" target="_blank" rel="noopener" class="ccard-cta">
            <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Tenho interesse
          </a>
        </div>
      </div>

      <div class="ccard">
        <div class="ccard-img">
          <svg viewBox="0 0 80 80"><rect x="20" y="18" width="40" height="44" rx="4" stroke-width="1.2"/><path d="M30 32Q40 22 50 32Q40 42 30 32z" stroke-width="1" fill="none"/><circle cx="40" cy="50" r="6" stroke-width="1" stroke-dasharray="2 1"/></svg>
          <div class="ccard-img-ov"></div><span class="ccard-badge">Presencial</span>
        </div>
        <div class="ccard-body">
          <div class="ccard-title">Dentística Estética</div>
          <p class="ccard-desc">Lentes de contato dental, facetas em porcelana, clareamento e harmonização do sorriso.</p>
          <div class="ccard-meta">
            <div class="ccard-meta-i"><svg viewBox="0 0 14 14"><circle cx="7" cy="7" r="6"/><path d="M7 4v3.5l2.5 1.5" stroke-linecap="round"/></svg>15 meses</div>
            <div class="ccard-meta-i"><svg viewBox="0 0 14 14"><path d="M7 1l1.8 3.6L13 5.4l-3 2.9.7 4.1L7 10.4 3.3 12.4l.7-4.1L1 5.4l4.2-.8z"/></svg>5.0/5.0</div>
          </div>
          <a href="https://wa.me/5562984666917?text=Estou%20interessado%20na%20%C3%A1rea%20de%20odonto" target="_blank" rel="noopener" class="ccard-cta">
            <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Tenho interesse
          </a>
        </div>
      </div>

    </div>
  </div>
  <div class="car-nav reveal d2">
    <div class="dots" id="cursosDots"></div>
    <div class="car-btns">
      <button class="car-btn" id="cursosPrev">&#8592;</button>
      <button class="car-btn" id="cursosNext">&#8594;</button>
    </div>
  </div>
</section>

<!-- DIFERENCIAIS -->
<section id="diferenciais">
  <div class="orb" style="width:380px;height:380px;top:5%;left:-8%;background:var(--royal)"></div>
  <div class="orb" style="width:280px;height:280px;bottom:10%;right:3%;background:var(--accent)"></div>
  <div class="dif-inner">
    <div class="counters">
      <div class="ci reveal">
        <div class="cc" id="c1"><svg viewBox="0 0 90 90"><circle class="track" cx="45" cy="45" r="40"/><circle class="fill" cx="45" cy="45" r="40"/></svg><div class="cc-num"><span data-target="500" data-suffix="+">0</span></div></div>
        <div><div class="ci-lbl">Alunos Formados</div><div class="ci-desc">Profissionais impactando a saúde bucal de milhares de pacientes.</div></div>
      </div>
      <div class="ci reveal d1">
        <div class="cc" id="c2"><svg viewBox="0 0 90 90"><circle class="track" cx="45" cy="45" r="40"/><circle class="fill" cx="45" cy="45" r="40"/></svg><div class="cc-num"><span data-target="98" data-suffix="%">0</span></div></div>
        <div><div class="ci-lbl">Taxa de Aprovação</div><div class="ci-desc">Altíssima aprovação em exames do Conselho Federal de Odontologia.</div></div>
      </div>
      <div class="ci reveal d2">
        <div class="cc" id="c3"><svg viewBox="0 0 90 90"><circle class="track" cx="45" cy="45" r="40"/><circle class="fill" cx="45" cy="45" r="40"/></svg><div class="cc-num"><span data-target="18" data-suffix="+">0</span></div></div>
        <div><div class="ci-lbl">Anos de Excelência</div><div class="ci-desc">Quase duas décadas formando especialistas reconhecidos no Brasil.</div></div>
      </div>
      <div class="ci reveal d3">
        <div class="cc" id="c4"><svg viewBox="0 0 90 90"><circle class="track" cx="45" cy="45" r="40"/><circle class="fill" cx="45" cy="45" r="40"/></svg><div class="cc-num"><span data-target="12" data-suffix="">0</span></div></div>
        <div><div class="ci-lbl">Especializações</div><div class="ci-desc">Programas em diversas áreas, do básico ao mais avançado.</div></div>
      </div>
    </div>
    <div class="dif-text">
      <div class="sec-lbl reveal">Por que nos escolher</div>
      <h2 class="sec-title reveal d1">Referência em<br>Educação Odontológica</h2>
      <p class="sec-sub reveal d2">Reconhecidos pelo compromisso com a excelência acadêmica, infraestrutura de última geração e metodologia que une teoria e prática com rigor científico.</p>
      <ul class="feat-list reveal d3">
        <li>Laboratórios com tecnologia CAD/CAM de última geração</li>
        <li>Doutores formados nas melhores instituições nacionais e internacionais</li>
        <li>Clínica-escola para prática clínica supervisionada</li>
        <li>Plataforma digital exclusiva para acompanhamento de pacientes</li>
        <li>Programa de intercâmbio com universidades europeias</li>
        <li>Certificação reconhecida pelo Conselho Federal de Odontologia</li>
      </ul>
      <a href="https://wa.me/5562984666917?text=Estou%20interessado%20na%20%C3%A1rea%20de%20odonto" target="_blank" rel="noopener" class="btn-wapp reveal d4" style="display:inline-flex">
        <svg class="wa-svg" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        Falar com um Consultor
      </a>
    </div>
  </div>
</section>

<!-- DEPOIMENTOS -->
<section id="depoimentos">
  <div class="dep-header">
    <div>
      <div class="sec-lbl reveal">Quem Passou por Aqui</div>
      <h2 class="sec-title reveal d1">O Que Dizem<br>Nossos Alunos</h2>
    </div>
    <div class="car-btns">
      <button class="car-btn" id="testPrev">&#8592;</button>
      <button class="car-btn" id="testNext">&#8594;</button>
    </div>
  </div>
  <div class="test-wrap reveal">
    <div class="test-track" id="testTrack">
      <div class="tcard">
        <div class="quote">"</div>
        <div class="stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
        <p class="ttext">O programa de Implantodontia superou todas as minhas expectativas. A estrutura prática, aliada ao acompanhamento dos professores, me deu segurança para atender casos complexos logo após a formatura.</p>
        <div class="tauthor"><div class="avatar">RC</div><div><div class="aname">Dr. Rafael Carvalho</div><div class="arole">Especialista em Implantodontia</div></div></div>
      </div>
      <div class="tcard">
        <div class="quote">"</div>
        <div class="stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
        <p class="ttext">Fiz a pós em Ortodontia e foi um divisor de águas. A metodologia é muito diferente — você aprende com casos reais, com supervisão diária. Hoje tenho uma clínica com agenda cheia.</p>
        <div class="tauthor"><div class="avatar">AM</div><div><div class="aname">Dra. Ana Mello</div><div class="arole">Ortodontista — Clínica Própria</div></div></div>
      </div>
      <div class="tcard">
        <div class="quote">"</div>
        <div class="stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
        <p class="ttext">A infraestrutura dos laboratórios é realmente impressionante. Trabalhamos com equipamentos que muitos consultórios não têm. A formação técnica é sólida e a parte teórica é rigorosa.</p>
        <div class="tauthor"><div class="avatar">LF</div><div><div class="aname">Dr. Lucas Ferreira</div><div class="arole">Dentística Estética</div></div></div>
      </div>
      <div class="tcard">
        <div class="quote">"</div>
        <div class="stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
        <p class="ttext">Como mãe e dentista, a especialização em Odontopediatria foi perfeita. Aprendi a lidar com comportamento infantil de forma empática e eficaz. Os professores são referências nacionais na área.</p>
        <div class="tauthor"><div class="avatar">JS</div><div><div class="aname">Dra. Juliana Santos</div><div class="arole">Odontopediatra</div></div></div>
      </div>
    </div>
  </div>
  <div class="dots" id="testDots" style="margin-top:1.5rem"></div>
</section>

<!-- PROFESSORES -->
<section id="professores">
  <div class="sec-lbl reveal">Excelência Acadêmica</div>
  <h2 class="sec-title reveal d1">Corpo Docente</h2>
  <p class="sec-sub reveal d2">Doutores e especialistas com experiência clínica e acadêmica nas mais renomadas instituições do país e do exterior.</p>
  <div class="prof-grid">
    <div class="pcard reveal"><div class="pavatar">MB</div><div class="pname">Prof. Dr. Marcos Brito</div><div class="pspec">Implantodontia</div><p class="pbio">Doutor pela USP, pós-doutor pela Universidade de Berna. Mais de 20 anos de prática cirúrgica avançada.</p></div>
    <div class="pcard reveal d1"><div class="pavatar">CA</div><div class="pname">Profa. Dra. Cristina Alves</div><div class="pspec">Ortodontia</div><p class="pbio">Especialista em alinhadores invisíveis, referência nacional em tratamentos complexos de mordida cruzada.</p></div>
    <div class="pcard reveal d2"><div class="pavatar">FN</div><div class="pname">Prof. Dr. Felipe Nunes</div><div class="pspec">Dentística Estética</div><p class="pbio">Palestrante internacional, autor de três livros sobre facetas e lentes de contato dental em porcelana.</p></div>
    <div class="pcard reveal d3"><div class="pavatar">PR</div><div class="pname">Profa. Dra. Patrícia Reis</div><div class="pspec">Odontopediatria</div><p class="pbio">Doutora pela UNICAMP. Pesquisadora em comportamento infantil e técnicas de sedação consciente.</p></div>
  </div>
</section>

<!-- CTA BAND -->
<section id="cta-band">
  <h2 class="cta-title reveal">Pronto para Transformar sua Carreira?</h2>
  <p class="cta-sub reveal d1">Entre em contato agora e descubra qual especialização é ideal para você.</p>
  <div class="cta-actions reveal d2">
    <a href="https://wa.me/5562984666917?text=Estou%20interessado%20na%20%C3%A1rea%20de%20odonto" target="_blank" rel="noopener" class="btn-wapp" style="font-size:.85rem;padding:1rem 2.2rem">
      <svg class="wa-svg" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
      Falar com um Consultor
    </a>
    <a href="#cursos" class="btn-ghost" style="color:rgba(255,255,255,.75);border-color:rgba(255,255,255,.3)">Ver Todos os Cursos</a>
  </div>
</section>

<!-- FOOTER -->
<footer id="footer">
  <div class="footer-grid">
    <div>
      <a href="#" class="nlogo" style="margin-bottom:1rem;display:inline-flex">
        <div class="nlogo-dot"><svg viewBox="0 0 16 16"><path d="M8 2C4 2 2.5 5.5 2.5 8c0 2.5 1 4.5 2.5 5.5l3 1 3-1c1.5-1 2.5-3 2.5-5.5C13.5 5.5 12 2 8 2z"/></svg></div>
        <span class="nlogo-name">OdontoElite</span>
      </a>
      <p class="fbrand-desc">Formando os melhores especialistas em odontologia desde 2006. Compromisso com excelência, inovação e o futuro da saúde bucal no Brasil.</p>
      <div class="fsocials">
        <a href="#" class="fsocial">Ig</a><a href="#" class="fsocial">Li</a>
        <a href="#" class="fsocial">Fb</a><a href="#" class="fsocial">Yt</a>
      </div>
      <a href="https://wa.me/5562984666917?text=Estou%20interessado%20na%20%C3%A1rea%20de%20odonto" target="_blank" rel="noopener" class="fwapp">
        <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        (62) 98466-6917
      </a>
    </div>

    <div>
      <div class="fcol-title">Cursos</div>
      <ul class="flinks">
        <li><a href="https://wa.me/5562984666917?text=Estou%20interessado%20na%20%C3%A1rea%20de%20odonto" target="_blank">Ortodontia Avançada</a></li>
        <li><a href="https://wa.me/5562984666917?text=Estou%20interessado%20na%20%C3%A1rea%20de%20odonto" target="_blank">Implantodontia</a></li>
        <li><a href="https://wa.me/5562984666917?text=Estou%20interessado%20na%20%C3%A1rea%20de%20odonto" target="_blank">Odontopediatria</a></li>
        <li><a href="https://wa.me/5562984666917?text=Estou%20interessado%20na%20%C3%A1rea%20de%20odonto" target="_blank">Dentística Estética</a></li>
        <li><a href="https://wa.me/5562984666917?text=Estou%20interessado%20na%20%C3%A1rea%20de%20odonto" target="_blank">Periodontia</a></li>
        <li><a href="https://wa.me/5562984666917?text=Estou%20interessado%20na%20%C3%A1rea%20de%20odonto" target="_blank">Endodontia</a></li>
      </ul>
    </div>

    <div>
      <div class="fcol-title">Institucional</div>
      <ul class="flinks">
        <li><a href="#">Sobre o Instituto</a></li>
        <li><a href="#">Corpo Docente</a></li>
        <li><a href="#">Infraestrutura</a></li>
        <li><a href="#">Intercâmbios</a></li>
        <li><a href="https://wa.me/5562984666917?text=Estou%20interessado%20na%20%C3%A1rea%20de%20odonto" target="_blank">Bolsas de Estudo</a></li>
        <li><a href="#">Blog</a></li>
      </ul>
    </div>

    <div>
      <div class="fcol-title">Contato</div>
      <div class="fcontact-i"><svg viewBox="0 0 14 14"><path d="M7 1C4.2 1 2 3.2 2 6c0 4 5 8 5 8s5-4 5-8c0-2.8-2.2-5-5-5z"/><circle cx="7" cy="6" r="1.5"/></svg>Av. Paulista, 1000 — São Paulo, SP</div>
      <div class="fcontact-i"><svg viewBox="0 0 14 14"><path d="M2 3h10v8H2z"/><path d="M2 3l5 4.5L12 3"/></svg>contato@odontaelite.com.br</div>
      <div class="fcontact-i"><svg viewBox="0 0 14 14"><path d="M2 2.5C2 2.2 2.2 2 2.5 2h2l1 2.5-1.5 1c.8 1.8 2.2 3.2 4 4l1-1.5L11.5 9v2c0 .3-.2.5-.5.5C5.6 11.5 2 8 2 4v-.5z"/></svg>(62) 98466-6917</div>
      <div class="fcontact-i"><svg viewBox="0 0 14 14"><circle cx="7" cy="7" r="5"/><path d="M7 4v3.5l2 1" stroke-linecap="round"/></svg>Seg–Sex: 8h–18h</div>
      <a href="https://wa.me/5562984666917?text=Estou%20interessado%20na%20%C3%A1rea%20de%20odonto" target="_blank" rel="noopener" class="btn-wapp" style="margin-top:1rem;font-size:.72rem;padding:.65rem 1.3rem;display:inline-flex">
        <svg class="wa-svg" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        Inscreva-se agora
      </a>
    </div>
  </div>
  <div class="footer-bottom">
    <span class="fcopy">© 2024 OdontoElite Instituto de Odontologia. Todos os direitos reservados.</span>
    <div class="flegal"><a href="#">Privacidade</a><a href="#">Termos</a><a href="#">Cookies</a></div>
  </div>
</footer>

<!-- FLOATING WHATSAPP -->
<a id="wfloat" href="https://wa.me/5562984666917?text=Estou%20interessado%20na%20%C3%A1rea%20de%20odonto" target="_blank" rel="noopener" aria-label="Fale pelo WhatsApp">
  <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
</a>

<script>
// Splash
window.addEventListener('load',()=>{setTimeout(()=>document.getElementById('splash').classList.add('hide'),2900)});

// Navbar + float button
const nb=document.getElementById('navbar'),wf=document.getElementById('wfloat');
window.addEventListener('scroll',()=>{
  nb.classList.toggle('visible',window.scrollY>80);
  wf.classList.toggle('visible',window.scrollY>300);
},{passive:true});

// Hamburger
document.getElementById('hamburger').addEventListener('click',()=>{
  document.getElementById('navLinks').classList.toggle('open');
});

// Reveal
const ro=new IntersectionObserver(entries=>{
  entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');ro.unobserve(e.target)}});
},{threshold:.1});
document.querySelectorAll('.reveal').forEach(el=>ro.observe(el));

// Carousel
function makeCarousel(tid,pid,nid,did,vis){
  const track=document.getElementById(tid);if(!track)return;
  const cards=track.children,total=cards.length,dotsEl=document.getElementById(did);
  let cur=0;
  const dc=Math.max(total-vis+1,1);
  for(let i=0;i<dc;i++){const d=document.createElement('div');d.className='dot'+(i===0?' active':'');d.addEventListener('click',()=>goTo(i));dotsEl.appendChild(d)}
  function goTo(idx){
    cur=Math.max(0,Math.min(idx,total-vis));
    track.style.transform=`translateX(-${cur*(cards[0].offsetWidth+24)}px)`;
    dotsEl.querySelectorAll('.dot').forEach((d,i)=>d.classList.toggle('active',i===cur));
  }
  document.getElementById(pid).addEventListener('click',()=>goTo(cur-1));
  document.getElementById(nid).addEventListener('click',()=>goTo(cur+1));
  window.addEventListener('resize',()=>goTo(cur),{passive:true});
}
const vw=window.innerWidth;
makeCarousel('cursosTrack','cursosPrev','cursosNext','cursosDots',vw<768?1:vw<1100?2:3);
makeCarousel('testTrack','testPrev','testNext','testDots',vw<768?1:2);

// Counters
function animCount(el){
  const t=+el.dataset.target,s=el.dataset.suffix||'',dur=2300,st=performance.now();
  (function step(now){const p=Math.min((now-st)/dur,1),e=1-Math.pow(1-p,3);el.textContent=Math.floor(e*t)+s;if(p<1)requestAnimationFrame(step)})(st);
}
const co=new IntersectionObserver(entries=>{
  entries.forEach(e=>{if(e.isIntersecting){e.target.querySelectorAll('[data-target]').forEach(animCount);e.target.querySelectorAll('.cc').forEach(c=>c.classList.add('counted'));co.unobserve(e.target)}});
},{threshold:.25});
document.querySelectorAll('.ci').forEach(i=>co.observe(i));
</script>
</body>
</html>