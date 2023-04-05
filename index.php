<?php
// Header
$pageTitle = "Notes";
require_once "layouts/header.php";

// Middleware
require_once("app/middleware/auth.php");

require_once "app/models/Task.php";
$task = new Task();
// Delete ToDo
if (isset($_POST['delete']) && $_POST['id']) {
  $task->setId($_POST['id']);
  $task->deleteData();
  header("Location:index.php");
}

// Add New ToDO
if (isset($_POST['new_task']) && $_POST['title']) {
  $task_title = $_POST['title'];
  $task->setTitle($task_title);
  $task->setDetails("bla bla from php");
  $task->setUser_id($_SESSION['user']->id);
  $task->insertData();
  header("Location:index.php");
}
$task->setUser_id($_SESSION['user']->id);
$tasks = $task->selectData();
if ($tasks) {
  $tasks->fetch_all(MYSQLI_ASSOC);
}

?>

<header>
  <div class="d-flex justify-content-between">
    <a href="index.php"><?php echo $task->getUserName() ?></a>
    <a href="logout.php">Logout</a>
  </div>
</header>

<section class="gradient-custom">
  <div class="container py-5 h-99">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">

        <div class="card">
          <div class="card-body p-5">
            <form action="index.php" method="POST">
              <div class="d-flex justify-content-center align-items-center mb-4">
                <div class="form-outline flex-fill">
                  <input id="task-title" type="text" class="form-control" name="title" placeholder="Note" />
                </div>
                <button id="add-task" name="new_task" class="btn btn-info ms-2">Add&plus;</button>
              </div>
            </form>
            <ul id="task-list" class="list-group mb-0">
              <?php
              if (empty($tasks)) {
              ?>
                <li class="list-group-item d-flex justify-content-between align-items-center border-0 mb-2 rounded">
                  <span>No notes yet</span>
                </li>
                <?php
              } else {
                foreach ($tasks as $task) {
                ?>
                  <li class="w-auto list-group-item d-flex justify-content-between align-items-center border-0 mb-2 rounded">
                    <p>
                      <?php echo $task['title'] ?>
                </p>
                    <div class="task-actions">
                      <form action="index.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $task['id'] ?>">
                        <button class="btn btn-danger ms-1" name="delete" type="submit">
                          X
                        </button>
                      </form>
                    </div>
                  </li>
              <?php
                }
              }
              ?>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<script>
  window.onload = function() {
    document.getElementById("task-title").focus();
  }
</script>
<?php
// Footer
require_once "layouts/footer.php";
?>