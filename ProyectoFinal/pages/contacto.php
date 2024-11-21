<?php
include('../templates/header.php');
include('../includes/db.php');

// Manejar el envío del comentario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $asunto = $_POST['asunto'];
    $comentario = $_POST['comentario'];

    // Insertar el nuevo comentario en la base de datos
    $sql_insert = "INSERT INTO comentarios (nombre, correo, asunto, comentario, fecha) VALUES (:nombre, :correo, :asunto, :comentario, NOW())";
    $stmt_insert = $pdo->prepare($sql_insert);
    $stmt_insert->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt_insert->bindParam(':correo', $correo, PDO::PARAM_STR);
    $stmt_insert->bindParam(':asunto', $asunto, PDO::PARAM_STR);
    $stmt_insert->bindParam(':comentario', $comentario, PDO::PARAM_STR);

    if ($stmt_insert->execute()) {
        // Redirigir con un mensaje de éxito
        header("Location: contacto.php?mensaje=Comentario enviado con éxito");
        exit();
    } else {
        // Redirigir con un mensaje de error si falla la inserción
        header("Location: contacto.php?mensaje=Error al enviar el comentario");
        exit();
    }
}

// Eliminar comentario
if (isset($_GET['eliminar_id'])) {
    $id_comentario = $_GET['eliminar_id'];

    // Eliminar el comentario de la base de datos
    $sql_delete = "DELETE FROM comentarios WHERE id = :id";
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->bindParam(':id', $id_comentario, PDO::PARAM_INT);

    if ($stmt_delete->execute()) {
        // Redirigir a la página de contacto con un mensaje de éxito
        header("Location: contacto.php?mensaje=Comentario eliminado con éxito");
        exit();
    } else {
        // Redirigir a la página de contacto con un mensaje de error
        header("Location: contacto.php?mensaje=Error al eliminar el comentario");
        exit();
    }
}

// Obtener los comentarios de la base de datos
$sql = "SELECT * FROM comentarios ORDER BY fecha DESC";
$stmt = $pdo->query($sql);
$comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- Header -->
<header class="masthead-cont text-center text-white">
    <div class="masthead-content">
        <div class="container px-5">
            <h1 class="masthead-heading mb-0">Contactanos, estamos siempre a tu orden</h1>
            <h2 class="masthead-subheading mb-0">De igual manera, si quieres compartir algo adelante</h2>
            <a class="btn btn-primary btn-xl rounded-pill mt-5" href="#Contacto">Contacto</a>
        </div>
    </div>
</header>

<body>
    <section id="Contacto" class="bg-dark text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Contacto</h1>
            <p class="lead">¿Tienes alguna pregunta o comentario?</p>
        </div>
    </section>

    <main class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h2 class="text-success mb-4"><i class="fas fa-paper-plane"></i> Envíame un mensaje</h2>
                    <form method="POST" action="contacto.php">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="correo" name="correo" required>
                        </div>
                        <div class="mb-3">
                            <label for="asunto" class="form-label">Asunto</label>
                            <input type="text" class="form-control" id="asunto" name="asunto" required>
                        </div>
                        <div class="mb-3">
                            <label for="comentario" class="form-label">Mensaje</label>
                            <textarea class="form-control" id="comentario" name="comentario" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Enviar mensaje</button>
                    </form>
                </div>
                <div class="col-md-6 mb-4">
                    <h2 class="text-success mb-4"><i class="fas fa-info-circle"></i> Información de contacto</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-map-marker-alt text-success me-2"></i> 54 Av. Canada, San Jose de Ocoa, Republica Dominicana</li>
                        <li class="mb-3"><i class="fas fa-phone text-success me-2"></i> +1 (829) 267-9095</li>
                        <li class="mb-3"><i class="fas fa-envelope text-success me-2"></i> bilymanuelalvarezsanchez@gmail.com</li>
                    </ul>
                </div>
            </div>

            <!-- Mostrar comentarios -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-success mb-4">Comentarios</h3>
                    <?php if (isset($_GET['mensaje'])): ?>
                        <div class="alert alert-info"><?= htmlspecialchars($_GET['mensaje']) ?></div>
                    <?php endif; ?>
                    <div id="comentariosContainer">
                        <?php foreach ($comentarios as $comentario): ?>
                            <div class="comentario mb-3 p-3 bg-light position-relative">
                                <!-- Botón de eliminación -->
                                <button onclick="eliminarComentario(<?= $comentario['id']; ?>)" class="close-btn position-absolute top-0 end-0 m-2">×</button>
                                <h4 class="h6 mb-2"><?= htmlspecialchars($comentario['nombre']) ?></h4>
                                <p class="mb-1"><?= htmlspecialchars($comentario['comentario']) ?></p>
                                <small class="text-muted">Publicado el <?= $comentario['fecha'] ?></small>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php
include('../templates/footer.php');
?>
