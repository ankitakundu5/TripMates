<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalabahal Peak Trek - TripMates</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./styles/search.css">
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container-fluid mt-5">
      <div class="row">

        <div class="back col-md-3 ml-20 p-20">
          <form method="GET" class="search-box mb-4">
            <h6>Choose where to go:</h6>
            <input type="text" class="form-control mb-3" name="destination" placeholder="All around India" value="<?php echo isset($_GET['destination']) ? htmlspecialchars($_GET['destination']) : ''; ?>">
            <input type="text" class="form-control mb-3" name="activity" placeholder="Activities" value="<?php echo isset($_GET['activity']) ? htmlspecialchars($_GET['activity']) : ''; ?>">
            <button type="submit" class="search-btn w-100">Search <i class="bi bi-search"></i></button>
          </form>

          <div class="filter-section">
            <div class="mb-3">
              <div class="sidebar-label">Activities</div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="trekking">
                <label class="form-check-label" for="trekking">Trekking</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="cycling">
                <label class="form-check-label" for="cycling">Cycling</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="adventure">
                <label class="form-check-label" for="adventure">Adventure</label>
              </div>
            </div>

            <div class="sidebar-label">Group Size</div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="groupSmall">
              <label class="form-check-label" for="groupSmall">1-5 people</label>
            </div>

            <div class="sidebar-label mt-3">Budget</div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="budgetLow">
              <label class="form-check-label" for="budgetLow">Under ₹5,000</label>


            </div>

      
          </div>
        </div>

        <!-- Right Cards -->
        <div class="col-md-9 mb-5">
          <div id="pack">
          <?php
            require_once '../Backend/connect_db.php';

            $destination = isset($_GET['destination']) ? $conn->real_escape_string($_GET['destination']) : '';
            $activity = isset($_GET['activity']) ? $conn->real_escape_string($_GET['activity']) : '';

            $sql = "SELECT * FROM packages WHERE 1=1";
            if (!empty($destination)) {
                $sql .= " AND destination LIKE '%$destination%'";
            }
            if (!empty($activity)) {
                $sql .= " AND activities LIKE '%$activity%'";
            }

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <a href="packages.php?id='.htmlspecialchars($row['package_id']).'">
                    <div class="">
                        <div class="position-relative package-card">
                            <span class="badge-top">'.htmlspecialchars($row['activities']).'</span>
                            <img src="'.htmlspecialchars($row['imageUrl']).'" alt="'.htmlspecialchars($row['name']).'" style="width:100%; height:200px; object-fit:cover;">
                            <div class="package-card-content">
                                <div class="card-location">'.htmlspecialchars($row['destination']).'</div>
                                <div class="card-title">'.htmlspecialchars($row['name']).'</div>
                            </div>
                        </div>
                    </div>
                         </a>';
                }
            } else {
                echo "No packages found.";
            }
          ?>
          </div>

          <div class="row g-4" id="card-container">
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div id="footer-container"></div>

    <script>
      fetch('footer.html')
        .then(res => res.text())
        .then(data => {
          document.getElementById('footer-container').innerHTML = data;
        });
    </script>

</body>
</html>
