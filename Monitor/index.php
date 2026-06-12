<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SIGAP — Sistem Informasi Kegiatan & Aktivitas Peserta</title>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Syne:wght@700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
  :root {
    --bg: #0a0e1a;
    --bg2: #0f1628;
    --bg3: #151d35;
    --surface: #1a2340;
    --surface2: #1f2a4a;
    --border: #253060;
    --accent: #3b82f6;
    --accent2: #60a5fa;
    --accent3: #93c5fd;
    --green: #10b981;
    --amber: #f59e0b;
    --red: #ef4444;
    --purple: #8b5cf6;
    --cyan: #06b6d4;
    --text: #e2e8f0;
    --text2: #94a3b8;
    --text3: #64748b;
    --sidebar-w: 240px;
    --header-h: 60px;
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  body {
    font-family: 'Space Grotesk', sans-serif;
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    display: flex;
    overflow-x: hidden;
  }

  /* ─── SIDEBAR ─── */
  .sidebar {
    width: var(--sidebar-w);
    background: var(--bg2);
    border-right: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0; left: 0; bottom: 0;
    z-index: 100;
  }

  .logo {
    padding: 20px 20px 16px;
    border-bottom: 1px solid var(--border);
  }

  .logo-mark {
    font-family: 'Syne', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: var(--accent2);
    letter-spacing: -0.5px;
  }

  .logo-sub {
    font-size: 9px;
    color: var(--text3);
    letter-spacing: 1.5px;
    text-transform: uppercase;
    margin-top: 2px;
    font-family: 'JetBrains Mono', monospace;
  }

  .nav-group {
    padding: 12px 12px 4px;
    font-size: 9px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: var(--text3);
    font-family: 'JetBrains Mono', monospace;
  }

  .nav-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 12px;
    margin: 1px 8px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 500;
    color: var(--text2);
    transition: all 0.15s;
    position: relative;
  }

  .nav-item:hover { background: var(--surface); color: var(--text); }

  .nav-item.active {
    background: rgba(59,130,246,0.15);
    color: var(--accent2);
  }

  .nav-item.active::before {
    content: '';
    position: absolute;
    left: -8px; top: 50%;
    transform: translateY(-50%);
    width: 3px; height: 18px;
    background: var(--accent);
    border-radius: 0 2px 2px 0;
  }

  .nav-icon {
    width: 18px; height: 18px;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
  }

  .nav-badge {
    margin-left: auto;
    background: var(--accent);
    color: white;
    font-size: 10px;
    padding: 1px 6px;
    border-radius: 10px;
    font-family: 'JetBrains Mono', monospace;
  }

  .sidebar-footer {
    margin-top: auto;
    padding: 12px;
    border-top: 1px solid var(--border);
  }

  .user-card {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 10px;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.15s;
  }

  .user-card:hover { background: var(--surface); }

  .avatar {
    width: 32px; height: 32px;
    border-radius: 8px;
    background: linear-gradient(135deg, var(--accent), var(--purple));
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700;
    flex-shrink: 0;
  }

  .user-info { flex: 1; min-width: 0; }
  .user-name { font-size: 12px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .user-role {
    font-size: 10px; color: var(--text3);
    font-family: 'JetBrains Mono', monospace;
  }

  .role-super { color: var(--amber); }

  /* ─── MAIN ─── */
  .main {
    margin-left: var(--sidebar-w);
    flex: 1;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  .topbar {
    height: var(--header-h);
    background: var(--bg2);
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    padding: 0 28px;
    gap: 16px;
    position: sticky;
    top: 0; z-index: 50;
  }

  .page-title {
    font-family: 'Syne', sans-serif;
    font-size: 16px;
    font-weight: 700;
    color: var(--text);
    flex: 1;
  }

  .topbar-actions {
    display: flex; align-items: center; gap: 8px;
  }

  .btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 14px;
    border-radius: 7px;
    font-size: 12px; font-weight: 600;
    cursor: pointer; border: none;
    font-family: 'Space Grotesk', sans-serif;
    transition: all 0.15s;
  }

  .btn-primary { background: var(--accent); color: white; }
  .btn-primary:hover { background: #2563eb; }
  .btn-ghost { background: transparent; color: var(--text2); border: 1px solid var(--border); }
  .btn-ghost:hover { background: var(--surface); color: var(--text); }

  .content {
    padding: 24px 28px;
    flex: 1;
    overflow-y: auto;
  }

  /* ─── GRID LAYOUT ─── */
  .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
  .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
  .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
  .col-span-2 { grid-column: span 2; }
  .col-span-3 { grid-column: span 3; }

  /* ─── CARDS ─── */
  .card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 20px;
  }

  .card-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 16px;
  }

  .card-title {
    font-size: 13px; font-weight: 600; color: var(--text2);
    letter-spacing: 0.3px;
  }

  .card-value {
    font-family: 'Syne', sans-serif;
    font-size: 32px; font-weight: 800;
    color: var(--text);
    line-height: 1;
  }

  .card-delta {
    font-size: 11px; font-weight: 600;
    font-family: 'JetBrains Mono', monospace;
    margin-top: 6px;
  }

  .delta-up { color: var(--green); }
  .delta-down { color: var(--red); }

  .stat-icon {
    width: 36px; height: 36px;
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px;
  }

  /* ─── SECTION HEADERS ─── */
  .section-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 16px;
    margin-top: 28px;
  }

  .section-title {
    font-family: 'Syne', sans-serif;
    font-size: 16px; font-weight: 800;
    color: var(--text);
  }

  /* ─── TABLES ─── */
  .table-wrap {
    overflow-x: auto;
    border-radius: 10px;
    border: 1px solid var(--border);
  }

  table {
    width: 100%; border-collapse: collapse;
    font-size: 13px;
  }

  thead th {
    background: var(--bg3);
    padding: 10px 14px;
    text-align: left;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--text3);
    font-family: 'JetBrains Mono', monospace;
    border-bottom: 1px solid var(--border);
    white-space: nowrap;
  }

  tbody tr {
    border-bottom: 1px solid rgba(37,48,96,0.5);
    transition: background 0.1s;
  }

  tbody tr:last-child { border-bottom: none; }
  tbody tr:hover { background: var(--surface2); }

  tbody td {
    padding: 11px 14px;
    color: var(--text);
    vertical-align: middle;
  }

  /* ─── BADGES ─── */
  .badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 3px 9px;
    border-radius: 20px;
    font-size: 11px; font-weight: 600;
    font-family: 'JetBrains Mono', monospace;
  }

  .badge-green { background: rgba(16,185,129,0.15); color: var(--green); }
  .badge-amber { background: rgba(245,158,11,0.15); color: var(--amber); }
  .badge-red { background: rgba(239,68,68,0.15); color: var(--red); }
  .badge-blue { background: rgba(59,130,246,0.15); color: var(--accent2); }
  .badge-purple { background: rgba(139,92,246,0.15); color: var(--purple); }
  .badge-cyan { background: rgba(6,182,212,0.15); color: var(--cyan); }

  /* ─── PROGRESS BARS ─── */
  .progress-row {
    display: flex; align-items: center; gap: 12px;
    margin-bottom: 12px;
  }

  .progress-label {
    font-size: 12px; color: var(--text2);
    min-width: 80px;
  }

  .progress-bar {
    flex: 1; height: 6px;
    background: var(--bg3);
    border-radius: 99px;
    overflow: hidden;
  }

  .progress-fill {
    height: 100%; border-radius: 99px;
    transition: width 1s ease;
  }

  .progress-val {
    font-size: 11px; font-weight: 600;
    font-family: 'JetBrains Mono', monospace;
    color: var(--text2);
    min-width: 36px;
    text-align: right;
  }

  /* ─── MINI BAR CHART ─── */
  .bar-chart {
    display: flex; align-items: flex-end; gap: 6px;
    height: 80px; padding-top: 10px;
  }

  .bar-col {
    flex: 1; display: flex; flex-direction: column;
    align-items: center; gap: 4px;
  }

  .bar {
    width: 100%; border-radius: 4px 4px 0 0;
    min-height: 4px;
    transition: height 0.6s ease;
  }

  .bar-label {
    font-size: 9px; color: var(--text3);
    font-family: 'JetBrains Mono', monospace;
  }

  /* ─── TIMELINE ─── */
  .timeline-item {
    display: flex; gap: 14px;
    padding: 12px 0;
    border-bottom: 1px solid rgba(37,48,96,0.5);
    position: relative;
  }

  .timeline-item:last-child { border-bottom: none; }

  .tl-dot {
    width: 10px; height: 10px;
    border-radius: 50%;
    margin-top: 4px;
    flex-shrink: 0;
  }

  .tl-content { flex: 1; }
  .tl-title { font-size: 13px; font-weight: 600; }
  .tl-meta { font-size: 11px; color: var(--text3); margin-top: 2px; font-family: 'JetBrains Mono', monospace; }

  /* ─── CHECKLIST ─── */
  .check-item {
    display: flex; align-items: center; gap: 10px;
    padding: 8px 0;
    border-bottom: 1px solid rgba(37,48,96,0.4);
  }

  .check-item:last-child { border-bottom: none; }

  .check-box {
    width: 16px; height: 16px; border-radius: 4px;
    border: 2px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; font-size: 10px;
  }

  .check-box.checked { background: var(--green); border-color: var(--green); }

  .check-label { font-size: 12px; flex: 1; }

  .radio-group {
    display: flex; gap: 6px; margin-left: auto;
  }

  .radio-opt {
    padding: 3px 8px;
    border-radius: 5px;
    font-size: 10px; font-weight: 600;
    cursor: pointer;
    border: 1px solid transparent;
    font-family: 'JetBrains Mono', monospace;
    transition: all 0.15s;
  }

  .radio-opt.layak { background: rgba(16,185,129,0.15); color: var(--green); border-color: var(--green); }
  .radio-opt.perbaikan { background: rgba(245,158,11,0.15); color: var(--amber); border-color: var(--amber); }
  .radio-opt.tidak-layak { background: rgba(239,68,68,0.1); color: var(--text3); border-color: var(--border); }

  /* ─── UPLOAD AREA ─── */
  .upload-area {
    border: 2px dashed var(--border);
    border-radius: 10px;
    padding: 28px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
    margin-top: 12px;
  }

  .upload-area:hover {
    border-color: var(--accent);
    background: rgba(59,130,246,0.04);
  }

  .upload-icon { font-size: 28px; margin-bottom: 8px; }
  .upload-text { font-size: 13px; color: var(--text2); }
  .upload-hint { font-size: 11px; color: var(--text3); margin-top: 4px; font-family: 'JetBrains Mono', monospace; }

  /* ─── GANTT CHART ─── */
  .gantt-wrap { overflow-x: auto; }

  .gantt-row {
    display: flex;
    align-items: center;
    gap: 0;
    height: 36px;
    border-bottom: 1px solid rgba(37,48,96,0.4);
  }

  .gantt-row:last-child { border-bottom: none; }

  .gantt-label {
    width: 120px; flex-shrink: 0;
    font-size: 11px; color: var(--text2);
    padding-right: 10px;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
  }

  .gantt-track {
    flex: 1; height: 100%;
    display: flex; align-items: center;
    position: relative;
    min-width: 500px;
  }

  .gantt-bar {
    position: absolute;
    height: 18px; border-radius: 4px;
    font-size: 10px; color: rgba(255,255,255,0.8);
    display: flex; align-items: center;
    padding: 0 8px;
    white-space: nowrap; overflow: hidden;
    font-family: 'JetBrains Mono', monospace;
  }

  /* ─── PHYSICAL SCORE ─── */
  .score-grid {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;
  }

  .score-card {
    background: var(--bg3);
    border-radius: 10px;
    padding: 14px;
    border: 1px solid var(--border);
  }

  .score-name { font-size: 11px; font-weight: 600; color: var(--text2); margin-bottom: 8px; }

  .score-ring {
    position: relative;
    width: 64px; height: 64px;
    margin: 0 auto 8px;
  }

  .score-ring svg { transform: rotate(-90deg); }

  .score-ring-val {
    position: absolute; inset: 0;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Syne', sans-serif;
    font-size: 16px; font-weight: 800;
  }

  .score-std {
    font-size: 10px; color: var(--text3);
    text-align: center;
    font-family: 'JetBrains Mono', monospace;
  }

  /* ─── ATTENDANCE HEATMAP ─── */
  .heatmap {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    gap: 4px; margin-top: 12px;
  }

  .heatmap-cell {
    aspect-ratio: 1;
    border-radius: 3px;
    cursor: pointer;
    transition: transform 0.1s;
  }

  .heatmap-cell:hover { transform: scale(1.2); }

  /* ─── NOTIFICATION DOT ─── */
  .notif-dot {
    width: 7px; height: 7px;
    background: var(--red);
    border-radius: 50%;
    position: absolute;
    top: 8px; right: 8px;
  }

  /* ─── FORM CONTROLS ─── */
  .form-group { margin-bottom: 14px; }
  .form-label { font-size: 11px; color: var(--text3); margin-bottom: 5px; display: block; letter-spacing: 0.5px; font-family: 'JetBrains Mono', monospace; text-transform: uppercase; }
  .form-input {
    width: 100%;
    background: var(--bg3);
    border: 1px solid var(--border);
    border-radius: 7px;
    padding: 8px 12px;
    font-size: 13px;
    color: var(--text);
    font-family: 'Space Grotesk', sans-serif;
    outline: none;
    transition: border-color 0.15s;
  }
  .form-input:focus { border-color: var(--accent); }

  /* ─── DRIVE PREVIEW ─── */
  .drive-item {
    display: flex; align-items: center; gap: 10px;
    padding: 10px;
    background: var(--bg3);
    border-radius: 8px;
    margin-bottom: 8px;
    cursor: pointer;
    transition: background 0.1s;
  }

  .drive-item:hover { background: var(--surface2); }

  .drive-icon { font-size: 20px; }
  .drive-name { font-size: 12px; font-weight: 600; }
  .drive-meta { font-size: 10px; color: var(--text3); font-family: 'JetBrains Mono', monospace; }
  .drive-actions { margin-left: auto; display: flex; gap: 6px; }

  /* PAGES */
  .page { display: none; }
  .page.active { display: block; }

  /* ─── SCROLL ─── */
  ::-webkit-scrollbar { width: 6px; height: 6px; }
  ::-webkit-scrollbar-track { background: transparent; }
  ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 99px; }

  /* ─── INLINE SVG CHART ─── */
  .mini-sparkline { overflow: visible; }

  /* ─── TABS ─── */
  .tabs { display: flex; gap: 4px; margin-bottom: 20px; background: var(--bg3); padding: 4px; border-radius: 9px; width: fit-content; }
  .tab {
    padding: 7px 16px; border-radius: 7px;
    font-size: 12px; font-weight: 600;
    cursor: pointer; transition: all 0.15s;
    color: var(--text3);
    border: none; background: none;
    font-family: 'Space Grotesk', sans-serif;
  }
  .tab.active { background: var(--surface2); color: var(--text); }
  .tab:hover:not(.active) { color: var(--text2); }

  .tag {
    display: inline-flex; align-items: center;
    padding: 2px 7px;
    background: var(--bg3);
    border: 1px solid var(--border);
    border-radius: 5px;
    font-size: 10px;
    color: var(--text3);
    font-family: 'JetBrains Mono', monospace;
  }

  .divider {
    height: 1px;
    background: var(--border);
    margin: 20px 0;
  }
