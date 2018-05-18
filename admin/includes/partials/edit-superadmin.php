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
        <td>Delete user</td>
      </thead>
      <tbody>
<?php
foreach ($allusers as $user) {
?>
        <tr>
          <td><?php echo $user["FirstName"] . " " . $user["LastName"]; ?></td>
          <td><?php echo $user["UserEmail"]; ?></td>
          <td><a href="manage-user.php?remove=<?php echo $user["UserEmail"]; ?>">Delete</a></td>
        </tr>
<?php
}
?>
      </tbody>
    </table>
  </div>
</div>
