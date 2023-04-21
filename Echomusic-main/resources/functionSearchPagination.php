<nav aria-label="Page navigation" id="searchPagination">
  <?php if(isset($page_no)){ ?>
  <ul class="pagination justify-content-center">

    <!-- Página Anterior -->
    <li class="page-item">

      <a class="page-link btn <?php if($page_no <= 1){ echo 'disabled'; } ?>" <?php if($page_no > 1){
      echo 'href="'.$hrefPrevious_page.'"';
    } ?> aria-label="Previous">

        <span aria-hidden="true">&laquo;</span>

      </a>

    </li>

    <?php
      if ($total_no_of_pages <= 10){
        for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
          if ($counter == $page_no) {
            echo '<li class="page-item"><a class="page-link active">'.$counter.'</a></li>';
          }else{
            echo '<li class="page-item"><a class="page-link" href="'.$link.'page_no='.$counter.'">'.$counter.'</a></li>';
          }
        }
      }
      elseif($total_no_of_pages > 10){

      if($page_no <= 4) {
        for ($counter = 1; $counter < 8; $counter++){
          if ($counter == $page_no) {
            echo '<li class="page-item active"><a class="page-link active">'.$counter.'</a></li>';
          }else{
            echo '<li class="page-item"><a class="page-link" href="'.$link.'page_no='.$counter.'">'.$counter.'</a></li>';
          }
        }
          echo '<li class="page-item"><a class="page-link">...</a></li>';
          echo '<li class="page-item"><a class="page-link" href="'.$link.'page_no='.$second_last.'">'.$second_last.'</a></li>';
          echo '<li class="page-item"><a class="page-link" href="'.$link.'page_no='.$total_no_of_pages.'">'.$total_no_of_pages.'</a></li>';
        }

        else if($page_no > 4 && $page_no < $total_no_of_pages - 4) {
          echo '<li class="page-item"><a class="page-link" href="'.$link.'page_no=1">1</a></li>';
          echo '<li class="page-item"><a class="page-link" href="'.$link.'page_no=2">2</a></li>';
          echo '<li class="page-item"><a class="page-link">...</a></li>';
          for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
            if ($counter == $page_no) {
              echo '<li class="page-item"><a class="page-link active">'.$counter.'</a></li>';
            }else{
              echo '<li class="page-item"><a class="page-link" href="'.$link.'page_no='.$counter.'">'.$counter.'</a></li>';
            }
          }
          echo '<li class="page-item"><a class="page-link">...</a></li>';
          echo '<li class="page-item"><a class="page-link" href="'.$link.'page_no='.$second_last.'">'.$second_last.'</a></li>';
          echo '<li class="page-item"><a class="page-link" href="'.$link.'page_no='.$total_no_of_pages.'">'.$total_no_of_pages.'</a></li>';
        }

        else {
          echo '<li class="page-item"><a class="page-link" href="'.$link.'page_no=1">1</a></li>';
          echo '<li class="page-item"><a class="page-link" href="'.$link.'page_no=2">2</a></li>';
          echo '<li class="page-item"><a class="page-link">...</a></li>';

          for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
            if ($counter == $page_no) {
              echo '<li class="page-item"><a class="page-link active">'.$counter.'</a></li>';
            }else{
              echo '<li class="page-item"><a class="page-link" href="'.$link.'page_no='.$counter.'">'.$counter.'</a></li>';
            }
          }
        }
      }
      ?>

    <!-- Siguiente Página -->
    <li class="page-item">

      <a class="page-link btn <?php if($total_no_of_pages <= 1){ echo 'disabled'; }else if($page_no >= $total_no_of_pages){echo 'disabled'; } ?>" <?php if($page_no < $total_no_of_pages) {
        echo 'href="'.$hrefNext_page.'"';
      } ?> aria-label="Next">

        <span aria-hidden="true">&raquo;</span>

      </a>

    </li>

  </ul>
  <?php } ?>

</nav>
