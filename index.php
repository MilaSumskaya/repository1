<?php
    session_start();
    include 'temp/head.php';
    if ($_SESSION['role'] == 'klient') {
        $id_user = $_SESSION['id_user'];
      include 'temp/nav_user.php';
    }
    elseif ($_SESSION['role'] == 'manager') {
      include 'temp/nav_manager.php';
    }
    else {
      include 'temp/nav.php';
    }
    include 'temp/header.php';
    include 'temp/bd.php';
?>
<!--==========================================
=           Основной контент страницы           =
===========================================-->
<section class=" section">
    <!-- Container Start -->
    <div class="container">
    <div class="row">
            <div class="col-md-12">
                <!-- Header Contetnt -->
                <div class="content-block">
                <p>Почему с нами выгодно работать?</p>
                </div>
            </div>
        </div>
  <div class="row justify-content-start">
    <div class="col-3">
    <img src="img/гарантия.png" class="img-fluid" alt="Гарантия">
    </div>
    <div class="col-3">
    <img src="img/большойвыбор.png" class="img-fluid" alt="Большой выбор">
    </div>
    <div class="col-3">
    <img src="img/опыт работы.png" class="img-fluid" alt="Опыт работы">
    </div>
    <div class="col-3">
    <img src="img/проверенный кирпич.png" class="img-fluid" alt="Проверенный кирпич">
    </div>
  </div>
</div><!-- Container End -->
<div class="row">
    <div class="col-1"></div>
    <div class="col-10">

  <form>
<div class="row row-cols-1 row-cols-md-4 g-4">
    <?php
    $result= $link->query("select * from tovar");
    foreach( $result as $row) {
            echo'<div class="col">
            <div class="card">
            <img src="img/'.$row['img'].'" class="card-img-top" alt="'.$row['name'].'">
            <div class="card-body">
            <h5 class="card-title">Цена за шт: '.$row['price'].' рублей</h5>
            <p class="card-text">'.$row['name'].'</p>
            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#zakaz"
 data-id_tovar="'.$row['ID_tovar'].'" data-name="'.$row['name'].'">
  Заказать товар
</button>
    </div>
    </div>
  </div>';
}
  ?>
</div>
  </form>
    </div>
<div class="col-1"></div>
  </div>

</div>
</section>

<!-- Modal -->
<div class="modal fade" id="zakaz" tabindex="-1" aria-labelledby="zakazLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="zakazLabel">Оформить заказ</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="vvod_z.php">
  <div class="mb-3">
    <label for="colvo" class="form-label">Количество товара</label>
    <input type="text" class="form-control" id="colvo" name="colvo" aria-describedby="colvo" placeholder="Введите количество товара">
    <input type="hidden" name="id_user" value="<?=$id_user?>">
    <input type="hidden" name="id_tovar" id="id_tovar">
</div>
  <div class="mb-3">
    <label for="date" class="form-label">Дата заказа</label>
    <input type="date" class="form-control" id="date" name="date" aria-describedby="date">
  </div>
  <div class="mb-3">
    <label for="adress" class="form-label">Адрес доставки</label>
    <input type="text" class="form-control" id="adress" name="adress" aria-describedby="adress" placeholder="Введите адрес доставки">
  </div>
  <div class="mb-3">
    <label for="sposob" class="form-label">Способ доставки</label>
    <select class="form-select" aria-label="Default select example" name="sposob">
  <option selected>Укажите способ доставки</option>
  <option value="Курьер">Курьер</option>
  <option value="Самовывоз">Самовывоз</option>
</select>
</div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button> -->
        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Сохранить</button>
      </div>
</form>
    </div>
  </div>
</div>

<?php
    include 'temp/footer.php';
?>
<!-- Вызов модального окна -->
<script>
$(document).ready(function(){
  $('#zakaz').on('show.bs.modal', function (event) {
// кнопка, которая вызывает модаль
 var button = $(event.relatedTarget) 
// получим  data-id_tovar атрибут
  var id_tovar = button.data('id_tovar') 
// получим  data-name атрибут
  var name = button.data('name');
   // Здесь изменяем содержимое модали
  var modal = $(this);
 modal.find('.modal-title').text('Заказать '+name+' '+id_tovar);
 modal.find('.modal-body #id_tovar').val(id_tovar);
})
});
</script>
