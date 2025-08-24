<?php
include './config/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid request.");
}

// Data fetch for selected admin
$result = mysqli_query($conn, "SELECT * FROM admin_users WHERE id = $id");
$admin = mysqli_fetch_assoc($result);

if (!$admin) {
    die("Admin not found.");
}

// Update logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = $_POST['password']; // plain text from form

    // agar password empty hai to old hi rahe
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $update = "UPDATE admin_users SET name='$name', email='$email', role='$role', password='$hashedPassword' WHERE id=$id";
    } else {
        $update = "UPDATE admin_users SET name='$name', email='$email', role='$role' WHERE id=$id";
    }

    if (mysqli_query($conn, $update)) {
        echo "<script>alert('Admin updated successfully!'); window.location.href='AdminUsers.php';</script>";
    } else {
        echo "<script>alert('Error updating admin.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<?php include './includes/source.html'; ?>

<h2>Edit Admin</h2>


ody>
<div class="loader"></div>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <?php
        // header.php ko include karna
        include './includes/navbar.php';
        ?>
        <?php
        // header.php ko include karna
        include './includes/sidebar.php';
        ?>

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-body">
                    <!--   comment  by  sana -->
                    <!-- <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Basic DataTables</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Task Name</th>
                            <th>Progress</th>
                            <th>Members</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              1
                            </td>
                            <td>Create a mobile app</td>
                            <td class="align-middle">
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-success width-per-40">
                                </div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="assets/img/users/user-5.png" width="35">
                            </td>
                            <td>2018-01-20</td>
                            <td>
                              <div class="badge badge-success badge-shadow">Completed</div>
                            </td>
                            <td><a href="#" class="btn btn-primary">Detail</a></td>
                          </tr>
                          <tr>
                            <td>
                              2
                            </td>
                            <td>Redesign homepage</td>
                            <td class="align-middle">
                              <div class="progress progress-xs">
                                <div class="progress-bar width-per-60"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="assets/img/users/user-1.png" width="35">
                              <img alt="image" src="assets/img/users/user-3.png" width="35">
                              <img alt="image" src="assets/img/users/user-4.png" width="35">
                            </td>
                            <td>2018-04-10</td>
                            <td>
                              <div class="badge badge-info badge-shadow">Todo</div>
                            </td>
                            <td><a href="#" class="btn btn-primary">Detail</a></td>
                          </tr>
                          <tr>
                            <td>
                              3
                            </td>
                            <td>Backup database</td>
                            <td class="align-middle">
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-warning width-per-70"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="assets/img/users/user-1.png" width="35">
                              <img alt="image" src="assets/img/users/user-2.png" width="35">
                            </td>
                            <td>2018-01-29</td>
                            <td>
                              <div class="badge badge-warning badge-shadow">In Progress</div>
                            </td>
                            <td><a href="#" class="btn btn-primary">Detail</a></td>
                          </tr>
                          <tr>
                            <td>
                              4
                            </td>
                            <td>Input data</td>
                            <td class="align-middle">
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-success width-per-90"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="assets/img/users/user-2.png" width="35">
                              <img alt="image" src="assets/img/users/user-5.png" width="35">
                              <img alt="image" src="assets/img/users/user-4.png" width="35">
                              <img alt="image" src="assets/img/users/user-1.png" width="35">
                            </td>
                            <td>2018-01-16</td>
                            <td>
                              <div class="badge badge-success badge-shadow">Completed</div>
                            </td>
                            <td><a href="#" class="btn btn-primary">Detail</a></td>
                          </tr>
                          <tr>
                            <td>
                              5
                            </td>
                            <td>Create a mobile app</td>
                            <td class="align-middle">
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-success width-per-40">
                                </div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="assets/img/users/user-5.png" width="35">
                            </td>
                            <td>2018-01-20</td>
                            <td>
                              <div class="badge badge-success badge-shadow">Completed</div>
                            </td>
                            <td><a href="#" class="btn btn-primary">Detail</a></td>
                          </tr>
                          <tr>
                            <td>
                              6
                            </td>
                            <td>Redesign homepage</td>
                            <td class="align-middle">
                              <div class="progress progress-xs">
                                <div class="progress-bar width-per-60"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="assets/img/users/user-1.png" width="35">
                              <img alt="image" src="assets/img/users/user-3.png" width="35">
                              <img alt="image" src="assets/img/users/user-4.png" width="35">
                            </td>
                            <td>2018-04-10</td>
                            <td>
                              <div class="badge badge-info badge-shadow">Todo</div>
                            </td>
                            <td><a href="#" class="btn btn-primary">Detail</a></td>
                          </tr>
                          <tr>
                            <td>
                              7
                            </td>
                            <td>Backup database</td>
                            <td class="align-middle">
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-warning width-per-70"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="assets/img/users/user-1.png" width="35">
                              <img alt="image" src="assets/img/users/user-2.png" width="35">
                            </td>
                            <td>2018-01-29</td>
                            <td>
                              <div class="badge badge-warning badge-shadow">In Progress</div>
                            </td>
                            <td><a href="#" class="btn btn-primary">Detail</a></td>
                          </tr>
                          <tr>
                            <td>
                              8
                            </td>
                            <td>Input data</td>
                            <td class="align-middle">
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-success width-per-90"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="assets/img/users/user-2.png" width="35">
                              <img alt="image" src="assets/img/users/user-5.png" width="35">
                              <img alt="image" src="assets/img/users/user-4.png" width="35">
                              <img alt="image" src="assets/img/users/user-1.png" width="35">
                            </td>
                            <td>2018-01-16</td>
                            <td>
                              <div class="badge badge-success badge-shadow">Completed</div>
                            </td>
                            <td><a href="#" class="btn btn-primary">Detail</a></td>
                          </tr>
                          <tr>
                            <td>
                              9
                            </td>
                            <td>Create a mobile app</td>
                            <td class="align-middle">
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-success width-per-40">
                                </div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="assets/img/users/user-5.png" width="35">
                            </td>
                            <td>2018-01-20</td>
                            <td>
                              <div class="badge badge-success badge-shadow">Completed</div>
                            </td>
                            <td><a href="#" class="btn btn-primary">Detail</a></td>
                          </tr>
                          <tr>
                            <td>
                              10
                            </td>
                            <td>Redesign homepage</td>
                            <td class="align-middle">
                              <div class="progress progress-xs">
                                <div class="progress-bar width-per-60"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="assets/img/users/user-1.png" width="35">
                              <img alt="image" src="assets/img/users/user-3.png" width="35">
                              <img alt="image" src="assets/img/users/user-4.png" width="35">
                            </td>
                            <td>2018-04-10</td>
                            <td>
                              <div class="badge badge-info badge-shadow">Todo</div>
                            </td>
                            <td><a href="#" class="btn btn-primary">Detail</a></td>
                          </tr>
                          <tr>
                            <td>
                              11
                            </td>
                            <td>Backup database</td>
                            <td class="align-middle">
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-warning width-per-70"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="assets/img/users/user-1.png" width="35">
                              <img alt="image" src="assets/img/users/user-2.png" width="35">
                            </td>
                            <td>2018-01-29</td>
                            <td>
                              <div class="badge badge-warning badge-shadow">In Progress</div>
                            </td>
                            <td><a href="#" class="btn btn-primary">Detail</a></td>
                          </tr>
                          <tr>
                            <td>
                              12
                            </td>
                            <td>Input data</td>
                            <td class="align-middle">
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-success width-per-90"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="assets/img/users/user-2.png" width="35">
                              <img alt="image" src="assets/img/users/user-5.png" width="35">
                              <img alt="image" src="assets/img/users/user-4.png" width="35">
                              <img alt="image" src="assets/img/users/user-1.png" width="35">
                            </td>
                            <td>2018-01-16</td>
                            <td>
                              <div class="badge badge-success badge-shadow">Completed</div>
                            </td>
                            <td><a href="#" class="btn btn-primary">Detail</a></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
                    <!-- <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Multi Select</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-2">
                        <thead>
                          <tr>
                            <th class="text-center pt-3">
                              <div class="custom-checkbox custom-checkbox-table custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                  class="custom-control-input" id="checkbox-all">
                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                              </div>
                            </th>
                            <th>Task Name</th>
                            <th>Progress</th>
                            <th>Members</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-center pt-2">
                              <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                  id="checkbox-1">
                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                              </div>
                            </td>
                            <td>Create a mobile app</td>
                            <td class="align-middle">
                              <div class="progress progress-xs">
                                <div class="progress-bar width-per-70"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="assets/img/users/user-5.png" width="35">
                            </td>
                            <td>2018-01-20</td>
                            <td>
                              <div class="badge badge-success badge-shadow">Completed</div>
                            </td>
                            <td><a href="#" class="btn btn-primary">Detail</a></td>
                          </tr>
                          <tr>
                            <td class="text-center pt-2">
                              <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                  id="checkbox-2">
                                <label for="checkbox-2" class="custom-control-label">&nbsp;</label>
                              </div>
                            </td>
                            <td>Redesign homepage</td>
                            <td class="align-middle">
                              <div class="progress progress-xs">
                                <div class="progress-bar width-per-60"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="assets/img/users/user-1.png" width="35">
                              <img alt="image" src="assets/img/users/user-3.png" width="35">
                              <img alt="image" src="assets/img/users/user-4.png" width="35">
                            </td>
                            <td>2018-04-10</td>
                            <td>
                              <div class="badge badge-info badge-shadow">Todo</div>
                            </td>
                            <td><a href="#" class="btn btn-primary">Detail</a></td>
                          </tr>
                          <tr>
                            <td class="text-center pt-2">
                              <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                  id="checkbox-3">
                                <label for="checkbox-3" class="custom-control-label">&nbsp;</label>
                              </div>
                            </td>
                            <td>Backup database</td>
                            <td class="align-middle">
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-warning width-per-70"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="assets/img/users/user-1.png" width="35">
                              <img alt="image" src="assets/img/users/user-2.png" width="35">
                            </td>
                            <td>2018-01-29</td>
                            <td>
                              <div class="badge badge-warning badge-shadow">In Progress</div>
                            </td>
                            <td><a href="#" class="btn btn-primary">Detail</a></td>
                          </tr>
                          <tr>
                            <td class="text-center pt-2">
                              <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                  id="checkbox-4">
                                <label for="checkbox-4" class="custom-control-label">&nbsp;</label>
                              </div>
                            </td>
                            <td>Input data</td>
                            <td class="align-middle">
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-success width-per-40"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="assets/img/users/user-2.png" width="35">
                              <img alt="image" src="assets/img/users/user-5.png" width="35">
                              <img alt="image" src="assets/img/users/user-4.png" width="35">
                              <img alt="image" src="assets/img/users/user-1.png" width="35">
                            </td>
                            <td>2018-01-16</td>
                            <td>
                              <div class="badge badge-success badge-shadow">Completed</div>
                            </td>
                            <td><a href="#" class="btn btn-primary">Detail</a></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
                    <div class="row">
                        <!-- HTML Form -->
                        <div class="container p-3  bg-white  ">
                            <form method="POST"  >
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="<?= $admin['name'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="<?= $admin['email'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" class="form-control" required>
                                        <option value="Admin" <?= $admin['role'] === 'Admin' ? 'selected' : '' ?>>Admin</option>
                                        <option value="Sub Admin" <?= $admin['role'] === 'Sub Admin' ? 'selected' : '' ?>>Sub Admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>New Password <small>(Leave blank to keep old password)</small></label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-success">Update Admin</button>
                                <a href="AdminUsers.php" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>


                    </div>
                </div>
            </section>
            <div class="settingSidebar">
                <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
                </a>
                <div class="settingSidebar-body ps-container ps-theme-default">
                    <div class=" fade show active">
                        <div class="setting-panel-header">Setting Panel
                        </div>
                        <div class="p-15 border-bottom">
                            <h6 class="font-medium m-b-10">Select Layout</h6>
                            <div class="selectgroup layout-color w-50">
                                <label class="selectgroup-item">
                                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                                    <span class="selectgroup-button">Light</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                                    <span class="selectgroup-button">Dark</span>
                                </label>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <h6 class="font-medium m-b-10">Sidebar Color</h6>
                            <div class="selectgroup selectgroup-pills sidebar-color">
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                        data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                        data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <h6 class="font-medium m-b-10">Color Theme</h6>
                            <div class="theme-setting-options">
                                <ul class="choose-theme list-unstyled mb-0">
                                    <li title="white" class="active">
                                        <div class="white"></div>
                                    </li>
                                    <li title="cyan">
                                        <div class="cyan"></div>
                                    </li>
                                    <li title="black">
                                        <div class="black"></div>
                                    </li>
                                    <li title="purple">
                                        <div class="purple"></div>
                                    </li>
                                    <li title="orange">
                                        <div class="orange"></div>
                                    </li>
                                    <li title="green">
                                        <div class="green"></div>
                                    </li>
                                    <li title="red">
                                        <div class="red"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <div class="theme-setting-options">
                                <label class="m-b-0">
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                        id="mini_sidebar_setting">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="control-label p-l-10">Mini Sidebar</span>
                                </label>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <div class="theme-setting-options">
                                <label class="m-b-0">
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                        id="sticky_header_setting">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="control-label p-l-10">Sticky Header</span>
                                </label>
                            </div>
                        </div>
                        <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                            <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                                <i class="fas fa-undo"></i> Restore Default
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        // header.php ko include karna
        include './includes/footer.php';
        ?>
    </div>
</div>
<!-- General JS Scripts -->
<!-- JS Libraies -->
<!-- <script src="assets/bundles/datatables/datatables.min.js"></script> -->
<!-- <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script> -->
<!-- Page Specific JS File -->
<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>
<script src="assets/bundles/sweetalert/sweetalert.min.js"></script>
<script src="assets/js/page/sweetalert.js"></script>


<!-- Custom JS File -->
</body>

</html>