<?php
class Order{
    public $invoiceNum;
    public array $productList;
    public $total;

    function __construct($invoiceNum,$products)
    {
       
        $this->invoiceNum = $invoiceNum;
        $this->productList = $products;
        $this->total = 0;
        return true;
    }

    public function addProduct($product)
    {
        foreach($this->productList as $item)
        {
            if($item['name'] == $product['name'])
            {
                $this->removeProduct($item);
            }
        }
        $this->productList[]=$product;
        return true;
    }

    public function removeProduct($product)
    {
        foreach($this->productList as $item)
        {
            if($item['name'] == $product['name'])
            {
                array_splice($this->productList,array_search($item,$this->productList),1);
                break;
            }
        }
        return true;
       
    }

    public function getTotal()
    {
        $sum=0;
        $total =0;
        foreach($this->productList as $item)
        {
            $sum = intval($item['price']) * intval($item['qty']);
            $total += $sum;
        } 
        return $total;
    }

}


?>