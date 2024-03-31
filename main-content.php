<div id="main-content" style="<?php echo isset($_SESSION['username']) ? '' : 'display: none;'; ?>">
    <div id="toolbar">
        <button onclick="toggleToolbar()">Afficher/Cacher Toolbar</button>
        <button onclick="loadPDFs()">Charger les PDFs</button>
        <button onclick="openMessagePage()">Participer à la discussion</button>
    </div>
    <div id="content">
        <h1>Groupe des informaticiens</h1>
        <img src="logo.png" alt="Logo">
    </div>
</div>
