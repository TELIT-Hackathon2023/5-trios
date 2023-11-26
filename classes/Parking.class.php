<?php
require_once "./classes/Db.class.php";
class Parking extends Db
{

    public function __construct()
    {
        // vola sa Db constructor pre pripojenie databazy
        parent::__construct();
    }


    public function addUser($fname, $lname, $login, $mobile_phone, $personal_id, $licence_plate, $password_hash)
    {

        $sql = "
                INSERT INTO
                    users
                SET
                    fname=:fname,
                    lname=:lname,
                    login=:login,
                    mobile_phone=:mobile_phone,
                    personal_id=:personal_id,
                    licence_plate=:licence_plate,
                    password_hash=:password_hash
          ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":fname", $fname);
        $stmt->bindParam(":lname", $lname);
        $stmt->bindParam(":login", $login);
        $stmt->bindParam(":mobile_phone", $mobile_phone);
        $stmt->bindParam(":licence_plate", $licence_plate);
        $stmt->bindParam(":personal_id", $personal_id);
        $stmt->bindParam(":password_hash", $password_hash);
        $stmt->execute();
    }
    public function createBooking($time_from, $time_till, $user_id, $place_id)
    {
        $sql = "
                INSERT INTO
                    bookings
                SET
                    time_from=:time_from,
                    time_till=:time_till,
                    user_id=:user_id,
                    place_id=:place_id
          ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":time_from", $time_from);
        $stmt->bindParam(":time_till", $time_till);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":place_id", $place_id);
        $stmt->execute();
    }

    public function deleteBooking($booking_id)
    {
        $sql = "DELETE from bookings WHERE id:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $booking_id);
        $stmt->execute();
    }

    public function getPlaces()
    {
        $sql = "SELECT parking_places.id, is_occupied, parking_places.user_id, users.login, users.licence_plate FROM parking_places LEFT JOIN users ON parking_places.user_id = users.id";
        // $sql = "SELECT * FROM parking_places LEFT JOIN users ON parking_places.user_id = users.id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function getUsersByEmail($mail)
    {
        $stmt = $this->db->prepare("SELECT login FROM users WHERE login=:mail");

        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getUserByEmail($mail)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE login=:mail");

        $stmt->bindParam(':mail', $mail);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetch();
    }

    public function getBookingsByUserId($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM bookings WHERE user_id=:userId");

        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    public function getBookingById($booking_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM bookings WHERE id=:booking_id");

        $stmt->bindParam(":booking_id", $booking_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function updateBooking($time_from, $time_till, $user_id, $place_id, $booking_id)
    {
        $sql = "
                UPDATE
                    bookings
                SET
                    time_from=:time_from,
                    time_till=:time_till,
                    user_id=:user_id,
                    place_id=:place_id
                WHERE
                    id=:booking_id 
          ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":time_from", $time_from);
        $stmt->bindParam(":time_till", $time_till);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":place_id", $place_id);
        $stmt->bindParam(":booking_id", $booking_id);
        $stmt->execute();
    }
}