</style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="logo">
    <div class="logo-mark">SIGAP</div>
    <div class="logo-sub">Monitor Kegiatan Siswa</div>
  </div>

  <div style="overflow-y:auto; flex:1;">
    <div class="nav-group">Utama</div>
    <div class="nav-item active" onclick="showPage('dashboard')">
      <span class="nav-icon">⬡</span> Dasbor
    </div>
    <div class="nav-item" onclick="showPage('timeline')">
      <span class="nav-icon">◫</span> Timeline Kegiatan
    </div>
    <div class="nav-item" onclick="showPage('kehadiran')">
      <span class="nav-icon">◻</span> Kehadiran
      <span class="nav-badge">3</span>
    </div>

    <div class="nav-group">Modul</div>
    <div class="nav-item" onclick="showPage('rabuan')">
      <span class="nav-icon">◈</span> Rabuan
    </div>
    <div class="nav-item" onclick="showPage('mentoring')">
      <span class="nav-icon">◎</span> Mentoring
    </div>
    <div class="nav-item" onclick="showPage('operasional')">
      <span class="nav-icon">◉</span> Operasional
    </div>
    <div class="nav-item" onclick="showPage('binjas')">
      <span class="nav-icon">◐</span> Bina Jasmani
    </div>

    <div class="nav-group">Sistem</div>
    <div class="nav-item" onclick="showPage('users')">
      <span class="nav-icon">◷</span> Manajemen User
    </div>
    <div class="nav-item">
      <span class="nav-icon">◌</span> Google Drive
      <span class="badge badge-green" style="margin-left:auto;font-size:9px">API ✓</span>
    </div>
    <div class="nav-item">
      <span class="nav-icon">◯</span> Pengaturan
    </div>
  </div>

  <div class="sidebar-footer">
    <div class="user-card">
      <div class="avatar">SA</div>
      <div class="user-info">
        <div class="user-name">Budi Santoso</div>
        <div class="user-role role-super">super_admin</div>
      </div>
    </div>
  </div>
