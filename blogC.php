<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$user = "fabi3557_db_gei";
$pass = "Iyamoopo16%";
$db   = "fabi3557_db_gei";
$conn = new mysqli($host, $user, $pass, $db);
if($conn->connect_error) die("Erro ao conectar: ".$conn->connect_error);

$sql = "SELECT * FROM artigos ORDER BY id DESC";
$res = $conn->query($sql);
$artigos = $res->fetch_all(MYSQLI_ASSOC);

function imagem_valida($img) {
    if (!$img) return 'https://via.placeholder.com/600x400?text=Imagem+indispon%C3%ADvel';
    if (file_exists(__DIR__ . '/uploads/' . $img)) return 'uploads/' . $img;
    return $img;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Blog</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* Header */
header {
    background: #142b51;
    color: white;
    padding: 25px;
    text-align: center;
}
header h1 {
    margin:0;
    font-size: 20px;
}
header a {
    color: #fec582;
    text-decoration: none;
    font-weight: bold;
}

/* Banner Sobre Mim */
.banner-sobremim {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(to right, #00ff00, #ff7f00);
    color: #fff;
    padding: 50px;
    gap: 20px;
}
.banner-sobremim .texto {
    flex: 1 1 65%;
}
.banner-sobremim .texto h2 {
    font-size: 28px;
    margin-bottom: 15px;
}
.banner-sobremim .texto p {
    font-size: 16px;
    line-height: 1.6;
}
.banner-sobremim .redes {
    margin-top: 15px;
}
.banner-sobremim .foto {
    flex: 0 0 30%;
}
.banner-sobremim .foto img {
    width: 100%;
    border-radius: 10px;
}

/* Container de artigos */
.artigos-section {
    max-width: 1200px;
    margin: 40px auto;
}
.artigos-section h3 {
    text-align: center;
    font-size: 22px;
    margin-bottom: 30px;
}

/* Bloco de artigo */
.artigo-box {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 40px;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    position: relative;
}
.artigo-box .imagem {
    flex: 0 0 50%;
    min-height: 250px;
}
.artigo-box .imagem img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.artigo-box .conteudo {
    flex: 0 0 50%;
    padding: 30px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
}
.artigo-box .conteudo h4 {
    font-size: 22px;
    font-style: italic;
    color: #142b51;
    margin-bottom: 10px;
}
.artigo-box .conteudo p {
    font-size: 16px;
    line-height: 1.6;
    color: #142b51;
}

/* Menu compartilhar */
.menu-share {
    position: absolute;
    top: 10px;
    right: 10px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 18px;
    cursor: pointer;
}
.menu-share span {
    width: 4px;
    height: 4px;
    background: #000;
    border-radius: 50%;
}
.share-options {
    display: none;
    position: absolute;
    top: 30px;
    right: 10px;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    z-index: 100;
    text-align: center;
}
.share-options a {
    text-decoration: none;
    color: #142b51;
    font-size: 14px;
}

/* Responsivo */
@media (max-width:768px){
    .banner-sobremim {
        flex-direction: column;
        text-align: center;
    }
    .banner-sobremim .foto {
        flex: 0 0 50%;
        margin-top: 20px;
    }
    .artigo-box {
        flex-direction: column;
    }
    .artigo-box .imagem, .artigo-box .conteudo {
        flex: 1 1 100%;
    }
    .artigo-box .conteudo {
        padding: 20px;
    }
}
</style>

<script>
function toggleShare(el){
    const menu = el.nextElementSibling;
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}
</script>
</head>
<body>

<header>
    <h1>Desvende o que há por trás dos seus sentimentos e transforme sua vida!</h1>
</header>

<!-- Banner Sobre Mim -->
<div class="banner-sobremim" style="background: #fff; max-width: 1200px; margin: 40px auto; padding: 40px; display: flex; flex-wrap: wrap; gap: 20px; border-radius: 10px; align-items: center;">
    <div class="texto" style="flex: 1 1 65%; color: #142b51;">
        <h2 style="font-size: 56px; margin-bottom: 20px;">Sobre mim</h2>
        <p style="font-size: 18px; line-height: 1.6; margin-bottom: 20px;">
            Meu nome é Fabio Lopes<br>
            Sou Professor Universitário há 16 anos. Sou Mestre em Ensino de Física e Matemática, que são as disciplinas da minha formação inicial há mais de 20 anos. Fiz doutorado na Itália em 2018, quando iniciei meus estudos em Psicanálise Clínica. Desde então venho me especializando na área e, atualmente, sou especialista em Psicodiagnóstico, Programação Neurolinguística, Neuropsicológica e Psicanálise e Racismo, entre outras.
        </p>
        <div class="redes">
            <a href="#" target="_blank"><img src="https://img.icons8.com/ios-filled/50/142b51/facebook.png" alt="Facebook" style="width:32px; height:32px; margin-right:10px;"></a>
            <a href="#" target="_blank"><img src="https://img.icons8.com/ios-filled/50/142b51/linkedin.png" alt="LinkedIn" style="width:32px; height:32px; margin-right:10px;"></a>
            <a href="#" target="_blank"><img src="https://img.icons8.com/ios-filled/50/142b51/twitter.png" alt="Twitter" style="width:32px; height:32px; margin-right:10px;"></a>
            <a href="#" target="_blank"><img src="https://img.icons8.com/ios-filled/50/142b51/instagram-new.png" alt="Instagram" style="width:32px; height:32px;"></a>
        </div>
    </div>
    <div class="foto" style="flex: 0 0 30%;">
    <img src="https://lh3.googleusercontent.com/a/ACg8ocKQc84DDx_jPtS_xWY7seGYRgv_aKDwWxecP9G_cgrKqA%3Ds96-c" 
         alt="Foto Fabio Lopes" 
         style="width:100%; height:100%; object-fit:cover; border-radius:0; display:block;">
</div>



</div>

<!-- Artigos -->
<div class="artigos-section">
    <h3>Artigos Mais Recentes</h3>
    <?php foreach($artigos as $artigo):
    // Busca a primeira parte do artigo
    $sql_partes = "SELECT * FROM artigos_partes WHERE artigo_id={$artigo['id']} ORDER BY parte ASC LIMIT 1";
    $res_partes = $conn->query($sql_partes);
    $parte = $res_partes->fetch_assoc();

    // Se não existir imagem, usa placeholder
    $imagem = $parte['imagem'] ?? '';
    if (empty($imagem)) {
        $imagem = 'https://cdn.pixabay.com/photo/2016/11/21/06/53/beautiful-natural-image-1844362_640.jpg';
    }

    // Texto do resumo
    $texto_resumo = '';
if (!empty($parte['texto'])) {
    $texto_resumo = $parte['texto'];
} else {
    $texto_resumo = $artigo['texto'] ?? 'Sem descrição disponível';
}

?>
<div class="artigo-box" style="display:flex; flex-wrap:wrap; background:#fff; border-radius:8px; overflow:hidden; margin-bottom:40px; box-shadow:0 2px 6px rgba(0,0,0,0.05); position:relative;">

    <!-- Imagem à esquerda -->
    <div class="imagem" style="flex:0 0 50%; min-height:250px;">
        <a href="blogP.php?id=<?= $artigo['id'] ?>">
            <img src="<?= htmlspecialchars($imagem) ?>" alt="Imagem artigo" style="width:100%; height:100%; object-fit:cover;">
        </a>
    </div>

    <!-- Conteúdo à direita -->
    <div class="conteudo" style="flex:0 0 50%; padding:30px; display:flex; flex-direction:column; justify-content:flex-start; position:relative;">

        <!-- Menu 3 pontinhos no canto superior direito -->
        <div class="menu-share" onclick="toggleShare(this)" style="position:absolute; top:10px; right:10px; cursor:pointer; display:flex; flex-direction:column; justify-content:space-between; height:18px;">
            <span style="display:block; width:4px; height:4px; background:#000; border-radius:50%;"></span>
            <span style="display:block; width:4px; height:4px; background:#000; border-radius:50%;"></span>
            <span style="display:block; width:4px; height:4px; background:#000; border-radius:50%;"></span>
        </div>
        <div class="share-options" style="display:none; position:absolute; top:30px; right:10px; background:#fff; border:1px solid #ccc; padding:10px; border-radius:5px; z-index:100; text-align:center;">
            <a href="javascript:void(0)" onclick="navigator.clipboard.writeText(window.location.href); alert('Link copiado!');" style="text-decoration:none; color:#142b51;">Compartilhar Link</a>
        </div>

        <!-- Título -->
        <h4 style="margin:0 0 10px 0; font-size:22px; font-style:italic; color:#142b51;">
            <a href="blogP.php?id=<?= $artigo['id'] ?>" style="text-decoration:none; color:#142b51;"><?= htmlspecialchars($artigo['titulo']) ?></a>
        </h4>

        <!-- Resumo -->
        <p style="margin:0; font-size:16px; line-height:1.6; color:#142b51;">
            <?= htmlspecialchars(mb_substr(strip_tags($texto_resumo), 0, 200)) ?>...
        </p>

    </div>
</div>
<?php endforeach; ?>

<?php include 'footerb.php'; ?>
</body>
</html>
