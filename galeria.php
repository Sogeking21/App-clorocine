<?php include"cabecalho.php"?>

<?php

 /* consulta no banco de dados */

$bd = new SQLite3("filmes.db");
$sql = "SELECT * FROM filmes";
$filmes = $bd->query($sql);

  /*  primeiro filme
 $filme1 =[
  "titulo"=>"Vingadores: Ultimato",
  "nota" => 8.6,
  "sinopse" => "Após os eventos devastadores de Vingadores: Guerra Infinita, o universo está em ruínas devido aos esforços do Titã Louco, Thanos. Com a ajuda de aliados remanescentes, os Vingadores devem se reunir mais uma vez a fim de desfazer as ações de Thanos e restaurar a ordem no universo de uma vez por todas, não importando as consequências.",
  "poster" => "https://www.themoviedb.org/t/p/original/zBXAjVMp92PvGovg148Qz0IjrEF.jpg"
 ];
 // segundo filme
 $filme2 =[
  "titulo"=>"Ad Astra - Rumo às Estrelas",
  "nota" => 6.1,
  "sinopse" => "Roy McBride é um engenheiro espacial, portador de um leve grau de autismo, que decide empreender a maior jornada de sua vida: viajar para o espaço, cruzar a galáxia e tentar descobrir o que aconteceu com seu pai, um astronauta que se perdeu há vinte anos atrás no caminho para Netuno.",
  "poster" => "https://www.themoviedb.org/t/p/original/dJ3VPQTg2gST26IKIk75TNHViB0.jpg"
 ];
// terceiro filme
 $filme3 =[
  "titulo"=>"Parasita",
  "nota" => 8.5,
  "sinopse" => "Toda a família de Ki-taek está desempregada, vivendo num porão sujo e apertado. Uma obra do acaso faz com que o filho adolescente da família comece a dar aulas de inglês à garota de uma família rica. Fascinados com a vida luxuosa destas pessoas, pai, mãe, filho e filha bolam um plano para se infiltrarem também na família burguesa, um a um. No entanto, os segredos e mentiras necessários à ascensão social custarão caro a todos.",
  "poster" => "https://www.themoviedb.org/t/p/original/igw938inb6Fy0YVcwIyxQ7Lu5FO.jpg"
 ];
 //quarto filme
 $filme4 =[
  "titulo"=>"O Auto da Compadecida ",
  "nota" => 8.3,
  "sinopse" => "O Auto da Compadecida: As aventuras dos nordestinos João Grilo (Matheus Natchergaele), um sertanejo pobre e mentiroso, e Chicó (Selton Mello), o mais covarde dos homens. Ambos lutam pelo pão de cada dia e atravessam por vários episódios enganando a todos do pequeno vilarejo de Taperoá, no sertão da Paraíba. A salvação da dupla acontece com a aparição da Nossa Senhora (Fernanda Montenegro). Adaptação da obra de Ariano Suassuna.",
  "poster" => "https://www.themoviedb.org/t/p/original/imcOp1kJsCsAFCoOtY5OnPrFbAf.jpg"
 ];
// quinto filme
 $filme5 =[
  "titulo"=>"Star Wars: Os Últimos Jedi",
  "nota" => 6.9,
  "sinopse" => "A tranquila e solitária vida de Luke Skywalker sofre uma reviravolta quando ele conhece Rey, uma jovem que mostra fortes sinais da Força. O desejo dela de aprender o estilo dos Jedi força Luke a tomar uma decisão que mudará sua vida para sempre. Enquanto isso, Kylo Ren e o General Hux lideram a Primeira Ordem para um ataque total contra Leia e a Resistência pela supremacia da galáxia.",
  "poster" => "https://www.themoviedb.org/t/p/original/2iGN0aKHJYD0xQydlfuCUAcgNbO.jpg"
 ]; */



//$filmes = [$filme1, $filme2, $filme3, $filme4,$filme5];

?>

<body>
<!--nav-->
  <nav class="nav-extended purple lighten-3">
    <div class="nav-wrapper">

      <ul id="nav-mobile" class="right">
        <li class="active"><a href="galeria.php">Galeira</a></li>
        <li class=""><a href="cadastrar.php">Cadastar</a></li>
      </ul>
    </div>
    <div class="nav-header center">
      <h1>CLOROCINE</h1>
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent  purple darken-1">
        <li class="tab"><a class="active"  href="#test1">Todos</a></li>
        <li class="tab"><a href="#test2">Assistidos</a></li>
        <li class="tab"><a href="#test3">Favoritos</a></li>
      </ul>
    </div>
  </nav>
<!--card -->
<div class="container">
  <div class="row">
    <?php while($filme = $filmes->fetchArray()) : ?>
    <div class="col s12 m6 l3">
      <div class="card hoverable">
        <div class="card-image">
          <img src="<?php echo$filme["poster"]?>">
          
          <a class="btn-floating halfway-fab waves-effect waves-light red">
            <i class="material-icons">favorite_border</i></a>
        </div>
        <div class="card-content">
          <P class="valign-wrapper">
            <i class="material-icons amber-text">star</i></a><?php echo$filme["nota"]?>
          </P>
          <span class="card-title"><?php echo$filme["titulo"]?></span>
          <p><?php echo$filme["sinopse"]?></p>
        </div>
      </div>
    </div>
     <?php endwhile ?>
  </div>
</div>

</body>

</html>