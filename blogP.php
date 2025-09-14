<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$user = "fabi3557_db_gei";
$pass = "Iyamoopo16%";
$db   = "fabi3557_db_gei";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Erro ao conectar: " . $conn->connect_error);

$id = intval($_GET['id'] ?? 0);
if (!$id) die("ID do artigo não informado.");

// Busca o artigo
$sql = "SELECT * FROM artigos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$artigo = $result->fetch_assoc();
if (!$artigo) die("Artigo não encontrado.");

// Busca todas as partes do artigo
$sql_partes = "SELECT * FROM artigos_partes WHERE artigo_id = ? ORDER BY parte ASC";
$stmt_partes = $conn->prepare($sql_partes);
$stmt_partes->bind_param("i", $id);
$stmt_partes->execute();
$res_partes = $stmt_partes->get_result();
$partes = $res_partes->fetch_all(MYSQLI_ASSOC);

// Função para imagem válida
function imagem_valida($img) {
  if (!$img) return 'https://via.placeholder.com/800x400?text=Imagem+indispon%C3%ADvel';
  if (file_exists(__DIR__ . '/uploads/' . $img)) return 'uploads/' . $img;
  return $img;
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($artigo['titulo']) ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  background: #fefeff;
  font-family: 'Georgia', serif;
  margin:0;
  padding:0;
}

header {
  background: #142b51;
  color: white;
  padding: 25px;
  text-align: center;
}

.voltar-blog {
  display: inline-block;
  margin-top: 10px;
  margin-bottom: 15px;
  padding: 10px 20px;
  background-color: #fec582;
  color: #142b51;
  text-decoration: none;
  border-radius: 5px;
  font-weight: bold;
  transition: background 0.3s;
}
.voltar-blog:hover {
  background-color: #e0a85a;
}

.container {
  max-width: 900px;
  margin: 40px auto;
  padding: 30px;
  position: relative;
}

.article-box {
  border: 1px solid #ccc; /* borda cinza fina */
  padding: 30px; /* mais espaçamento interno */
  position: relative;
}

.autor-info {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 25px;
  flex-wrap: wrap;
}

.autor-info img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
}

.imagem-artigo {
  width: 100%;
  height: auto;
  margin-bottom: 25px;
}

.parte {
  margin-bottom: 35px;
}

.parte img {
  max-width: 100%;
  height: auto;
  margin: 15px 0;
}

h1 { font-size: 28px; color: #142b51; font-style: italic; }
h2 { font-size: 22px; color: #2c3e50; margin-top: 25px; }
p { font-size: 18px; line-height: 1.6; color: #333; }

/* TRÊS PONTINHOS DE MENU */
.menu-share {
  position: absolute;
  top: 20px;
  right: 20px;
  cursor: pointer;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 18px;
}

.menu-share span {
  display: block;
  width: 5px;       /* leve aumento */
  height: 5px;      /* leve aumento */
  background: #142b51; /* cor mais harmoniosa com header */
  border-radius: 50%;
  transition: transform 0.2s;
}

/* hover nos pontinhos para efeito */
.menu-share:hover span:nth-child(1) {
  transform: translateY(-2px);
}
.menu-share:hover span:nth-child(3) {
  transform: translateY(2px);
}

.share-options {
  display: none;
  position: absolute;
  top: 30px;
  right: 0;
  background: #fff;
  border: 1px solid #ccc;
  padding: 10px;
  z-index: 100;
  text-align: center;
  border-radius: 8px; /* cantos levemente arredondados */
  box-shadow: 0 3px 8px rgba(0,0,0,0.15);
}

.share-options a {
  display: flex;
  align-items: center;
  gap: 8px; /* espaçamento maior entre ícone e texto */
  margin-bottom: 8px;
  text-decoration: none;
  color: inherit;
  font-size: 14px;
}

.share-options a img {
  width: 28px;  /* leve aumento */
  height: 28px; /* leve aumento */
}

/* RESPONSIVO */
@media (max-width: 768px) {
  .container { margin: 20px 10px; padding: 20px; }
  .autor-info { justify-content: center; }
  h1 { font-size: 24px; }
  h2 { font-size: 20px; }
  p { font-size: 16px; }
  .share-options {
    right: auto;
    left: 50%;
    transform: translateX(-50%);
  }
}
</style>
<script>
function toggleShare() {
  const options = document.getElementById('shareOptions');
  options.style.display = options.style.display === 'block' ? 'none' : 'block';
}

function copyLink() {
  navigator.clipboard.writeText(window.location.href);
  alert('Link copiado!');
}
</script>
</head>
<body>

<header>
  <h1><?= htmlspecialchars($artigo['titulo']) ?></h1>
  <a href="blogC.php" class="voltar-blog">← Voltar para o Blog</a>
</header>

<div class="container">
  <div class="article-box">
    <div class="autor-info">
      <img src="<?= htmlspecialchars(imagem_valida($artigo['autor_foto'])) ?>" alt="Autor">
      <strong><?= htmlspecialchars($artigo['autor']) ?></strong>
    </div>

    <?php if (!empty($partes[0]['imagem'])): ?>
      <img src="<?= imagem_valida($partes[0]['imagem']) ?>" alt="Imagem do artigo" class="imagem-artigo">
    <?php endif; ?>

    <?php foreach ($partes as $parte): ?>
      <div class="parte">
        <?php if (!empty($parte['titulo'])): ?>
          <h2><?= htmlspecialchars($parte['titulo']) ?></h2>
        <?php endif; ?>
        <?php if (!empty($parte['texto'])): ?>
          <p><?= nl2br(htmlspecialchars($parte['texto'])) ?></p>
        <?php endif; ?>
        <?php if (!empty($parte['imagem']) && $parte !== $partes[0]): ?>
          <img src="<?= imagem_valida($parte['imagem']) ?>" alt="Imagem da parte">
        <?php endif; ?>
      </div>
    <?php endforeach; ?>

    <!-- TRÊS PONTINHOS MENU -->
    <div class="menu-share" onclick="toggleShare()">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div class="share-options" id="shareOptions">
      <a href="https://twitter.com/intent/tweet?url=<?= urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) ?>" target="_blank">
        <img src="https://img.icons8.com/color/48/000000/twitter.png"/> X
      </a>
      <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) ?>" target="_blank">
        <img src="https://img.icons8.com/color/48/000000/facebook-new.png"/> Facebook
      </a>
      <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) ?>" target="_blank">
        <img src="https://img.icons8.com/color/48/000000/linkedin.png"/> LinkedIn
      </a>
      <a href="javascript:void(0)" onclick="copyLink()">
        <img src="https://img.icons8.com/color/48/000000/copy.png"/> Copiar link
      </a>
    </div>

  </div>
</div>

<!-- INCLUDE DO FOOTER -->
<?php include 'footerb.php'; ?>

</body>
</html>
