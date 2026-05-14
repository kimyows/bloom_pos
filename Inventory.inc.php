<?php

function putonsale(mysqli $conn, string $sku, string $discount_id): bool {
    $stmt = $conn->prepare("UPDATE inventory SET discount_id = ? WHERE sku = ?");
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("ss", $discount_id, $sku);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function takeofsale(mysqli $conn, string $sku): bool {
    $stmt = $conn->prepare("UPDATE inventory SET discount_id = NULL WHERE sku = ?");
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("s", $sku);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

?>