<?php
  session_start();

  // Check if user is logged in
  if (!isset($_SESSION['user_id'])) {
      // Redirect to login page if not logged in
      header("Location: login.php");
      exit();
  }

  // Get user attributes from session
  $user_type = $_SESSION['user_type'];
  $first_name = $_SESSION['first_name'];
  $email = $_SESSION['email'];
  $user_id = $_SESSION['user_id'];

  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "ims_db";

  // Create connection
  $connection = new mysqli($servername, $username, $password, $database);

  // Check connection
  if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
  }

  // Queries to count incidents
  $totalQuery = "SELECT COUNT(*) AS total FROM incidents";
  $pendingQuery = "SELECT COUNT(*) AS pending FROM incidents WHERE status = 'Pending'";
  $ongoingQuery = "SELECT COUNT(*) AS ongoing FROM incidents WHERE status = 'Ongoing'";
  $resolvedQuery = "SELECT COUNT(*) AS resolved FROM incidents WHERE status = 'Resolved'";

  // Fetch counts
  $totalIncidents = $connection->query($totalQuery)->fetch_assoc()['total'];
  $pendingIncidents = $connection->query($pendingQuery)->fetch_assoc()['pending'];
  $ongoingIncidents = $connection->query($ongoingQuery)->fetch_assoc()['ongoing'];
  $resolvedIncidents = $connection->query($resolvedQuery)->fetch_assoc()['resolved'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard - GRP3.</title>
    <link rel="icon" href="src/img/favicon/favicon-32x32.png" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />

    <!-- Fonts and icons -->
    <script src="src/dashboard/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["src/dashboard/assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="src/dashboard/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="src/dashboard/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="src/dashboard/assets/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="src/css/queue/queue.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="src/dashboard/assets/css/demo.css" />
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.php" class="logo">
              <img
                src="src/img/home/grp3ims-light.png"
                alt="navbar brand"
                class="navbar-brand logo-light-dash"
                height="20"
              />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item active">
                <a
                  data-bs-toggle="collapse"
                  href="#dashboard"
                  class="collapsed"
                  aria-expanded="false"
                >
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Components</h4>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base">
                  <i class="fas fa-layer-group"></i>
                  <p>Queues</p>
                </a>            
               </li>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="index.html" class="logo">
                <img
                  src="src/dashboard/assets/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
                />
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <nav
                class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
              >
              </nav>

              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">

                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false"
                  >
                    <div class="avatar-sm">
                      <img
                        src="src/dashboard/assets/img/profile.jpg"
                        alt="..."
                        class="avatar-img rounded-circle"
                      />
                    </div>
                    <span class="profile-username">
                      <span class="op-7">Hi,</span>
                      <span class="fw-bold"><?php echo htmlspecialchars($first_name); ?></span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                            <img
                              src="src/dashboard/assets/img/profile.jpg"
                              alt="image profile"
                              class="avatar-img rounded"
                            />
                          </div>
                          <div class="u-text">
                            <h4><?php echo htmlspecialchars($first_name); ?></h4>
                            <p class="text-muted"><?php echo htmlspecialchars($email); ?></p>
                            <a
                              href="profile.html"
                              class="btn btn-xs btn-secondary btn-sm"
                              >View Profile</a
                            >
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">My Profile</a>
                        <a class="dropdown-item" href="#">My Balance</a>
                        <a class="dropdown-item" href="#">Inbox</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Account Setting</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>

        <div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Queues</h3>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Total Reports</p>
                          <h4 class="card-title"><?php echo $totalIncidents; ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-info bubble-shadow-small"
                        >
                          <i class="fas fa-user-check"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Ongoing</p>
                          <h4 class="card-title"><?php echo $ongoingIncidents; ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-success bubble-shadow-small"
                        >
                          <i class="fas fa-luggage-cart"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Pending</p>
                          <h4 class="card-title"><?php echo $pendingIncidents; ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-secondary bubble-shadow-small"
                        >
                          <i class="far fa-check-circle"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Resolved</p>
                          <h4 class="card-title"><?php echo $resolvedIncidents; ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                      <h4 class="card-title">Summary</h4>
                      <div class="card-tools">
                        <button
                          class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card"
                        >
                          <span class="fa fa-sync-alt"></span>
                        </button>
                      </div>
                    </div>
                    <p class="card-category">
                      <br>
                      <div style="overflow-x:auto;">
                        <table class="table">
                          <thead>
                            <tr align="center">
                              <th>ID</th>
                              <th>Created By</th>
                              <th>priority level</th>
                              <th>Status</th>
                              <th>Resolved By</th>
                              <th>Summary</th>
                              <th>Description</th>
                              <th>Affected Organization</th>
                              <th>Created At</th>
                              <th>Updated At</th>
                            </tr>
                          </thead>
                          <tbody align="center">
                            <?php
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $database = "ims_db";

                                //Create connection
                                $connection = new mysqli($servername, $username, $password, $database);

                                //Check connection
                                if ($connection->connect_error) {
                                    die("Connection failed: " . $connection->connect_error);
                                }
                                //read all data
                                $sql = "
                                          SELECT 
                                              incidents.incident_id, 
                                              creator.first_name AS creator_name, 
                                              resolver.first_name AS resolver_name, 
                                              incidents.priority_level, 
                                              incidents.status, 
                                              incidents.summary,
                                              incidents.description,
                                              incidents.affected_organization, 
                                              incidents.created_at, 
                                              incidents.updated_at
                                          FROM incidents
                                          JOIN users AS creator ON incidents.created_by = creator.user_id
                                          LEFT JOIN users AS resolver ON incidents.resolved_by = resolver.user_id
                                          ORDER BY incidents.created_at ASC
                                        ";
                                $result = $connection->query($sql);

                                if (!$result) {
                                  die("Invalid query:" . $connection->$connect_error);
                                }
                                //read data of each row
                                while($row = $result->fetch_assoc()) {
                                  echo "<tr>
                                        <td>{$row['incident_id']}</td>                                      
                                        <td>{$row['creator_name']}</td>
                                        <td>{$row['priority_level']}</td>
                                        <td>{$row['status']}</td>
                                        <td>" . (!empty($row['resolver_name']) ? $row['resolver_name'] : 'Unresolved') . "</td>
                                        <td>{$row['summary']}</td>
                                        <td>{$row['description']}</td>
                                        <td>{$row['affected_organization']}</td>
                                        <td>{$row['created_at']}</td>
                                        <td>{$row['updated_at']}</td>
                                        <td>
                                            <a class='btn btn-primary btn-sm' href='edit.php?incident_id=$row[incident_id]'>Edit</a> 
                                            <a class='btn btn-danger btn-sm' href='delete.php?incident_id=$row[incident_id]'>Delete</a>
                                        </td>
                                        </tr>
                                        ";
                                }
                            ?>
                            
                          </tbody>
                        </table>
                      </div>
                    </p>
                  </div>
                  <div class="card-body">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <footer class="footer">
          <div class="container-fluid d-flex justify-content-between">
            <nav class="pull-left">
              <ul class="nav">
                
              </ul>
            </nav>
            <div class="copyright">
              2024, made with <i class="fa fa-heart heart text-danger"></i> by
              <a href="#">GRP3</a>
            </div>
            <div>
            </div>
          </div>
        </footer>
      </div>

      
    </div>
    <!--   Core JS Files   -->
    <script src="src/dashboard/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="src/dashboard/assets/js/core/popper.min.js"></script>
    <script src="src/dashboard/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="src/dashboard/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="src/dashboard/assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="src/dashboard/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="src/dashboard/assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="src/dashboard/assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="src/dashboard/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="src/dashboard/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="src/dashboard/assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="src/dashboard/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="src/dashboard/assets/js/kaiadmin.min.js"></script>
  </body>
</html>
