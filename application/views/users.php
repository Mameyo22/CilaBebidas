

    <!-- **********************************************************************************************************************************************************
        ABM usuarios
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> <?= $title ?></h3>   
      <table id="usertable" class="display">
        <thead>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            <?php foreach($usuarios as $usuario){ ?>
            <tr>
                <td><?= $usuario['userid']; ?></td>
                <td><?= $usuario['username']; ?></td>
                <td><?= $usuario['useremail']; ?></td>
                <td></td>
            </tr>
            <?php } ?>
        </tbody>
      </table>

     </section>
    </section>
    <!--main content end-->
    <script>
$(document).ready(function(){
    $('#usertable').DataTable();
});
</script>
 