</aside>

<!-- MAIN -->
<div class="main">

  <!-- ═══════════════════ DASHBOARD PAGE ═══════════════════ -->
  <div id="page-dashboard" class="page active">
    <div class="topbar">
      <div class="page-title">Dasbor Analitik</div>
      <div class="topbar-actions">
        <span style="font-size:11px;color:var(--text3);font-family:'JetBrains Mono',monospace;">Rabu, 16 Jul 2025</span>
        <button class="btn btn-ghost">↓ Export</button>
        <button class="btn btn-primary">+ Kegiatan Baru</button>
      </div>
    </div>
    <div class="content">

      <!-- STAT CARDS -->
      <div class="grid-4">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Total Siswa</div>
            <div class="stat-icon" style="background:rgba(59,130,246,0.15)">👤</div>
          </div>
          <div class="card-value">142</div>
          <div class="card-delta delta-up">↑ +8 dari bulan lalu</div>
        </div>
        <div class="card">
          <div class="card-header">
            <div class="card-title">Rata Kehadiran</div>
            <div class="stat-icon" style="background:rgba(16,185,129,0.15)">✓</div>
          </div>
          <div class="card-value">87<span style="font-size:18px;color:var(--text3)">%</span></div>
          <div class="card-delta delta-up">↑ +2.4% minggu ini</div>
        </div>
        <div class="card">
          <div class="card-header">
            <div class="card-title">Sesi Mentoring</div>
            <div class="stat-icon" style="background:rgba(139,92,246,0.15)">◎</div>
          </div>
          <div class="card-value">24</div>
          <div class="card-delta" style="color:var(--text3)">→ bulan ini</div>
        </div>
        <div class="card">
          <div class="card-header">
            <div class="card-title">Operasional</div>
            <div class="stat-icon" style="background:rgba(245,158,11,0.15)">⬡</div>
          </div>
          <div class="card-value">6</div>
          <div class="card-delta delta-down">↓ 1 belum selesai</div>
        </div>
      </div>

      <div class="grid-2" style="margin-top:16px">
        <!-- KEHADIRAN CHART -->
        <div class="card">
          <div class="card-header">
            <div class="card-title">Tingkat Kehadiran per Modul</div>
            <span class="tag">Q3 2025</span>
          </div>
          <div style="margin-bottom:16px">
            <div class="progress-row">
              <span class="progress-label">Rabuan</span>
              <div class="progress-bar">
                <div class="progress-fill" style="width:91%;background:var(--accent)"></div>
              </div>
              <span class="progress-val">91%</span>
            </div>
            <div class="progress-row">
              <span class="progress-label">Mentoring</span>
              <div class="progress-bar">
                <div class="progress-fill" style="width:84%;background:var(--purple)"></div>
              </div>
              <span class="progress-val">84%</span>
            </div>
            <div class="progress-row">
              <span class="progress-label">Bina Jasmani</span>
              <div class="progress-bar">
                <div class="progress-fill" style="width:78%;background:var(--cyan)"></div>
              </div>
              <span class="progress-val">78%</span>
            </div>
          </div>

          <div class="divider"></div>
          <div class="card-title" style="margin-bottom:12px">Tren 6 Bulan</div>
          <div class="bar-chart">
            <div class="bar-col"><div class="bar" style="height:55%;background:var(--accent);opacity:0.5"></div><div class="bar-label">Feb</div></div>
            <div class="bar-col"><div class="bar" style="height:62%;background:var(--accent);opacity:0.6"></div><div class="bar-label">Mar</div></div>
            <div class="bar-col"><div class="bar" style="height:70%;background:var(--accent);opacity:0.7"></div><div class="bar-label">Apr</div></div>
            <div class="bar-col"><div class="bar" style="height:80%;background:var(--accent);opacity:0.8"></div><div class="bar-label">Mei</div></div>
            <div class="bar-col"><div class="bar" style="height:75%;background:var(--accent);opacity:0.9"></div><div class="bar-label">Jun</div></div>
            <div class="bar-col"><div class="bar" style="height:91%;background:var(--accent)"></div><div class="bar-label">Jul</div></div>
          </div>
        </div>

        <!-- AKTIVITAS TERBARU -->
        <div class="card">
          <div class="card-header">
            <div class="card-title">Aktivitas Terbaru</div>
            <button class="btn btn-ghost" style="padding:4px 10px;font-size:11px">Lihat Semua</button>
          </div>

          <div class="timeline-item">
            <div class="tl-dot" style="background:var(--green)"></div>
            <div class="tl-content">
              <div class="tl-title">Notulensi Rabuan diunggah</div>
              <div class="tl-meta">Rapat Evaluasi Q2 · 2 jam lalu · PDF → Drive</div>
            </div>
            <span class="badge badge-green">✓ Sync</span>
          </div>
          <div class="timeline-item">
            <div class="tl-dot" style="background:var(--purple)"></div>
            <div class="tl-content">
              <div class="tl-title">Sesi Mentoring: Navigasi Peta</div>
              <div class="tl-meta">Instruktur: Capt. Rendra · Kemarin</div>
            </div>
            <span class="badge badge-purple">Selesai</span>
          </div>
          <div class="timeline-item">
            <div class="tl-dot" style="background:var(--amber)"></div>
            <div class="tl-content">
              <div class="tl-title">Pra-Operasional: Ekspedisi Rinjani</div>
              <div class="tl-meta">Persiapan 32 peserta · 3 hari lalu</div>
            </div>
            <span class="badge badge-amber">Pra-Ops</span>
          </div>
          <div class="timeline-item">
            <div class="tl-dot" style="background:var(--cyan)"></div>
            <div class="tl-content">
              <div class="tl-title">Binjas: Lari & Panjat Tebing</div>
              <div class="tl-meta">42 siswa · Skor rata: 78.4 · 4 hari lalu</div>
            </div>
            <span class="badge badge-cyan">+Score</span>
          </div>
          <div class="timeline-item">
            <div class="tl-dot" style="background:var(--red)"></div>
            <div class="tl-content">
              <div class="tl-title">Pasca-Ops: 3 alat perlu perbaikan</div>
              <div class="tl-meta">Harness, Carabiner × 2 · 5 hari lalu</div>
            </div>
            <span class="badge badge-red">⚠ Perbaikan</span>
          </div>
        </div>
      </div>

      <!-- BINJAS TOP PERFORMERS -->
      <div class="section-header">
        <div class="section-title">Top Performer — Bina Jasmani</div>
        <button class="btn btn-ghost" style="padding:5px 12px;font-size:12px">Lihat Semua →</button>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Siswa</th>
              <th>Lari 12 Min</th>
              <th>Pull-up</th>
              <th>Push-up</th>
              <th>Sit-up</th>
              <th>Total Skor</th>
              <th>vs Standar</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="color:var(--amber);font-weight:700;font-family:'JetBrains Mono',monospace">01</td>
              <td><strong>Ahmad Fauzi</strong></td>
              <td><span class="tag">2.8 km</span></td>
              <td>22</td>
              <td>52</td>
              <td>60</td>
              <td style="font-family:'Syne',sans-serif;font-weight:800;font-size:16px;color:var(--accent2)">94</td>
              <td><span class="badge badge-green">↑ +12</span></td>
              <td><span class="badge badge-green">LULUS</span></td>
            </tr>
            <tr>
              <td style="color:var(--text3);font-family:'JetBrains Mono',monospace">02</td>
              <td>Siti Rahayu</td>
              <td><span class="tag">2.6 km</span></td>
              <td>18</td>
              <td>48</td>
              <td>55</td>
              <td style="font-family:'Syne',sans-serif;font-weight:800;font-size:16px;color:var(--accent2)">88</td>
              <td><span class="badge badge-green">↑ +8</span></td>
              <td><span class="badge badge-green">LULUS</span></td>
            </tr>
            <tr>
              <td style="color:var(--text3);font-family:'JetBrains Mono',monospace">03</td>
              <td>Dwi Prasetyo</td>
              <td><span class="tag">2.5 km</span></td>
              <td>16</td>
              <td>44</td>
              <td>52</td>
              <td style="font-family:'Syne',sans-serif;font-weight:800;font-size:16px;color:var(--purple)">82</td>
              <td><span class="badge badge-blue">→ +2</span></td>
              <td><span class="badge badge-blue">CUKUP</span></td>
            </tr>
            <tr>
              <td style="color:var(--text3);font-family:'JetBrains Mono',monospace">04</td>
              <td>Rina Wulandari</td>
              <td><span class="tag">2.1 km</span></td>
              <td>12</td>
              <td>38</td>
              <td>44</td>
              <td style="font-family:'Syne',sans-serif;font-weight:800;font-size:16px;color:var(--amber)">68</td>
              <td><span class="badge badge-amber">↓ −4</span></td>
              <td><span class="badge badge-amber">REMEDI</span></td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>

  <!-- ═══════════════════ RABUAN PAGE ═══════════════════ -->
  <div id="page-rabuan" class="page">
    <div class="topbar">
      <div class="page-title">Modul Rabuan (Rapat Rutin)</div>
      <div class="topbar-actions">
        <button class="btn btn-ghost">Jadwal Baru</button>
        <button class="btn btn-primary">↑ Upload Notulensi</button>
      </div>
    </div>
    <div class="content">
      <div class="grid-2">
        <div>
          <div class="section-header" style="margin-top:0">
            <div class="section-title">Jadwal & Notulensi</div>
          </div>
          <div class="table-wrap">
            <table>
              <thead>
                <tr><th>Tanggal</th><th>Agenda</th><th>Notulensi</th><th>Drive</th><th>Status</th></tr>
              </thead>
              <tbody>
                <tr>
                  <td style="font-family:'JetBrains Mono',monospace;font-size:11px">16 Jul 2025</td>
                  <td>Evaluasi Operasional Q2</td>
                  <td><span class="badge badge-green">📄 notulensi_jul16.pdf</span></td>
                  <td><span class="badge badge-blue">🔗 Drive</span></td>
                  <td><span class="badge badge-green">Selesai</span></td>
                </tr>
                <tr>
                  <td style="font-family:'JetBrains Mono',monospace;font-size:11px">09 Jul 2025</td>
                  <td>Persiapan Ekspedisi Rinjani</td>
                  <td><span class="badge badge-green">📄 notulensi_jul09.pdf</span></td>
                  <td><span class="badge badge-blue">🔗 Drive</span></td>
                  <td><span class="badge badge-green">Selesai</span></td>
                </tr>
                <tr>
                  <td style="font-family:'JetBrains Mono',monospace;font-size:11px">02 Jul 2025</td>
                  <td>Evaluasi Binjas Semester 1</td>
                  <td><span class="badge badge-green">📄 notulensi_jul02.pdf</span></td>
                  <td><span class="badge badge-blue">🔗 Drive</span></td>
                  <td><span class="badge badge-green">Selesai</span></td>
                </tr>
                <tr>
                  <td style="font-family:'JetBrains Mono',monospace;font-size:11px">23 Jul 2025</td>
                  <td>Rapat Koordinasi Mentoring</td>
                  <td><span class="badge badge-amber">— Belum</span></td>
                  <td>—</td>
                  <td><span class="badge badge-amber">Mendatang</span></td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- DRIVE ITEMS -->
          <div class="section-header">
            <div class="section-title">Google Drive — Folder Rabuan</div>
            <span class="tag">Sync Otomatis</span>
          </div>
          <div class="drive-item">
            <div class="drive-icon">📄</div>
            <div>
              <div class="drive-name">notulensi_jul16.pdf</div>
              <div class="drive-meta">320 KB · 16 Jul 2025 14:32</div>
            </div>
            <div class="drive-actions">
              <button class="btn btn-ghost" style="padding:4px 9px;font-size:11px">👁 Lihat</button>
              <button class="btn btn-ghost" style="padding:4px 9px;font-size:11px">↓ Unduh</button>
            </div>
          </div>
          <div class="drive-item">
            <div class="drive-icon">📄</div>
            <div>
              <div class="drive-name">notulensi_jul09.pdf</div>
              <div class="drive-meta">285 KB · 9 Jul 2025 15:10</div>
            </div>
            <div class="drive-actions">
              <button class="btn btn-ghost" style="padding:4px 9px;font-size:11px">👁 Lihat</button>
              <button class="btn btn-ghost" style="padding:4px 9px;font-size:11px">↓ Unduh</button>
            </div>
          </div>
        </div>

        <!-- UPLOAD FORM -->
        <div>
          <div class="section-header" style="margin-top:0">
            <div class="section-title">Upload Notulensi Baru</div>
          </div>
          <div class="card">
            <div class="form-group">
              <label class="form-label">Tanggal Rapat</label>
              <input class="form-input" type="date" value="2025-07-16">
            </div>
            <div class="form-group">
              <label class="form-label">Agenda / Judul Rapat</label>
              <input class="form-input" type="text" placeholder="Contoh: Evaluasi Operasional Q2">
            </div>
            <div class="form-group">
              <label class="form-label">Peserta Hadir</label>
              <input class="form-input" type="text" placeholder="Jumlah peserta">
            </div>
            <div class="form-group">
              <label class="form-label">Catatan Singkat</label>
              <textarea class="form-input" rows="3" placeholder="Ringkasan keputusan rapat..."></textarea>
            </div>
            <label class="form-label">File Notulensi (.pdf)</label>
            <div class="upload-area">
              <div class="upload-icon">📄</div>
              <div class="upload-text">Drag & drop file PDF di sini</div>
              <div class="upload-hint">atau klik untuk pilih file · maks 10MB</div>
              <div style="margin-top:12px;padding:6px 12px;background:rgba(59,130,246,0.1);border-radius:6px;font-size:11px;color:var(--accent2);font-family:'JetBrains Mono',monospace">
                📁 Target Drive: /SIGAP/Rabuan/2025/
              </div>
            </div>
            <button class="btn btn-primary" style="width:100%;justify-content:center;margin-top:14px;padding:10px">
              ↑ Upload & Simpan ke Drive
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════ MENTORING PAGE ═══════════════════ -->
  <div id="page-mentoring" class="page">
    <div class="topbar">
      <div class="page-title">Modul Mentoring</div>
      <div class="topbar-actions">
        <button class="btn btn-primary">+ Sesi Baru</button>
      </div>
    </div>
    <div class="content">
      <div class="table-wrap">
        <table>
          <thead>
            <tr><th>#</th><th>Judul Materi</th><th>Pengisi / Mentor</th><th>Tanggal</th><th>Bahan Ajar</th><th>Kebutuhan Logistik</th><th>Hadir</th><th>Status</th></tr>
          </thead>
          <tbody>
            <tr>
              <td style="font-family:'JetBrains Mono',monospace;color:var(--text3)">001</td>
              <td><strong>Navigasi Peta & Kompas</strong></td>
              <td>Capt. Rendra Wijaya</td>
              <td style="font-family:'JetBrains Mono',monospace;font-size:11px">15 Jul 2025</td>
              <td><span class="badge badge-blue">📎 modul_nav.pdf</span></td>
              <td><span class="tag">Peta × 40, Kompas × 40</span></td>
              <td><span style="font-family:'JetBrains Mono',monospace">38/40</span></td>
              <td><span class="badge badge-green">Selesai</span></td>
            </tr>
            <tr>
              <td style="font-family:'JetBrains Mono',monospace;color:var(--text3)">002</td>
              <td><strong>P3K & Manajemen Krisis</strong></td>
              <td>dr. Sari Kusuma</td>
              <td style="font-family:'JetBrains Mono',monospace;font-size:11px">08 Jul 2025</td>
              <td><span class="badge badge-blue">📎 p3k_handbook.pdf</span></td>
              <td><span class="tag">Kit P3K × 8</span></td>
              <td><span style="font-family:'JetBrains Mono',monospace">40/40</span></td>
              <td><span class="badge badge-green">Selesai</span></td>
            </tr>
            <tr>
              <td style="font-family:'JetBrains Mono',monospace;color:var(--text3)">003</td>
              <td><strong>Teknik Survival Hutan</strong></td>
              <td>Instruktur Bagas</td>
              <td style="font-family:'JetBrains Mono',monospace;font-size:11px">23 Jul 2025</td>
              <td><span class="badge badge-amber">— Belum</span></td>
              <td><span class="tag">Pisau × 40, Tinder Kit × 10</span></td>
              <td>—</td>
              <td><span class="badge badge-amber">Mendatang</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- ═══════════════════ OPERASIONAL PAGE ═══════════════════ -->
  <div id="page-operasional" class="page">
    <div class="topbar">
      <div class="page-title">Modul Operasional Kegiatan</div>
      <div class="topbar-actions">
        <button class="btn btn-primary">+ Operasional Baru</button>
      </div>
    </div>
    <div class="content">

      <!-- FASE TABS -->
      <div class="tabs">
        <button class="tab active" onclick="switchTab(this, 'tab-pra')">① Pra-Operasional</button>
        <button class="tab" onclick="switchTab(this, 'tab-ops')">② Operasional</button>
        <button class="tab" onclick="switchTab(this, 'tab-pasca')">③ Pasca-Operasional</button>
      </div>

      <!-- PRE-OPS TAB -->
      <div id="tab-pra" class="tab-content">
        <div class="grid-2">
          <div>
            <div class="card">
              <div class="card-header">
                <div class="card-title">Informasi Kegiatan</div>
                <span class="badge badge-amber">Pra-Ops</span>
              </div>
              <div class="form-group"><label class="form-label">Nama Kegiatan</label><input class="form-input" value="Ekspedisi Gunung Rinjani 2025"></div>
              <div class="form-group"><label class="form-label">Tanggal Pelaksanaan</label><input class="form-input" type="date" value="2025-08-10"></div>
              <div class="form-group"><label class="form-label">Lokasi</label><input class="form-input" value="Gunung Rinjani, Lombok NTB"></div>
              <div class="form-group"><label class="form-label">Jumlah Peserta</label><input class="form-input" type="number" value="32"></div>
            </div>

            <!-- PERBEKALAN REGU -->
            <div class="card" style="margin-top:16px">
              <div class="card-header">
                <div class="card-title">Perbekalan & Peralatan Regu</div>
              </div>
              <table style="font-size:12px">
                <thead><tr><th>Item</th><th>Jumlah</th><th>Satuan</th><th>Status</th></tr></thead>
                <tbody>
                  <tr><td>Tenda Kelompok</td><td>8</td><td>Unit</td><td><span class="badge badge-green">Siap</span></td></tr>
                  <tr><td>Kompor Gas</td><td>8</td><td>Unit</td><td><span class="badge badge-green">Siap</span></td></tr>
                  <tr><td>Tabung Gas</td><td>16</td><td>Tabung</td><td><span class="badge badge-amber">Pesan</span></td></tr>
                  <tr><td>Tali Karmantel</td><td>4</td><td>Roll</td><td><span class="badge badge-green">Siap</span></td></tr>
                  <tr><td>Obat-obatan</td><td>8</td><td>Kit</td><td><span class="badge badge-amber">Pesan</span></td></tr>
                </tbody>
              </table>
            </div>
          </div>

          <div>
            <!-- DATA SISWA -->
            <div class="card">
              <div class="card-header">
                <div class="card-title">Data Siswa Peserta (32)</div>
                <button class="btn btn-ghost" style="font-size:11px;padding:4px 10px">+ Tambah</button>
              </div>
              <div style="max-height:200px;overflow-y:auto">
                <table style="font-size:12px">
                  <thead><tr><th>No</th><th>Nama</th><th>Regu</th><th>Peralatan Pribadi</th><th>Hadir</th></tr></thead>
                  <tbody>
                    <tr><td style="font-family:'JetBrains Mono',monospace">01</td><td>Ahmad Fauzi</td><td>Alpha</td><td><span class="badge badge-green">✓ Lengkap</span></td><td>✅</td></tr>
                    <tr><td style="font-family:'JetBrains Mono',monospace">02</td><td>Siti Rahayu</td><td>Alpha</td><td><span class="badge badge-green">✓ Lengkap</span></td><td>✅</td></tr>
                    <tr><td style="font-family:'JetBrains Mono',monospace">03</td><td>Dwi Prasetyo</td><td>Bravo</td><td><span class="badge badge-amber">⚠ Kurang</span></td><td>✅</td></tr>
                    <tr><td style="font-family:'JetBrains Mono',monospace">04</td><td>Rina W.</td><td>Bravo</td><td><span class="badge badge-green">✓ Lengkap</span></td><td>✅</td></tr>
                    <tr><td style="font-family:'JetBrains Mono',monospace">05</td><td>Bowo Santosa</td><td>Charlie</td><td><span class="badge badge-green">✓ Lengkap</span></td><td>❌</td></tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- PERALATAN PRIBADI CHECKLIST -->
            <div class="card" style="margin-top:16px">
              <div class="card-header"><div class="card-title">Peralatan Pribadi — Checklist</div></div>
              <div class="check-item">
                <div class="check-box checked">✓</div>
                <span class="check-label">Sepatu gunung</span>
                <span class="badge badge-green">32/32</span>
              </div>
              <div class="check-item">
                <div class="check-box checked">✓</div>
                <span class="check-label">Carrier / Ransel 60L+</span>
                <span class="badge badge-green">32/32</span>
              </div>
              <div class="check-item">
                <div class="check-box checked">✓</div>
                <span class="check-label">Jaket gunung (waterproof)</span>
                <span class="badge badge-amber">30/32</span>
              </div>
              <div class="check-item">
                <div class="check-box">–</div>
                <span class="check-label">Sleeping bag (-5°C)</span>
                <span class="badge badge-red">28/32</span>
              </div>
              <div class="check-item">
                <div class="check-box checked">✓</div>
                <span class="check-label">Headlamp + baterai cadangan</span>
                <span class="badge badge-green">32/32</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- OPS TAB (hidden by default) -->
      <div id="tab-ops" class="tab-content" style="display:none">
        <div class="grid-2">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Status Pelaksanaan</div>
              <span class="badge badge-blue">In Progress</span>
            </div>
            <div style="margin:16px 0;text-align:center">
              <div style="font-size:48px">🏔️</div>
              <div style="font-family:'Syne',sans-serif;font-size:18px;font-weight:800;margin:8px 0">Ekspedisi Rinjani 2025</div>
              <div style="color:var(--text3);font-size:13px">10 – 14 Agustus 2025 · 32 Peserta</div>
              <div style="display:flex;gap:12px;justify-content:center;margin-top:16px">
                <span class="badge badge-blue">Hari ke-2</span>
                <span class="badge badge-green">Semua Selamat</span>
                <span class="badge badge-green">Komunikasi OK</span>
              </div>
            </div>
            <div class="divider"></div>
            <div class="card-title" style="margin-bottom:12px">Upload Laporan Hasil Kegiatan</div>
            <div class="upload-area">
              <div class="upload-icon">📋</div>
              <div class="upload-text">Upload Laporan Operasional (.pdf)</div>
              <div class="upload-hint">Tersimpan otomatis ke Google Drive</div>
              <div style="margin-top:12px;padding:6px 12px;background:rgba(59,130,246,0.1);border-radius:6px;font-size:11px;color:var(--accent2);font-family:'JetBrains Mono',monospace">
                📁 Target: /SIGAP/Operasional/2025/
              </div>
            </div>
            <button class="btn btn-primary" style="width:100%;justify-content:center;margin-top:12px;padding:10px">
              ↑ Upload & Selesaikan Operasional
            </button>
          </div>

          <div class="card">
            <div class="card-header"><div class="card-title">Dokumen Tersimpan di Drive</div></div>
            <div class="drive-item">
              <div class="drive-icon">📋</div>
              <div>
                <div class="drive-name">laporan_rinjani_hari1.pdf</div>
                <div class="drive-meta">Field report · 11 Agt · 1.2 MB</div>
              </div>
              <div class="drive-actions">
                <button class="btn btn-ghost" style="padding:4px 9px;font-size:11px">👁 Preview</button>
              </div>
            </div>
            <div style="margin-top:16px;padding:16px;background:var(--bg3);border-radius:10px;border:1px solid var(--border);text-align:center;color:var(--text3);font-size:12px">
              <div style="font-size:32px;margin-bottom:8px">📄</div>
              PDF Preview Area<br>
              <span style="font-family:'JetBrains Mono',monospace;font-size:10px">laporan_rinjani_hari1.pdf</span>
            </div>
          </div>
        </div>
      </div>

      <!-- PASCA TAB (hidden) -->
      <div id="tab-pasca" class="tab-content" style="display:none">
        <div class="grid-2">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Checklist Pemeliharaan — Peralatan Regu</div>
              <span class="tag">Pasca Rinjani 2025</span>
            </div>
            <div style="display:flex;gap:8px;margin-bottom:12px">
              <span class="badge badge-green">Layak: 12</span>
              <span class="badge badge-amber">Perbaikan: 3</span>
              <span class="badge badge-red">Tidak Layak: 1</span>
            </div>
            <div class="check-item">
              <span class="check-label">Tenda kelompok (×8)</span>
              <div class="radio-group">
                <span class="radio-opt layak">Layak</span>
              </div>
            </div>
            <div class="check-item">
              <span class="check-label">Tali Karmantel (×4)</span>
              <div class="radio-group">
                <span class="radio-opt layak">Layak</span>
              </div>
            </div>
            <div class="check-item">
              <span class="check-label">Harness (×8)</span>
              <div class="radio-group">
                <span class="radio-opt perbaikan">Perbaikan</span>
              </div>
            </div>
            <div class="check-item">
              <span class="check-label">Carabiner (×24)</span>
              <div class="radio-group">
                <span class="radio-opt perbaikan">Perbaikan</span>
              </div>
            </div>
            <div class="check-item">
              <span class="check-label">Kompor gas (×8)</span>
              <div class="radio-group">
                <span class="radio-opt layak">Layak</span>
              </div>
            </div>
            <div class="check-item">
              <span class="check-label">Stretcher lipat (×2)</span>
              <div class="radio-group">
                <span class="radio-opt tidak-layak" style="background:rgba(239,68,68,0.15);color:var(--red);border-color:var(--red)">Tidak Layak</span>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <div class="card-title">Checklist — Peralatan Pribadi (Sampel)</div>
            </div>
            <div class="check-item">
              <span class="check-label">Sepatu gunung Ahmad F.</span>
              <div class="radio-group"><span class="radio-opt layak">Layak</span></div>
            </div>
            <div class="check-item">
              <span class="check-label">Carrier Siti R.</span>
              <div class="radio-group"><span class="radio-opt layak">Layak</span></div>
            </div>
            <div class="check-item">
              <span class="check-label">Jaket Dwi P.</span>
              <div class="radio-group"><span class="radio-opt perbaikan">Perbaikan</span></div>
            </div>
            <div class="check-item">
              <span class="check-label">Sleeping bag Rina W.</span>
              <div class="radio-group"><span class="radio-opt layak">Layak</span></div>
            </div>
            <div style="margin-top:16px">
              <button class="btn btn-primary" style="width:100%;justify-content:center;padding:10px">Simpan Laporan Recovery</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- ═══════════════════ BINA JASMANI PAGE ═══════════════════ -->
  <div id="page-binjas" class="page">
    <div class="topbar">
      <div class="page-title">Bina Jasmani — Rekap Skor</div>
      <div class="topbar-actions">
        <button class="btn btn-ghost">Standar Nilai</button>
        <button class="btn btn-primary">+ Input Nilai Latihan</button>
      </div>
    </div>
    <div class="content">

      <!-- STANDARISASI BANNER -->
      <div style="background:var(--bg3);border:1px solid var(--border);border-radius:10px;padding:14px 20px;margin-bottom:20px;display:flex;align-items:center;gap:20px">
        <span style="font-size:20px">📏</span>
        <div>
          <div style="font-size:12px;font-weight:700;color:var(--text)">Standar Nilai Minimum</div>
          <div style="font-size:11px;color:var(--text3);font-family:'JetBrains Mono',monospace;margin-top:2px">
            Lari 12 Min: ≥2.4km &nbsp;·&nbsp; Pull-up: ≥15 &nbsp;·&nbsp; Push-up: ≥40 &nbsp;·&nbsp; Sit-up: ≥50 &nbsp;·&nbsp; Total: ≥80
          </div>
        </div>
        <span class="badge badge-blue" style="margin-left:auto">Periode Jul 2025</span>
      </div>

      <!-- SCORE RINGS -->
      <div class="section-header" style="margin-top:0">
        <div class="section-title">Visualisasi Individual</div>
      </div>
      <div class="score-grid">
        <div class="score-card">
          <div class="score-name">Ahmad Fauzi</div>
          <div class="score-ring">
            <svg width="64" height="64" viewBox="0 0 64 64">
              <circle cx="32" cy="32" r="26" fill="none" stroke="var(--bg)" stroke-width="6"/>
              <circle cx="32" cy="32" r="26" fill="none" stroke="var(--accent)" stroke-width="6"
                stroke-dasharray="163.4" stroke-dashoffset="9.8" stroke-linecap="round"/>
            </svg>
            <div class="score-ring-val" style="color:var(--accent2)">94</div>
          </div>
          <div class="score-std">Standar: 80 · <span style="color:var(--green)">+14 ↑</span></div>
        </div>
        <div class="score-card">
          <div class="score-name">Siti Rahayu</div>
          <div class="score-ring">
            <svg width="64" height="64" viewBox="0 0 64 64">
              <circle cx="32" cy="32" r="26" fill="none" stroke="var(--bg)" stroke-width="6"/>
              <circle cx="32" cy="32" r="26" fill="none" stroke="var(--purple)" stroke-width="6"
                stroke-dasharray="163.4" stroke-dashoffset="19.6" stroke-linecap="round"/>
            </svg>
            <div class="score-ring-val" style="color:var(--purple)">88</div>
          </div>
          <div class="score-std">Standar: 80 · <span style="color:var(--green)">+8 ↑</span></div>
        </div>
        <div class="score-card">
          <div class="score-name">Dwi Prasetyo</div>
          <div class="score-ring">
            <svg width="64" height="64" viewBox="0 0 64 64">
              <circle cx="32" cy="32" r="26" fill="none" stroke="var(--bg)" stroke-width="6"/>
              <circle cx="32" cy="32" r="26" fill="none" stroke="var(--cyan)" stroke-width="6"
                stroke-dasharray="163.4" stroke-dashoffset="29.4" stroke-linecap="round"/>
            </svg>
            <div class="score-ring-val" style="color:var(--cyan)">82</div>
          </div>
          <div class="score-std">Standar: 80 · <span style="color:var(--green)">+2 ↑</span></div>
        </div>
        <div class="score-card">
          <div class="score-name">Rina Wulandari</div>
          <div class="score-ring">
            <svg width="64" height="64" viewBox="0 0 64 64">
              <circle cx="32" cy="32" r="26" fill="none" stroke="var(--bg)" stroke-width="6"/>
              <circle cx="32" cy="32" r="26" fill="none" stroke="var(--amber)" stroke-width="6"
                stroke-dasharray="163.4" stroke-dashoffset="49.0" stroke-linecap="round"/>
            </svg>
            <div class="score-ring-val" style="color:var(--amber)">68</div>
          </div>
          <div class="score-std">Standar: 80 · <span style="color:var(--red)">−12 ↓</span></div>
        </div>
        <div class="score-card">
          <div class="score-name">Bowo Santosa</div>
          <div class="score-ring">
            <svg width="64" height="64" viewBox="0 0 64 64">
              <circle cx="32" cy="32" r="26" fill="none" stroke="var(--bg)" stroke-width="6"/>
              <circle cx="32" cy="32" r="26" fill="none" stroke="var(--accent)" stroke-width="6"
                stroke-dasharray="163.4" stroke-dashoffset="16.3" stroke-linecap="round"/>
            </svg>
            <div class="score-ring-val" style="color:var(--accent2)">90</div>
          </div>
          <div class="score-std">Standar: 80 · <span style="color:var(--green)">+10 ↑</span></div>
        </div>
        <div class="score-card" style="border:1px dashed var(--border);display:flex;align-items:center;justify-content:center;cursor:pointer">
          <div style="text-align:center;color:var(--text3)">
            <div style="font-size:24px;margin-bottom:6px">+</div>
            <div style="font-size:11px">Input Nilai</div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- ═══════════════════ TIMELINE PAGE ═══════════════════ -->
  <div id="page-timeline" class="page">
    <div class="topbar">
      <div class="page-title">Timeline Kegiatan — Juli 2025</div>
      <div class="topbar-actions">
        <button class="btn btn-ghost">◁ Jun</button>
        <button class="btn btn-ghost">Agt ▷</button>
      </div>
    </div>
    <div class="content">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Gantt Chart — Kegiatan Terpadu</div>
          <div style="display:flex;gap:8px">
            <span class="badge badge-blue">● Rabuan</span>
            <span class="badge badge-purple">● Mentoring</span>
            <span class="badge badge-amber">● Operasional</span>
            <span class="badge badge-cyan">● Binjas</span>
          </div>
        </div>

        <!-- GANTT HEADER -->
        <div style="margin-left:120px;display:grid;grid-template-columns:repeat(31,1fr);gap:0;margin-bottom:4px;min-width:500px;overflow-x:auto">
          <div style="font-size:9px;color:var(--text3);font-family:'JetBrains Mono',monospace;grid-column:1/8;padding-left:4px">Jul 1–7</div>
          <div style="font-size:9px;color:var(--text3);font-family:'JetBrains Mono',monospace;grid-column:8/15;padding-left:4px">Jul 8–14</div>
          <div style="font-size:9px;color:var(--text3);font-family:'JetBrains Mono',monospace;grid-column:15/22;padding-left:4px">Jul 15–21</div>
          <div style="font-size:9px;color:var(--text3);font-family:'JetBrains Mono',monospace;grid-column:22/31;padding-left:4px">Jul 22–31</div>
        </div>

        <div class="gantt-wrap">
          <div class="gantt-row">
            <div class="gantt-label">Rabuan Mingguan</div>
            <div class="gantt-track">
              <div class="gantt-bar" style="left:6%;width:2%;background:var(--accent)">R</div>
              <div class="gantt-bar" style="left:29%;width:2%;background:var(--accent)">R</div>
              <div class="gantt-bar" style="left:52%;width:2%;background:var(--accent)">R</div>
              <div class="gantt-bar" style="left:74%;width:2%;background:rgba(59,130,246,0.4)">R</div>
            </div>
          </div>
          <div class="gantt-row">
            <div class="gantt-label">Mentoring: Navigasi</div>
            <div class="gantt-track">
              <div class="gantt-bar" style="left:48%;width:4%;background:var(--purple)">Nav</div>
            </div>
          </div>
          <div class="gantt-row">
            <div class="gantt-label">Mentoring: Survival</div>
            <div class="gantt-track">
              <div class="gantt-bar" style="left:71%;width:4%;background:rgba(139,92,246,0.5)">Surv</div>
            </div>
          </div>
          <div class="gantt-row">
            <div class="gantt-label">Pra-Ops Rinjani</div>
            <div class="gantt-track">
              <div class="gantt-bar" style="left:0%;width:30%;background:rgba(245,158,11,0.25);border:1px solid var(--amber);color:var(--amber)">Persiapan Pra-Ops</div>
            </div>
          </div>
          <div class="gantt-row">
            <div class="gantt-label">Operasional Rinjani</div>
            <div class="gantt-track">
              <div class="gantt-bar" style="left:30%;width:45%;background:var(--amber);opacity:0.7">Ekspedisi Gunung Rinjani</div>
            </div>
          </div>
          <div class="gantt-row">
            <div class="gantt-label">Binjas Reguler</div>
            <div class="gantt-track">
              <div class="gantt-bar" style="left:3%;width:3%;background:var(--cyan)">B</div>
              <div class="gantt-bar" style="left:13%;width:3%;background:var(--cyan)">B</div>
              <div class="gantt-bar" style="left:23%;width:3%;background:var(--cyan)">B</div>
              <div class="gantt-bar" style="left:77%;width:3%;background:rgba(6,182,212,0.4)">B</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════ KEHADIRAN PAGE ═══════════════════ -->
  <div id="page-kehadiran" class="page">
    <div class="topbar">
      <div class="page-title">Modul Kehadiran</div>
      <div class="topbar-actions">
        <button class="btn btn-primary">+ Input Kehadiran</button>
      </div>
    </div>
    <div class="content">
      <div class="tabs">
        <button class="tab active">Rabuan</button>
        <button class="tab">Mentoring</button>
        <button class="tab">Bina Jasmani</button>
      </div>

      <div class="grid-2">
        <div>
          <div class="table-wrap">
            <table>
              <thead><tr><th>No</th><th>Nama Siswa</th><th>09 Jul</th><th>16 Jul</th><th>23 Jul</th><th>30 Jul</th><th>%</th></tr></thead>
              <tbody>
                <tr>
                  <td style="font-family:'JetBrains Mono',monospace">01</td>
                  <td>Ahmad Fauzi</td>
                  <td>✅</td><td>✅</td><td>✅</td><td>✅</td>
                  <td><span class="badge badge-green">100%</span></td>
                </tr>
                <tr>
                  <td style="font-family:'JetBrains Mono',monospace">02</td>
                  <td>Siti Rahayu</td>
                  <td>✅</td><td>✅</td><td>❌</td><td>✅</td>
                  <td><span class="badge badge-blue">75%</span></td>
                </tr>
                <tr>
                  <td style="font-family:'JetBrains Mono',monospace">03</td>
                  <td>Dwi Prasetyo</td>
                  <td>✅</td><td>✅</td><td>✅</td><td>❌</td>
                  <td><span class="badge badge-blue">75%</span></td>
                </tr>
                <tr>
                  <td style="font-family:'JetBrains Mono',monospace">04</td>
                  <td>Rina Wulandari</td>
                  <td>❌</td><td>✅</td><td>❌</td><td>✅</td>
                  <td><span class="badge badge-amber">50%</span></td>
                </tr>
                <tr>
                  <td style="font-family:'JetBrains Mono',monospace">05</td>
                  <td>Bowo Santosa</td>
                  <td>✅</td><td>✅</td><td>✅</td><td>✅</td>
                  <td><span class="badge badge-green">100%</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <div class="card-title">Heatmap Kehadiran — Jul 2025</div>
          </div>
          <div style="font-size:10px;color:var(--text3);font-family:'JetBrains Mono',monospace;margin-bottom:4px">
            Min &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sen &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sel &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rab &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kam &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Jum &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sab
          </div>
          <div style="display:grid;grid-template-columns:repeat(7,1fr);gap:4px">
            <!-- Week 1 -->
            <div class="heatmap-cell" style="background:var(--bg3)"></div>
            <div class="heatmap-cell" style="background:var(--bg3)"></div>
            <div class="heatmap-cell" style="background:var(--bg3)"></div>
            <div class="heatmap-cell" style="background:rgba(16,185,129,0.8);height:24px;border-radius:4px" title="Rabuan 2 Jul"></div>
            <div class="heatmap-cell" style="background:var(--bg3)"></div>
            <div class="heatmap-cell" style="background:var(--bg3)"></div>
            <div class="heatmap-cell" style="background:rgba(6,182,212,0.6);height:24px;border-radius:4px" title="Binjas 5 Jul"></div>
            <!-- Week 2 -->
            <div class="heatmap-cell" style="background:var(--bg3);height:24px;border-radius:4px"></div>
            <div class="heatmap-cell" style="background:var(--bg3);height:24px;border-radius:4px"></div>
            <div class="heatmap-cell" style="background:var(--bg3);height:24px;border-radius:4px"></div>
            <div class="heatmap-cell" style="background:rgba(16,185,129,0.9);height:24px;border-radius:4px" title="Rabuan 9 Jul"></div>
            <div class="heatmap-cell" style="background:var(--bg3);height:24px;border-radius:4px"></div>
            <div class="heatmap-cell" style="background:var(--bg3);height:24px;border-radius:4px"></div>
            <div class="heatmap-cell" style="background:rgba(6,182,212,0.8);height:24px;border-radius:4px" title="Binjas 12 Jul"></div>
            <!-- Week 3 -->
            <div class="heatmap-cell" style="background:var(--bg3);height:24px;border-radius:4px"></div>
            <div class="heatmap-cell" style="background:var(--bg3);height:24px;border-radius:4px"></div>
            <div class="heatmap-cell" style="background:rgba(139,92,246,0.7);height:24px;border-radius:4px" title="Mentoring 15 Jul"></div>
            <div class="heatmap-cell" style="background:rgba(16,185,129,1.0);height:24px;border-radius:4px" title="Rabuan 16 Jul"></div>
            <div class="heatmap-cell" style="background:var(--bg3);height:24px;border-radius:4px"></div>
            <div class="heatmap-cell" style="background:var(--bg3);height:24px;border-radius:4px"></div>
            <div class="heatmap-cell" style="background:rgba(6,182,212,0.9);height:24px;border-radius:4px" title="Binjas 19 Jul"></div>
          </div>
          <div style="display:flex;gap:10px;margin-top:12px;font-size:10px;color:var(--text3)">
            <span>⬛ Tidak Ada</span>
            <span style="color:var(--green)">⬛ Rabuan</span>
            <span style="color:var(--purple)">⬛ Mentoring</span>
            <span style="color:var(--cyan)">⬛ Binjas</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════ USERS PAGE ═══════════════════ -->
  <div id="page-users" class="page">
    <div class="topbar">
      <div class="page-title">Manajemen Pengguna</div>
      <div class="topbar-actions">
        <button class="btn btn-primary">+ Tambah Admin</button>
      </div>
    </div>
    <div class="content">
      <div style="background:rgba(245,158,11,0.08);border:1px solid rgba(245,158,11,0.3);border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:12px;color:var(--amber)">
        ⚠ Halaman ini hanya dapat diakses oleh <strong>Super Admin</strong>. Admin biasa tidak dapat mengelola pengguna.
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr><th>ID</th><th>Nama</th><th>Email</th><th>Role</th><th>Terakhir Aktif</th><th>Status</th><th>Aksi</th></tr>
          </thead>
          <tbody>
            <tr>
              <td style="font-family:'JetBrains Mono',monospace;color:var(--text3)">USR001</td>
              <td><strong>Budi Santoso</strong></td>
              <td style="font-family:'JetBrains Mono',monospace;font-size:11px">budi@sigap.id</td>
              <td><span class="badge badge-amber">Super Admin</span></td>
              <td style="font-family:'JetBrains Mono',monospace;font-size:11px">Sekarang</td>
              <td><span class="badge badge-green">Aktif</span></td>
              <td style="color:var(--text3);font-size:11px">—</td>
            </tr>
            <tr>
              <td style="font-family:'JetBrains Mono',monospace;color:var(--text3)">USR002</td>
              <td>Dewi Anggraini</td>
              <td style="font-family:'JetBrains Mono',monospace;font-size:11px">dewi@sigap.id</td>
              <td><span class="badge badge-blue">Admin</span></td>
              <td style="font-family:'JetBrains Mono',monospace;font-size:11px">2 jam lalu</td>
              <td><span class="badge badge-green">Aktif</span></td>
              <td><button class="btn btn-ghost" style="font-size:11px;padding:3px 9px">Edit</button></td>
            </tr>
            <tr>
              <td style="font-family:'JetBrains Mono',monospace;color:var(--text3)">USR003</td>
              <td>Fajar Nugroho</td>
              <td style="font-family:'JetBrains Mono',monospace;font-size:11px">fajar@sigap.id</td>
              <td><span class="badge badge-blue">Admin</span></td>
              <td style="font-family:'JetBrains Mono',monospace;font-size:11px">1 hari lalu</td>
              <td><span class="badge badge-green">Aktif</span></td>
              <td><button class="btn btn-ghost" style="font-size:11px;padding:3px 9px">Edit</button></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="section-header">
        <div class="section-title">Pengaturan Google Drive API</div>
      </div>
      <div class="card" style="max-width:500px">
        <div class="form-group">
          <label class="form-label">Service Account Key</label>
          <div style="display:flex;gap:8px;align-items:center">
            <input class="form-input" type="password" value="••••••••••••••••••••••" style="flex:1">
            <button class="btn btn-ghost" style="font-size:11px">Ubah</button>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Folder Rabuan</label>
          <input class="form-input" value="/SIGAP/Rabuan/2025/">
        </div>
        <div class="form-group">
          <label class="form-label">Folder Operasional</label>
          <input class="form-input" value="/SIGAP/Operasional/2025/">
        </div>
        <div style="display:flex;gap:8px;margin-top:4px">
          <button class="btn btn-ghost">Test Koneksi</button>
          <button class="btn btn-primary">Simpan Pengaturan</button>
        </div>
        <div style="margin-top:12px;display:flex;align-items:center;gap:8px;font-size:12px">
          <span class="badge badge-green">● Connected</span>
          <span style="color:var(--text3);font-family:'JetBrains Mono',monospace;font-size:10px">google-drive-api v3 · Last sync: 14:32</span>
        </div>
      </div>

    </div>
  </div>

</div><!-- /main -->

<script>
function showPage(name) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.getElementById('page-' + name).classList.add('active');
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  event.currentTarget.classList.add('active');
}

function switchTab(btn, tabId) {
  // Switch tab button state
  btn.closest('.tabs').querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
  btn.classList.add('active');
  // Switch content
  btn.closest('.content').querySelectorAll('.tab-content').forEach(t => t.style.display = 'none');
  document.getElementById(tabId).style.display = 'block';
}
</script>
</body>
</html>