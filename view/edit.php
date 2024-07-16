<?php

require('../model/Dbconnection.php');
require('../config.php');



$database = new Database($config['host'], $config['dbname'], $config['username'], $config['password']);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch the current data for the record
    $query = "SELECT * FROM `BookingAppointment` WHERE `id` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $record = $result->fetch_assoc();
    $stmt->close();
} else {
    echo "No record ID provided.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../style//Booking.css">
    <title>booking form</title>
</head>
<body>
    
<div class="background-image">


<div class="formbold-main-wrapper" >

  <div class="formbold-form-wrapper">
    <form action="../controller/editfun.php" method="POST">
      <div class="formbold-mb-5">
        <label for="name" class="formbold-form-label"> Patient full Name </label>
        <input
          type="text"
          name="name"          
          id="name"
           value="<?php echo htmlspecialchars($record['name']); ?>"
          placeholder="Full Name"
          class="formbold-form-input"
          
        />
        <?php if (isset($errors['name'])): ?>
           <p class="error"><?php echo $errors['name']; ?></p>
        <?php endif; ?>
      </div>
      <div class="formbold-mb-5">
        <label for="phone" class="formbold-form-label"> Phone Number </label>
        <input
          type="text"
          name="phone"
          id="phone"
           value="<?php echo htmlspecialchars($record['phone']); ?>"
          placeholder="Enter your phone number"
          class="formbold-form-input"
         
        />
        <?php if (isset($errors['phone'])): ?>
           <p class="error"><?php echo $errors['phone']; ?></p>
        <?php endif; ?>
      </div>
      <div class="formbold-mb-5">
        <label for="email" class="formbold-form-label"> Email Address </label>
        <input
          type="email"
          name="email"
          id="email"
           value="<?php echo htmlspecialchars($record['email']); ?>"
          placeholder="Enter your email"
          class="formbold-form-input"
         
        />
        <?php if (isset($errors['email'])): ?>
           <p class="error"><?php echo $errors['email']; ?></p>
        <?php endif; ?>
      </div>
      <div class="flex flex-wrap formbold--mx-3">
        <div class="w-full sm:w-half formbold-px-3">
          <div class="formbold-mb-5 w-full">
            <label for="date" class="formbold-form-label"> Date </label>
            <input
              type="date"
              name="date"
              id="date"
               value="<?php echo htmlspecialchars($record['date']); ?>"
              class="formbold-form-input"
              
            />
            <?php if (isset($errors['date'])): ?>
           <p class="error"><?php echo $errors['date']; ?></p>
        <?php endif; ?>
          </div>
        </div>
        <div class="w-full sm:w-half formbold-px-3">
          <div class="formbold-mb-5">
            <label for="time" class="formbold-form-label"> Time </label>
            <input
              type="text"
              name="time"
              id="time"
               value="<?php echo htmlspecialchars($record['time']); ?>"
              class="formbold-form-input"
             
            />
            <?php if (isset($errors['time'])): ?>
           <p class="error"><?php echo $errors['time']; ?></p>
        <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="formbold-mb-5 formbold-pt-3">
        <label class="formbold-form-label formbold-form-label-2">
          Address Details
        </label>
        <input
          type="text"
          name="address"
          id="address"
           value="<?php echo htmlspecialchars($record['address']); ?>"
          placeholder="Enter your address"
          class="formbold-form-input"
         
        />
        <?php if (isset($errors['address'])): ?>
           <p class="error"><?php echo $errors['address']; ?></p>
        <?php endif; ?>
      </div>

      <div class="formbold-mb-5">
        <label for="name" class="formbold-form-label"> Which department would you like to get an appointment from? </label>
        <textarea
         type="text"
          name="need"
          id="name"
           value="<?php echo htmlspecialchars($record['need']); ?>"
          placeholder="what need"
          class="formbold-form-input"
         
          >

        </textarea>
        <?php if (isset($errors['need'])): ?>
           <p class="error"><?php echo $errors['need']; ?></p>
        <?php endif; ?>
      </div>

      <div class="formbold-mb-5">
        <label for="name" class="formbold-form-label"> Which procedure do you want to make an appointment for? </label>
        <select 
        name="department" 
        id="department"
         value="<?php echo htmlspecialchars($record['department']); ?>"
        placeholder="what need"
        class="formbold-form-input" >
        
        <option value="Select Option">Select Option</option>
        <option value="Medical Examination">Medical Examination</option>
        <option value="Doctor Check">Doctor Check</option>
        <option value="Result Analysis">Result Analysis</option>
        <option value="Check Up">Check Up</option>

        </select>
        <?php if (isset($errors['department'])): ?>
           <p class="error"><?php echo $errors['department']; ?></p>
        <?php endif; ?>
      </div>

      <div>
        <button class="formbold-btn" value="update">Book Appointment</button>
      </div>
    </form>
  </div>
</div>
</div>
</body>
</html>