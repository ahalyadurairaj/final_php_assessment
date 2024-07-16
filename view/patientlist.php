<?php
require('../controller/patientlistfun.php');

// // Pagination variables
// $records_per_page = 10; // Number of records per page
// $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// $start = ($page - 1) * $records_per_page;

// // Fetch data with pagination
// $bookings = getBookingsWithPagination($start, $records_per_page);

// // Count total number of records
// $total_records = countTotalBookings();

// // Calculate total pages
// $total_pages = ceil($total_records / $records_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style//patientlist.css">
    <title>Booking Appointments</title>

</head>
<body>

<div class="background-image">
    
        <div class="formbold-form-wrapper">
            <h2>Booking Appointments</h2>
            <button class="sortingAss" >Sort</button>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Address</th>
                        <th>Need</th>
                        <th>Department</th>
                        <th>Updateds</th>
                        <!-- Add more headers as needed -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?php echo $booking['id']; ?></td>
                            <td><?php echo htmlspecialchars($booking['patient_name']); ?></td>
                            <td><?php echo htmlspecialchars($booking['contact']); ?></td>
                            <td><?php echo htmlspecialchars($booking['email']); ?></td>
                            <td><?php echo $booking['date']; ?></td>
                            <td><?php echo $booking['time']; ?></td>
                            <td><?php echo htmlspecialchars($booking['address']); ?></td>
                            <td><?php echo htmlspecialchars($booking['need']); ?></td>
                            <td><?php echo htmlspecialchars($booking['which_department']); ?></td>
                           <td><div class="button_actions">
                          <a href="../view/edit.php?id=. $row['id'] " style='display: inline-block; padding: 5px 20px; margin-right: 15px; background-color: blue; color: white; text-decoration: none; border: none; cursor: pointer;'>Edit</a> ;
                            <a href="../controller/delete.php?id= . $row['id']" style='display: inline-block; padding: 5px 10px; background-color: #dc3545; color: white; text-decoration: none; border: none; cursor: pointer;'>DELETE</a>;
                           </div></td>
       
   
   
                            <!-- Add more columns as needed -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <!-- Pagination links -->
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo ($page - 1); ?>">&laquo; Prev</a>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a <?php if ($i === $page) echo 'class="active"'; ?> href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
                
                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo ($page + 1); ?>">Next &raquo;</a>
                <?php endif; ?>
            </div>
        </div>
   
</div>

</body>
</html>
