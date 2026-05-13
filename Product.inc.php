<?php
// Base Class demonstrating Encapsulation
class Product {
    // Private properties: cannot be directly accessed outside the class
    private $sku;
    private $name;
    private $price;
    private $stock;
    private $category;
    private $description;

    public function __construct($sku, $name, $price, $stock, $category, $description) {
        $this->sku         = $sku;
        $this->name        = $name;
        $this->price       = $price;
        $this->stock       = $stock;
        $this->category    = $category;
        $this->description = $description;
    }

    // Magic Getter: Safely read private properties
    public function __get($name) {
        return $this->$name;
    }

    // Magic Setter: Safely update properties with validation
    public function __set($name, $value) {
        if ($name === 'price' && $value < 0) {
            $this->price = 0; // Prevent negative prices
        } elseif ($name === 'stock' && $value < 0) {
            $this->stock = 0; // Prevent negative stock
        } else {
            $this->$name = $value;
        }
    }

    // Magic String Method: Replaces a getSummary() function
    public function __toString() {
        return $this->name . " (" . $this->sku . ") - ₱" . number_format($this->price, 2) . " | Stock: " . $this->stock . " [" . $this->category . "]";
    }

    // Check if item is in stock
    public function isAvailable() {
        return $this->stock > 0;
    }

    // Reduce stock after a sale
    public function deductStock($qty) {
        if ($qty > $this->stock) return false;
        $this->stock -= $qty;
        return true;
    }
}

// Inheritance: Child classes extending the base Product class

class FlowerProduct extends Product {
    public function __construct($sku, $name, $price, $stock) {
        parent::__construct($sku, $name, $price, $stock, "Flowers", "Fresh cut flowers");
    }
}

class ArrangementProduct extends Product {
    public function __construct($sku, $name, $price, $stock) {
        parent::__construct($sku, $name, $price, $stock, "Arrangements", "Custom flower arrangement");
    }
}

class PlantProduct extends Product {
    public function __construct($sku, $name, $price, $stock) {
        parent::__construct($sku, $name, $price, $stock, "Plants", "Live potted plant");
    }
}

class AccessoryProduct extends Product {
    public function __construct($sku, $name, $price, $stock) {
        parent::__construct($sku, $name, $price, $stock, "Accessories", "Vases, ribbons, and add-ons");
    }
}
?>