<?php

require_once __DIR__ . '/functions.php';
sessionStart();

class Panier
{

    private $DB;
    public function __construct($DB)
    {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }
        $this->DB = $DB;
        if (isset($_GET['delPanier'])) {
            $this->del($_GET['delPanier']);
        }
        if (isset($_POST['panier']['quantity'])) {
            $this->recalc();
        }
    }

    /**
     * fonction pour recalculer le panier
     */
    public function recalc()
    {
        foreach ($_SESSION['panier'] as $product_id => $quantity) {
            if (isset($_POST['panier']['quantity'][$product_id])) {
                $_SESSION['panier'][$product_id] = $_POST['panier']['quantity'][$product_id];
            }
        }
    }

    /**
     * Nombre d'elements dans le panier
     */
    public function countPanier()
    {
        return array_sum($_SESSION['panier']);
    }

    /**
     *
     */
    public function total()
    {

        $total = 0;
        $ids = array_keys($_SESSION['panier']);

        if (empty($ids)) {
            $products = [];
        } else {
            $products = $this->DB->query('SELECT id, price FROM product WHERE id IN (' . implode(',', $ids) . ')');
        }
        foreach ($products as $product) {
            $total += $product->price * $_SESSION['panier'][$product->id];
        }

        return $total;
    }
    /**
     * Ajoute un produit
     * Il verifie la session dans le panier:
     * -> S'il y a déja un produit avec le meme id: il rajoute 1 à la quantité du produit
     * -> Si c'est un nouveau produit dans le panier: il défini à 1 la quantité de ce produit
     */
    public function add($product_id)
    {
        $_SESSION['panier'][$product_id] = ($_SESSION['panier'][$product_id] ?? 0) + 1;
    }

    /**
     * @param int $productId
     * @return bool
     */
    public function checkProduct($productId)
    {
        return isset($_SESSION['panier'][$productId]);
    }

    public function del($product_id)
    {
        unset($_SESSION['panier'][$product_id]);
    }

    public function getPrixCoupon()
    {
        // il verifie que on a mis un code dans le input
        $couponCode = $_POST['code_coupon'] ?? '';
        // si c'est vide, message
        if (empty($couponCode)) {
            unset($_SESSION['panier_reduc']);
            return '';
        }
        // il verifie que le coupon existe dans la base de donnée
        $coupon = $this->DB->query("SELECT product_id, price_reduc from coupon where code = :code", [
            ':code' => $couponCode
        ]);
        // si le coupon existe pas, il renvoie null
        $coupon = $coupon[0] ?? null;
        if ($coupon === null) {
            return 'coupon invalide';
        }
        // il verifie que le coupon est lier au produit
        $productId = $coupon->product_id;
        if ($productId === null) {
            $_SESSION['panier_reduc'] = $coupon;
            return $coupon;
        }

        // requete qui vérifie que le produit exite
        $product = $this->DB->query('SELECT id FROM product WHERE id = :id', [
            ':id' => $productId
        ]);
        // si le produit n'existe pas, il renvoit null
        $product = $product[0] ?? null;
        if ($product === null || !$this->checkProduct($product->id)) {
            return 'produit invalide';
        }

        $_SESSION['panier_reduc'] = $coupon;
        return $coupon;
    }

    public function affichePrixCouponExiste()
    {
        $coupon = $_SESSION['panier_reduc'] ?? '';
        if (is_string($coupon)) {
            return $coupon;
        }

        return $coupon->price_reduc . ' €';
    }
}
