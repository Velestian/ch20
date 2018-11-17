<?php
function get_categories() {
    global $db;
    $query = 'SELECT * FROM categories
              ORDER BY categoryID';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function get_category($category_id) {
    global $db;
    $query = 'SELECT * FROM categories
              WHERE categoryID = :category_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function delete_category($category_id) {
    global $db;
    $query = 'DELETE FROM categories
              WHERE categoryID = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_category($category_name) {
    global $db;
    $query = 'INSERT INTO categories
                 (categoryName)
              VALUES
                 (:categoryName)';
    $statement = $db->prepare($query);
    $statement->bindValue(':categoryName', $category_name);
    $statement->execute();
    $statement->closeCursor();
}

function count_products($category_id)    {
    global $db;
    $query = 'SELECT COUNT(productID)
                FROM products
                WHERE categoryID = :category_id';
        $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result[0];
}
?>