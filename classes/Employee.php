<?php
class Employee {
    private $db;
    private $link;

    public function __construct() {
        $this->db = new Database();
        $this->link = $this->db->getLink();
    }

    public function addEmployee($name, $department, $role, $contact) {
        $query = "INSERT INTO employees (name, department, role, contact) VALUES (?, ?, ?, ?)";
        if($stmt = mysqli_prepare($this->link, $query)){
            mysqli_stmt_bind_param($stmt, "ssss", $name, $department, $role, $contact);
            if(mysqli_stmt_execute($stmt)){
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function editEmployee($id, $name, $department, $role, $contact) {
        $query = "UPDATE employees SET name = ?, department = ?, role = ?, contact = ? WHERE id = ?";
        if($stmt = mysqli_prepare($this->link, $query)){
            mysqli_stmt_bind_param($stmt, "ssssi", $name, $department, $role, $contact, $id);
            if(mysqli_stmt_execute($stmt)){
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function deleteEmployee($id) {
        $query = "DELETE FROM employees WHERE id = ?";
        if($stmt = mysqli_prepare($this->link, $query)){
            mysqli_stmt_bind_param($stmt, "i", $id);
            if(mysqli_stmt_execute($stmt)){
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function viewEmployees() {
        $query = "SELECT * FROM employees";
        $result = mysqli_query($this->link, $query);
        return $result;
    }

    public function searchEmployees($criteria) {
        $query = "SELECT * FROM employees WHERE name LIKE ? OR department LIKE ? OR role LIKE ?";
        if($stmt = mysqli_prepare($this->link, $query)){
            $param = "%" . $criteria . "%";
            mysqli_stmt_bind_param($stmt, "sss", $param, $param, $param);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            return $result;
        }
        return false;
    }
}
?>
