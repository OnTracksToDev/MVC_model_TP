
<!-- ********** EXAMPLE POUR CARROUSSEL (FABIEN)************ -->

<? php foreach($results2 as $key => $photo){
 ?>
 // Début de la boucle foreach pour parcourir le tableau $results2 et stocker chaque élément dans $photo
 //$key = index de chaque element
 //SI index element ($key) est égale a l'index 0 du premier tableau de résultat ($results2) ALORS afficher "active" 
 <div class="carousel-item <?php if(array_key_first($results2)===$key) echo "active";?>">

      <img src="<?= $photo['source']?>" style=" aspect-ratio:16/9 " class="d-block w-100" alt="<?= $photo['description']?>">
     
    </div>
  
  <?php
}
?>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>

</div>



