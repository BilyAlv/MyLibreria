<?php
include('../templates/header.php'); 
include('../includes/db.php');

// Consultar los libros
$sql_libros = "SELECT id_titulo, notas, titulo, tipo, COALESCE(precio, 0) AS precio, fecha_pub FROM titulos ORDER BY fecha_pub DESC";
$stmt_libros = $pdo->query($sql_libros);
$libros = $stmt_libros->fetchAll();

// Formatear precios y manejar valores nulos
foreach ($libros as &$libro) {
    $libro['precio'] = number_format((float)$libro['precio'], 2, '.', '');
}
?>

<!-- Header-->
<header class="masthead-lib text-center text-white">
    <div class="masthead-content">
        <div class="container px-5">
            <h1 class="masthead-heading mb-0">Esta es Nuestra Librería Virtual</h1>
            <h2 class="masthead-subheading mb-0">Nos Complace Recibirte, Bienvenidos</h2>
            <a class="btn btn-primary btn-xl rounded-pill mt-5" href="#Libros">Libros</a>
        </div>
    </div>
</header>

<body> 
    <section id="Libros" class="bg-dark text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Libros</h1>
            <p class="lead">¿Tienes ganas de leer algún libro?</p>
        </div>
    </section>

    <div><br /><br /></div>
<div class="col-md-10 offset-md-1">
    <h1 class="text-center mb-4" style="color: var(--forest-bark-brown);">Catálogo de Libros</h1>
    <div class="row g-4">
        <?php if (empty($libros)): ?>
            <div class="alert alert-info mt-3 text-center">
                No hay libros disponibles en este momento.
            </div>
        <?php else: ?>
            <?php foreach ($libros as $libro): ?>
                <div class="col-md-4 col-sm-6">
                    <div class="card-libro">
                        <img src="..\imagenes\libros\default-book.png" class="card-img-top" alt="Imagen del libro">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($libro['titulo']); ?></h5>
                            <p class="card-text">
                                <strong>Tipo:</strong> <?php echo htmlspecialchars($libro['tipo']); ?><br>
                                <strong>Precio:</strong> $<?php echo $libro['precio']; ?><br>
                                <strong>Publicado:</strong> <?php echo htmlspecialchars($libro['fecha_pub']); ?><br>
                                <strong>Nota:</strong> <?php echo htmlspecialchars($libro['notas']); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php
include('../templates/footer.php'); 
?>
