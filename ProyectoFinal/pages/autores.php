<?php
include('../templates/header.php');
include('../includes/db.php');

// Consulta de autores
$sql_autores = "SELECT 
                    ta.id_autor, 
                    COALESCE(a.nombre, 'Desconocido') AS nombre, 
                    COALESCE(a.apellido, 'Desconocido') AS apellido, 
                    a.telefono, 
                    a.direccion, 
                    a.ciudad, 
                    a.estado, 
                    a.pais, 
                    a.cod_postal,
                    ta.derechos, 
                    ta.ord_au, 
                    fa.fotografia
                FROM titulo_autor ta
                LEFT JOIN autores a ON ta.id_autor = a.id_autor
                LEFT JOIN fotografias fa ON ta.id_autor = fa.id_autor
                WHERE a.nombre != 'Desconocido' AND a.apellido != 'Desconocido'"; 

// Ejecutar la consulta
$stmt_autores = $pdo->query($sql_autores);
$autores = $stmt_autores->fetchAll();
?>

<!-- Header-->
<header class="masthead-au text-center text-white">
    <div class="masthead-content">
        <div class="container px-5">
            <h1 class="masthead-heading mb-0">Conoce a Nuestros Autores, Nos Complace Recibirte</h1>
            <h2 class="masthead-subheading mb-0">Esperamos encuentres lo que buscas</h2>
            <a class="btn btn-primary btn-xl rounded-pill mt-5" href="#Autores">Autores</a>
        </div>
    </div>
</header>

<body>
<section id="Autores" class="bg-dark text-white text-center py-5">
    <div class="container">
        <h1 class="display-4">Autores</h1>
        <p class="lead">Estos son nuestros autores</p>
    </div>
</section>

<div><br /><br /></div>
<div class="container" id="autores-container">
    <div class="row" id="autores-row">
        <h1 class="text-center mb-4" style="color: var(--forest-bark-brown);">Nuestros Autores</h1>
        <?php foreach ($autores as $autor): ?>
            <div class="col-md-4 mb-4" id="autor-<?php echo htmlspecialchars($autor['id_autor']); ?>">
                <div class="card shadow-sm autor-card">
                    <div class="card-body text-center">
                        <!-- Mostrar fotografía si está disponible -->
                        <?php if ($autor['fotografia']): ?>
                            <img src="../imagenes/autores/<?php echo htmlspecialchars($autor['fotografia']); ?>" 
                                alt="Foto de <?php echo htmlspecialchars($autor['nombre']); ?>" 
                                class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;" id="foto-<?php echo htmlspecialchars($autor['id_autor']); ?>">
                        <?php else: ?>
                            <div class="bg-light rounded-circle mb-3 mx-auto" style="width: 150px; height: 150px;" id="foto-placeholder-<?php echo htmlspecialchars($autor['id_autor']); ?>"></div>
                        <?php endif; ?>

                        <!-- Nombre y Apellido -->
                        <h5 class="card-title" id="nombre-<?php echo htmlspecialchars($autor['id_autor']); ?>">
                            <?php echo htmlspecialchars($autor['nombre']) . ' ' . htmlspecialchars($autor['apellido']); ?>
                        </h5>
                        
                        <!-- Mostrar los demás datos -->
                        <p class="card-text">
                            <strong>Teléfono:</strong> <?php echo htmlspecialchars($autor['telefono'] ?? 'No disponible'); ?><br>
                            <strong>Dirección:</strong> <?php echo htmlspecialchars($autor['direccion'] ?? 'No disponible'); ?><br>
                            <strong>Ciudad:</strong> <?php echo htmlspecialchars($autor['ciudad'] ?? 'No disponible'); ?><br>
                            <strong>Estado:</strong> <?php echo htmlspecialchars($autor['estado'] ?? 'No disponible'); ?><br>
                            <strong>País:</strong> <?php echo htmlspecialchars($autor['pais'] ?? 'No disponible'); ?><br>
                        </p>

                        <!-- Derechos y Orden -->
                        <p class="card-text">
                            Derechos: <?php echo htmlspecialchars($autor['derechos']); ?>%<br>
                            Orden de autor: <?php echo htmlspecialchars($autor['ord_au']); ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
include('../templates/footer.php');
?>
