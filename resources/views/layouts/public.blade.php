<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'HvacDocParse — AI Document Intake Extractor for HVAC Contractors')</title>
    <meta name="description" content="@yield('meta_description', 'HvacDocParse extracts fields from HVAC forms, PDFs and attachments, validates data, routes exceptions, and creates service requests and job tickets with human approval and audit logs.')">
    <meta name="keywords" content="HVAC document intake, AI PDF extraction, HVAC contractors software, service request automation, field technician job tickets, Laravel Filament SaaS">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0c1a24;
            --muted: #4a6270;
            --paper: #f3f7f9;
            --card: #ffffff;
            --line: #d5e2e8;
            --accent: #0e7c6b;
            --accent-2: #1a8f7c;
            --accent-deep: #065647;
            --warm: #e8a23a;
            --danger: #c23b3b;
            --shadow: 0 18px 50px rgba(12, 26, 36, 0.08);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "DM Sans", system-ui, sans-serif;
            color: var(--ink);
            background:
                radial-gradient(1200px 600px at 10% -10%, rgba(14,124,107,.12), transparent 60%),
                radial-gradient(900px 500px at 100% 0%, rgba(232,162,58,.14), transparent 55%),
                linear-gradient(180deg, #eef5f7 0%, var(--paper) 40%, #e8f1f4 100%);
            min-height: 100vh;
        }
        a { color: inherit; text-decoration: none; }
        .wrap { width: min(1120px, calc(100% - 2rem)); margin: 0 auto; }
        header.site {
            position: sticky; top: 0; z-index: 40;
            backdrop-filter: blur(14px);
            background: rgba(243,247,249,.85);
            border-bottom: 1px solid rgba(213,226,232,.8);
        }
        .nav {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 0; gap: 1rem;
        }
        .brand {
            font-family: "Instrument Serif", Georgia, serif;
            font-size: 1.55rem; letter-spacing: -0.02em;
        }
        .brand span { color: var(--accent); }
        .nav-links { display: flex; flex-wrap: wrap; gap: .85rem 1.1rem; align-items: center; font-size: .95rem; color: var(--muted); }
        .nav-links a:hover { color: var(--ink); }
        .btn {
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 999px; padding: .72rem 1.15rem; font-weight: 600; font-size: .92rem;
            border: 1px solid transparent; transition: .2s ease;
        }
        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: var(--accent-deep); }
        .btn-ghost { border-color: var(--line); background: #fff; }
        .btn-ghost:hover { border-color: var(--accent); color: var(--accent-deep); }
        .hero {
            padding: 4.5rem 0 3.2rem;
            display: grid; grid-template-columns: 1.15fr .85fr; gap: 2.5rem; align-items: center;
        }
        .eyebrow {
            display: inline-block; font-size: .78rem; font-weight: 700; letter-spacing: .08em;
            text-transform: uppercase; color: var(--accent-deep); margin-bottom: .85rem;
        }
        h1, h2, h3 { font-family: "Instrument Serif", Georgia, serif; font-weight: 400; letter-spacing: -0.02em; margin: 0 0 .75rem; }
        h1 { font-size: clamp(2.4rem, 5vw, 3.6rem); line-height: 1.05; }
        h2 { font-size: clamp(1.8rem, 3vw, 2.4rem); }
        h3 { font-size: 1.35rem; }
        .lead { font-size: 1.08rem; line-height: 1.65; color: var(--muted); max-width: 38rem; }
        .cta-row { display: flex; flex-wrap: wrap; gap: .75rem; margin-top: 1.6rem; }
        .hero-panel {
            background: linear-gradient(160deg, #0c1a24, #134d45 70%, #0e7c6b);
            color: #e8f6f3; border-radius: 1.4rem; padding: 1.5rem; box-shadow: var(--shadow);
            min-height: 320px;
        }
        .hero-panel .pill {
            display: inline-block; background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.18);
            border-radius: 999px; padding: .35rem .7rem; font-size: .78rem; margin-bottom: 1rem;
        }
        .flow-step { display: flex; gap: .75rem; margin: .85rem 0; align-items: flex-start; }
        .flow-num {
            width: 1.7rem; height: 1.7rem; border-radius: 999px; background: var(--warm); color: #1a1204;
            display: grid; place-items: center; font-weight: 700; font-size: .8rem; flex: 0 0 auto;
        }
        section.block { padding: 3.2rem 0; }
        .section-head { margin-bottom: 1.6rem; max-width: 40rem; }
        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
        .grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
        .card {
            background: var(--card); border: 1px solid var(--line); border-radius: 1rem;
            padding: 1.2rem 1.25rem; box-shadow: 0 8px 24px rgba(12,26,36,.04);
        }
        .card .tag {
            display: inline-block; font-size: .72rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: .06em; color: var(--accent-deep); margin-bottom: .5rem;
        }
        .card p { color: var(--muted); line-height: 1.55; margin: .35rem 0 0; }
        .stat-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: .85rem; margin-top: 1.5rem; }
        .stat { background: #fff; border: 1px solid var(--line); border-radius: .9rem; padding: 1rem; text-align: center; }
        .stat strong { display: block; font-size: 1.6rem; font-family: "Instrument Serif", Georgia, serif; }
        .stat span { color: var(--muted); font-size: .85rem; }
        .badge {
            display: inline-flex; align-items: center; gap: .35rem; border-radius: 999px;
            padding: .25rem .65rem; font-size: .75rem; font-weight: 700;
        }
        .badge-on { background: #dff5ef; color: #065647; }
        .badge-off { background: #f1f3f5; color: #61707a; }
        table.demo { width: 100%; border-collapse: collapse; background: #fff; border-radius: 1rem; overflow: hidden; border: 1px solid var(--line); }
        table.demo th, table.demo td { padding: .85rem 1rem; text-align: left; border-bottom: 1px solid var(--line); font-size: .95rem; }
        table.demo th { background: #e7f1f4; font-size: .78rem; text-transform: uppercase; letter-spacing: .05em; color: var(--muted); }
        footer.site {
            margin-top: 3rem; border-top: 1px solid var(--line); padding: 2rem 0 2.5rem; color: var(--muted); font-size: .92rem;
        }
        footer.site a { color: var(--accent-deep); font-weight: 600; }
        .price {
            border: 1px solid var(--line); border-radius: 1.1rem; padding: 1.4rem; background: #fff;
        }
        .price.featured { border-color: var(--accent); box-shadow: var(--shadow); }
        .price .amount { font-size: 2.2rem; font-family: "Instrument Serif", Georgia, serif; margin: .4rem 0; }
        @media (max-width: 900px) {
            .hero, .grid-3, .grid-2, .stat-row { grid-template-columns: 1fr; }
            .nav-links { display: none; }
        }
    </style>
    @stack('head')
</head>
<body>
<header class="site">
    <div class="wrap nav">
        <a class="brand" href="{{ url('/') }}">Hvac<span>Doc</span>Parse</a>
        <nav class="nav-links">
            <a href="{{ url('/features') }}">Features</a>
            <a href="{{ url('/workflow') }}">Workflow</a>
            <a href="{{ url('/modules') }}">Modules</a>
            <a href="{{ url('/integrations') }}">Integrations</a>
            <a href="{{ url('/pricing') }}">Pricing</a>
            <a href="{{ url('/demo') }}">Demo</a>
            <a class="btn btn-primary" href="{{ url('/admin') }}">Admin Login</a>
        </nav>
    </div>
</header>
<main>
    @yield('content')
</main>
<footer class="site">
    <div class="wrap">
        <p><strong>HvacDocParse</strong> — AI Document Intake Extractor for HVAC Contractors.</p>
        <p>Built with Laravel + Filament. Modular AI business automation for home & field services.</p>
        <p style="margin-top:1rem">
            Contact / Hire: <a href="https://imrandev.bd/contact" target="_blank" rel="noopener">Imran Ahmed (IMRAN Dev BD)</a>
            · <a href="mailto:me@imrandev.bd">me@imrandev.bd</a>
            · <a href="https://github.com/imranbru99" target="_blank" rel="noopener">GitHub</a>
        </p>
    </div>
</footer>
</body>
</html>
