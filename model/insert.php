<?php
$sql = "INSERT INTO BookingAppointment (patient_name, contact, email, date, time, address, need, which_department)
         VALUES (:name, :phone, :email, :date, :time, :address, :need, :department)";

?>