<?php
require_once 'Customer.class.php';

class CustomerManager {
    private $dataFile = 'customers.json';
    private $customers = [];

    public function __construct() {
        if (file_exists($this->dataFile)) {
            $data = json_decode(file_get_contents($this->dataFile), true);
            if ($data) {
                $this->customers = $data;
            }
        }
    }

    private function saveData() {
        file_put_contents($this->dataFile, json_encode($this->customers, JSON_PRETTY_PRINT));
    }

    public function tambahCustomer($nama, $email, $telepon, $alamat) {
        $id = uniqid();
        $customer = new Customer($id, $nama, $email, $telepon, $alamat);
        $this->customers[] = $customer->toArray();
        $this->saveData();
        return $id;
    }

    public function getCustomers() {
        return $this->customers;
    }

    public function hapusCustomer($id) {
        $this->customers = array_filter($this->customers, function($customer) use ($id) {
            return $customer['id'] !== $id;
        });
        $this->saveData();
    }

    public function getCustomerById($id) {
        foreach ($this->customers as $customer) {
            if ($customer['id'] === $id) {
                return $customer;
            }
        }
        return null;
    }
}
