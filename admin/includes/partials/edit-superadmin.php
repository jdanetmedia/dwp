<?php
$allusers = $users->GetAllUsers();
?>
<div class="card">
  <div class="card-content">
    <span class="card-title left">Users</span><a class="waves-effect waves-light btn right black" href="new-user.php">Add new user</a>
    <table class="striped">
      <thead>
        <td>Name</td>
        <td>Email</td>
        <td></td>
      </thead>
      <tbody>
<?php
foreach ($allusers as $user) {
?>
        <tr>
          <td><?php echo $user["FirstName"] . " " . $user["LastName"]; ?></td>
          <td><?php echo $user["UserEmail"]; ?></td>
          <td><form action="manage-user.php?remove=<?php echo $user["UserEmail"]; ?>" method="post" onsubmit="return confirm('Are you sure?');"><input class="waves-effect waves-light btn grey darken-4 black right" type="submit" name="submitdeleteuser" value="Delete"></form></td>
        </tr>
<?php
}
?>
      </tbody>
    </table>
  </div>
</div>
