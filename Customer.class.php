<?php
class Customer {
    private $id;
    private $nama;
    private $email;
    private $telepon;
    private $alamat;

    public function __construct($id, $nama, $email, $telepon, $alamat) {
        $this->id = $id;
        $this->nama = $nama;
        $this->email = $email;
        $this->telepon = $telepon;
        $this->alamat = $alamat;
    }

    public function getId() {
        return $this->id;
    }

    public function getNama() {
        return $this->nama;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelepon() {
        return $this->telepon;
    }

    public function getAlamat() {
        return $this->alamat;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'email' => $this->email,
            'telepon' => $this->telepon,
            'alamat' => $this->alamat
        ];
    }
}
