<br/>
<h5>Addresses List</h5>
<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if(isset($_SESSION["update_address_error"]) && $_SESSION["update_address_error"] != '') {?>
    <div class="alert alert-danger" role="alert">
        <?php
            echo $_SESSION["update_address_error"];
            unset($_SESSION["update_address_error"]);
        ?>
    </div>
    <?php
}
if(isset($_SESSION["new_address_error"]) && $_SESSION["new_address_error"] != '') {?>
    <div class="alert alert-danger" role="alert">
        <?php
            echo $_SESSION["new_address_error"];
            unset($_SESSION["new_address_error"]);
        ?>
    </div>
    <?php
}
?>
<table class="table table-striped" id="addressTable" style="width:100%">
  <thead>
    <tr>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Company</th>
      <th scope="col">State</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($addresses as $address) { ?>
        <tr>
            <td><?php echo $address->first_name; ?></td>
            <td><?php echo $address->last_name; ?></td>
            <td><?php echo $address->company; ?></td>
            <td><?php echo $address->state; ?></td>
            <td>
                <a href='?controller=addresses&action=show&id=<?php echo $address->id_address; ?>'><i class="bi bi-search"></i></a>
                <a href='?controller=addresses&action=edit&id=<?php echo $address->id_address; ?>'><i class="bi bi-pencil-square"></i></a>
                <a href='#' onclick="deleteAddress(<?php echo $address->id_address; ?>)" "><i class="bi bi-trash"></i></a>
            </td>
        </tr>
    <?php } ?>
  </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#addressTable').DataTable();
  });
  function deleteAddress(addressID){
      if (confirm("Are you sure ! "+addressID) == true) {
          location.href = '?controller=addresses&action=delete&id='+addressID;
      }
  }
</script>