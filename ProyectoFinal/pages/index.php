<?php
include('../templates/header.php'); 
include('../includes/db.php');

// Consultar los libros
$sql_libros = "SELECT id_titulo, titulo, tipo, precio, fecha_pub FROM titulos";
$stmt_libros = $pdo->query($sql_libros);
$libros = $stmt_libros->fetchAll();

// Consultar los autores con información completa
$sql_autores = "SELECT 
                    ta.id_autor, 
                    fa.fotografia, 
                    ta.derechos, 
                    ta.ord_au, 
                    a.nombre, 
                    a.apellido, 
                    a.telefono, 
                    a.direccion, 
                    a.ciudad, 
                    a.estado, 
                    a.pais, 
                    a.cod_postal
                FROM titulo_autor ta
                LEFT JOIN fotografias fa ON ta.id_autor = fa.id_autor
                LEFT JOIN autores a ON ta.id_autor = a.id_autor";
$stmt_autores = $pdo->query($sql_autores);
$autores = $stmt_autores->fetchAll();

// Filtrar los autores que no tienen nombre
$autores_filtrados = array_filter($autores, function($autor) {
    return !empty($autor['nombre']);
});
?>

<!-- Header-->
<header class="masthead text-center text-white">
    <div class="masthead-content">
        <div class="container px-5">
            <h1 class="masthead-heading mb-0">Bienvenidos a Nuestra Librería Virtual</h1>
            <h2 class="masthead-subheading mb-0">Nos Complace Recibirte</h2>
            <a class="btn btn-xl rounded-pill mt-5" href="#Portfolio">Bienvenidos</a>
            <a class="btn btn-xl rounded-pill mt-5" href="#Libros">Libros</a>
            <a class="btn btn-xl rounded-pill mt-5" href="#Autores">Autores</a>
        </div>
    </div>
</header>

<body>
<!-- Sección de Portfolio-->
<section id="Portfolio" class="bg-dark text-white text-center py-5">
    <div class="container">
        <h1 class="display-4">Bienvenido</h1>
        <p class="lead">Esta es nuestra librería digital</p>
    </div>
</section>

<section class="content-section" id="portfolio">
    <div class="row gx-0">
        <div class="col-lg-6">
            <a class="portfolio-item" href="index.php">
                <div class="caption">
                    <div class="caption-content">
                        <div class="h2">Inicio</div>
                        <p class="mb-0">Bienvenido a nuestra página principal con todas las secciones.</p>
                    </div>
                </div>
                <img class="img-fluid" src="../assets/img/5.png" alt="Inicio" />
            </a>
        </div>
        <div class="col-lg-6">
            <a class="portfolio-item" href="libros.php">
                <div class="caption">
                    <div class="caption-content">
                        <div class="h2">Libros</div>
                        <p class="mb-0">Descubre nuestra colección de libros, desde los más clásicos hasta los más recientes.</p>
                    </div>
                </div>
                <img class="img-fluid" src="../assets/img/4.png" alt="Libros" />
            </a>
        </div>
        <div class="col-lg-6">
            <a class="portfolio-item" href="autores.php">
                <div class="caption">
                    <div class="caption-content">
                        <div class="h2">Autores</div>
                        <p class="mb-0">Conoce a nuestros talentosos autores y sus contribuciones literarias.</p>
                    </div>
                </div>
                <img class="img-fluid" src="../assets/img/3.png" alt="Autores" />
            </a>
        </div>
        <div class="col-lg-6">
            <a class="portfolio-item" href="contacto.php">
                <div class="caption">
                    <div class="caption-content">
                        <div class="h2">Contacto</div>
                        <p class="mb-0">Ponte en contacto con nosotros para cualquier consulta o solicitud.</p>
                    </div>
                </div>
                <img class="img-fluid" src="../assets/img/2.png" alt="Contacto" />
            </a>
        </div>
    </div>
</section>

<!-- Sección de Libros-->
<section id="Libros" class="bg-dark text-white text-center py-5">
    <div class="container">
        <h1 class="display-4">Libros</h1>
        <p class="lead">Esperamos que encuentres lo que buscas</p>
    </div>
</section>

<div><br /><br /><div>
    <div class="col-md-10 offset-md-1">
        <h1 class="text-center mb-4" style="color: var(--forest-bark-brown);">Catálogo de Libros</h1><br />
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h2 class="h4 mb-0">Libros Disponibles</h2>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Tipo</th>
                                <th>Precio</th>
                                <th>Fecha de Publicación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($libros as $libro): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($libro['titulo'] ?? 'No disponible'); ?></td>
                                <td><?php echo htmlspecialchars($libro['tipo'] ?? 'Desconocido'); ?></td>
                                <td>$<?php echo number_format($libro['precio'] ?? 0, 2); ?></td>
                                <td><?php echo htmlspecialchars($libro['fecha_pub'] ?? 'No disponible'); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<!-- Sección de Autores-->
<section id="Autores" class="bg-dark text-white text-center py-5">
    <div class="container">
        <h1 class="display-4">Autores</h1>
        <p class="lead">Estos son nuestros autores</p>
    </div>
</section>

<div><br /><br /><div>
<div class="col-md-10 offset-md-1">
    <h1 class="text-center mb-4" style="color: var(--forest-bark-brown);">Catálogo de Autores</h1><br />
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="h4 mb-0">Autores Registrados</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <?php foreach ($autores as $autor): ?>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 autor-card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h3 class="h5"><?php echo htmlspecialchars($autor['nombre'] ?? 'N/A') . ' ' . htmlspecialchars($autor['apellido'] ?? 'N/A'); ?></h3>
                                    <p><strong>ID Autor:</strong> <?php echo htmlspecialchars($autor['id_autor'] ?? 'N/A'); ?></p>
                                    <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($autor['telefono'] ?? 'N/A'); ?></p>
                                    <p><strong>Dirección:</strong> <?php echo htmlspecialchars($autor['direccion'] ?? 'N/A'); ?></p>
                                    <p><strong>Ciudad:</strong> <?php echo htmlspecialchars($autor['ciudad'] ?? 'N/A'); ?></p>
                                    <p><strong>Estado:</strong> <?php echo htmlspecialchars($autor['estado'] ?? 'N/A'); ?></p>
                                    <p><strong>País:</strong> <?php echo htmlspecialchars($autor['pais'] ?? 'N/A'); ?></p>
                                    <p><strong>Código Postal:</strong> <?php echo htmlspecialchars($autor['cod_postal'] ?? 'N/A'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php
include('../templates/footer.php'); 
?>
